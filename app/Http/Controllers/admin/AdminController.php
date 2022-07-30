<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // admin home
    public function adminHome() {
        return view('admin.home');
    }

    // admin logout
    public function logout() {
        Auth::logout();
        $notification = ['messege' => 'You are Logged Out!', 'alert-type' => 'success'];
        return redirect()->route('admin.login')->with($notification);
    }

    // Admin Password Change
    public function adminPassword() {
        return view('admin.profile.pasword_change');
    }

    // Admin Password Update
    public function passwordUpdate(Request $request) {
        $validated = $request->validate([
            'old_password'          => 'required',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        $current_pass = Auth::user()->password;
        $old_pass     = $request->old_password;
        if (Hash::check($old_pass, $current_pass)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification = ['messege' => 'Your Password Updated Successfully', 'alert-type' => 'success'];
            return redirect()->route('admin.login')->with($notification);
        } else {
            $notification = ['messege' => 'Your Old Password Not Matched!', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    
}
