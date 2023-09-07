<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        //handle request for admin and user
        // 1 is admin
        // 2 is doctor
        // 3 is patient
        // 5 is head office
        // 8 is malasakit
    
        if (Auth::check()) {
    
            if (Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 5 || Auth::user()->type == 8) {
                return $next($request);
                
            } else {
                return redirect()->route('login')->with('error', 'Access Denied!');
            }
    
    
        } else {
    
            return redirect('/login')->with('error', 'Please Login First!');
        }
    }
    
}