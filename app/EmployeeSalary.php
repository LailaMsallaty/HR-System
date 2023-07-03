<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
use App\Location;
use App\Department;

class EmployeeSalary extends Model
{

    protected $table = 'Employee_Salary';
    public $timestamps = true;
    protected $guarded =[];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }
   

}
