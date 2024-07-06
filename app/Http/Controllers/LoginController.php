<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'password' => 'User doesn’t exist! Please check your email and password',
            ])
            ->onlyInput('email');
    }

    public function googleLoginRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function usernameCleaner($username)
    {
        // Replaces all spaces with hyphens.
        $cleanUsername = str_replace(' ', '-', $username);

        // Removes special chars.
        $cleanUsername = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanUsername);

        // Replaces multiple hyphens with single one.
        $cleanUsername = preg_replace('/-+/', '-', $cleanUsername);

        return $cleanUsername;
    }

    public function googleLoginCallback()
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        $existUser = User::where('email', $googleUser->email)->first();

        $message = "Welcome to Kpop Soulmate!";

        if ($existUser != null && $existUser->google_id == null) {
            return redirect('/login')->with('loginError', 'This account is not connected to Google. Please login with email instead!');
        }

        if ($existUser == null) {
            $user = User::create([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'username' => $this->usernameCleaner($googleUser->name),
                    'profile_picture' => $googleUser->avatar,
                    'password' => '',
                    'email_verified_at' => date('Y-m-d H:i:s'),
                ]
            );
        } elseif ($existUser !== null && $existUser->google_id !== null) {
            $user = User::where('google_id', $existUser->google_id)->first();
            $message = "Welcome Back!";
        }

        Auth::login($user);

        return redirect('/')->with('success', $message);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
