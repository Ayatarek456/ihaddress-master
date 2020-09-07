<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Http\Controllers\Controller;
use App\SaveAddress;
use Illuminate\Http\Request;

class SaveAddressController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        if($user){
            $address = $user->saveaddress()->with('address:id,ih')->get();


            return $address;
        }
        return response()->json([
            'error' => 'Please sign in first',
            'code' => 401,
        ], 401);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $addrees = $request->address_id;

        if($user){
            $user->saveaddress()->create([
                'address_id' => $addrees,
                'name' => $request->name,
                'note' => $request->note
            ]);
            return response()->json([
                'message' => 'address created',
                'code' => 201,
            ], 201);
        }
        return response()->json([
            'error' => 'Please sign in first',
            'code' => 401,
        ], 401);
    }
    public function delete(Request $request){
        $user = auth()->user();
        if ($user){
            $id = $request->id;
            $user->saveaddress()->where('id',$id)->delete();
            return response()->json([
                'message' => 'address deleted',
                'code' => 201,
            ], 201);
        }

              return response()->json([
                  'error' => 'Please sign in first',
                  'code' => 401,
              ], 401);
    }
        public function edit(Request $request){
            $user = auth()->user();
            if ($user){
                $id = $request->id;
               $update = $user->saveaddress()->where('id',$id)->update([
                    'name' => $request->name,
                    'note' => $request->note
                ]);
                return response()->json([
                    'message' => $update,
                    'code' => 201,
                ], 201);
            }

            return response()->json([
                'error' => 'Please sign in first',
                'code' => 401,
            ], 401);
        }
}
