<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    final public const ACCOUNT_PROFILE_PATH = '/account/profile';

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
    public function requests()
    {
        $myRequestsQuery = Project::orderBy('title')->where('requester', Auth::user()->name)->get();
        $myCompletedRequestQuery = Project::orderBy('title')->where([['requester', Auth::user()->name], ['status', 'Completed']])->get();
        $myOnProcessRequestQuery = Project::orderBy('title')->where([['requester', Auth::user()->name], ['status', 'In Progress']])->get();
        $myPendingRequestQuery = Project::orderBy('title')->where([['requester', Auth::user()->name], ['status', 'Pending']])->get();
        $myRejectedRequestQuery = Project::orderBy('title')->where([['requester', Auth::user()->name], ['status', 'Rejected']])->get();

        return view('account.requests', [
            'title' => 'My Requests',
            'myrequests' => $myRequestsQuery,
            'myCompletedRequests' => $myCompletedRequestQuery,
            'myOnProcessRequests' => $myOnProcessRequestQuery,
            'myPendingRequests' => $myPendingRequestQuery,
            'myRejectedRequests' => $myRejectedRequestQuery
        ]);
    }

    public function update(Request $request, User $user)
    {
        $userId = Auth::id();

        $usernameRules = 'required|between:3,191|alpha_dash:ascii|unique:users,username';

        if ($request->username === Auth::user()->username) {
            $usernameRules = 'required|between:3,191|alpha_dash:ascii';
        }

        $validateData = $request->validate([
            'name' => 'required|max:191',
            'username' => $usernameRules,
        ]);

        $user::where('id', $userId)->update($validateData);

        return redirect('/account/profile')->with('updateSuccess', 'The Account Information has been updated!');
    }

    public function updateProfilePicture(Request $request)
    {
        $rules = [
            'profile_picture' => 'required|image|file|max:256',
        ];

        $validateData = $request->validate($rules);

        if ($request->file('profile_picture')) {

            if (Auth::user()->profile_picture !== null) {
                Storage::delete(Auth::user()->profile_picture);
            }

            $validateData['profile_picture'] = $request->file('profile_picture')->store('img/user');
        }

        $userId = Auth::id();

        User::where('id', $userId)->update($validateData);

        return redirect(self::ACCOUNT_PROFILE_PATH)->with('changeProfileSuccess', 'Profile Picture has been updated!');
    }

    public function removeProfilePicture()
    {
        if (Auth::user()->profile_picture != null) {
            Storage::delete(Auth::user()->profile_picture);
        }

        $userId = Auth::id();

        User::where('id', $userId)->update(['profile_picture' => null]);

        return redirect(self::ACCOUNT_PROFILE_PATH)->with('changeProfileSuccess', 'Profile Picture has been removed!');
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old-password' => 'required',
            'password' => ['required', 'max:191', Password::min(8)->letters()
                ->mixedCase()
                ->numbers()],
            'confirm-password' => 'required|min:8|same:password'
        ], [
            'confirm-password.same' => 'The Confirm Password does not match password'
        ]);


        if (!Hash::check($validatedData['old-password'], auth()->user()->password)) {
            return back()->with('errorOldpassword', 'The old password does not match your password!');
        }

        if (Hash::check($validatedData['password'], auth()->user()->password)) {
            return back()->with('errorSamePassword', 'New password should be different from your old password!');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        $userId = Auth::id();

        User::where('id', $userId)->update(['password' => $validatedData['password']]);

        return redirect(self::ACCOUNT_PROFILE_PATH)->with('successChangePassword', 'Password has been changed!');
    }
}
