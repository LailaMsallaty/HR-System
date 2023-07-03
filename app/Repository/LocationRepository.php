<?php

namespace App\Repository;
use App\Location;

class LocationRepository implements LocationRepositoryInterface{

    public function getAllLocations(){
        return Location::all();
    }

  }
