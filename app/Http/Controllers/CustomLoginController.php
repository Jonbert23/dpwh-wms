<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use Auth;

class CustomLoginController extends Controller
{
    public function LoginValidation()
    {
        $validateWorker = request()->validate([
            
            'idNumber' => 'required',
            'password'  => 'required'
        ]);

        $idNumber = request('idNumber');
        $password = request('password');

        if (Auth::attempt(['idNumber' => $idNumber, 'password' => $password]))
        {
            $role = Auth::user()->role_id;

            if($role == 1)
            {
                return redirect('/adminDashboard');
            }

            if($role == 4)
            {
                return redirect('/HrDashboard');
            }
            if($role == 2)
            {
                return redirect('/mppProfile');
            }
            if($role == 3)
            {
               return redirect('/myProfile');
               
               
            }
        }
        else
        {
            return back()->withErrors(['message' => 'Wrong Password Or ID Number does not exist']);
        }
    }
}
