<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function getStatesByCountryId($countryId)
    {
        return State::where("countryId",$countryId)->get();
    }
}
