<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Employee;
use App\Department;
use App\EmployeeSalary;
use App\EmployeeLeave;
use App\Leave;
use App\Award;
use App\Punishment;
use App\DepartmentLocation;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:Reports|التقارير']);
    }
    public function index()
    {
        //
    }

    public function View_Company_Report(){

        $locations = Location::all();
        $departments = Department::all();
        $Departments_loc = DepartmentLocation::join('Departments','Departments.id','=','Department_Location.Department_Id')
        ->join('Employees','Employees.id','=','Department_Location.Manager_Id')
        ->join('Locations','Locations.id','=','Department_Location.Location_Id')
        ->select('Locations.Address','Department_Location.Department_Id','Employees.FName','Employees.LName','Employees.Code')
        ->get();
        $employees = Employee::all();
        return view('pages.Reports.Company',compact('Departments_loc','locations','employees','departments'));

    }
    public static function getNameAttribute($value)
    {
        return json_decode($value)->{\App::getLocale()};
    }
    public function View_Payments_Report(){

        $salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary','Employees.Code')
        ->orderby('Employee_Salary.id','desc')
        ->get();
        $Locations = Location::all();
        return view('pages.Reports.Payments', compact('salaries','Locations'));

    }
    public function View_Leaves_Report(){

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();
        $Locations = Location::all();
        $leaves = Leave::all();

        return view('pages.Reports.Leaves', compact('Leaves','Locations','leaves'));

    }
    public function View_Awards_Punishments(){
        $all_Award = Award::all();
        $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
        ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Awards.id','desc')
        ->get();
        $locations = Location::all();
        $Employees = Employee::all();
        $Selection = True;
        return view('pages.Reports.Awards_Punishment',compact('Selection','all_Award','Awards','locations','Employees'));

    }
    public function View_Employees_Report(){

        $Departments = Department::all();
        $Employees = Employee::orderby('id','desc')
        ->get();
        $Locations = Location::all();
        return view('pages.Reports.Employees', compact('Locations','Departments','Employees'));

    }

    public function makeEmployeesReport(Request $request){


        $date_from = $request->input('From');
        $date_to = $request->input('To');


          /**
         *  employees between two dates
         */
if($request->selection == 1)
     {
        if ($request->Location == 0 && $request->Department == 0 ) {

            $Employees = Employee::whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->orderby('id','desc')
            ->get();

        }

        elseif($request->Location == 0 && $request->Department !== 0){

            $Employees = Employee::whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Department_Id',$request->Department)
            ->orderby('id','desc')
            ->get();

        }

        elseif ($request->Location !== 0 && $request->Department == 0) {

            $Employees = Employee::whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Location_Id',$request->Location)
            ->orderby('id','desc')
            ->get();

        }

        else{

            $Employees = Employee::whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Location_Id',$request->Location)
            ->where('Department_Id',$request->Department)
            ->orderby('id','desc')
            ->get();

        }

}else{

        if ($request->Location == 0 && $request->Department == 0 ) {

            $employees = Employee::onlyTrashed()->whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->orderby('id','desc')
            ->get();

        }

        elseif($request->Location == 0 && $request->Department !== 0){

            $employees = Employee::onlyTrashed()->whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Department_Id',$request->Department)
            ->orderby('id','desc')
            ->get();

        }

        elseif ($request->Location !== 0 && $request->Department == 0) {

            $employees = Employee::onlyTrashed()->whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Location_Id',$request->Location)
            ->orderby('id','desc')
            ->get();

        }

        else{

            $employees = Employee::onlyTrashed()->whereBetween('HireDate' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Location_Id',$request->Location)
            ->where('Department_Id',$request->Department)
            ->orderby('id','desc')
            ->get();

            }

    }

        //generate pdf


    if ($_POST['action'] == 'report') {
    if(isset($Employees)){
            $pdf = PDF::loadView('pages.Reports.EmployeesReport',['Employees' => $Employees,'from'=>$date_from,'to'=>$date_to],[],
            [ 'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'xL',
            'default_font' => 'sans-serif',
            'display_mode'  => 'fullpage',
            'margin_left'   => 20,
            ]);
            return $pdf->stream('Employees_report_from_'.$date_from.'_to_'.$date_to.'.pdf');

    }else{

        $pdf = PDF::loadView('pages.Reports.EmployeesResignedReport',['employees' => $employees,'from'=>$date_from,'to'=>$date_to],[],
        [ 'mode' => 'utf-8',
        'format' => 'A4-L',
        'orientation' => 'xL',
        'default_font' => 'sans-serif',
        'display_mode'  => 'fullpage',
        'margin_left'   => 20,
        ]);
        return $pdf->stream('Resigned_Employees_report_from_'.$date_from.'_to_'.$date_to.'.pdf');

    }

    }else{

        if (isset($employees)) {
            $Departments = Department::all();
            $Locations = Location::all();
            return view('pages.Reports.Employees',compact('Locations','Departments','employees'));

        }else {
        $Departments = Department::all();
        $Locations = Location::all();
        return view('pages.Reports.Employees', compact('Locations','Departments','Employees'));
         }

    }
    }

    public function makePaymentsReport(Request $request){

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
        if ($request->Location == 0 && $request->selection == 1 ) {

            $salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
            ->whereBetween('Employee_Salary.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
            ->orderby('Employee_Salary.id','desc')
            ->get();


        }

        elseif($request->Location == 0 && $request->selection == 2){

            $Employees = Employee::select('id')->where('Manager',1)->get('id')->modelKeys();

            $salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
            ->whereIn('Employee_Salary.Employee_Id', $Employees)
            ->whereBetween('Employee_Salary.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
            ->orderby('Employee_Salary.id','desc')
            ->get();

        }

        elseif ($request->Location == 0 && $request->selection == 3) {

            $ids_paid = Employee::join('Employee_Salary','Employee_Salary.Employee_Id','=','Employees.id')
            ->whereBetween('Employee_Salary.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employees.id')
            ->orderby('Employee_Salary.id','desc')
            ->get('Employees.id')->modelKeys();
            $Employees = Employee::whereNotIn('id',$ids_paid)->get(); // not paid
        }

        elseif( $request->Location !== 0 && $request->selection == 1){

            $Employees = Employee::select('id')->where('Location_Id',$request->Location)->get('id')->modelKeys();

            $salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
            ->whereIn('Employee_Salary.Employee_Id', $Employees)
            ->whereBetween('Employee_Salary.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
            ->orderby('Employee_Salary.id','desc')
            ->get();

            }

        elseif ($request->Location !== 0 && $request->selection == 2) {

            $Employees = Employee::select('id')->where('Location_Id',$request->Location)->where('Manager',1)->get('id')->modelKeys();

            $salaries = EmployeeSalary::join('Employees','Employees.id','=','Employee_Salary.Employee_Id')
            ->whereIn('Employee_Salary.Employee_Id', $Employees)
            ->where('Employees.Deleted_at',null)
            ->whereBetween('Employee_Salary.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->select('Employee_Salary.*','Employees.FName','Employees.LName','Employees.Code','Employees.Salary')
            ->orderby('Employee_Salary.id','desc')
            ->get();

        }

        else {

            $ids_paid = Employee::join('Employee_Salary','Employee_Salary.Employee_Id','=','Employees.id')
            ->where('Employees.Location_Id',$request->Location)
            ->whereBetween('Employee_Salary.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employees.id')
            ->orderby('Employee_Salary.id','desc')
            ->get('Employees.id')->modelKeys();

            $Employees = Employee::whereNotIn('id',$ids_paid)->get(); // not paid


        }

        //generate pdf


    if ($_POST['action'] == 'report') {
        if (isset($salaries)) {
            $pdf = PDF::loadView('pages.Reports.PaymentsReport',['salaries' => $salaries,'from'=>$date_from,'to'=>$date_to],[],
            [ 'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'xL',
            'default_font' => 'sans-serif',
            'display_mode'  => 'fullpage',
            'margin_left'   => 40,
            ]);

            return $pdf->stream('Employees_Payments_report_from_'.$date_from.'_to_'.$date_to.'.pdf');
        }else{

            $pdf = PDF::loadView('pages.Reports.EmployeesNotPaidReport',['Employees' => $Employees,'from'=>$date_from,'to'=>$date_to],[],
            [ 'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'xL',
            'default_font' => 'sans-serif',
            'display_mode'  => 'fullpage',
            'margin_left'   => 20,
            ]);

            return $pdf->stream('Employees_Payments_report_from_'.$date_from.'_to_'.$date_to.'.pdf');

        }
    }else{

        if (isset($salaries)) {
            $Locations = Location::all();
            $from = $date_from;
            $to = $date_to;
            return view('pages.Reports.Payments',compact('salaries','Locations','from','to'));

        }else {
            $from = $date_from;
            $to = $date_to;
            $Locations = Location::all();
            return view('pages.Reports.Payments', compact('Employees','Locations','from','to'));
        }

    }
    }
public function makeLeavesReport(Request $request){

    $this->validate($request,[
        'From' => 'required',
        'To'   => 'required',
        'Location'=>'required',
        'Leave'=>'required',
        'selection'=>'required',
    ]);

    $date_from = $request->input('From');
    $date_to = $request->input('To');


    /**
     *  employees between two dates
     */
if($request->Leave == 0){
    if ($request->Location == 0 && $request->selection == 0) {

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',1)
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')

        ->get();

    }
    elseif($request->Location == 0 && $request->selection == 1) {
        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',2)
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();

    }
    elseif($request->Location == 0 && $request->selection == 2) {
        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->where('Employees.Deleted_at',null)
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',0)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();

    }
    elseif($request->Location !== 0 && $request->selection == 0){

        $Employees = Employee::select('id')
        ->where('Location_Id',$request->Location)->get('id')->modelKeys();

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',1)
        ->where('Employees.Deleted_at',null)
        ->whereIn('Employee_Leaves.Employee_Id', $Employees)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code'
        ->orderby('Employee_Leaves.id','desc')
        )->get();



    }
    elseif($request->Location !== 0 && $request->selection == 1){

        $Employees = Employee::select('id')
        ->where('Location_Id',$request->Location)->get('id')->modelKeys();

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',2)
        ->where('Employees.Deleted_at',null)
        ->whereIn('Employee_Leaves.Employee_Id', $Employees)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();


    }
    else{

        $Employees = Employee::select('id')->where('Location_Id',$request->Location)->get('id')->modelKeys();

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',0)
        ->whereIn('Employee_Leaves.Employee_Id', $Employees)
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();


    }
}else{

    if ($request->Location == 0 && $request->selection == 0) {

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',1)
        ->where('Employees.Deleted_at',null)
        ->where('Employee_Leaves.Leave_Id',$request->Leave)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();

    }
    elseif($request->Location == 0 && $request->selection == 1) {
        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',2)
        ->where('Employees.Deleted_at',null)
        ->where('Employee_Leaves.Leave_Id',$request->Leave)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();

    }
    elseif($request->Location == 0 && $request->selection == 2) {
        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',0)
        ->where('Employee_Leaves.Leave_Id',$request->Leave)
        ->where('Employees.Deleted_at',null)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();

    }
    elseif($request->Location !== 0 && $request->selection == 0){

        $Employees = Employee::select('id')->where('Location_Id',$request->Location)->get('id')->modelKeys();

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',1)
        ->where('Employees.Deleted_at',null)
        ->whereIn('Employee_Leaves.Employee_Id', $Employees)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();



    }
    elseif($request->Location !== 0 && $request->selection == 1){

        $Employees = Employee::select('id')->where('Location_Id',$request->Location)->get('id')->modelKeys();

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',2)
        ->where('Employees.Deleted_at',null)
        ->whereIn('Employee_Leaves.Employee_Id', $Employees)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();


    }
    else{

        $Employees = Employee::select('id')->where('Location_Id',$request->Location)->get('id')->modelKeys();

        $Leaves = Leave::join('Employee_Leaves','leaves.id','=','Employee_Leaves.Leave_Id')
        ->join('Employees','Employees.id','=','Employee_Leaves.Employee_Id')
        ->whereBetween('Employee_Leaves.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->where('Employee_Leaves.Status',0)
        ->where('Employees.Deleted_at',null)
        ->whereIn('Employee_Leaves.Employee_Id', $Employees)
        ->select('Employee_Leaves.*','Employees.FName','Employees.LName','leaves.Name','Employees.Code')
        ->orderby('Employee_Leaves.id','desc')
        ->get();


    }
}
    //generate pdf


if ($_POST['action'] == 'report') {
    $pdf = PDF::loadView('pages.Reports.LeaveReport',['Leaves' => $Leaves,'from'=>$date_from,'to'=>$date_to  ],[],
    [ 'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'xL',
    'default_font' => 'sans-serif',
    'display_mode'  => 'fullpage',
    'margin_left'   => 65,
  ]);
  return $pdf->stream('Employees_Leaves_report_from_'.$date_from.'_to_'.$date_to.'.pdf');
}else{

  $Locations = Location::all();
  $leaves = Leave::all();
  $from = $date_from;
    $to = $date_to;
  return view('pages.Reports.Leaves',compact('Leaves','Locations','leaves','from','to'));

}
    }

    public function makeAwardsPunishmentsReport(Request $request){


        $date_from = $request->input('From');
        $date_to = $request->input('To');

        /**
         *  employees between two dates
         */
    if(isset($request->selection) && $request->selection == 1){
        if ($request->Location == 0) {

            $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
            ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
            ->whereBetween('Employee_Awards.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')
            ->orderby('Employee_Awards.id','desc')
            ->get();

        }
        else{
            $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
            ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
            ->whereBetween('Employee_Awards.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Location_Id',$request->Location)
            ->where('Employees.Deleted_at',null)
            ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')
            ->orderby('Employee_Awards.id','desc')
            ->get();

        }

    }elseif(isset($request->selection ) && $request->selection == 2){

        if ($request->Location == 0) {

            $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
            ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
            ->whereBetween('Employee_Punishments.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->where('Employees.Deleted_at',null)
            ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
            ->orderby('Employee_Punishments.id','desc')
            ->get();

        }
        else{
            $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
            ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
            ->where('Employees.Location_Id',$request->Location)
            ->where('Employees.Deleted_at',null)
            ->whereBetween('Employee_Punishments.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
            ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
            ->orderby('Employee_Punishments.id','desc')
            ->get();
        }
    }elseif(isset($request->Award) && $request->Location == 0)
    {
        $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
        ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
        ->where('awards.id',$request->Award)
        ->where('Employees.Deleted_at',null)
        ->whereBetween('Employee_Awards.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Awards.id','desc')

        ->get();


    }elseif(isset($request->Award) && $request->Location !== 0)
    {
        $Awards = Award::join('Employee_Awards','awards.id','=','Employee_Awards.Award_Id')
        ->join('Employees','Employees.id','=','Employee_Awards.Employee_Id')
        ->where('Employees.Location_Id',$request->Location)
        ->where('awards.id',$request->Award)
        ->where('Employees.Deleted_at',null)
        ->whereBetween('Employee_Awards.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->select('Employee_Awards.*','Employees.FName','Employees.LName','awards.Name','Employees.Location_Id','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Awards.id','desc')
        ->get();

    }elseif (isset($request->Punishment) && $request->Location == 0) {

        $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
        ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
        ->where('punishments.id',$request->Punishment)
        ->where('Employees.Deleted_at',null)
        ->whereBetween('Employee_Punishments.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Punishments.id','desc')
        ->get();

    }elseif (isset($request->Punishment) && $request->Location !== 0) {

        $Punishments = Punishment::join('Employee_Punishments','punishments.id','=','Employee_Punishments.Punishment_Id')
        ->join('Employees','Employees.id','=','Employee_Punishments.Employee_Id')
        ->where('Employees.Location_Id',$request->Location)
        ->where('punishments.id',$request->Punishment)
        ->where('Employees.Deleted_at',null)
        ->whereBetween('Employee_Punishments.created_at' ,[new Carbon($date_from),new Carbon($date_to)])
        ->select('Employee_Punishments.*','Employees.FName','Employees.LName','punishments.Name','punishments.Description','punishments.Deducted_Amount','Employees.Location_Id','Employees.Department_Id as DepartmentID','Employees.id as EmployeeID','Employees.Code')
        ->orderby('Employee_Punishments.id','desc')
        ->get();

    }

        //generate pdf


    if($_POST['action'] == 'report') {
        if(isset($Punishments)){
            $pdf = PDF::loadView('pages.Reports.PunishmentsReport',['Punishments' => $Punishments,'from'=>$date_from,'to'=>$date_to  ],[],
            [ 'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'xL',
            'default_font'=> 'sans-serif',
            'display_mode'  => 'fullpage',
            'margin_left'    => 45,
        ]);

        return $pdf->stream('Employees_Punishments_report_from_'.$date_from.'_to_'.$date_to.'.pdf');
        }else{

            $pdf = PDF::loadView('pages.Reports.AwardsReport',['Awards' => $Awards,'from'=>$date_from,'to'=>$date_to  ],[],
            [ 'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'xL',
            'default_font' => 'sans-serif',
            'display_mode'  => 'fullpage',
            'margin_left'   => 65,
        ]);
        return $pdf->stream('Employees_Awards_report_from_'.$date_from.'_to_'.$date_to.'.pdf');

        }

    }else{

        if(isset($Punishments)) {
            $locations = Location::all();
            $Employees = Employee::all();
            $Departments = Department::all();
            $punishments = Punishment::all();
            $from = $date_from;
            $to = $date_to;
            return view('pages.Reports.Awards_Punishment',compact('Departments','punishments','Employees','Punishments','locations','from','to'));

        }else{
            $locations = Location::all();
            $Employees = Employee::all();
            $all_Award = Award::all();
            $from = $date_from;
            $to = $date_to;
            return view('pages.Reports.Awards_Punishment',compact('all_Award','Awards','Employees','locations','from','to'));
        }

    }
    }
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
        //
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
        //
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
