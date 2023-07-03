<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
class DepartmentLocation extends Model
{
    protected $table = 'Department_Location';
    public $timestamps = true;
    protected $guarded = [];

    public function manager()
    {
        return $this->hasOne(Employee::class,'Manager_Id');
    }

}
