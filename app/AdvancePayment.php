<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class AdvancePayment extends Model
{

    protected $table = 'Advance_Payments';
    public $timestamps = true;
    protected $guarded =[];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'Employee_Id');
    }


}

