<?php

namespace App\Http\Controllers\Website;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function get_country()
    {
        $country = Country::all();

        $json_data = array(
            'message'  => 'ok',
            "data"     => $country
        );

        return response()->json($json_data);
    }
}
