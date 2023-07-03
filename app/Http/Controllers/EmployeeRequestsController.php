<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\empRequest;
use App\Employee;
use App\EmployeeRequests;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\SendRequest;
class EmployeeRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Employees_Requests_Show|عرض_طلبات_الموظفين'],['only' => ['viewRequests','accept_reject_Request']]);
    }

    public function index()
    {
        $requests = empRequest::all();

        $employee_requests = empRequest::join('employee_requests','requests.id','=','employee_requests.Request_Id')
        ->join('Employees','Employees.id','=','employee_requests.Employee_Id')
        ->select('employee_requests.*','Employees.FName','Employees.LName','Employees.id as EmployeeID','requests.Name','Employees.Code')
        ->where('Employees.id',Auth::user()->employee->id)
        ->where('Employees.Deleted_at',null)
        ->orderby('employee_requests.id','desc')
        ->get();
        return view('pages.Requests.EmployeeRequest',compact('requests','employee_requests'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            $Employee = Employee::where('id',Auth::user()->employee->id)->get()->first();

               $request->validate([
                'requestType'=>'required',
                'statement'=>'required'

               ]);

              $req = $request->requestType;
              $file = $request->file('statement');
              $name = $file->getClientOriginalName();
              $Employee->requests()->attach($req,['Statement'=>$name]);

              $file->move('attachments/employeeRequests/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');


            $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','عرض_طلبات_الموظفين')->first();
            $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','الأدوار')->first();

            $users = User::get();

            foreach ($users as $user) {
                if(($user->can($permission) && $user->employee->Location_Id == $Employee->Location_Id) || $user->can($permission_2) ) {
                    $Employee = Employee::where('id',Auth::user()->employee->id)->get()->first();
                    Notification::send($user, new SendRequest($Employee));
                }
            }
              toastr()->success(trans('messages.Success'));
              return redirect()->route('Send_Request.index');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function viewRequests()
    {
        $permission = Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)) {
            if(isset(Auth::user()->employee->id)){

            $requests = empRequest::join('employee_requests','requests.id','=','employee_requests.Request_Id')
            ->join('Employees','Employees.id','=','employee_requests.Employee_Id')
            ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)
            ->select('employee_requests.*','Employees.FName','Employees.LName','requests.Name','Employees.Code')
            ->orderby('employee_requests.id','desc')
            ->get();
            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }
        }
        else{
        $requests = empRequest::join('employee_requests','requests.id','=','employee_requests.Request_Id')
        ->join('Employees','Employees.id','=','employee_requests.Employee_Id')
        ->select('employee_requests.*','Employees.FName','Employees.LName','requests.Name','Employees.Code')
        ->orderby('employee_requests.id','desc')
        ->get();
        }
        return view('pages.Requests.Requests',compact('requests'));
    }

    public function accept_reject_Request(Request $request)
    {


        $Request = EmployeeRequests::findOrFail($request->id);

        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

        if(isset(Auth::user()->employee->id)){
           if(auth()->user()->can($permission_2)){
               $Employee= $Request->Employee_Id;
               if ($Employee == Auth::user()->employee->id) {
                   toastr()->error(trans('messages.HR_Permission'));
                   return  redirect()->route('Employee_Requests');
               }
           }
             }
             else{
               toastr()->error(trans('messages.You_Are_Not_Employee'));
               return redirect()->back();
           }

        if ($_POST['action'] == 'accept') {
            $Request->Status = 1;
        }elseif ($_POST['action'] == 'reject') {
            $Request->Status = 2;
        }
        $Request->save();

        if ($Request->Status == 1) {
            toastr()->success(trans('messages.Acceptable'));
        }else {
            toastr()->error(trans('messages.Rejected'));
        }

        $Employee = Employee::findOrFail($Request->Employee_Id);
        $user = $Employee->user;
        $reply = EmployeeRequests::latest()->first();
        Notification::send($user, new \App\Notifications\AcceptRejectRequest($reply));

        return redirect()->route('Employee_Requests');

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
            $emp_req = EmployeeRequests::findOrFail($request->id);

               $request->validate([
                'requestType'=>'required',
                'statement'=>'required'

               ]);


              $file = $request->file('statement');
              $name = $file->getClientOriginalName();

              Storage::disk('upload_attachments')->delete('attachments/employeeRequests/'.$request->FName.'_'.$request->LName.'/'.$emp_req->Statement);

              $emp_req->Request_Id = $request->requestType;
              $emp_req->Statement = $name;

              $emp_req->save();

              $file->move('attachments/employeeRequests/'.$request->FName.'_'.$request->LName, $file->getClientOriginalName(),'upload_attachments');

              toastr()->success(trans('messages.Success'));
              return redirect()->route('Send_Request.index');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function Download_Statement($employeename, $filename)
    {
        return response()->download(public_path('attachments/employeeRequests/'.$employeename.'/'.$filename));
    }
    public function Download_Replying($employeename, $filename)
    {
        return response()->download(public_path('attachments/Replying_HR_Requests/'.$employeename.'/'.$filename));
    }

    public function showRequest($employeename, $filename , $id)
    {
      $Employee_Request = EmployeeRequests::findOrFail($id);

      return view('pages.Requests.ShowRequest',compact('employeename','filename','Employee_Request'));
    }

    public function showReply($employeename, $filename , $id)
    {
      $Employee_Reply = EmployeeRequests::findOrFail($id);

      return view('pages.Requests.ShowReply',compact('employeename','filename','Employee_Reply'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $emp = EmployeeRequests::findOrFail($request->id);
        Storage::disk('upload_attachments')->delete('attachments/employeeRequests/'.$request->FName.'_'.$request->LName.'/'.$emp->Statement);
        $emp->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Send_Request.index');
    }

    public function delete_all_Employee_requests(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $requests = EmployeeRequests::whereIn('id', $delete_all_id);
        $Requests = EmployeeRequests::join('Employees','employee_requests.Employee_Id','Employees.id')->whereIn('employee_requests.id', $delete_all_id)->select('Employees.FName','Employees.LName','employee_requests.Statement')->get();


        foreach ($Requests as $Request) {
            Storage::disk('upload_attachments')->delete('attachments/employeeRequests/'.$Request->FName.'_'.$Request->LName.'/'.$Request->Statement);
            Storage::disk('upload_attachments')->delete('attachments/Replying_HR_Requests/'.$Request->FName.'_'.$Request->LName.'/'.$Request->Reply_Statement);

        }
        $requests->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Employee_Requests');


    }
}
