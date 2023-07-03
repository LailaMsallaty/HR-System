<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;
class Award extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];

    protected $table = 'awards';
    public $timestamps = true;
    protected $guarded  = [];

    public function employees()
    {
        return $this->belongsToMany(Employee::class,'Employee_Awards','Employee_Id','Award_Id')->withTimestamps();
    }
}
