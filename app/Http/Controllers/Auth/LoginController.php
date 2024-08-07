<?php

namespace App\Http\Controllers\Auth;

use Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;

use App\Models\User;




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


    protected function redirectTo()
    {
        if (isset($_POST['email'])) {

            $user = User::where('email', $_POST['email'])->first();

            if ($user->role === "ROLE_ADMIN") {
                return 'admin-panel';
            }
            if ($user->role === "ROLE_SUBAD" && !$user->first_login) {
                return '/admin';
            }
            if ($user->role === "ROLE_SUBAD" && $user->first_login) {
                return '/first-login';
            }
            session(['restau_id' => null]);
            // return 'admin';
            return 'https://monmenu.io/boutique/?autologB='.$user->wp_token.'&n='.$user->name.'&hello=1&restauSlug='.Str::slug($user->restaurant->name).'&restauid='.$user->restaurant->id.'&restauName='.$user->restaurant->name.'';
        } else {
            return 'home/';
        }
    }


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/home";





    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Auth::logout();
        $this->redirectTo = "/home";
        $this->middleware('guest')->except('logout');
    }
}
