<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function logout(){
        Auth::logout();
        $notification = array('messege' => 'You are Logged Out!', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
}
