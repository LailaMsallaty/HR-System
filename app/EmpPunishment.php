<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
class EmpPunishment extends Model
{
    protected $table = 'Employee_Punishments';
    public $timestamps = true;
    protected $guarded = [];


    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }
}
