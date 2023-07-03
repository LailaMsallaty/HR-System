<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Task;
use App\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Auth;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Employees_Tasks_Show|عرض_مهام_الموظفين'],['except'=>['ShowTask','Download_Task',
        'Download_Task_receive']]);
    }

    public function index()
    {
        $Locations = Location::all();
        $employees = Employee::all();

        $permission = Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $permission_2 = Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_القسم')->first();

        if(auth()->user()->can($permission)) {
            if(isset(Auth::user()->employee->id)){

                $employee_tasks = Task::join('Employees','tasks.Employee_Id','=','Employees.id')
                ->select('tasks.*','Employees.FName','Employees.LName','Employees.id as EmployeeID','Employees.Location_Id as Location_Id','Employees.Code')
                ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)
                ->where('Employees.Deleted_at',null)
                ->orderby('tasks.id','desc')
                ->get();

            }else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }

            if(auth()->user()->can($permission_2)) {
                if(isset(Auth::user()->employee->id)){
            $employee_tasks = Task::join('Employees','tasks.Employee_Id','=','Employees.id')
            ->select('tasks.*','Employees.FName','Employees.LName','Employees.id as EmployeeID','Employees.Location_Id as Location_Id','Employees.Code')
            ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)
            ->where('Employees.Department_Id',Auth::user()->employee->Department_Id)
            ->where('Employees.Deleted_at',null)
            ->orderby('tasks.id','desc')
            ->get();

                }else{
                    toastr()->error(trans('messages.You_Are_Not_Employee'));
                    return redirect()->back();
                }

            }
    }

        else{
            $employee_tasks = Task::join('Employees','tasks.Employee_Id','=','Employees.id')
            ->select('tasks.*','Employees.FName','Employees.LName','Employees.id as EmployeeID','Employees.Location_Id as Location_Id','Employees.Code')
            ->where('Employees.Deleted_at',null)
            ->orderby('tasks.id','desc')
            ->get();

        }
        return view('pages.Tasks.Send_Task',compact('employees','employee_tasks','Locations'));

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
                'employee'=>'required',
                'sent'=>'required',
                'title_en'=>'required',
                'title_ar'=>'required',
                'From'=>'required',
                'To'=>'required',

               ]);
              $Task = new Task();

              $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
              $employee = Employee::findOrfail($request->employee);


              if(isset(Auth::user()->employee->id)){
                  if(auth()->user()->can($permission)){

                              $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                              $Employee_loc = (int)$employee->Location_Id;
                              if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
                                  toastr()->error(trans('messages.add_Task_In_Loc_Permission'));
                                  return redirect()->back();
                                }
                      }
                  }
                  else{
                      toastr()->error(trans('messages.You_Are_Not_Employee'));
                      return redirect()->back();
                  }
              $Task->Employee_Id = $request->employee;
              $Task->Title = ['ar' => $request->title_ar, 'en' => $request->title_en];
              if(isset($Task->Description)){

                $Task->Description = $request->description;

              }
              $Task->Start_Date = $request->From;
              $Task->End_Date = $request->To;
              $Task->Sender_id = $request->Sender_id;

              $fdate = $request->From;
              $tdate = $request->To;
              $datetime1 = new Carbon($fdate);
              $datetime2 = new Carbon($tdate);
              $interval = $datetime1->diff($datetime2);

              $days = (int) $interval->format('%a');
              $Task->Duration = $days;

              $Employee =Employee::findOrFail($request->employee);

              if($datetime1->greaterThan($datetime2)){
                toastr()->error(trans('messages.Date_From'));
                return redirect()->back();
             }
              if($request->file('sent')){
              $file = $request->file('sent');
              $name = $file->getClientOriginalName();
              $Task->Sent_Task_Attachment = $name;
              }
              $Task->save();

              if($request->file('sent')){
              $file->move('attachments/SendingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');
              }

              $user = $Employee->user;
              $task = Task::latest()->first();
              Notification::send($user, new \App\Notifications\ArriveTask($task));


                toastr()->success(trans('messages.Success'));
                return redirect()->route('Send_Task.index');


        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function accept_reject_Task(Request $request)
    {
        $Task = Task::findOrFail($request->id);

        if ( $Task->Sender_id !== Auth::user()->employee->id ) {

            toastr()->error(trans('messages.Not_your_task'));
            return redirect()->route('Send_Task.index');

        }

        if ($_POST['action'] == 'accept') {
            $Task->Status = 1;
        }elseif ($_POST['action'] == 'reject') {
            $Task->Status = 2;
        }
        $Task->save();

        if ($Task->Status == 1) {
            toastr()->success(trans('messages.Task_Acceptable'));
        }else {
            toastr()->error(trans('messages.Task_Rejected'));
        }

        $employee = Employee::findOrfail($Task->Employee_Id);
        $user = $employee->user;
        $task = Task::latest()->first();
        Notification::send($user, new \App\Notifications\AcceptRejectTask($task));

        return redirect()->route('Send_Task.index');

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
    public function update(Request $request)
    {
        try {
            $Task = Task::findOrFail($request->id);

             $request->validate([
                'employee'=>'required',
                'title_en'=>'required',
                'title_ar'=>'required',
                'From'=>'required',
                'To'=>'required',

               ]);

            $Employee = Employee::findOrFail($request->employee);

            $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();


            if(isset(Auth::user()->employee->id)){
                if(auth()->user()->can($permission)){

                            $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                            $Employee_loc = (int)$Employee->Location_Id;
                            if ($Employee_loc !==  (int)$User_loc->Location_Id  ) {
                                toastr()->error(trans('messages.add_Task_In_Loc_Permission'));
                                return redirect()->back();
                              }
                    }
                }
                else{
                    toastr()->error(trans('messages.You_Are_Not_Employee'));
                    return redirect()->back();
                }

             if($request->file('sent')){
              $file = $request->file('sent');
              $name = $file->getClientOriginalName();
              Storage::disk('upload_attachments')->delete('attachments/SendingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName.'/'.$Task->Sent_Task_Attachment);
              $file->move('attachments/SendingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');
              $Task->Sent_Task_Attachment = $name;

             }

              $Task->Employee_Id = $request->employee;
              $Task->Title = ['ar' => $request->title_ar, 'en' => $request->title_en];
              $Task->Description = $request->description;
              $Task->Start_Date = $request->From;
              $Task->End_Date = $request->To;

              $fdate = $request->From;
              $tdate = $request->To;
              $datetime1 = new Carbon($fdate);
              $datetime2 = new Carbon($tdate);
              $interval = $datetime1->diff($datetime2);

              $days = (int) $interval->format('%a');
              $Task->Duration = $days;

            if($datetime1->greaterThan($datetime2)){
                        toastr()->error(trans('messages.Date_From'));
                        return redirect()->back();
                    }

              $Task->save();

              toastr()->success(trans('messages.Success'));
              return redirect()->route('Send_Task.index');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function Download_Task($employeename, $filename)
    {
        return response()->download(public_path('attachments/SendingEmployeeTasks/'.$employeename.'/'.$filename));
    }
    public function Download_Task_receive($employeename, $filename)
    {
        return response()->download(public_path('attachments/ReceivingEmployeeTasks/'.$employeename.'/'.$filename));
    }

    public function ShowTask($employeename, $filename , $id)
    {
      $Employee_Task = Task::findOrFail($id);

      return view('pages.Tasks.ShowTask',compact('employeename','filename','Employee_Task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $task = Task::findOrFail($request->id);
        Storage::disk('upload_attachments')->delete('attachments/SendingEmployeeTasks/'.$request->FName.'_'.$request->LName.'/'.$task->Sent_Task_Attachment);
        Storage::disk('upload_attachments')->delete('attachments/ReceivingEmployeeTasks/'.$request->FName.'_'.$request->LName.'/'.$task->Received_Task_Attachment);
        $task->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Send_Task.index');
    }

    public function delete_all_Employee_Tasks(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $tasks = Task::whereIn('id', $delete_all_id);
        $Employees = Task::join('Employees','tasks.Employee_Id','Employees.id')->whereIn('tasks.id', $delete_all_id)->select('Employees.FName','Employees.LName','tasks.Received_Task_Attachment','tasks.Sent_Task_Attachment','Employees.Code')->get();


        foreach ($Employees as $Employee) {
            Storage::disk('upload_attachments')->delete('attachments/ReceivingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->Received_Task_Attachment);
            Storage::disk('upload_attachments')->delete('attachments/SendingEmployeeTasks/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->Sent_Task_Attachment);
         }
        $tasks->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Send_Task.index');


    }

}
