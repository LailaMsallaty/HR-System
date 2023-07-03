<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
use Spatie\Translatable\HasTranslations;

class EmployeeDegree extends Model
{

    protected $table = 'Employee_Degree';
    public $timestamps = true;
    use HasTranslations;
    public $translatable = ['Level'];
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany(Employee::class,'Degree_Id');
    }

}
