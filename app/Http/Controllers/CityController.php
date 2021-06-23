<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCitiesByStateId($stateId)
    {
        return City::where("stateId",$stateId)->get();
    }
}
