<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {
        return view('login.index', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'password' => 'User doesn’t exist! Please check your email and password'
        ])->onlyInput('email');
    }

    public function googleLoginRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleLoginCallback() {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'username' => $googleUser->name,
            'profile_picture' => $googleUser->avatar,
            'password' => ''
            // 'github_token' => $googleUser->token,
            // 'github_refresh_token' => $googleUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request): RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
