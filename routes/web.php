<?php
use App\http\Controllers\EmployeeAttendanceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['guest','localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],'prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/', function () {
        return view('layouts.welcome');
    });

});



Route::get('login', function () {
    return view('auth.login');
})->name('login');



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {


     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    // Route::resource('jobseeker', 'JobSeekerController');
    // Route::resource('skill', 'SkillController');
    // Route::resource('jobseekerskill', 'JobSeekerSkillController');
    // Route::resource('degree', 'DegreeController');
    // Route::resource('seekerpastexperience', 'SeekerPastExperienceController');
    // Route::resource('jobseekeraward', 'JobSeekerAwardController');
    Route::resource('position', 'PositionController');
    // Route::resource('job_seeker_role', 'Job_Seeker_RoleController');
     Route::resource('location', 'LocationController');

    Route::resource('department', 'DepartmentController');

    Route::resource('employee', 'EmployeeController');

    Route::resource('country', 'CountryController');

    Route::resource('city', 'CityController');

    Route::resource('event', 'EventController');


    Route::resource('punishment', 'PunishmentController');
    Route::resource('Employee_punishment', 'EmployeePunishmentsController');
    Route::post('employee_punishment_update','EmployeePunishmentsController@update')->name('Punishment_employee_update');

     Route::resource('employeeaward', 'AwardController');
     Route::resource('Give_Award', 'EmployeeAwardController');
     Route::get('/Location_employees/{id}', 'EmployeeAwardController@getEmployees')->name('Location_employees');
     Route::post('Award_Generate_PDF','EmployeeAwardController@GeneratePDF')->name('Award_Generate_PDF');
     Route::get('/Employee_Awards', 'EmployeeAwardController@viewAwards')->name('Employee_Awards');


     Route::resource('Leave_Request', 'EmployeeLeaveController');
     Route::resource('employeeleave', 'LeaveController');
     Route::get('/Employee_Leave_Requests', 'LeaveController@viewRequests')->name('Employee_Leave_Requests');
     Route::post('/Accept_Reject_Leave_Request', 'LeaveController@accept_reject_Request')->name('Accept_Reject_Leave_Request');


     Route::resource('Send_Request', 'EmployeeRequestsController');
     Route::get('/Employee_Requests', 'EmployeeRequestsController@viewRequests')->name('Employee_Requests');
     Route::post('/Accept_Reject_Request', 'EmployeeRequestsController@accept_reject_Request')->name('Accept_Reject_Request');
     Route::get('Download_Statement/{employeename}/{filename}', 'EmployeeRequestsController@Download_Statement')->name('Download_Statement');
     Route::get('Download_Replying/{employeename}/{filename}', 'EmployeeRequestsController@Download_Replying')->name('Download_Replying');
     Route::get('ShowRequest/{employeename}/{filename}/{id}', 'EmployeeRequestsController@showRequest')->name('ShowRequest');
     Route::get('ShowReply/{employeename}/{filename}/{id}', 'EmployeeRequestsController@showReply')->name('ShowReply');
     Route::resource('Reply_Request', 'RequestReplyController');



     Route::resource('Send_Task', 'TaskController');
     Route::resource('Receive_Task', 'EmployeeTaskController');
     Route::post('/Accept_Reject_Task', 'TaskController@accept_reject_Task')->name('Accept_Reject_Task');
     Route::get('Download_Task/{employeename}/{filename}', 'TaskController@Download_Task')->name('Download_Task');
     Route::get('Download_Receive_Task/{employeename}/{filename}', 'TaskController@Download_Task_receive')->name('Download_Receive_Task');
     Route::get('ShowTask/{employeename}/{filename}/{id}', 'TaskController@ShowTask')->name('ShowTask');
     Route::get('ShowReceiveTask/{employeename}/{filename}/{id}', 'EmployeeTaskController@ShowTask')->name('ShowReceiveTask');


    Route::resource('employeeattendance', 'EmployeeAttendanceController');
    Route::get('/employees_Attendance/{id}/{loc}', 'EmployeeAttendanceController@showEmployee')->name('employees_Attendance');
    Route::get('View_Attendances', 'EmployeeAttendanceController@View_Attendances')->name('View_Attendances');
    Route::post('/reports/pdf','EmployeeAttendanceController@makeReport')->name('reports.make');

    Route::resource('employeesalary', 'EmployeeSalaryController');
    Route::resource('employeerole', 'EmployeeRoleController');
    Route::resource('employeedegree', 'EmployeeDegreeController');
    Route::post('delete_all', 'EmployeeController@delete_all')->name('delete_all');
    Route::get('/employees/{id}', 'PositionController@getEmployees')->name('employees');
    Route::get('/positions/{id}', 'EmployeeController@getPositions')->name('positions');
    Route::get('/locations/{id}', 'EmployeeController@getLocations')->name('locations');
    Route::get('/cities/{id}', 'LocationController@getCities')->name('cities');
    Route::post('Filter_Employees', 'EmployeeController@Filter_Employees')->name('Filter_Employees');
    Route::post('Upload_attachment', 'EmployeeController@Upload_attachment')->name('Upload_attachment');
    Route::get('Download_attachment/{employeename}/{filename}', 'EmployeeController@Download_attachment')->name('Download_attachment');
    Route::post('Delete_attachment', 'EmployeeController@Delete_attachment')->name('Delete_attachment');
    Route::get('showAttachment/{employeename}/{filename}/{id}', 'EmployeeController@showAttachment')->name('showAttachment');


    Route::get('/departments/{id}', 'EmployeeSalaryController@getDepartments')->name('departments');
    Route::get('/DepartmentEmployees/{id}/{loc}', 'EmployeeSalaryController@getEmployees')->name('Department_employees');
    Route::get('/employee_advance/{id}', 'EmployeeController@Show_Pay_Advance')->name('Show_Pay_Advance');
    Route::post('/pay_employee_advance', 'EmployeeController@Pay_Advance')->name('Pay_Advance');
    Route::post('/delete_employee_advance', 'EmployeeController@delete_Advance')->name('advance_destroy');
    Route::get('/edit_employee_advance/{id}/{empId}', 'EmployeeController@editAdvance')->name('edit_advance');
    Route::post('/update_employee_advance', 'EmployeeController@update_Advance')->name('Update_Advance');
    Route::get('/print_slip/{id}', 'EmployeeSalaryController@Print_Slip')->name('print_slip');
    Route::get('View_Advances', 'EmployeeController@View_Advances')->name('View_Advances');
    Route::post('/AdvancePaymentReports/pdf','EmployeeController@makeReport')->name('PaymentReports.make');


    Route::resource('resigned', 'ResignedController');
    Route::get('/Resign_departments/{id}', 'ResignedController@getResignDepartments')->name('Resign_departments');
    Route::get('/Resign_Department_Employees/{id}/{loc}', 'ResignedController@getResignEmployees')->name('Resign_Department_Employees');


    Route::get('export_employees', 'EmployeeController@export');
    Route::get('pdf_employees', 'EmployeeController@pdf');

    Route::post('delete_all_Countries', 'CountryController@delete_all')->name('delete_all_Countries');
    Route::post('delete_all_Cities', 'CityController@delete_all')->name('delete_all_Cities');
    Route::post('delete_all_Departments', 'DepartmentController@delete_all')->name('delete_all_Departments');
    Route::post('delete_all_Locations', 'LocationController@delete_all')->name('delete_all_Locations');
    Route::post('delete_all_Salaries', 'EmployeeSalaryController@delete_all')->name('delete_all_Salaries');
    Route::post('delete_all_Attendances', 'EmployeeAttendanceController@delete_all')->name('delete_all_Attendances');
    Route::post('delete_all_Leaves', 'LeaveController@delete_all')->name('delete_all_Leaves');
    Route::post('delete_all_Requests', 'EmployeeLeaveController@delete_all')->name('delete_all_Requests');
    Route::post('delete_all_Awards', 'EmployeeAwardController@delete_all')->name('delete_all_Awards');
    Route::post('delete_all_Give_Awards', 'EmployeeAwardController@delete_all_give_awards')->name('delete_all_Give_Awards');
    Route::post('delete_all_Employee_Awards', 'EmployeeAwardController@delete_all_Employee_awards')->name('delete_all_Employee_Awards');
    Route::post('delete_all_Employee_Requests', 'EmployeeRequestsController@delete_all_Employee_requests')->name('delete_all_Employee_Requests');
    Route::post('delete_all_AdvancePayments', 'EmployeeController@delete_all_AdvancePayments')->name('delete_all_AdvancePayments');
    Route::post('delete_all_Employee_Tasks', 'TaskController@delete_all_Employee_Tasks')->name('delete_all_Employee_Tasks');
    Route::post('delete_all_Punishments', 'PunishmentController@delete_all_Punishments')->name('delete_all_Punishments');
    Route::post('delete_all_Impose_Punishments', 'EmployeePunishmentsController@delete_all_Impose_punishments')->name('delete_all_Impose_Punishments');
    Route::post('delete_all_Users', 'UserController@delete_all_Users')->name('delete_all_Users');
    Route::post('delete_all_events', 'EventController@delete_all_events')->name('delete_all_events');



    Route::resource('report', 'ReportController');
    Route::get('Company_Report','ReportController@View_Company_Report')->name('Company_Report');
    Route::get('Payments','ReportController@View_Payments_Report')->name('Payments');
    Route::get('Leaves','ReportController@View_Leaves_Report')->name('Leaves');
    Route::get('Employees','ReportController@View_Employees_Report')->name('Employees');
    Route::get('Awards_Punishments','ReportController@View_Awards_Punishments')->name('Awards_Punishments');
    Route::post('/PaymentReports/pdf','ReportController@makePaymentsReport')->name('PaymentReports');
    Route::post('/LeaveReports/pdf','ReportController@makeLeavesReport')->name('LeaveReports');
    Route::post('/EmployeeReports/pdf','ReportController@makeEmployeesReport')->name('EmployeeReports');
    Route::post('/AwardsPunishmentsReports/pdf','ReportController@makeAwardsPunishmentsReport')->name('AwardsPunishmentsReports');



    Route::group(['middleware' => ['auth']], function() {
        Route::resource('roles','RoleController');
        Route::resource('users','UserController');
        });


    Route::get('MyAttendance', function () {
        return view('pages.Attendance.My_attendances');
    })->name('MY_Attendance');

    Route::get('MyTasks', function () {
        return view('pages.Tasks.My_Tasks');
    })->name('MY_Tasks');

    Route::get('events', function () {
        return view('pages.Events.Eventcalendar');
    })->name('Events');

    Route::get('/getEvents', 'EventController@getCalendar')->name('getEvents');
    Route::get('/getAttendances', 'EmployeeAttendanceController@getCalendar')->name('getAttendances');
    Route::get('/getLeaves', 'EmployeeLeaveController@getCalendar')->name('getLeaves');
    Route::get('/getTasks', 'EmployeeTaskController@getCalendar')->name('getTasks');


    Route::get('MarkAsRead_all','HomeController@MarkAsRead_all')->name('MarkAsRead_all');

    Route::get('/messages/{id}', 'HomeController@show')->name('messages.show');

    Route::post('/upload_personal_photo','EmployeeController@upload_personal_photo')->name('upload_personal_photo');



});
