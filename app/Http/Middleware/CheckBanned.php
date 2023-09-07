<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->isActivated == 0)){
                Auth::logout();
    
                $request->session()->invalidate();
    
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Your account is deactivated.');
    
        }
    
        return $next($request);
    }
}
