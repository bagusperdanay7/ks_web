<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function index() {
        return view('auth.forgot-password', [
            'title' => 'Forgot Password'
        ]);
    }

    public function sendEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordView(string $token) {
        return view('auth.reset-password', [
            'title' => 'Reset Password',
            'token' => $token
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|max:191',
            'password' => ['required', 'max:191', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
