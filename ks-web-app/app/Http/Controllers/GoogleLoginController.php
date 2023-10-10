<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;

class GoogleLoginController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function handlerCallback() {
        $googleUser = Socialite::driver('google')->user();

        // dd($googleUser);

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
}
