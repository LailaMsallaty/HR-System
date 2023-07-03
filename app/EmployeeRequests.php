<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRequests extends Model
{
    protected $table = 'employee_requests';
    public $timestamps = true;
    protected $guarded = [];
}
