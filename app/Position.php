<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;
use App\Department;
use App\Requirement;

class Position extends Model
{

    use HasTranslations;
    public $translatable = ['Role','FT_PT'];

    protected $table = 'Positions';
    public $timestamps = true;
    protected $fillable = ['Role','id','Status','Salary' ,'FT_PT' ,'Requirements' ,'Department_Id'];
    // public function jobSeekers()
    // {
    //     return $this->belongsToMany('JobSeeker');
    // }

    // public function requirements()
    // {
    //     return $this->belongsToMany(Requirement::class);
    // }

    public function department()
    {
        return $this->belongsTo(Department::class,'Department_Id');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Employee','Employee_Role','Position_Id','Employee_Id')->withTimestamps();
    }

}
