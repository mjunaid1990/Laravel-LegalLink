<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Socialite;

class LoginController extends Controller {
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        if (Auth::check() && Auth::user()->role == 1) {
            $this->redirectTo = '/admin';
        }
        $this->middleware('guest')->except('logout');
    }

    public function googleHandleProvider() {
        return Socialite::driver('google')->redirect();
    }
    
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleHandleProviderCallback() {

        $user_google = Socialite::driver('google')->user();

        $user = User::where('email', $user_google->email)->first();
        if (!$user) {

            $uniquid = generatePin(8);
            
            $name = split_name($user_google->name);
            $user = new User;
            $user->google_id = $user_google->id;
            $user->firstname = isset($name[0]) ? $name[0] : null;
            $user->lastname = isset($name[1]) ? $name[1] : null;
            $user->email = $user_google->email;
            $user->password = Hash::make($uniquid);
            $user->role = 0;
            $user->save();
        } else {
            if (empty($user->google_id)) {
                $user->google_id = $user_google->id;
            }
            $user->update();
        }

        // login
        Auth::loginUsingId($user->id);
        return redirect('/');
    }

    protected function authenticated(\Illuminate\Http\Request $request, $user) {

        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                return redirect('admin');
            } else if (Auth::user()->role == 0) {
                return redirect('/');
            } else {
                return redirect('login');
            }
        }
    }

}
