<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGiveAward;
use Illuminate\Support\Facades\DB;
use App\Award;
use App\Location;
use App\Employee;
use App\EmployeeAward;
use \PDF;
use Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;


class EmployeeAwardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Add_Awards|إضافة_جائزة'],['only' => ['index','store']]);
    }

    public function index()
    {

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();

        $awards = Award::all();

        $locations = Location::all();

        $Employees = Employee::all();

        if(auth()->user()->can($permission)) {
            if(isset(Auth::user()->employee->id)){

            $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
            ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
            ->where('Employees.Deleted_at',null)
            ->where('Employees.Location_Id',Auth::user()->employee->Location_Id)->orderBy('Employee_Awards.id', 'DESC')
            ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')->get();
            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }
        }
        else{
        $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
        ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
        ->where('Employees.Deleted_at',null)->orderBy('Employee_Awards.id', 'DESC')
        ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')->get();
        }

        return view('pages.Awards.GiveAward',compact('Awards','awards','locations','Employees'));

    }


    public function create()
    {
        //
    }


    public function store(StoreGiveAward $request)
    {
        try{

            $validated = $request->validated();
            $Employee = Employee::findOrFail($request->employee);
            $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();
            $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();


     if(isset(Auth::user()->employee->id)){
            if(auth()->user()->can($permission)){
              $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
              if ((int)$Employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
                toastr()->error(trans('messages.add_Award_In_Loc_Permission'));
                return redirect()->back();
              }
             }
             if(auth()->user()->can($permission_2)){

                if ($Employee->id == Auth::user()->employee->id) {

                    toastr()->error(trans('messages.HR_Add_Permission'));
                    return  redirect()->back();

                }
            }

            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }
            $Gift = $request->gift;
            $Cashe = $request->Cash_Prize;
            $Award = $request->awardType;

            $Employee->awards()->attach($Award,['Gift'=>$Gift,'Cash_Prize'=>$Cashe]);

            $user = $Employee->user;
            $award = EmployeeAward::latest()->first();
            Notification::send($user, new \App\Notifications\ArriveAward($award));


            toastr()->success(trans('messages.Success'));
            return redirect()->route('Give_Award.index');
        }
            catch (\Exception $e){
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }


    }

    public function show($id)
    {
        $EmployeeAward = EmployeeAward::find($id);

        $employee= Employee::join('Employee_Awards','Employees.id','=','Employee_Awards.Employee_Id')
        ->where('Employee_Awards.id',$id)
        ->select('Employees.FName as FName','Employees.LName as LName','Employees.id as EmployeeID','Employees.Code')
        ->first();

        $award= Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')->where('Employee_Awards.id',$id)->select('awards.Name as Name','awards.id as AwardID')->first();

         return view('pages.Awards.certificate',compact('EmployeeAward','employee','award'));
    }
    public function viewAwards()
    {
        $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
        ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
        ->where('Employees.id',Auth::user()->employee->id)
        ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','awards.id as AwardID','Employees.id as EmployeeID','Employees.Code')->orderBy('Employee_Awards.id', 'DESC')
        ->get();
        return view('pages.Awards.Employee_Awards',compact('Awards'));

    }
    public function delete_all_Employee_awards(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Awards = EmployeeAward::whereIn('id', $delete_all_id);

        $Awards->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Employee_Awards');
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
    public function update(StoreGiveAward $request)
    {
        try {

            $validated = $request->validated();
            $Award = EmployeeAward::findOrFail($request->id);

            $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
            $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

        if(isset(Auth::user()->employee->id)){
            if(auth()->user()->can($permission)){

              $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
              $Employee= $Award->Employee_Id;
              $Employee_loc = Employee::where('id',$Employee)->first();

              if ((int)$Employee_loc->Location_Id !==  (int)$User_loc->Location_Id  ) {
                toastr()->error(trans('messages.Loc_Permission'));
                return redirect()->route('Give_Award.index');
              }
             }
             if(auth()->user()->can($permission_2)){
                $Employee= $Award->Employee_Id;
                if ($Employee == Auth::user()->employee->id) {

                    toastr()->error(trans('messages.HR_Permission'));
                    return  redirect()->back();
                }
            }
            }
            else{
                toastr()->error(trans('messages.You_Are_Not_Employee'));
                return redirect()->back();
            }


                $Award->Gift = $request->gift;
                $Award->Cash_Prize = $request->Cash_Prize;
                $Award->Award_Id = $request->awardType;
                $Award->Employee_Id = $request->employee;

                $Award->save();

                toastr()->success(trans('messages.Success'));
                return redirect()->route('Give_Award.index');
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
    public function delete_all_give_awards(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        $Awards = EmployeeAward::whereIn('id', $delete_all_id)->get();

        $permission =  Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_لنفس_المركز')->first();
        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

    if (Auth::user()->employee->id) {
        if(auth()->user()->can($permission)){
         $User_loc = Employee::where('id',Auth::user()->employee->id)->first();
         foreach ($Awards as $award) {
          if ((int)$award->employee->Location_Id !==  (int)$User_loc->Location_Id  ) {
            toastr()->error(trans('messages.Loc_Permissions'));
            return redirect()->route('Give_Award.index');
           }
          }
        }
        if(auth()->user()->can($permission_2)){
            foreach($Awards as $award) {
                if ((int)$award->employee->id == Auth::user()->employee->id ) {
                  toastr()->error(trans('messages.HR_Permission'));
                  return redirect()->route('Give_Award.index');

              }
            }
        }
        }
        else{
            toastr()->error(trans('messages.You_Are_Not_Employee'));
            return redirect()->back();
        }

        EmployeeAward::whereIn('id', $delete_all_id)->Delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Give_Award.index');

    }

   public function destroy(Request $request)
    {
        $Awards = EmployeeAward::findOrFail($request->id);

        $permission_2 =  Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_على_الموظفين_فقط')->first();

        if(auth()->user()->can($permission_2)){

                             if ($Awards->Employee_Id == Auth::user()->employee->id) {

                                 toastr()->error(trans('messages.HR_Permission'));
                                 return  redirect()->route('Give_Award.index');

                             }
                         }
        $Awards->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Give_Award.index');
    }
    public function getEmployees($id)
    {
        $list_employees = Employee::select(DB::raw("CONCAT(FName,' ',LName,' - ',Code) AS Name"),'id')
        ->where("Location_Id", $id)
        ->get()
        ->pluck("Name", "id");
         return $list_employees;


    }
     public function GeneratePDF(Request $request)
    {
        $employee = Employee::findOrFail($request->emp_id);
        $award = Award::findOrFail($request->award_id);
        $EmployeeAward = EmployeeAward::findOrFail($request->emp_award_id);

        $pdf = PDF::loadView('pages.Awards.certificate_PDF',['employee'=>$employee,'award'=>$award,'EmployeeAward'=>$EmployeeAward],[],
        [ 'mode' => 'utf-8',
        'format' => 'A4-L',
        'orientation' => 'L',
        'default_font'=> 'sans-serif',
        'display_mode'  => 'fullpage',
        'margin_left'    => 40,
      ]);
      return $pdf->stream('Employee_Award_PDF_for_'.$employee->FName.'_'.$employee->LName.'.pdf');

    }
}
