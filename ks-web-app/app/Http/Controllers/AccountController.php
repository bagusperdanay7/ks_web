<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account.profile', [
            'title' => 'Profile',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $userId = Auth::id();

        $validateData = $request->validate([
            'name' => 'required|max:191',
            'username' => 'required|between:3,191|unique:users,username|alpha_dash:ascii',
        ]);

        $user::where('id', $userId)->update($validateData);

        return redirect('/account/profile')->with('success', "The Account Information has been updated!");
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old-password' => 'required',
            'password' => ['required', 'max:191', Password::min(8)->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()],
            'confirm-password' => 'required|min:8|same:password'
        ], [
            'confirm-password.same' => 'The Confirm Password does not match password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if (!Hash::check($validatedData['old-password'], auth()->user()->password)) {
            return back()->with('errorOldpassword', 'The old password does not match your password!');
        }

        $userId = Auth::id();

        User::where('id', $userId)->update(['password' => $validatedData['password']]);

        return redirect('/account/profile')->with('successChangePassword', "Password has been changed!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
