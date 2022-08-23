<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // store review
    public function store(Request $request) {
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);
        $check = DB::table('reviews')->where('product_id', $request->product_id)->where('user_id', Auth::id())->first();
        if ($check) {
            $notification = ['messege' => 'Already you have a review in this product', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        } else {
            $data                 = [];
            $data['user_id']      = Auth::id();
            $data['product_id']   = $request->product_id;
            $data['review']       = $request->review;
            $data['rating']       = $request->rating;
            $data['review_date']  = date('d-m-Y');
            $data['review_month'] = date('M');
            $data['review_year']  = date('Y');
            DB::table('reviews')->insert($data);
            $notification = ['messege' => 'Review Submitted Done', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }
    }

    // Wishlist add
    public function wishlistAdd($id) {
        $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();
        if ($check) {
            $notification = ['messege' => 'Already have in wishlist', 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        } else {
            $data               = [];
            $data['user_id']    = Auth::id();
            $data['product_id'] = $id;
            DB::table('wishlists')->insert($data);
            $notification = ['messege' => 'Product add on your wishlist', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }
    }
}
