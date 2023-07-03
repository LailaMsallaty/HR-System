<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Punishment;
use App\Location;
use App\EmpPunishment;
use App\Employee;
use App\Department;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Http\Requests\StoreImposePunishment;
use Illuminate\Support\Facades\Notification;


class EmployeePunishmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Impose_Punishment|فرض_عقوبة'],['except' => ['index']]);
    }

    public function index()
    {
        $punishments = Punishment::all();

        $permission_1 =  Permission::select("name->".\App::getLocale())->where('name->ar','عقوبات_الموظف')->first();
        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

       if(auth()->user()->can($permission_1)) {
        if(isset(Auth::user()->employee->id)){

        $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
        ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->where('Employees.id',Auth::user()->employee->id)
        ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Punishments.id','desc')
        ->get();

       }
       else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }

      }elseif(auth()->user()->can($permission_2)){

        $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
        ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)
        ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Punishments.id','desc')
        ->get();

      }

      else{

        $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
        ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Punishments.id','desc')
        ->get();
        }

        $locations = Location::all();
        $Employees = Employee::all();
        $Departments = Department::all();
        return view('pages.Punishments.index',compact('Punishments','Departments','punishments','locations','Employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Locations = Location::all();
        $Punishments = Punishment::all();
        return view('pages.Punishments.Create', compact('Locations','Punishments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImposePunishment $request)
    {
        try{

        $validated = $request->validated();


        $employee = Employee::findOrfail($request->employee);

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

    if(isset(Auth::user()->employee->id)){
        if(auth()->user()->can($permission)){

                    $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                    $Employee_loc = (int)$employee->Location_Id;
                    if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
                        toastr()->error(trans('messages.add_Punishment_In_Loc_Permission'));
                        return redirect()->back();
                      }
            }
        if(auth()->user()->can($permission_2)){

            if ($employee->id == Auth::user()->employee->id) {

                toastr()->error(trans('messages.HR_Add_Permission'));
                return  redirect()->back();

            }
        }

        }
        else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }

        $statement = $request->statement;

        $punishment = $request->punishment_id;

        $employee->punishments()->attach($punishment,['Statement'=>$statement]);

        $user = $employee->user;
        $emp_punishment = EmpPunishment::latest()->first();
        Notification::send($user, new \App\Notifications\ReceivePunishment($emp_punishment));


        toastr()->success(trans('messages.Success'));
        return redirect()->route('Employee_punishment.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreImposePunishment $request)
    {
        try {
            $validated = $request->validated();
            $punishment = EmpPunishment::findOrFail($request->id);

            $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
            $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

     if(isset(Auth::user()->employee->id)){
            if(auth()->user()->can($permission)){

              $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
              $Employee= $punishment->Employee_Id;
              $Employee_loc = Employee::where('id',$Employee)->first();

              if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                toastr()->error(trans('messages.Loc_Permission'));
                return  redirect()->route('Employee_punishment.index');
              }
             }
            if(auth()->user()->can($permission_2)){

                if ($punishment->Employee_Id == Auth::user()->employee->id) {

                    toastr()->error(trans('messages.HR_Permission'));
                    return  redirect()->route('Employee_punishment.index');

                }
            }
        }else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->route('Employee_punishment.index');
        }

            $punishment->Punishment_Id = $request->punishment_id;
            $punishment->Employee_Id = $request->employee;
            $punishment->Statement = $request->statement;


            $punishment->save();

            toastr()->success(trans('messages.Success'));
            return redirect()->route('Employee_punishment.index');
    }

    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_all_Impose_punishments(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Punishments = EmpPunishment::whereIn('id', $delete_all_id)->get();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

    if (Auth::user()->employee->id) {
        if(auth()->user()->can($permission)){
         $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
         foreach ($Punishments as $punishment) {
          if ((int)$punishment->employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
            toastr()->error(trans('messages.Loc_Permissions'));
            return redirect()->route('Employee_punishment.index');
             }
          }
        }
        if(auth()->user()->can($permission_2)){
            foreach($Punishments as $punishment) {
                if ($punishment->Employee_Id == Auth::user()->employee->id ) {
                  toastr()->error(trans('messages.HR_Permission'));
                  return redirect()->route('Employee_punishment.index');

              }
            }
        }

    }else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }

    EmpPunishment::whereIn('id', $delete_all_id)->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Employee_punishment.index');

    }

   public function destroy(Request $request)
    {
        $Punishments = EmpPunishment::findOrFail($request->id);

        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

        if(auth()->user()->can($permission_2)){

                       if ($Punishments->Employee_Id == Auth::user()->employee->id) {

                           toastr()->error(trans('messages.HR_Permission'));
                           return  redirect()->route('Employee_punishment.index');

                       }
                   }

        $Punishments->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Employee_punishment.index');
    }
}
