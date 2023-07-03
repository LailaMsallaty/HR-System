<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Employee;
use App\Department;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class ResignedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Add_Resignation|إضافة_استقالة']);
    }
    public function index()
    {

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)) {
            if(isset(Auth::user()->employee->id)){

                $employees = Employee::onlyTrashed()->
                where('Location_Id',Auth::user()->employee->Location_Id)
                ->orderby('id','desc')
                ->get();
            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }
        }
        else{
        $employees = Employee::orderby('id','desc')->onlyTrashed()->get();
        }

        return view('pages.Resigned.index',compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Locations = Location::all();
        return view('pages.Resigned.Create', compact('Locations'));
    }

     public function store(Request $request)
    {
        $employee = Employee::where('id',$request->employee_id)->first();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)){
         if(isset(Auth::user()->employee->id)){

          $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
          if ( (int)$employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
            toastr()->error(trans('messages.add_Resign_In_Loc_Permission'));
            return redirect()->back();
          }
         }
         else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }
        }

        $user = User::where('Employee_Id',$request->employee_id)->first();

        $user->Status = 0;

        $user->save();

        Employee::where('id', $request->employee_id)->Delete();

        toastr()->success(trans('messages.Success'));
        return redirect()->route('resigned.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request, $id)
    {

        $user = User::where('Employee_Id',$request->id)->first();
        $user->Status = 1;
        $user->save();
        $employee = Employee::onlyTrashed()->where('id', $request->id)->first()->restore();


        toastr()->success(trans('messages.Success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function getResignDepartments($id)
    {
      $departments = Department::join("Department_Location", "Department_Location.Department_Id", "=", "Departments.id")
      ->where("Department_Location.Location_Id","=",(int)$id)
      ->select("Departments.Name as Name","Departments.id as id")->get()
      ->pluck('Name','id');

       return $departments;
    }
    public function getResignEmployees($id,$loc)
    {
      $list_employees = Employee::select(DB::raw("CONCAT(FName,' ',LName,' - ',Code) AS Name"),'id')
      ->where("Department_Id", $id)->where("Location_Id",$loc)
      ->get()
      ->pluck("Name", "id");
        return  $list_employees;
    }


    public function destroy(Request $request)
    {
        Employee::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
