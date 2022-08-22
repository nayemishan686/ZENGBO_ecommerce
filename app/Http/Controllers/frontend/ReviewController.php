<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
     /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // store review
    public function store(Request $request){
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $data               = [];
        $data['user_id'] = Auth::id();
        $data['product_id'] = $request->product_id;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d-m-Y');
        $data['review_month'] = date('M');
        $data['review_year'] = date('Y');
        DB::table('reviews')->insert($data);
        $notification = ['messege' => 'Review Submitted Done', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
