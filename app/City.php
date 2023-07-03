<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Location;
use App\Country;

class City extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
    protected $guarded =[];

    public function locations()
    {
        return $this->hasMany(Location::Class,'City_Id');
    }
    public function country()
    {
        return $this->belongsTo(Country::Class,'Country_Id');
    }
}
