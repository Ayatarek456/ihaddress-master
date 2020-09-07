<?php

namespace App\Http\Controllers\Api;

use App\fcmtoken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FcmtokenController extends Controller
{

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            if($user->fcm()->first() != null){
                $token = $user->fcm()->get('token');
                if ($token->first()->token == $request->token){
                    return response()->json([
                        'error' => 'Token already exists',
                        'code' => 401,
                    ], 401);
                }
                if ($token->first()->token != $request->token){
                    $user->fcm()->update([
                        'token' => $request->token
                    ]);
                    return response()->json([
                        'message' => 'Updated',
                        'code' => 201,
                    ], 201);
                }

            }if ($user->fcm()->first() == null){
                $user->fcm()->create([
                    'user_id' => $user,
                    'token' => $request->token
                ]);
                return response()->json([
                    'message' => 'Created',
                    'code' => 201,
                ], 201);
            }
        }
        return response()->json([
            'error' => 'Please sign in first',
            'code' => 401,
        ], 401);

    }

    public function sendMessage(Request $request){

        $fcm = fcmtoken::where('user_id',$request->user_id)->first();
        $array =[$fcm['token']];
        fcm()
            ->to($array) // $recipients must an array
            ->priority('high')
            ->notification([
                'title' => 'Notice from IH',
                'body' => 'A user requested your address and on the way to you',
            ])
            ->send();
        return $fcm;
    }


}
