<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
use App\Location;
use App\Department;

class Attendance extends Model
{
    protected $table = 'attendances';
    public $timestamps = true;
    protected $guarded  = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }


}
