<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Department;
use App\City;
use App\Country;
use App\Employee;
use App\EmployeeSalary;
use App\Attendance;
class Location extends Model
{

    use HasTranslations;
    public $translatable = ['Address'];

    protected $table = 'Locations';
    public $timestamps = true;
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsToMany(Department::class,'Department_Location','Location_Id','Department_Id')->withTimestamps();
    }
    public function city()
    {
        return $this->belongsTo(City::class,'City_Id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class,'Location_Id');
    }


}
