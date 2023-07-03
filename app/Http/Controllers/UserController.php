<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//custom Spatie\Permission
use Spatie\Permission\Models\Role;
use App\User;
use DB;
use Hash;
use Auth;
use App\Employee;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function __construct()
{
    $this->middleware(['permission:Users|المستخدمين']);
}

    public function index(Request $request)
    {
        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

   if(isset(Auth::user()->employee->id)){

    if(auth()->user()->can($permission)) {

                $data = User::join('Employees','users.Employee_Id','=','Employees.id')->where('Employees.Location_Id',Auth::user()->employee->Location_Id)->select('users.*')->orderBy('users.id','Desc')->get();
            }

            else{
                $data = User::orderBy('id','Desc')->get();
            }
        }else{
        toastr()->error(trans('messages.You_Are_Not_Employee'));
        return redirect()->back();
    }

    return view('users.show_users',compact('data'))
    ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
    $roles = Role::pluck('name','name')->all();
    return view('users.Add_user',compact('roles'));
    }
    public function store(Request $request)
    {
    $this->validate($request, [
    'name' => 'required',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|same:confirm-password',
    'roles_name' => 'required',
    'Status' => 'required',
    ]);
    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);
    $user->assignRole($request->input('roles_name'));
    return redirect()->route('users.index')
    ->with('success',trans('messages.User_Success'));
    }
    public function show($id)
    {
        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        $user = User::find($id);


    if(auth()->user()->can($permission)){

        if(isset(Auth::user()->employee->id)){
                $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                $Employee= $user->Employee_Id;
                $Employee_loc = Employee::where('id',$Employee)->first();

                if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                    toastr()->error(trans('messages.Loc_Permission'));
                    return redirect()->back();
                  }
        }
        else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }
    }
    return view('users.show',compact('user'));
    }
    public function edit($id)
    {
        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $user = User::find($id);

        if(auth()->user()->can($permission)){

            if(isset(Auth::user()->employee->id)){
                    $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
                    $Employee= $user->Employee_Id;
                //    dd($Employee);
                    $Employee_loc = Employee::where('id',$Employee)->first();

                    if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                        toastr()->error(trans('messages.Loc_Permission'));
                        return redirect()->back();
                      }
            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }
        }
    $roles = Role::all();
    $userRole = $user->roles->pluck('name','name')->all();
    return view('users.edit',compact('user','roles','userRole'));
    }
    public function update(Request $request, $id)
    {
    $this->validate($request, [
    'name' => 'required',
    'email' => 'required|email|unique:users,email,'.$id,
    'password' => 'same:confirm-password',
    'roles_name' => 'required'
    ]);
    $input = $request->all();
    if(!empty($input['password'])){
    $input['password'] = Hash::make($input['password']);
    }else{
    $input = array_except($input,array('password'));
    }
    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $user->assignRole($request->input('roles_name'));
    return redirect()->route('users.index')
    ->with('success',trans('messages.User_Updated'));
    }
    public function destroy(Request $request)
    {
    User::find($request->id)->delete();
    return redirect()->route('users.index')
    ->with('danger',trans('messages.User_Deleted'));
    }
    public function delete_all_Users(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Users = User::whereIn('id', $delete_all_id);

        $Users->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('users.index');


    }
}

