<?php

namespace App\Http\Controllers\Website;

use App\Address;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index()
    {
        return view('website.search');
    }

    public function search_ajax(Request $request)
    {
        $address = Address::where('ih',$request->ih)->first();

        $json_data = array(
            'message'  => 'ok',
            "data"     => $address
        );

        return response()->json($json_data);
    }
}
