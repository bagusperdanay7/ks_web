<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index() {
        return view('login.signup', [
            'title' => 'Sign Up',
            'active' => 'sign_up',
        ]);
    }
}
