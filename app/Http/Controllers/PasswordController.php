<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Worker;
use Auth;


class PasswordController extends Controller
{
    public function index()
    {
        $worker = Worker::all();
        return view('admin.password.ResetPassword', compact('worker'));
    }

    public function ResetPassword(Request $request)
    {
        $id = request('workerId');

        $worker = Worker::find($id);
        $idNumber = $worker->idNumber;

        //echo $idNumber;
        Worker::find($id)->update(['password'=> Hash::make($idNumber)]);

        return redirect()->back()->with('message', 'Password Reset Successfully!');
    }

    public function CPForm()
    {
        $role = Auth::user()->role_id;

        if($role == 1)
        {
            return view('Password.adminPassword');
        }

        if($role == 2)
        {
            return view('Password.mppPassword');
        }

        if($role == 3 )
        {
            return view('Password.workerPassword');
        }

        if($role == 4)
        {
            return view('Password.hrPassword');
        }
        
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'required',
        ]);

        if(Hash::check($request->current_password,Auth::user()->password))
        {
            if($request->new_password == $request->new_confirm_password)
            {
                Worker::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
            }
            else
            {
                return back()->withErrors(['message'=>'New password confirmation failed']);
            }
        }
        else
        {
            return back()->withErrors(['message'=>'Current password confirmation failed']);
        }

        return back()->with('message','Password updated succesfully');
    }
}
