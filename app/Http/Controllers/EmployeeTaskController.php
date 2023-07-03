<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Employee;
use App\Task;
use App\User;
use Auth;
use App;
use Illuminate\Support\Facades\Notification;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Employee_Tasks|مهام_الموظف'],['except'=>['ShowTask']]);
    }


    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
    public function getCalendar()
    {
        $employee = Employee::where('id',Auth::user()->employee->id)->first();

        $Tasks = Task::select('Title->'.App::getLocale().'  as title','Start_Date as start','End_Date as end','Description as description')
        ->where('Status',1)
        ->where('Employee_Id',$employee->id)
        ->get()->toArray();


        foreach ($Tasks as $i => $value) {
            $Tasks[$i]['color'] = $this->rand_color();
        }

        return json_encode($Tasks);

        //        WHen Employee_Leaves.Status	= "1" THEN "'.trans('leaves-trans.Leave').'"
        //select('Employee_Leaves.Start_Date as start ','Employee_Leaves.End_Date as end ')

    }

    public function index()
    {
            $Locations = Location::all();
            $employees = Employee::all();
            $employee_tasks = Task::join('Employees','tasks.Employee_Id','=','Employees.id')
            ->select('tasks.*','Employees.FName','Employees.LName','Employees.id as EmployeeID','Employees.Location_Id as Location_Id','Employees.Code')
            ->where('Employees.id',Auth::user()->employee->id)
            ->orderby('tasks.id','desc')
            ->get();
            return view('pages.Tasks.EmployeeTask',compact('employees','employee_tasks','Locations'));
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
    public function store(Request $request)
    {
        try {

            $request->validate([
             'receive'=>'required',
            ]);
           $Task = Task::FindOrFail($request->id);
           $Employee = Employee::where('id',$Task->Employee_Id)->first();


           if($request->file('receive')){
           $file = $request->file('receive');
           $name = $file->getClientOriginalName();

           $file->move('attachments/ReceivingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

           $Task->Received_Task_Attachment = $name;
           $Task->Comment = $request->comment;

           $emp =Employee::where('id',$Task->Sender_id)->first();
           $user = User::where('id',$emp->user->id)->get();

          Notification::send($user, new \App\Notifications\TaskComplete($Employee));
          $Task->save();



           toastr()->success(trans('messages.Success'));
           return redirect()->route('Receive_Task.index');

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
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
             'comment'=>'required',
             'receive'=>'required',
            ]);
           $Task = Task::FindOrFail($request->id);

           $Employee = Employee::where('id',$Task->Employee_Id);

           if($request->file('receive')){
           $file = $request->file('receive');
           $name = $file->getClientOriginalName();
           Storage::disk('upload_attachments')->delete('attachments/ReceivingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName.'/'.$Task->Receive_Task_Attachment);
           $file->move('attachments/ReceivingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

           $Task->Received_Task_Attachment = $name;
           $Task->Comment = $request->comment;
           $Task->save();

           toastr()->success(trans('messages.Success'));
           return redirect()->route('Receive_Task.index');

           }


     }

     catch (\Exception $e){
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
    }
    public function ShowTask($employeename, $filename , $id)
    {
      $Employee_Task = Task::findOrFail($id);

      return view('pages.Tasks.ShowReceiveTask',compact('employeename','filename','Employee_Task'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
