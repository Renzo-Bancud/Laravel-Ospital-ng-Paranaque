<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    const NEW_USER_SESSION_KEY = 'new_user';
    const HOME_URL = RouteServiceProvider::HOME;
    const LOGIN_URL = 'login';
    const ERROR_MESSAGE = 'You need to re-login because you forgot to logout last time.';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Session::get(self::NEW_USER_SESSION_KEY) == 'yes') {
                Session::forget(self::NEW_USER_SESSION_KEY);
                return redirect(self::HOME_URL);
            } else {
                return redirect(self::LOGIN_URL)
                    ->with('error-logout', self::ERROR_MESSAGE);
            }
        }

        return $next($request);
    }
}
