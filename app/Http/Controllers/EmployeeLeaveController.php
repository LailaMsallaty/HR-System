<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use App\Employee;
use App\EmployeeLeave;
use Carbon\Carbon;
use App\Http\Requests\StoreRequestLeave;
use Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\ArriveLeave;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Leave_Request|تقديم_طلب_إجازة'],['except' => ['getCalendar']]);
    }

    public function getCalendar()
    {
        $employee = Employee::where('id',Auth::user()->employee->id)->first();

        $Leaves = EmployeeLeave::select('Employee_Leaves.Start_Date as start','Employee_Leaves.End_Date as end ', \DB::raw('(CASE

        WHEN  Employee_Leaves.Status = "1" THEN "'.trans('leaves-trans.Leave').'"

        END ) as title'))
        ->where('Employee_Leaves.Employee_Id',$employee->id)->where('Employee_Leaves.Status',1)
        ->get();

        $color ='#8499d3';
        foreach ($Leaves as $i => $value) {
            $Leaves[$i]['color'] = $color;
        }


        return json_encode($Leaves);


    }
    public function index()
    {
        $leaves = Leave::all();
        $employee_Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->where('Employees.id',Auth::user()->employee->id)->orderby('Employee_Leaves.id','desc')
        ->get();
        return view('pages.Leaves.LeaveRequest',compact('leaves','employee_Leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestLeave $request)
    {
        try {
      $Employee = Employee::where('id',Auth::user()->employee->id)->get()->first();

        $validated = $request->validated();

        $fdate = $request->From;
        $tdate = $request->To;
        $datetime1 = new Carbon($fdate);
        $datetime2 = new Carbon($tdate);
        $interval = $datetime1->diff($datetime2);

        $days = (int) $interval->format('%a');
        $leave_days = Leave::where('id',$request->leaveType)->first()->Days;


         if($datetime1->greaterThan($datetime2)){
            toastr()->error(trans('messages.Date_From'));
            return redirect()->back();
         }

        if ($days > $leave_days ) {

            toastr()->error(trans('messages.Days'));
            return redirect()->back();
        }


        else{

            $Employee->leaves()->attach($request->leaveType,['Start_Date'=>$fdate,'End_Date'=>$tdate,'TotalDays'=>$days]);

            $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','عرض_طلبات_الإجازة')->first();
            $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','الأدوار')->first();
            $users = User::get();

            foreach ($users as $user) {
                if(($user->can($permission) && $user->employee->Location_Id == $Employee->Location_Id) || $user->can($permission_2) ) {
                    $Employee = Employee::where('id',Auth::user()->employee->id)->get()->first();
                    Notification::send($user, new ArriveLeave($Employee));

                }

            }

                    // $leave= EmployeeLeave::latest()->first();
                    // Notification::send($user, new \App\Notifications\ArriveLeave($leave));




        toastr()->success(trans('messages.Success'));
        return redirect()->route('Leave_Request.index');
        }
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
    public function update(StoreRequestLeave $request)
    {

        try {
            $validated = $request->validated();
            $Request_Leave = EmployeeLeave::findOrFail($request->id);

            $fdate = $request->From;
            $tdate = $request->To;
            $datetime1 = new Carbon($fdate);
            $datetime2 = new Carbon($tdate);
            $interval = $datetime1->diff($datetime2);

            $days = (int) $interval->format('%a');
            $leave_days = Leave::where('id',$request->leaveType)->first()->Days;

            if($datetime1->greaterThan($datetime2)){
                toastr()->error(trans('messages.Date_From'));
                return redirect()->back();
             }

            if ($days > $leave_days) {

                toastr()->error(trans('messages.Days'));
                return redirect()->back();

            }else{

                $Request_Leave->Leave_Id = $request->leaveType;
                $Request_Leave->Start_Date = $request->From;
                $Request_Leave->End_Date = $request->To;
                $Request_Leave->TotalDays = $days;

                $Request_Leave->save();

                toastr()->success(trans('messages.Success'));
                return redirect()->route('Leave_Request.index');

            }
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

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Employee_Leaves = EmployeeLeave::whereIn('id', $delete_all_id)->get();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)){
               if (Auth::user()->employee->id) {
             $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
             foreach ($Employee_Leaves as $emp_leave) {
              if ((int)$emp_leave->employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
                toastr()->error(trans('messages.Loc_Permissions'));
                return redirect()->route('Employee_Leave_Requests');
               }
              }
            }
            else{
              toastr()->error(trans('messages.You_Are_Not_Employee'));
              return redirect()->back();
          }
            }

            EmployeeLeave::whereIn('id', $delete_all_id)->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Employee_Leave_Requests');


    }
    public function destroy(Request $request)
    {
        $Leaves = EmployeeLeave::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Leave_Request.index');
    }
}
