<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;
use App\EmployeeSalary;
use App\Position;
use App\Location;
use App\Attendance;


class Department extends Model
{

    use HasTranslations;
    public $translatable = ['Name'];

    protected $table = 'Departments';
    public $timestamps = true;
    protected $guarded = [];


    public function positions()
    {
        return $this->hasMany(Position::Class,'Department_Id');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class,'Department_Location','Department_Id','Location_Id')->withTimestamps();
    }

    public function employees()
    {
        return $this->hasMany(Employee::Class,'Department_Id');
    }



}
