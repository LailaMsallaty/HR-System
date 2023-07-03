<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeRequests;
use App\Employee;
use Auth;
use Illuminate\Support\Facades\Notification;
use App\User;
use Spatie\Permission\Models\Permission;

class RequestReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
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

           $Request_Reply = EmployeeRequests::FindOrFail($request->id);
           $Employee = Employee::where('id',$Request_Reply->Employee_Id)->first();

           $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

           if(isset(Auth::user()->employee->id)){

                if(auth()->user()->can($permission_2)){

                    if ($Request_Reply->Employee_Id == Auth::user()->employee->id) {
                        toastr()->error(trans('messages.HR_Add_Permission'));
                        return  redirect()->route('Employee_Requests');
                    }
                }
            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }



           if($request->file('receive')){
           $file = $request->file('receive');
           $name = $file->getClientOriginalName();

           $file->move('attachments/Replying_HR_Requests/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

           $Request_Reply->Reply_Statement = $name;
           $Request_Reply->HR_Comment = $request->comment;
           $Request_Reply->save();

        //    $user = $Employee->user;
        //    $reply = EmployeeRequests::latest()->first();
        //    Notification::send($user, new \App\Notifications\ReplyRequest($reply));

           toastr()->success(trans('messages.Success'));
           return redirect()->route('Employee_Requests');

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
             'receive'=>'required',
            ]);
           $Request_Reply = EmployeeRequests::FindOrFail($request->id);

           $Employee = Employee::where('id',$Request_Reply->Employee_Id);

           if($request->file('receive')){
           $file = $request->file('receive');
           $name = $file->getClientOriginalName();
           Storage::disk('upload_attachments')->delete('attachments/Replying_HR_Requests/'.$Employee->FName.'_'.$Employee->LName.'/'.$Request_Reply->Reply_Statement);
           $file->move('attachments/Replying_HR_Requests/'.$Employee->FName.'_'.$Employee->LName, $file->getClientOriginalName(),'upload_attachments');

           $Request_Reply->Reply_Statement = $name;
           $Request_Reply->HR_Comment = $request->comment;
           $Request_Reply->save();

           toastr()->success(trans('messages.Success'));
           return redirect()->route('Employee_Requests');

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
    public function destroy($id)
    {
        //
    }
}
