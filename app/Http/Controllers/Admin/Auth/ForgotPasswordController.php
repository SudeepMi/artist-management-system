<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Admin\AdminForgetPasswordNotification;
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

    public function showLinkRequestForm()
    {
        return view('admin.auth.forget-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        //
    }
    public function checkOtp(Request $request)
    {
        //
    }
}
