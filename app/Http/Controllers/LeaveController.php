<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use App\Employee;
use App\EmployeeLeave;
use App\Http\Requests\StoreLeaves;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;
use Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:View_Leave_Requests|عرض_طلبات_الإجازة'],['only' => ['viewRequests','accept_reject_Request']]);
        $this->middleware(['permission:General_Management|إدارة_عامة'],['except' => ['viewRequests','accept_reject_Request']]);
    }

    public function index()
    {
        $leaves = Leave::all();
        return view('pages.Leaves.index',compact('leaves'));

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
    public function store(StoreLeaves $request)
    {
        $List_Leaves = $request->List_leaves;

        try {

            $validated = $request->validated();

            foreach ($List_Leaves as $List_Leave) {

                $Leaves = new Leave();

                $Leaves->Name = ['en' => $List_Leave['Name_Leave_en'], 'ar' => $List_Leave['Name_Leave_ar']];
                $Leaves->Days = $List_Leave['days'];

                $Leaves->save();

            }

            toastr()->success(trans('messages.Success'));
            return redirect()->route('employeeleave.index');
        } catch (\Exception $e) {
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
    public function update(StoreLeaves $request)
    {
        try {

            $validated = $request->validated();

            $Leaves = Leave::findOrFail($request->id);

            $Leaves->Name = ['ar' => $request->Name_Leave_ar, 'en' => $request->Name_Leave_en];

            $Leaves->Days = $request->days;

            $Leaves->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('employeeleave.index');
        }

        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function viewRequests()
    {

        $permission = Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        if(auth()->user()->can($permission)) {
         if(isset(Auth::user()->employee->id)){

        $leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->where('Employees.Deleted_at',null)
        ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)
        ->orderby('Employee_Leaves.id','desc')
        ->get();
         }
         else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }
        }
        else{
        $leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->where('Employees.Deleted_at',null)
        ->orderby('Employee_Leaves.id','desc')
        ->get();
        }
        return view('pages.Leaves.Requests',compact('leaves'));
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

        $Leaves = Leave::whereIn('id', $delete_all_id);

        $Leaves->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('employeeleave.index');


    }
    public function destroy(Request $request)
    {
          $Leaves = Leave::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('employeeleave.index');

    }
   public function accept_reject_Request(Request $request)
    {
        $Request_Leave = EmployeeLeave::findOrFail($request->id);

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

     if(isset(Auth::user()->employee->id)){
        if(auth()->user()->can($permission)){

                $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                $Employee= $Request_Leave->Employee_Id;
                $Employee_loc = Employee::where('id',$Employee)->first();

                if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                    toastr()->error(trans('messages.Loc_Permission'));
                    return redirect()->route('Employee_Leave_Requests');
                }
              }

        if(auth()->user()->can($permission_2)){
            $Employee= $Request_Leave->Employee_Id;
            if ($Employee == Auth::user()->employee->id) {
                toastr()->error(trans('messages.HR_Permission'));
                return  redirect()->route('Employee_Leave_Requests');
            }
        }
          }
          else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }

        if ($_POST['action'] == 'accept') {
            $Request_Leave->Status = 1;
        }elseif ($_POST['action'] == 'reject') {
            $Request_Leave->Status = 2;
        }
        $Request_Leave->save();

        if ($Request_Leave->Status == 1) {
            toastr()->success(trans('messages.Acceptable'));
        }else {
            toastr()->error(trans('messages.Rejected'));
        }

        $employee = Employee::findOrfail($Request_Leave->Employee_Id);
        $user = $employee->user;
        $leave = EmployeeLeave::latest()->first();
        Notification::send($user, new \App\Notifications\AcceptRejectLeave($leave));


        return redirect()->route('Employee_Leave_Requests');

    }

}
