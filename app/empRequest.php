<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
use Spatie\Translatable\HasTranslations;

class empRequest extends Model
{
    protected $table = 'requests';
    public $timestamps = true;
    protected $guarded = [];
    use HasTranslations;
    public $translatable = ['Name'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class,'employee_requests','Employee_Id','Request_Id')->withTimestamps();
    }
}


