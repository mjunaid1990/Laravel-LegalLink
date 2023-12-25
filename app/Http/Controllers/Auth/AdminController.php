<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check() && Auth::user()->role == 1){
            return redirect('admin');
        }
        $this->middleware('guest')->except('logout');
    }
    
    
    
    public function index(\Illuminate\Http\Request $request) {
        return view('auth.admin.login');
    }

    
}
