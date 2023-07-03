<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeSalary;
use App\Location;
use App\Department;
use App\Employee;
use App\User;
use App\EmployeeLeave;
use App\EmpPunishment;
use App\EmployeeAward;
use App\Http\Requests\StoreSalary;
use Illuminate\Support\Facades\DB;
use App\Notifications\SlipPaid;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use Spatie\Permission\Models\Permission;

class EmployeeSalaryController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
  */
  public function __construct()
  {
      $this->middleware(['permission:Pay_Salary|دفع_راتب'],['only'=>['create','edit']]);
  }

  public function index()
  {

    $permission_1 =  Permission::select("name->".\App::getLocale())->where('name->ar','رواتب_الموظف')->first();
    $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

if(isset(Auth::user()->employee->id)){
   if(auth()->user()->can($permission_1)) {

        $Salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->where('Employees.id',Auth::user()->employee->id)
        ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
        ->orderby('Employee_Salary.id','desc')
        ->get();

   }
   elseif(auth()->user()->can($permission_2)){

    $Salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
    ->where('Employees.Deleted_at',null)
    ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)
    ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
    ->orderby('Employee_Salary.id','desc')
    ->get();

    }

  else{

    $Salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
    ->where('Employees.Deleted_at',null)
    ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
    ->orderby('Employee_Salary.id','desc')
    ->get();

    }
}
else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }

    return view('pages.Paying.Employee_Salary', compact('Salaries'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $Locations = Location::all();
    return view('pages.Paying.Pay_salary', compact('Locations'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreSalary $request)
  {
    DB::beginTransaction();

     try {
        $validated = $request->validated();
        $Salary = new EmployeeSalary();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

    if(isset(Auth::user()->employee->id)){
        if(auth()->user()->can($permission)){

                    $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                    $Employee_loc = (int)$request->location_id;
                    if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
                        toastr()->error(trans('messages.add_Salary_Employee_In_Loc_Permission'));
                        return redirect()->route('employeesalary.index');
                      }
            }
            if(auth()->user()->can($permission_2)){
                $Employee = $request->employee_id;
                if ($Employee == Auth::user()->employee->id) {
                    toastr()->error(trans('messages.HR_Add_Permission'));
                    return  redirect()->route('employeesalary.index');
                }
            }
        }
        else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }

        $Salary->Employee_Id = $request->employee_id;
        $Salary->Taxes = $request->taxes;
        $Salary->Insurance = $request->insurance;
        $Salary->Bonus = $request->Bonus;

        $Emp_Id = $request->employee_id;

        $Employee = Employee::findOrfail($Emp_Id)->first();


        $f = new Carbon($request->From);
        $t = new Carbon($request->To);

        $Emp_salary = EmployeeSalary::where('Employee_Id', $Emp_Id)
        ->whereBetween('created_at', [$f, $t])
        ->get();


        if ($Emp_salary->count() !== 0) {
            toastr()->error(trans('messages.Error_Salary'));
            return redirect()->route('employeesalary.index');
        }

        $advances = $Employee->advancePayments;

        if ($advances) {

        $sum_Advances =0;
        foreach( $advances as $advancePayment) {
            $sum_Advances =  $sum_Advances + $advancePayment->Advance_Amount;
        }

       }
        $emp_salary =Employee::where('id', $Emp_Id)->first()->Salary;

        $Salary->Sum_Advances = $sum_Advances;
        $Bonus = ($emp_salary * $request->Bonus)/100;
        $taxes = ($emp_salary * $request->taxes)/100;
        $insurance = ($emp_salary * $request->insurance)/100;

        $Salary_count_taxes = $emp_salary + $Bonus - $taxes - $insurance ;

        $Salary->Start_Date = $request->From;
        $Salary->End_Date = $request->To;

        $fdate = $request->From;
        $tdate = $request->To;
        $datetime1 = new Carbon($fdate);
        $datetime2 = new Carbon($tdate);
        $interval = $datetime1->diff($datetime2);

        $diff = (int) $interval->format('%a');

        $Emp = Employee::findOrfail($Emp_Id);
        $CountLeaves = $Emp->leaves()->whereBetween('Employee_Leaves.created_at',[$fdate, $tdate])->where('Employee_Leaves.Status',1)->select('Employee_Leaves.TotalDays')->get();
        $days = 0;
        foreach($CountLeaves as $leave) {
          $total = $leave->TotalDays;
          $days = $days + $total;
        }


        $CountAbsents = $Employee->attendances()->whereBetween('attendance_date',[$fdate, $tdate])->where('attendance_status',0)->get();
        $Absents = $CountAbsents->Count();

        $Sum_Absents_Amount = ($days + $Absents)*($emp_salary /$diff);


        $CountPunishments = EmpPunishment::join('punishments','Employee_Punishments.Punishment_Id','=','punishments.id')->where('Employee_Punishments.Employee_Id',$Emp_Id)->whereBetween('Employee_Punishments.created_at',[$fdate, $tdate])->select('punishments.Deducted_Amount')->get();
        $PunishmentsAmount = 0;
        foreach($CountPunishments as $punishment) {
          $total = $punishment->Deducted_Amount;
          $PunishmentsAmount = $PunishmentsAmount + $total;
        }


        $CountAwards = $Employee->awards()->whereBetween('Employee_Awards.created_at',[$fdate, $tdate])->select('Cash_Prize')->get();
        $AwardsAmount = 0;
        foreach($CountAwards as $award) {
          $total = $award->Cash_Prize;
          $AwardsAmount = $AwardsAmount + $total;
        }

        $Salary->Total = $Salary_count_taxes - $sum_Advances - $Sum_Absents_Amount - $PunishmentsAmount + $AwardsAmount  ;
        $Salary->save();

        //  $slip_id = EmployeeSalary::latest()->first()->id;
        //  Employee::FindOrFail($Emp_Id)->notify(new SlipPaid($slip_id));
        $Employee = Employee::findOrfail($Emp_Id);
        $user = $Employee->user;
        $slip_id = EmployeeSalary::latest()->first()->id;
        Notification::send($user, new \App\Notifications\SlipPaid($slip_id));

         DB::commit(); // insert data



        toastr()->success(trans('messages.Success'));
        return redirect()->route('employeesalary.index');



   }catch (\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

 }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
    $Salary = EmployeeSalary::findOrFail($id);

    if(auth()->user()->can($permission)){

        if(isset(Auth::user()->employee->id)){
                $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                $Employee= $Salary->Employee_Id;
                $Employee_loc = Employee::where('id',$Employee)->first();

                if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                    toastr()->error(trans('messages.Loc_Permission'));
                    return redirect()->back();
                  }
        }
        else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }
    }
    $Locations = Location::all();
    return view('pages.Paying.Edit_Pay_salary',compact('Salary','Locations'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreSalary $request ,$id)
  {
    DB::beginTransaction();

     try {
        $validated = $request->validated();
        $Salary = EmployeeSalary::find($id);

        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

        if(isset(Auth::user()->employee->id)){
            if(auth()->user()->can($permission_2)){
                $Employee= $Salary->Employee_Id;
                if ($Employee == Auth::user()->employee->id) {
                    toastr()->error(trans('messages.HR_Permission'));
                    return  redirect()->route('employeesalary.index');
                }
            }
        }
        else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }


        $Salary->Employee_Id = $request->employee_id;
        $Salary->Taxes = $request->taxes;
        $Salary->Insurance = $request->insurance;
        $Salary->Bonus = $request->Bonus;

        $Emp_Id = $request->employee_id;
        $Employee = Employee::findOrfail($Emp_Id)->first();

        $f = new Carbon($request->From);
        $t = new Carbon($request->To);

        $Emp_salary = EmployeeSalary::where('Employee_Id', $Emp_Id)
        ->whereBetween('created_at', [$f, $t])
        ->get();


        if ($Emp_salary->count() !== 0) {
            toastr()->error(trans('messages.Error_Salary'));
            return redirect()->route('employeesalary.index');
        }


        $emp_salary =Employee::where('id', $Emp_Id)->first()->Salary;
        $Salary->Sum_Advances =$request->Sum_Advances;

        $Bonus = ($emp_salary * $request->Bonus)/100;
        $taxes = ($emp_salary * $request->taxes)/100;
        $insurance = ($emp_salary * $request->insurance)/100;

        $Salary_count_taxes = $emp_salary + $Bonus - $taxes - $insurance ;


        $fdate = $request->From;
        $tdate = $request->To;
        $datetime1 = new Carbon($fdate);
        $datetime2 = new Carbon($tdate);
        $interval = $datetime1->diff($datetime2);

        $diff = (int) $interval->format('%a');


        $Emp = Employee::findOrfail($Emp_Id);
        $CountLeaves = $Emp->leaves()->whereBetween('Employee_Leaves.created_at',[$fdate, $tdate])->where('Employee_Leaves.Status',1)->select('Employee_Leaves.TotalDays')->get();
        $days = 0;
        foreach($CountLeaves as $leave) {
          $total = $leave->TotalDays;
          $days = $days + $total;
        }
        $CountAbsents = $Employee->attendances()->whereBetween('attendance_date',[$fdate, $tdate])->where('attendance_status',0)->get();
        $Absents = $CountAbsents->Count();

        $Sum_Absents_Amount = ($days + $Absents) * ($emp_salary/$diff);


        $CountPunishments = EmpPunishment::join('punishments','Employee_Punishments.Punishment_Id','=','punishments.id')->where('Employee_Punishments.Employee_Id',$Emp_Id)->whereBetween('Employee_Punishments.created_at',[$fdate, $tdate])->select('punishments.Deducted_Amount')->get();
        $PunishmentsAmount = 0;
        foreach($CountPunishments as $punishment) {
          $total = $punishment->Deducted_Amount;
          $PunishmentsAmount = $PunishmentsAmount + $total;
        }

        $CountAwards = $Employee->awards()->whereBetween('Employee_Awards.created_at',[$fdate, $tdate])->select('Cash_Prize')->get();
        $AwardsAmount = 0;
        foreach($CountAwards as $award) {
          $total = $award->Cash_Prize;
          $AwardsAmount = $AwardsAmount + $total;
        }


        $Salary->Total = $Salary_count_taxes - $request->Sum_Advances - $Sum_Absents_Amount - $PunishmentsAmount + $AwardsAmount;

        $Salary->Start_Date = $request->From;
        $Salary->End_Date = $request->To;


        $Salary->save();

         DB::commit(); // insert data
        toastr()->success(trans('messages.Success'));
        return redirect()->route('employeesalary.index');



   }catch (\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */

  public function delete_all(Request $request)
  {
      $delete_all_id = explode(",", $request->delete_all_id);


      $Salaries = EmployeeSalary::whereIn('id', $delete_all_id)->get();

      $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
      $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

      if (Auth::user()->employee->id) {
      if(auth()->user()->can($permission)){
       $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
       foreach ($Salaries as $salary) {
        if ((int)$salary->employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
          toastr()->error(trans('messages.Loc_Permissions'));
          return redirect()->route('employeesalary.index');
          }
        }
      }
      if(auth()->user()->can($permission_2)){
        foreach($Salaries as $salary) {
            if ((int)$salary->employee->id == Auth::user()->employee->id ) {
              toastr()->error(trans('messages.HR_Permission'));
              return redirect()->route('employeesalary.index');
          }
        }
    }
      }
      else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }

    EmployeeSalary::whereIn('id', $delete_all_id)->Delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('employeesalary.index');
  }
  public function destroy(Request $request)
  {
    $Salary = EmployeeSalary::findOrFail($request->id);
    $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

    if(auth()->user()->can($permission_2)){

                         if ($Salary->Employee_Id == Auth::user()->employee->id) {

                             toastr()->error(trans('messages.HR_Permission'));
                             return  redirect()->route('employeesalary.index');

                         }
                     }
    $Salary->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('employeesalary.index');
  }

  public function getDepartments($id)
  {
    $departments = Department::join("Department_Location", "Department_Location.Department_Id", "=", "Departments.id")
    ->where("Department_Location.Location_Id","=",(int)$id)
    ->select("Departments.Name as Name","Departments.id as id")->get()
    ->pluck('Name','id');

    return $departments;
  }
  public function getEmployees($id,$loc)
  {
    $list_employees = Employee::select(DB::raw("CONCAT(FName,' ',LName,' - ',Code) AS Name"),'id')
    ->where("Department_Id", $id)->where("Location_Id",$loc)
    ->get()
    ->pluck("Name", "id");
     return $list_employees;
  }
  public function Print_Slip($id)
  {

      $EmployeeSalary = EmployeeSalary::where('id', $id)->first();

      $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

      if(auth()->user()->can($permission)){

          if(isset(Auth::user()->employee->id)){
                  $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                  $Employee= $EmployeeSalary->Employee_Id;
                  $Employee_loc = Employee::where('id',$Employee)->first();

                  if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                      toastr()->error(trans('messages.Loc_Slip_Permission'));
                      return redirect()->back();
                    }
          }
          else{
              toastr()->error(trans('messages.You_Are_Not_Employee'));
              return redirect()->back();
          }
      }
      return view('pages.Paying.Print_Slip',compact('EmployeeSalary'));
  }

}

?>
