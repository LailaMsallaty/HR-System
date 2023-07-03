<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRole extends Model
{

    protected $table = 'Employee_Role';
    public $timestamps = true;
    protected $fillable = ['id'
    ,'Position_Id'
    ,'Employee_Id'];
}
