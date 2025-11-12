<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Country;

class CountryController extends Controller
{
    public function get_countries()
    {

        $countries = Country::all();

        return response()->json($countries);

    }
}
