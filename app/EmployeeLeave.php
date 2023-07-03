<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
use App\Leave;
class EmployeeLeave extends Model
{

    protected $table = 'Employee_Leaves';
    public $timestamps = true;
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }
   


}
