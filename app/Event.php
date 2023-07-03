<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{

    protected $table = 'events';
    public $timestamps = true;

    use HasTranslations;

    public $translatable = ['title'];
	protected $fillable = [
		'title', 'start', 'end'
	];
}
