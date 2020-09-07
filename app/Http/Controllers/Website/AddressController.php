<?php

namespace App\Http\Controllers\Website;

use App\Country;
use App\Http\Controllers\Api\IhUniqueController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function get_address()
    {
        $address = Auth::user()->address()->count();

        if ($address == 0)
        {
            $json_data = array(
                'message'  => 'set your address',
                "data"     => $address
            );
        }else
            {
                $address = Auth::user()->address ;
                $json_data = array(
                    'message'  => 'ok',
                    'percentage'  => (int)calculate_address($address),
                    "data"     => $address
                );
            }

        return response()->json($json_data);
    }

    public function store(Request $request)
    {
        $arg = [];

        $request['landmark'] = $request->landmark1 . ', ' . $request->landmark2;

        $arg = [
            'state' => $request->state,
            'streetname1' => $request->streetname1,
            'streetname2' => $request->streetname2,
            'myhomeis' => $request->myhomeis,
            'number' => $request->number,
            'landmark' => $request->landmark,
            'type' => $request->type,
        ];

        if (Auth::user()->address()->count() == 0)
        {
            $arg['country_id'] = $request->country_id;
            $country_code = Country::find($request->country_id);
            $ih = (new IhUniqueController)->generateIH($country_code->country_code);

            $arg['ih'] = $ih;
        }else
        {
            $ih = Auth::user()->address->ih ;
            $country_id = Auth::user()->address->country_id ;
            $arg['ih'] = $ih;
            $arg['country_id'] = $country_id;
        }

        if ($request->save_location == 'true')
        {
            $arg['latitude'] = $request->current_lat;
            $arg['longitude'] = $request->current_lan;
        }

        $address = Auth::user()->address()->updateOrCreate( ['user_id' => Auth::id()] ,$arg);

        $json_data = array(
            'message'     => 'success',
            'percentage'  => (int)calculate_address($address),
            "data"        => $address
        );

        return response()->json($json_data);
    }

    public function store_image(Request $request)
    {
        $destinationPath = 'images';
        $dbPath1 = null;
        $dbPath2 = null;
        $dbPath3 = null;
        $dbPath4 = null;

        if ($request->hasFile('image1')) {
//            unlink(public_path().'/'  . auth()->user()->address->image1);
            $image1 = $request->image1;
            $input['imagename1'] = time() . '1.' . $image1->getClientOriginalExtension();
            $image1->move($destinationPath, $input['imagename1']);
            $dbPath1 = $destinationPath . '/' . $input['imagename1'];
            $data['image1'] = $dbPath1;
        }
        if ($request->hasFile('image2')) {
//            unlink(public_path().'/'  . auth()->user()->address->image2);
            $image2 = $request->image2;
            $input['imagename2'] = time() . '2.' . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $input['imagename2']);
            $dbPath2 = $destinationPath . '/' . $input['imagename2'];
            $data['image2'] = $dbPath2;
        }
        if ($request->hasFile('image3')) {
//            unlink(public_path().'/'  . auth()->user()->address->image3);
            $image3 = $request->image3;
            $input['imagename3'] = time() . '3.' . $image3->getClientOriginalExtension();
            $image3->move($destinationPath, $input['imagename3']);
            $dbPath3 = $destinationPath . '/' . $input['imagename3'];
            $data['image3'] = $dbPath3;
        }
        if ($request->hasFile('image4')) {
//            unlink(public_path().'/'  . auth()->user()->address->image4);
            $image4 = $request->image4;
            $input['imagename4'] = time() . '4.' . $image4->getClientOriginalExtension();
            $image4->move($destinationPath, $input['imagename4']);
            $dbPath4 = $destinationPath . '/' . $input['imagename4'];
            $data['image4'] = $dbPath4;
        }

        $address = Auth::user()->address()->update($data);

        $json_data = array(
            'message'     => 'images upload success',
            "data"        => $address
        );

        return response()->json($json_data);
    }
}
