<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    
    
    public function authenticated(Request $request, User $user){
    Session::put('new_user', 'yes');
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // public function login(Request $request)
    // {

    //     $input = $request->all();
     
    //     $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    //     if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))){
    //         if (Auth::user()->type == 1) {
    //             return redirect('/admin')->with('success', 'Account login successfully.')->with(['fieldType' => $fieldType]);
    //         } else if (Auth::user()->type == 2) {
    //             return redirect('/player')->with('success', 'Account login successfully')->with(['fieldType' => $fieldType]);
    //         } else {
    //             return redirect('/');
    //         }

    //     }else{
    //             return back()->with('error', 'Credentials do not match our records');
    //     }
    // }






}
