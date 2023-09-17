<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SignUpController extends Controller
{
    public function index() {
        return view('sign-up.index', [
            'title' => 'Sign Up',
        ]);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'email' => 'required|email:dns|max:191|unique:users,email',
            'username' => 'required|between:3,191|unique:users,username',
            'name' => 'required|max:191',
            'password' => ['required', Password::min(8)->letters()
                                                ->mixedCase()
                                                ->numbers()
                                                ->symbols()
                                                ->uncompromised()
                            ],
            'confirm-password' => 'required|min:8|same:password'
        ],
        [
            'confirm-password.same' => 'The Confirm Password does not match password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect(route('sign-up'))->with('success', 'Your account has been successfully created, please login');
    }
}
