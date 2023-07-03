<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{

    protected $table = 'JobSeekers';
    public $timestamps = true;

    // public function skills()
    // {
    //     return $this->belongsToMany('Skill');
    // }

    // public function pastExperience()
    // {
    //     return $this->hasMany('SeekerPastExperience');
    // }

    // public function positions()
    // {
    //     return $this->belongsToMany('Position');
    // }

    // public function degree()
    // {
    //     return $this->belongsTo('Degree');
    // }

    // public function awards()
    // {
    //     return $this->hasMany('JobSeekerAward');
    // }

}
