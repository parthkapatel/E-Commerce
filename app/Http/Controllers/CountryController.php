<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryController extends Controller
{

    public function getCountryStateCity()
    {
        return Country::with('states','states.cities')->get();
    }

}
