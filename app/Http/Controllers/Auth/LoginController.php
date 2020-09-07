<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialAccount;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::guard('web')->login($authUser, true);

        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($providerUser, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->id)
            ->first();

        if ($account) {
            return $account->user;
        } else {
            DB::beginTransaction();
            try {
                $user = User::whereEmail($providerUser->email)->first();

                if (! $user)
                {
                    $user = User::create([
                        'name'              => $providerUser->name,
                        'email'             => $providerUser->email,
                        'api_token'         => Str::random(60),
                    ]);
                }

                $user->socialAccounts()->create([
                    'provider_user_id'   => $providerUser->id,
                    'provider' => $provider,
                ]);

                DB::commit();

                return $user;

            }catch (\Exception $e) {
                throw new ModelNotFoundException('لقد فشلت عملية التسجيل','2000');
            }

        }
    }
}
