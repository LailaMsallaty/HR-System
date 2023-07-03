<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Employee;
use App\Attendance;
use Carbon\Carbon;
use App\EmployeeLeave;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use \PDF;
use Auth;

class EmployeeAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Attendance_Register|تسجيل_الدوام'],['except' => ['getCalendar']]);
    }

    public function getCalendar()
    {
        $employee = Employee::where('id',Auth::user()->employee->id)->first();

        $Attendances = Attendance::select('attendances.attendance_date as start','attendances.attendance_date as end', \DB::raw('(CASE

        WHEN attendances.attendance_status = "0" THEN "'.trans('attendance-trans.Absent').'"

        WHEN attendances.attendance_status = "1" THEN "'.trans('attendance-trans.Present').'"

        END ) as title'))
        ->where('attendances.Employee_Id',$employee->id)
        ->get();


    foreach ($Attendances as $attendance) {

        if($attendance->title == "Absent" || $attendance->title == "غائب"){

            $color = '#e83e8c';
            $attendance['color'] = $color;


        }elseif($attendance->title == "Present" || $attendance->title == "حاضر")
        {
            $color = '#17a2b8';
            $attendance['color'] = $color;

        }
      }
        return json_encode($Attendances);
    }
    public function index()
    {

        $Locations = Location::all();
        return view('pages.Attendance.departments',compact('Locations'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {

           $attendance_status =1;
                                                  // key   =>  value
        if(isset($request->attendances))
           { foreach ($request->attendances as $employee_id => $attendance) {

                if( $attendance == 'presence' ) {
                    $attendance_status = 1;
                } else if( $attendance == 'absent'){
                    $attendance_status = 0;
                }

                Attendance::create([
                    'Employee_Id'=> $employee_id,
                    'attendance_date'=> date('Y-m-d'),
                    'attendance_status'=> $attendance_status
                ]);

            }


            toastr()->success(trans('messages.Success'));
            return redirect()->route('employeeattendance.index');

        }else {

            toastr()->error(trans('messages.NO_Attendance'));
            return redirect()->route('employeeattendance.index');
        }
    }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showEmployee($id,$loc)
    {


        $Employees = Employee::with('attendances')->where('Department_Id',$id)->where('Location_Id',$loc)->get();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)){
         if(isset(Auth::user()->employee->id)){

          $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
          if ( (int)$loc !==  (int)$User_loc->Location_Id  ) {
            toastr()->error(trans('messages.Loc_ListEmployees_Permission'));
            return redirect()->back();
          }
         }
         else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }
        }
        return view('pages.Attendance.index',compact('Employees'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function View_Attendances()
    {
        $employees = Attendance::all();
        $locations =Location::all();
        return view('pages.Attendance.View_Attendances',compact('employees','locations'));
    }

    public function makeReport(Request $request){

        $this->validate($request,[
            'From' => 'required',
            'To'   => 'required',
            'Location'=>'required',
            'selection'=>'required',
        ]);

        $date_from = $request->input('From');
        $date_to = $request->input('To');


        /**
         *  employees between two dates
         */
        if ($request->Location == 0 && $request->selection == 0 ) {
            $employees = Attendance::whereBetween('attendance_date' ,[new Carbon($date_from),new Carbon($date_to)])
            ->orderBy('attendance_date', 'desc')
            ->select('attendances.*')
            ->get();

        }
        elseif($request->Location == 0 && $request->selection == 1 ) {
            $employees = Attendance::whereBetween('attendance_date' ,[new Carbon($date_from),new Carbon($date_to)])->where('attendance_status',1)
            ->orderBy('attendance_date', 'desc')
            ->select('attendances.*')
            ->get();

        }
        elseif($request->Location == 0 && $request->selection == 2 ) {
            $employees = Attendance::whereBetween('attendance_date' ,[new Carbon($date_from),new Carbon($date_to)])->where('attendance_status',0)
            ->orderBy('attendance_date', 'desc')
            ->select('attendances.*')
            ->get();

        }
        elseif($request->Location !== 0 && $request->selection == 0){
            $employees = Attendance::join('Employees','attendances.Employee_Id','=','Employees.id')
            ->where('Employees.Location_Id','=',$request->Location)
            ->whereBetween('attendances.attendance_date' ,[new Carbon($date_from),new Carbon($date_to)])
            ->orderBy('attendances.attendance_date', 'desc')
            ->select('attendances.*')
            ->get();
            }
        elseif($request->Location !== 0 && $request->selection == 1){
        $employees = Attendance::join('Employees','attendances.Employee_Id','=','Employees.id')
        ->where('Employees.Location_Id','=',$request->Location)->where('attendances.attendance_status',1)
        ->whereBetween('attendances.attendance_date' ,[new Carbon($date_from),new Carbon($date_to)])
        ->orderBy('attendances.attendance_date', 'desc')
        ->select('attendances.*')
        ->get();
        }
        else{

        $employees = Attendance::join('Employees','attendances.Employee_Id','=','Employees.id')
        ->where('Employees.Location_Id','=',$request->Location)->where('attendances.attendance_status',0)
        ->whereBetween('attendances.attendance_date' ,[new Carbon($date_from),new Carbon($date_to)])
        ->orderBy('attendances.attendance_date', 'desc')
        ->select('attendances.*')
        ->get();


        }
        //generate pdf


    if ($_POST['action'] == 'report') {
        $pdf = PDF::loadView('pages.Attendance.report',['employees' => $employees,'from'=>$date_from,'to'=>$date_to],[],
        [ 'mode' => 'utf-8',
        'format' => 'A4-L',
        'orientation' => 'xL',
        'default_font' => 'sans-serif',
        'display_mode'  => 'fullpage',
        'margin_left'   => 20,
      ]);
      return $pdf->stream('Employee_attendance_report_from_'.$date_from.'_to_'.$date_to.'.pdf');
    }else{

      $locations = Location::all();
      return view('pages.Attendance.View_Attendances',compact('employees','locations'));

    }
}


    public function delete_all(Request $request)
  {

    $delete_all_id = explode(",", $request->delete_all_id);

    $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

    $Attendance = Attendance::whereIn('id', $delete_all_id)->get();

    if(auth()->user()->can($permission)){
       if (Auth::user()->employee->id) {
     $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
     foreach ($Attendance as $attendance) {
      if ((int)$attendance->employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
        toastr()->error(trans('messages.Loc_Permissions'));
        return redirect()->back();
       }
      }
    }
    else{
      toastr()->error(trans('messages.You_Are_Not_Employee'));
      return redirect()->back();
  }
    }

    Attendance::whereIn('id', $delete_all_id)>Delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('View_Attendances');
  }
}
