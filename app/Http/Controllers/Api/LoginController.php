<?php

namespace App\Http\Controllers\Api;
use App\Address;
use App\Country;
use App\SocialAccount;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function MongoDB\BSON\toJSON;


class LoginController extends Controller
{



public function ApiLogout(){
    if (auth()->user()) {
        $user = auth()->user();
        $user->api_token = null; // clear api token
        $user->save();

        return response()->json([
            'message' => 'Thank you for using our application',
        ]);
    }
    return response()->json([
        'error' => 'Unable to logout user',
        'code' => 401,
    ], 401);
}


    public function register(Request $request)
    {
        //create user in database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60)
        ]);
        $token = [
          'api_token'=>   $user->api_token,
           'name' => $user->name,
            'email'=>   $user->email
            ];

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'name' => $token['name'],
            'email'=>   $token['email'],
            'api_token'=>   $token['api_token'],
            'country'   => Country::all(),
        ]);

    }


    public function socialAuth(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|email',
            'provider' => 'required|in:facebook,twitter,google',
            'provider_user_id' => 'required'
        ]);

        $socialAccount = SocialAccount::where('provider', $request->provider)->where
        ('provider_user_id', $request->provider_user_id)->first();

        $email = User::where('email', $request->email)->first();

        //Check whether it has a social contact account before, if it exists we give it api_token
        if($email && $socialAccount){
            $userok = User::where('id', $socialAccount['user_id'])->first();
            if($email->api_token){
                $userok = Arr::add($userok ,'country' , Country::where('id',$userok->address()->get('country_id')[0]->country_id ?? ""
                    )->get('country_name')[0]->country_name ?? "" );
                $userok = Arr::add($userok ,'ih',$userok->address()->get('ih')[0]->ih ?? null );
                return $userok ;
            }
            $userok->api_token = Str::random(60);
            $userok->save();
            $socialAccount = Arr::add($socialAccount ,'country' , Country::where('id',$socialAccount->address()->get('country_id')[0]->country_id
                    ?? "")->get('country_name')[0]->country_name ?? "" );
            $socialAccount = Arr::add($socialAccount ,'ih',$socialAccount->address()->get('ih')[0]->ih ?? null );
            return $socialAccount ;
        }

        //Check if the account has an email and in this case a new account
        // is added and the social communication account is added and the account is returned api_token
        if(!$email &&  !$socialAccount ){
            try{
                $this->createUserAccount($request);
                $getUserAfterCreate = User::where('email', $request->email)->first();
                $getUserAfterCreate = Arr::add($getUserAfterCreate ,'country' , Country::where('id',$getUserAfterCreate->address()->get('country_id')[0]->country_id
                        ?? "")->get('country_name')[0]->country_name ?? "" );
                $getUserAfterCreate = Arr::add($getUserAfterCreate ,'ih',$getUserAfterCreate->address()->get('ih')[0]->ih ?? null );
                return  $getUserAfterCreate ;

            }catch(\Exception $e){
                return response("An Error Occured1, please retry later", 422);
            }

        }
        if($email &&  !$socialAccount ){
            try{
                $this->addSocialAccountToUser($request ,$email);
                $email->api_token = Str::random(60);
                $email->save();
                $email = Arr::add($email ,'country' , Country::where('id',$email->address()->get('country_id')[0]->country_id
                        ?? "")->get('country_name')[0]->country_name ?? "" );
                $email = Arr::add($email ,'ih',$email->address()->get('ih')[0]->ih ?? null);
                return $email;

            }catch(\Exception $e){
                return response("An Error Occured2, please retry later", 422);
            }
        }
        return response()->json([
            'error' => 'Unable to login user',
            'code' => 401,
        ], 401);

    }


    private function addSocialAccountToUser(Request $request, User $user){

        $this->validate($request, [
            'provider' => ['required', Rule::unique('social_accounts')->where(function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })],
            'provider_user_id' => 'required'
        ]);

        $user->socialAccounts()->create([
            'provider' => $request->provider,
            'provider_user_id' => $request->provider_user_id
        ]);


    }


    private function createUserAccount(Request $request){

        DB::transaction( function () use ($request){
            $ip = $_SERVER['REMOTE_ADDR'];
//            $ih = (new IhUniqueController)->generateIH($ip);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'api_token' => Str::random(60),
//                'ih'=> $ih
            ]);

            $this->addSocialAccountToUser($request, $user);

        });


    }
}
