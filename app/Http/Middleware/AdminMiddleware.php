<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
   
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
        {
            return redirect()->back();
        }
        
        if(Auth::user()->role_id == 1 && Auth::user()->status == 1)
        {
            return $next($request);
        }
        else
        {
            return redirect()->back();
        }
    }
}
