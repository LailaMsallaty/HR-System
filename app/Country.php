<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Location;
use App\City;

class Country extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
    protected $guarded =[];


    public function cities()
    {
        return $this->hasMany(City::Class,'Country_id');
    }

}
