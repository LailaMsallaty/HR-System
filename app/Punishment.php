<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;

class Punishment extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];

    protected $table = 'punishments';
    public $timestamps = true;
    protected $guarded  = [];


    public function employees()
    {
        return $this->belongsToMany(Employee::class,'Employee_Punishments','Employee_Id','Punishment_Id')->withTimestamps();
    }
}
