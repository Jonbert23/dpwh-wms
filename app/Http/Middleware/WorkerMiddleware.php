<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class WorkerMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
        {
            return redirect()->back();
        }
        
        if(Auth::user()->role_id == 3 && Auth::user()->status == 1)
        {
            return $next($request);
        }
        else
        {
            return redirect()->back();
        }
    }
}
