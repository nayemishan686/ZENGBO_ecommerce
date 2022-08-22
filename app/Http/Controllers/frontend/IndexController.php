<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller {

    // Customer Logout
    public function customerLogout(){
            Auth::logout();
            $notification = ['messege' => 'You are Logged Out!', 'alert-type' => 'success'];
            return redirect('/')->with($notification);
    }
    
    // Index method
    public function index() {
        $bannerProduct = Product::where('product_slider', 1)->first();
        return view('frontend.index', compact('bannerProduct'));
    }

    // Product Details
    public function productDetails($slug) {     
        $product = Product::where('slug', $slug)->first();
        $review = Reviews::where('product_id',$product->id)->get();
        $related_product = DB::table('products')->where('subcategory_id', $product->subcategory_id)->take(8)->get();
        return view('frontend.product.productDetails',compact('product','related_product','review'));
    }

}
