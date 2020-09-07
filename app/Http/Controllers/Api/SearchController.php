<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Country;
use App\Http\Controllers\Api\IhUniqueController;
use App\Http\Controllers\Controller;
use App\Rate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //

    public function search(Request $request)
    {
        $ih = Address::where('ih', $request->ih)->with(['country','user:id,name'])->firstOrFail();

        $ih->image1 = asset($ih->image1) ;
        $ih->image2 = asset($ih->image2) ;
        $ih->image3 = asset($ih->image3) ;
        $ih->image4 = asset($ih->image4) ;
        $allRate = Rate::where('address_id', $ih['id'])->get();
        $total_rate = count($allRate);
       if($total_rate != 0){
           $good_rate = count($allRate->where('rate', 1));
           $rate = $good_rate / $total_rate * 100  ;
           $ih['rate']=  intval($rate) ;
       }else{
           $ih['rate']=  intval(100) ;
       }

//        $rate_dec = number_format($rate,0,'.','');
        return  $ih;
    }
}
