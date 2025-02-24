<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function handalProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $existUser = User::whereEmail($user->email)->first();
        if ($existUser) {
            Auth::login($existUser);
        } else {
            $newUser = User::updateOrCreate([
                'name'     => $user->getName(),
                'gender'   => '',
                'birthday' => '',
                'email'    => $user->getEmail(),
                'password' => bcrypt(Str::random(16)),
            ]);
            Auth::login($newUser);
        }
        // return redirect()->route('user.dashboard');
        return redirect()->intended(route('user.dashboard'));
    }
}
