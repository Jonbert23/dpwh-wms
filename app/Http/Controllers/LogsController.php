<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logs;
use Carbon\Carbon;

class LogsController extends Controller
{
    public function index()
    {
        $log = Logs::all();
        $counter = 0;
        return view('logs.logIndex',compact('log','counter'));
    }

    public function search(Request $request)
    {
        $search = request('searchLog');
        $log = Logs::all();
        $counter = 0;
        
        return view('logs.logSearch',compact('log','search','counter'));
    }
}
