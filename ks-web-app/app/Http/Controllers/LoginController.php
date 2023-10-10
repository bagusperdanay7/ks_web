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

        //Cleaning the username 
        $username = $googleUser['name'];

        // Replaces all spaces with hyphens.
        $username = str_replace(' ', '-', $username);

        // Removes special chars.
        $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);

        // Replaces multiple hyphens with single one.
        $usernameClean = preg_replace('/-+/', '-', $username);

        // TODO: Jika sudah terdaftar, maka tidak bisa dihubungkan, Hubungi Admin untuk menghapus account. , jika ada google_id kasih badge (this account linked to google)
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'username' => $usernameClean,
            'profile_picture' => $googleUser->avatar,
            'password' => '',
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Your account has been successfully created');
    }

    public function logout(Request $request): RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
