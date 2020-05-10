<?php

namespace App\Http\Controllers\Auth;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
        if(Auth::user()->role_id == '1' && Auth::user()->status == 1)
        {
            return 'adminWorker';
        }
        else 
        {
            return 'home';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function adminLogout(Request $request)
    // {
    //     Auth::guard('web')->logout();

    //     return redirect('/');
    // }
}
