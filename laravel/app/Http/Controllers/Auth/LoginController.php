<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Http\Request;



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
    protected function redirectTo() {
        session()->flash('flash_message', 'ログインしました');
        return '/books';
    }

    /**
     * 外部ログイン
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, string $provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $providerUser->getEmail())->first();

        if ($user) {
            $this->guard()->login($user, true);
            return $this->sendLoginResponse($request);
        }

        return redirect()->route('register.{provider}', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $providerUser->token,
        ]);


    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut()
    {
        return redirect(route('login'));
    }

}
