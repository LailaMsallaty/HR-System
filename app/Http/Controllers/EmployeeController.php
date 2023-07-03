<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\Department;
use App\Nationality;
use App\Location;
use App\Position;
use App\Attachment;
use App\DepartmentLocation;
use App\AdvancePayment;
use App\EmployeeDegree;
use App\User;
use Carbon\Carbon;
use PDF;
use App\Http\Requests\StoreEmployees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use App\Exports\EmployeesExport;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Illuminate\Support\Facades\Input;


class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Manage_Employees|إدارة_الموظفين'],['except' => ['show','Download_attachment','showAttachment','upload_personal_photo']]);
    }


    public function export()
    {
        return Excel::download(new EmployeesExport, 'Employees.xlsx');
    }

    public function upload_personal_photo(Request $request){

        try {


        $Employee = Employee::findOrFail($request->id);

        $file = $request->file('photo');
        if($file)
          {
              if(File::exists(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))){

                  File::delete(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName));
              }
                  $name = $file->getClientOriginalName();
                  $Employee->ImageName = $name;
                  $file->storeAs('attachments/employees/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

          }else{

              $Employee->ImageName ='385-3856300_no-avatar-png.png';
            }

      $Employee->save();

      toastr()->success(trans('messages.Success'));
      return redirect()->route('employee.show');



   }catch (\Exception $e){
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}

    }

  public function index()
  {
    $Departments = Department::all();
    $Nationalities = Nationality::all();
    $Degrees = EmployeeDegree::all();
    $positions = Position::all();
    $Employees = Employee::orderBy('id', 'DESC')->get();
    $Locations = Location::all();
    return view('pages.Employees.Employees', compact('Locations','Departments','Employees','positions','Nationalities','Degrees'));

  }


  public function create()
  {
    $Departments = Department::all();
    $Nationalities = Nationality::all();
    $Degrees = EmployeeDegree::all();

    return view('pages.Employees.Create',compact('Departments','Nationalities','Degrees'));


  }


  public function store(StoreEmployees $request)
  {
    DB::beginTransaction();

    try {


        $validated = $request->validated();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)){
            if(isset(Auth::user()->employee->id)){
                    $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                    $Employee_loc = (int)$request->location_id;
                    if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
                        toastr()->error(trans('messages.add_Employee_In_Loc_Permission'));
                        return redirect()->back();
                      }
            }
        }

        $Employee = new Employee();


        $Employee->FName = $request->FName;
        $Employee->LName = $request->LName;
        $Employee->BirthDate = $request->BirthDate;
        $Employee->email = $request->Email;
        $Employee->Code = $request->Code;
        $Employee->Degree_Id = $request->Degree;
        $Employee->Skills = $request->Skills;



        if ($request->Gender == "أنثى" || $request->Gender == "Female" ) {
            $Employee->Gender  =['ar' => 'أنثى', 'en' => 'Female'];
        }
        elseif ($request->Gender == "ذكر" || $request->Gender == "Male" ) {
            $Employee->Gender  =['ar' => 'ذكر', 'en' => 'Male'];
        }
        // $Employee->Gender = $request->Gender;
        $Employee->HireDate = $request->HireDate;
        $Employee->Address = $request->Address;
        $Employee->Number = $request->Number;
        $Employee->Location_Id = $request->location_id;


        if ($request->Trainee == "نعم" || $request->Trainee == "Yes" ) {
            $Employee->Trainee  =['ar' => 'نعم', 'en' => 'Yes'];
        }
        else if ($request->Trainee == "لا" || $request->Trainee == "No" ) {
            $Employee->Trainee  =['ar' => 'لا', 'en' => 'No'];
        }

        // $Employee->Trainee = $request->Trainee;
        $Employee->Years_Of_Experience = $request->YearsOfExp;
        $Employee->Department_Id = $request->employee_department;
        $Employee->Nationality_Employee_id = $request->Nationality;

        $Department_Location_Manager = DepartmentLocation::where('Department_Id',$request->employee_department)
        ->where('Location_Id', $request->location_id)->first();


        if($request->Status == true && $Department_Location_Manager->Manager_Id == null) {
            $Employee->Manager = 1;
            $Department_Location_Manager->Manager_Id = $Employee->id;
            $Department_Location_Manager->save();
          } else {
            $Employee->Manager = 0;

          }

          $file = $request->file('photo');
          if($file)
            {
                if(File::exists(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))){

                    File::delete(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName));
                }
                    $name = $file->getClientOriginalName();
                    $Employee->ImageName = $name;
                    $file->storeAs('attachments/employees/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

            }else{

                $Employee->ImageName ='385-3856300_no-avatar-png.png';
              }

        $Employee->save();

        $user_emp = User::where('email',$Employee->email)->get()->first();
        if(!isset($user_emp))
        { $user = new User();
        $user->name = $request->FName.' '.$request->LName;
        $user->email = $request->Email;
        $user->Employee_Id = $Employee->id;
        $user->save();
        }else{
        $user_emp->name = $request->FName.' '.$request->LName;
        $user_emp->Employee_Id = $Employee->id;
        $user_emp->save();

        }

        $Dep_manager = Role::where('name->en','Department Manager')->first();
        if ($Employee->Manager == 1) {
            $Employee->user->assignRole($Dep_manager);
        }

        $Employee->positions()->attach($request->position_id);

        $emp =Employee::where('id',$Employee->id)->first()->Salary;

        foreach ($Employee->positions as $position ) {

          $emp = $emp + $position->Salary;

          }
        $Employee->Salary = $emp;

        $Employee->save();

         DB::commit(); // insert data
        toastr()->success(trans('messages.Success'));
        return redirect()->route('employee.index');



   }catch (\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}


  public function show($id)
  {

    $Employee = Employee::find($id);


    $positions = $Employee->positions;

     return view('pages.Employees.Show',compact('Employee','positions'));

  }



  public function edit($id)
  {
    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
    $Departments = Department::all();
    $Nationalities = Nationality::all();
    $positions = Position::all();
    $Degrees = EmployeeDegree::all();
    $Employee = Employee::findOrFail($id);

    if(auth()->user()->can($permission)){
        if(isset(Auth::user()->employee->id)){

      $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
      $Employee_loc = Employee::where('id',$id)->first();

   if ((int)$Employee_loc->Location_Id  !==  (int)$User_loc->Location_Id ) {

        toastr()->error(trans('messages.Loc_Permission'));
        return redirect()->back();

      }
    }
    else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }
    }
    return view('pages.Employees.Edit',compact('Departments','positions','Nationalities','Employee','Degrees'));
  // dd($Employee->department->locations);

  }

  public function Show_Pay_Advance($id)
  {
    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
    $Employee = Employee::findOrFail($id);

    if(auth()->user()->can($permission)){
        if(isset(Auth::user()->employee->id)){

      $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
      $Employee_loc = (int)$Employee->Location_Id;

      if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permission'));
        return redirect()->back();
      }
    }
    else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }
    }
    return view('pages.Paying.Pay_Advance',compact('Employee'));

  }

  public function editAdvance($id,$empId)
  {
   $AdvancePayment = AdvancePayment::findOrFail($id);
   $Employee = Employee::findOrFail($empId);

   $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

   if(auth()->user()->can($permission)){
    if(isset(Auth::user()->employee->id)){

     $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
     $Employee_loc = (int)$Employee->Location_Id;

     if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
       toastr()->error(trans('messages.Loc_Permission'));
       return redirect()->back();
     }
    }
    else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }
   }
    return view('pages.Paying.Edit_Advance',compact('AdvancePayment','Employee'));

  }

  public function update_Advance(Request $request)
  {

    DB::beginTransaction();
    try {


    $Employee = Employee::findOrFail($request->empid);
    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

    if(auth()->user()->can($permission)){

        if(isset(Auth::user()->employee->id)){
      $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
      $Employee_loc = (int)$Employee->Location_Id;

      if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permission'));
        return redirect()->back();
      }
}
else{
    toastr()->error(trans('messages.You_Are_Not_Employee'));
    return redirect()->back();
}
    }

    $AdvancePayment = AdvancePayment::findOrFail($request->id);

    $AdvancePayment->Previous_Salary = $request->previous_salary;
    $AdvancePayment->Employee_id = $request->empid;
    $AdvancePayment->Statement = $request->statement;

    if (count($Employee->advancePayments) != 0) {
        $advanceAmount = 0;
       foreach ($Employee->advancePayments as $advance) {
           $advanceAmount = $advanceAmount + $advance->Advance_Amount;
       }
       $advanceAmount = $advanceAmount - $AdvancePayment->Advance_Amount  ;
       $AdvancePayment->Remaining_Amount = $request->previous_salary - $advanceAmount - $request->advance ;

        }
   else $AdvancePayment->Remaining_Amount = $request->previous_salary - $request->advance ;

   $AdvancePayment->Advance_Amount = $request->advance;
   $AdvancePayment->save();

    DB::commit(); // insert data
    toastr()->success(trans('messages.Success'));
    return redirect()->route('employee.show',$Employee->id);
}

catch (\Exception $e){
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}

  }
  public function delete_Advance(Request $request)
  {

    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
    $AdvancePayment = AdvancePayment::findOrFail($request->id);

    $Employee = Employee::where('id',$AdvancePayment->Employee_Id)->first();

    if(auth()->user()->can($permission)){

    if(isset(Auth::user()->employee->id)){
      $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
      $Employee_loc = $Employee->Location_Id;

      if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permission'));
        return redirect()->back();
      }
     }
     else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }
    }
    $AdvancePayment = AdvancePayment::findOrFail($request->id);
    $AdvancePayment->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->back();

  }

  public function Pay_Advance(Request $request)
  {
    DB::beginTransaction();
    try {

    $Employee = Employee::findOrFail($request->id);

    $AdvancePayment = new AdvancePayment();

    $AdvancePayment->Previous_Salary = $request->previous_salary;
    $AdvancePayment->Employee_id = $request->id;
    $AdvancePayment->Advance_Amount = $request->advance;
    $AdvancePayment->Statement = $request->statement;

    if (count($Employee->advancePayments) != 0) {
        $advanceAmount = 0;
       foreach ($Employee->advancePayments as $advance) {
           $advanceAmount = $advanceAmount + $advance->Advance_Amount;
       }
       $AdvancePayment->Remaining_Amount = $request->previous_salary - $advanceAmount - $request->advance ;

    }
   else $AdvancePayment->Remaining_Amount = $request->previous_salary - $request->advance ;

    $AdvancePayment->save();

    DB::commit(); // insert data
    toastr()->success(trans('messages.Success'));
    return redirect()->route('employee.show',$Employee->id);
}

catch (\Exception $e){
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}



  }


 public function View_Advances()
{
    $advances = AdvancePayment::orderBy('id', 'DESC')->get();
    $locations =Location::all();
    return view('pages.Paying.View_Advance_Payments',compact('advances','locations'));

}

public function makeReport(Request $request){

    $this->validate($request,[
        'From' => 'required',
        'To'   => 'required',
        'Location'=>'required'
    ]);

    $date_from = $request->input('From');
    $date_to = $request->input('To');


    /**
     *  employees between two dates
     */
    if ($request->Location == 0) {
        $advances = AdvancePayment::whereBetween('created_at' ,[new Carbon($date_from),new Carbon($date_to)])->orderBy('Advance_Payments.id', 'DESC')->get();

    }
    else{
    $advances = AdvancePayment::join('Employees','Advance_Payments.Employee_Id','=','Employees.id')
    ->where('Employees.Location_Id','=',$request->Location)->orderBy('Advance_Payments.id', 'DESC')
    ->whereBetween('Advance_Payments.created_at' ,[new Carbon($date_from),new Carbon($date_to)])->get();
    }
    //generate pdf


if ($_POST['action'] == 'report') {
    $pdf = PDF::loadView('pages.Paying.AdvancesReport',['advances' => $advances,'from'=>$date_from,'to'=>$date_to  ],[],
    [ 'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'xL',
    'default_font' => 'sans-serif',
    'display_mode'  => 'fullpage',
    'margin_left'   => 60,

  ]);
  return $pdf->stream('Employees_Advances_report_from_'.$date_from.'_to_'.$date_to.'.pdf');
}else{

  $locations = Location::all();

  return view('pages.Paying.View_Advance_Payments',compact('advances','locations'));

}
}

public function delete_all_AdvancePayments(Request $request)
{


    $delete_all_id = explode(",", $request->delete_all_id);

    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

    $Advances = AdvancePayment::whereIn('id', $delete_all_id)->get();

    if(auth()->user()->can($permission)){
       if (Auth::user()->employee->id) {
     $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
     foreach ($Advances as $advance) {
      if ((int)$advance->employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permissions'));
        return redirect()->route('View_Advances');
       }
      }
    }
    else{
      toastr()->error(trans('messages.You_Are_Not_Employee'));
      return redirect()->back();
  }
    }


    $Advances->Delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('View_Advances');
}

  public function update(StoreEmployees $request)
  {
    DB::beginTransaction();

    try {
        $validated = $request->validated();
        $Employee = Employee::findOrFail($request->id);

        $Employee->FName = $request->FName;
        $Employee->LName = $request->LName;
        $Employee->BirthDate = $request->BirthDate;
        $Employee->email = $request->Email;
        $Employee->Number = $request->Number;
        $Employee->Location_Id = $request->location_id;
        $Employee->Code = $request->Code;
        $Employee->Degree_Id = $request->Degree;
        $Employee->Skills = $request->Skills;



        if ($request->Gender == 'أنثى' || $request->Gender == 'Female' ) {
            $Employee->Gender  =['ar' => 'أنثى', 'en' => 'Female'];
        }
        elseif ($request->Gender == 'ذكر' || $request->Gender == 'Male' ) {
            $Employee->Gender  =['ar' => 'ذكر', 'en' => 'Male'];
        }
        $Employee->Nationality_Employee_id = $request->Nationality;


        // $Employee->Gender = $request->Gender;
        $Employee->HireDate = $request->HireDate;
        $Employee->Address = $request->Address;

       if ($request->Trainee == 'نعم' || $request->Trainee == 'Yes' ) {
            $Employee->Trainee  =['ar' => 'نعم', 'en' => 'Yes'];
        }
        else if ($request->Trainee == 'لا' || $request->Trainee == 'No' ) {
            $Employee->Trainee  =['ar' => 'لا', 'en' => 'No'];
        }

        // $Employee->Trainee = $request->Trainee;
        $Employee->Years_Of_Experience = $request->YearsOfExp;
        $Employee->Department_Id = $request->employee_department;

        $employee = Employee::findOrFail($request->id);

        $Department_Location_Manager = DepartmentLocation::where('Location_Id', $request->location_id)->where('Department_Id',$request->employee_department)->first();
        $Previous_department_Location_Manager = DepartmentLocation::where('Location_Id', $employee->Location_Id)->where('Department_Id',$employee->Department_Id)->first();


        if($request->Status == true && $Department_Location_Manager->Manager_Id == null ) {


          if ($Employee->Manager == 1) {
            $Previous_department_Location_Manager->Manager_Id = null;
            $Previous_department_Location_Manager->save();

            $Department_Location_Manager->Manager_Id = $request->id;
            $Department_Location_Manager->save();


           }
          else{

            $Employee->Manager = 1;
            $Department_Location_Manager->Manager_Id = $request->id;
            $Department_Location_Manager->save();

          }

        }
        elseif(($request->Status == false  && $Department_Location_Manager->Manager_Id == $request->id) || ($request->Status == false  && $Department_Location_Manager->Manager_Id == null) )
        {
            $Employee->Manager = 0;
            $Department_Location_Manager->Manager_Id = null;
            $Department_Location_Manager->save();

        }


          $file = $request->file('Updatephoto');
          if(isset($file))
            {
                if(File::exists(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))){

                    File::delete(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName));
                }
                    $name = $file->getClientOriginalName();
                    $Employee->ImageName = $name;
                    $file->storeAs('attachments/employees/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

            }

        $Employee->positions()->sync($request->position_id);

        $Employee->save();



        $Employee->Salary = 0;
        foreach ($Employee->positions as $position ) {

          $Employee->Salary = $Employee->Salary + $position->Salary;

        }
        $Employee->save();


        $user_emp = User::where('Employee_Id',$request->id)->get()->first();
        $user_emp->name = $request->FName.' '.$request->LName;
        $user_emp->email = $request->Email;
        $user_emp->Employee_Id = $request->id;
        $user_emp->save();

        $Dep_manager = Role::where('name->en','Department Manager')->first();

        if ($Employee->Manager == 1) {
            $Employee->user->assignRole($Dep_manager);
        }else{
            $Employee->user->removeRole($Dep_manager);
        }

        DB::commit(); // insert data
        toastr()->success(trans('messages.Update'));
        return redirect()->route('employee.index');

    }

    catch (\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }



  public function destroy(Request $request)
  {
    $Employee = Employee::findOrFail($request->id);

    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

    if(auth()->user()->can($permission)){
        if(isset(Auth::user()->employee->id)){
            $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
            $Employee_loc = $Employee->Location_Id;

            if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
                toastr()->error(trans('messages.Loc_Permission'));
                return redirect()->back();
            }
    }
      else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }
    }

    File::deleteDirectory(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName));
    $Employee->forceDelete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('employee.index');

  }

  public function delete_all(Request $request)
  {
      $delete_all_id = explode(",", $request->delete_all_id);
      $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

      $Employees = Employee::whereIn('id', $delete_all_id)->get();


      if(auth()->user()->can($permission)){
         if (Auth::user()->employee->id) {

       $User_loc = Employee::where('id',Auth::user()->employee->id)->first();

       foreach ($Employees as $Employee) {
        if ((int)$Employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
          toastr()->error(trans('messages.Loc_Permissions'));
          return redirect()->route('employee.index');
         }
        }
      }
      else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }
      }

      foreach ($Employees as $Employee) {
         File::deleteDirectory(public_path('attachments/employees/'.$Employee->FName.'_'.$Employee->LName));
      }
      Employee::whereIn('id', $delete_all_id)->forceDelete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('employee.index');
  }

  public function Filter_Employees(Request $request)
  {
      $Departments = Department::all();
      $Nationalities = Nationality::all();

        $Search = Employee::select('*')->where('Department_Id','=',$request->Department_id)->get();
        return view('pages.Employees.Employees',compact('Departments','Nationalities'))->withDetails($Search);

  }

    public function pdf()
    {
        $Departments = Department::all();
        $Nationalities = Nationality::all();
        $Degrees = EmployeeDegree::all();
        $positions = Position::all();
        $Employees = Employee::all();
        $Locations = Location::all();

        $pdf = PDF::loadView('pages.Reports.EmployeesReport',['Employees' => $Employees,'Nationalities'=>$Nationalities,'Departments'=>$Departments,'Degrees'=>$Degrees,'positions'=>$positions,'Locations',$Locations]
        ,[
        ],
        [ 'mode' => 'utf-8',
        'format' => 'A4-L',
        'orientation' => 'L',
        'default_font' => 'sans-serif',
        'display_mode'  => 'fullpage',
        'margin_left'   => 10,

        ]);

        return $pdf->stream('Employees_report.pdf');
    }

  public function getPositions($id)
  {
      $list_positions = Position::where("Department_Id", $id)->where('Status',1)->get()->pluck("Role", "id");

      return $list_positions;
  }

  public function getLocations($id)
  {

    $locations = Location::join("Department_Location", "Department_Location.Location_Id", "=", "Locations.id")
            ->where("Department_Location.Department_Id","=",$id)
            ->select("Locations.Address as Address","Locations.id as id")->get()
            ->pluck('Address','id');

           return $locations;
      // dd($locations);

  }
public function Upload_attachment(Request $request){

    $Employee = Employee::findOrFail($request->employee_id);
    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

    if(auth()->user()->can($permission)){
     if(isset(Auth::user()->employee->id)){

      $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
      $Employee_loc = $Employee->Location_Id;

      if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permission'));
        return redirect()->back();
      }
     }
     else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
         }
    }
foreach($request->file('attachments') as $file)
{
    $name = $file->getClientOriginalName();
    $file->move('attachments/employees/'.$request->employee_fname.'_'.$request->employee_lname, $file->getClientOriginalName(),'upload_attachments');

    // insert in Attachments_table
    $attachment= new Attachment();
    $attachment->filename=$name;
    $attachment->attachmentable_id = $request->employee_id;
    $attachment->attachmentable_type = 'App\Employee';
    $attachment->save();
}
        if($request->file('attachments')){
            toastr()->success(trans('messages.Success'));
            return redirect()->route('employee.show',$request->employee_id);
        }

  }
  public function Download_attachment($employeename, $filename)
  {
      return response()->download(public_path('attachments/employees/'.$employeename.'/'.$filename));
  }
  public function Delete_attachment(Request $request)
  {
    $Employee = Employee::findOrFail($request->employee_id);
    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

    if(auth()->user()->can($permission)){
     if(isset(Auth::user()->employee->id)){

      $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
      $Employee_loc = (int)$Employee->Location_Id;

      if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permission'));
        return redirect()->back();
      }
     }else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }

    }
      // Delete img in server disk
      Storage::disk('upload_attachments')->delete('attachments/employees/'.$request->employee_fname.'_'.$request->employee_lname.'/'.$request->filename);

      // Delete in data
      Attachment::where('id',$request->id)->where('filename',$request->filename)->delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('employee.show',$request->employee_id);
  }

  public function showAttachment($employeename, $filename , $id)
  {
    $Employee = Employee::findOrFail($id);

    return view('pages.Employees.ShowAttachment',compact('employeename','filename','Employee'));
  }

}

?>
