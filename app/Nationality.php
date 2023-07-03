<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;

class Nationality extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
    protected $table = 'nationalities';

    //protected $guarded =[];

    public function employees()
    {
        return $this->hasMany(Employee::Class,'Nationality_Employee_id');
    }
}
