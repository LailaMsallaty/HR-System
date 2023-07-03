<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Nationality;
use App\Position;
use App\Location;
use App\EmployeeSalary;
use App\EmployeeDegree;
use App\AdvancePayment;
use App\DepartmentLocation;
use App\Attendance;
use App\Leave;
use App\Award;
use App\empRequest;
use App\EmployeeLeave;
use App\Task;
use App\Punishment;
use App\User;
use App\EmployeeAward;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{

    use Notifiable;
    use SoftDeletes;
    use HasTranslations;
    public $translatable = ['Gender','Trainee'];

    protected $table = 'Employees';
    public $timestamps = true;
    protected $fillable  = [
    'id',
    'FName',
    'Location_Id',
    'Code',
    'Salary',
    'Skills',
    'Degree_Id',
    'email',
    'password'
    ,'LName'
    ,'BirthDate'
    ,'email'
    ,'Nationality_Employee_id'
    ,'Gender'
    ,'HireDate'
    ,'Address'
    ,'Department_Id'
    ,'Manager'
    ,'Trainee'
    ,'Years_Of_Experience'
    ,'ImageName'];


    public function department()
    {
        return $this->belongsTo(Department::class,'Department_Id');
    }

    public function attachments()
    {
        return $this->morphMany('App\Attachment','attachmentable');
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class,'Employee_Role','Employee_Id','Position_Id')->withTimestamps();
    }

    public function Nationality()
    {
        return $this->belongsTo(Nationality::class,'Nationality_Employee_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class,'Location_Id');
    }


    public function salary()
    {
        return $this->hasMany(EmployeeSalary::class,'Employee_Id');
    }
    public function empleave()
    {
        return $this->hasMany(EmployeeLeave::class,'Employee_Id');
    }
    public function empaward()
    {
        return $this->hasMany(EmployeeAward::class,'Employee_Id');
    }
    public function advancePayments()
    {
        return $this->hasMany(AdvancePayment::class,'Employee_Id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::Class,'Employee_Id');
    }

    public function department_location()
    {
        return $this->belongsTo(DepartmentLocation::class,'Manager_Id');
    }

    public function degree()
    {
        return $this->belongsTo(EmployeeDegree::class,'Degree_Id');
    }
    public function leaves()
    {
        return $this->belongsToMany(Leave::class,'Employee_Leaves','Employee_Id','Leave_Id')->withTimestamps();
    }

    public function requests()
    {
        return $this->belongsToMany(empRequest::class,'employee_requests','Employee_Id','Request_Id')->withTimestamps();
    }
    public function awards()
    {
        return $this->belongsToMany(Award::class,'Employee_Awards','Employee_Id','Award_Id')->withTimestamps();
    }
    public function punishments()
    {
        return $this->belongsToMany(Punishment::class,'Employee_Punishments','Employee_Id','Punishment_Id')->withTimestamps();
    }
    public function tasks()
    {
        return $this->hasMany(Task::Class,'Employee_Id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'Employee_Id');
    }

}


