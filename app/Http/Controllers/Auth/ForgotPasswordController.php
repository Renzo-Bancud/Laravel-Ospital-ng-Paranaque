<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    // public function sendResetLinkEmail(Request $request)
    // {
    //     // Validate and send the password reset email...

    //     // Set a success message in the session
    //     $request->session()->flash('status', 'A password reset link has been sent to your email!');

    //     // Redirect back to the form
    //     return back();
    // }
}
