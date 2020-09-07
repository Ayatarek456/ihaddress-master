<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Country;
use App\Http\Controllers\Api\IhUniqueController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function createAddress(Request $request){
        $file = null;
        $file2 = null;
        $file3 = null;
        $file4 = null;
        $user = auth::user();
        $country = $request->country;
        if($user->address()->count() == 0){
        $country_code = Country::where('country_name',$country)->first();
        $ih = (new IhUniqueController)->generateIH($country_code->country_code);



                        $image = str_replace('data:image/png;base64,', '', $_POST['image1']);
                        $image = str_replace(' ', '+', $image);
                        $data = base64_decode($image);
                        $file = 'images/1'  .time().'.jpg';
                        file_put_contents($file, $data);


                        $image2 = str_replace('data:image/png;base64,', '', $_POST['image2']);
                        $image2 = str_replace(' ', '+', $image2);
                        $data2 = base64_decode($image2);
                        $file2 = 'images/2' . time() . '.jpg';
                        file_put_contents($file2, $data2);


                        $image3 = str_replace('data:image/png;base64,', '', $_POST['image3']);
                        $image3 = str_replace(' ', '+', $image3);
                        $data3 = base64_decode($image3);
                        $file3 = 'images/3' . time() . '.jpg';
                        file_put_contents($file3, $data3);


                        $image4 = str_replace('data:image/png;base64,', '', $_POST['image4']);
                        $image4 = str_replace(' ', '+', $image4);
                        $data4 = base64_decode($image4);
                        $file4 = 'images/4'. $image4 . time() . '.jpg';
                        file_put_contents($file4, $data4);




            $createAdreess = $user->address()->create([
            'ih' => $ih,
            'country_id' => $country_code->id,
            'user_id' => $user,
            'state' => $request->state,
            'streetname1' => $request->streetname,
            'streetname2' => $request->streetname1,
            'myhomeis' => $request->myhomeis,
            'type' => $request->type,
             'number' => $request->number,
             'oppo' => $request->oppo,
            'landmark' => $request->landmark,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
             'image1' => $file,
             'image2' => $file2,
             'image3' => $file3,
             'image4' => $file4,


        ]);
            $createAdreess['country_id'] = $country_code->country_name;

            return  $createAdreess;
        }

       return response()->json([
            'error' => 'This user already has an address',
           'code' => 401,
        ], 401);
    }

    public function createAddress2(Request $request){
        $destinationPath = 'images';
        $dbPath1 = null;
        $dbPath2 = null;
        $dbPath3 = null;
        $dbPath4 = null;
        if($request->image1){
            $image1 = $request->image1;
            $input['imagename1'] = time().'1.'.$image1->getClientOriginalExtension();
            $image1->move($destinationPath, $input['imagename1']);
            $dbPath1 = $destinationPath. '/'.$input['imagename1'];
        }
        if($request->image2){
            $image2 = $request->image2;
            $input['imagename2'] = time().'2.'.$image2->getClientOriginalExtension();
            $image2->move($destinationPath, $input['imagename2']);
            $dbPath2 = $destinationPath. '/'.$input['imagename2'];
        }
        if($request->image3){
            $image3 = $request->image3;
            $input['imagename3'] = time().'3.'.$image3->getClientOriginalExtension();
            $image3->move($destinationPath, $input['imagename3']);
            $dbPath3 = $destinationPath. '/'.$input['imagename3'];
        }
        if($request->image4){
            $image4 = $request->image4;
            $input['imagename4'] = time().'4.'.$image4->getClientOriginalExtension();
            $image4->move($destinationPath, $input['imagename4']);
            $dbPath4 = $destinationPath. '/'.$input['imagename4'];
        }
        $user = auth::user();
        $country = $request->country;
        if($user->address()->count() == 0){
            $country_code = Country::where('country_name',$country)->first();
            $ih = (new IhUniqueController)->generateIH($country_code->country_code);


            $createAdreess = $user->address()->create([
                'ih' => $ih,
                'country_id' => $country_code->id,
                'user_id' => $user,
                'state' => $request->state,
                'streetname1' => $request->streetname1,
                'streetname2' => $request->streetname2,
                'myhomeis' => $request->myhomeis,
                'type' => $request->type,
                'number' => $request->number,
                'landmark' => $request->landmark,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image1' =>  $dbPath1,
                'image2' =>  $dbPath2,
                'image3' =>  $dbPath3,
                'image4' =>  $dbPath4,
            ]);
            $createAdreess['country_id'] = $country_code->country_name;

            return  $createAdreess;
        }

        return response()->json([
            'error' => 'This user already has an address',
            'code' => 401,
        ], 401);

    }

    public function updateAddress(Request $request)
    {
        if (auth()->user()) {
            $data = $request->all();
            $destinationPath = 'images';
            $dbPath1 = null;
            $dbPath2 = null;
            $dbPath3 = null;
            $dbPath4 = null;
            if ($request->image1) {
                unlink(public_path().'/'  . auth()->user()->address->image1);
                $image1 = $request->image1;
                $input['imagename1'] = time() . '1.' . $image1->getClientOriginalExtension();
                $image1->move($destinationPath, $input['imagename1']);
                $dbPath1 = $destinationPath . '/' . $input['imagename1'];
                $data['image1'] = $dbPath1;
            }
            if ($request->image2) {
                unlink(public_path().'/'  . auth()->user()->address->image2);
                $image2 = $request->image2;
                $input['imagename2'] = time() . '2.' . $image2->getClientOriginalExtension();
                $image2->move($destinationPath, $input['imagename2']);
                $dbPath2 = $destinationPath . '/' . $input['imagename2'];
                $data['image2'] = $dbPath2;
            }
            if ($request->image3) {
                unlink(public_path().'/'  . auth()->user()->address->image3);
                $image3 = $request->image3;
                $input['imagename3'] = time() . '3.' . $image3->getClientOriginalExtension();
                $image3->move($destinationPath, $input['imagename3']);
                $dbPath3 = $destinationPath . '/' . $input['imagename3'];
                $data['image3'] = $dbPath3;
            }
            if ($request->image4) {
                unlink(public_path().'/'  . auth()->user()->address->image4);
                $image4 = $request->image4;
                $input['imagename4'] = time() . '4.' . $image4->getClientOriginalExtension();
                $image4->move($destinationPath, $input['imagename4']);
                $dbPath4 = $destinationPath . '/' . $input['imagename4'];
                $data['image4'] = $dbPath4;
            }
            $user = auth::user();

            if ($user->address()->count() == 1) {

//                $ih = (new IhUniqueController)->generateIH($country_code->country_code);

                unset($data['api_token']);
                if($data['country'])  unset($data['country']);
                $createAdreess = $user->address()->update($data);
//
//                      [
//                    'state' => $request->state,
//                    'streetname1' => $request->streetname1,
//                    'streetname2' => $request->streetname2,
//                    'myhomeis' => $request->myhomeis,
//                    'type' => $request->type,
//                    'number' => $request->number,
//                    'landmark' => $request->landmark,
//                    'latitude' => $request->latitude,
//                    'longitude' => $request->longitude,
//                    'image1' => $dbPath1,
//                    'image2' => $dbPath2,
//                    'image3' => $dbPath3,
//                    'image4' => $dbPath4,
//                ]);
//                $createAdreess['country_id'] = $country_code->country_name;

                return $createAdreess;
            }

            return response()->json([
                'error' => 'This user already has an address',
                'code' => 401,
            ], 401);

        }

    }

    public function editAddress(){
        if (auth()->user()) {
            $user = auth()->user();
            $address = $user->address()->with(['country'])->get();
            $address[0]->image1 = asset($address[0]->image1) ;
            $address[0]->image2 = asset($address[0]->image2) ;
            $address[0]->image3 = asset($address[0]->image3) ;
            $address[0]->image4 = asset($address[0]->image4) ;
            return $address[0];
        }
        return response()->json([
            'error' => 'Unable to login user',
            'code' => 401,
        ], 401);
    }

    public function deleteAddress(Request $request){
        if (auth()->user()) {
            $user = auth()->user();

          if($user->address->image1)  unlink(public_path().'/'  . $user->address->image1);
          if($user->address->image2)  unlink(public_path().'/'  . $user->address->image2);
          if($user->address->image3)  unlink(public_path().'/'  . $user->address->image3);
          if($user->address->image4)  unlink(public_path().'/'  . $user->address->image4);
            $user->address()->delete();
            $user->api_token = null;

            return response()->json([
                'message' => 'IH successfully deleted',
            ]);
        }
        return response()->json([
            'error' => 'Unable to delete IH',
            'code' => 401,
        ], 401);
    }

    public function test(Request $request){
        unset($request['api_token']);
        $country = $request->country;
        $country_code = Country::where('country_name',$country)->first();
        unset($request['country']);
        $ih = (new IhUniqueController)->generateIH($country_code->country_code);
//        array_add($input,"ih",$ih) ;
        $request->merge(["ih"=> $ih]);
        $request->merge([ 'country_id' => $country_code->id]);


        $input = $request->all();

        $user = Auth::user();

        if ($file = $request->file('image3')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $input['image3'] = $name ;
        }
        $user->address()->create($input);

        return[
            "ali1"  =>  $request->image1,
            "ali2" =>  $request->image2 ,
            "ali3" =>  $request->image3,
            "ali4" =>  $request->image4
        ] ;
    }
}


