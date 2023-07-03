<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;
class Leave extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];

    protected $table = 'Leaves';
    public $timestamps = true;
    protected $guarded = [];


    public function employees()
    {
        return $this->belongsToMany(Employee::class,'Employee_Leaves','Employee_Id','Leave_Id')->withTimestamps();
    }
}

