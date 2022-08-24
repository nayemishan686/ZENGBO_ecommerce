<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller {

    // Customer Register
    public function register(){
        return view('frontend.form.register');
    }

    // Customer Logout
    public function customerLogout(){
            Auth::logout();
            $notification = ['messege' => 'You are Logged Out!', 'alert-type' => 'success'];
            return redirect('/')->with($notification);
    }
    
    // Index method
    public function index() {
        $featuredProduct = Product::where('status',1)->where('featured',1)->get();
        $bannerProduct = Product::where('status',1)->where('product_slider', 1)->first();
        $MostPopularProduct = Product::where('status',1)->orderBy('view','DESC')->limit(20)->get();
        return view('frontend.index', compact('bannerProduct','featuredProduct','MostPopularProduct'));
    }

    // Product Details
    public function productDetails($slug) {     
        $product = Product::where('slug', $slug)->first();
        Product::where('slug',$slug)->increment('view');
        $review = Reviews::where('product_id',$product->id)->get();
        $related_product = DB::table('products')->where('subcategory_id', $product->subcategory_id)->take(8)->get();
        return view('frontend.product.productDetails',compact('product','related_product','review'));
    }

}
