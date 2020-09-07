<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class RateController extends Controller
{


    public function store(Request $request)
    {
        $data = $request->all();
        $address = Address::find($data['address_id'])->rate()->create($data);
        return $address;
    }

}
