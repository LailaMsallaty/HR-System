<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Employee;
class Task extends Model
{
    protected $table = 'tasks';
    public $timestamps = true;
    protected $guarded = [];

    use HasTranslations;
    public $translatable = ['Title'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }
}
