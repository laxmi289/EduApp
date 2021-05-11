<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HodMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->usertype == 'hod' && Auth::user()->department == 'CSE')
        {
            return $next($request);
        }
        else if(Auth::user()->usertype == 'hod' && Auth::user()->department == 'ECE')
        {
            return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You are not allowed to other HOD Dashboard');
        }
        
        

    }
}
