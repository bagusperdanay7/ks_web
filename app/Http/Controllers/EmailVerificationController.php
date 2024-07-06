<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function sentEmailVerification() {
        return view('auth.verify-email', ['title' => 'Verify Email']);
    }

    public function verificationSuccess(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/')->with('validationSuccess', 'The verification of your account was successful.');
    }

    public function resendVerification(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
