<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
class EmployeeAward extends Model
{
    protected $table = 'Employee_Awards';
    public $timestamps = true;
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }
}
