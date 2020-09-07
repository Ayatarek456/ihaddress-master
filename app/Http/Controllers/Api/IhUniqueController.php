<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Http\Controllers\Controller;
use App\User;
use Keygen\Keygen;

class IhUniqueController extends Controller
{

    protected function getIpAddress($ip){

        $arr_ip = geoip()->getLocation($ip);
        return $arr_ip->getAttribute('iso_code');
    }



    protected function generateNumericKey($country)
    {

        return Keygen::numeric(12)->prefix($country . ".")->generate(function($key) {
            return join('.', str_split($key, 3));
        });
    }

    // generateID() method

    public function generateIH($country)
    {
        $ih = $this->generateNumericKey($country);

        // Ensure IH does not exist
        // Generate new one if ID already exists
        while (Address::where('ih',$ih)->count() > 0) {
            $ih = $this->generateNumericKey($country);
        }

        return $ih;
    }

}
