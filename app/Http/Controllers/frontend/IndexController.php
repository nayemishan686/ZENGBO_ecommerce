<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {
    // Index method
    public function index() {
        $bannerProduct = Product::where('product_slider', 1)->first();
        return view('frontend.index', compact('bannerProduct'));
    }

    // Product Details
    public function productDetails($slug) {
        
        $product = Product::where('slug', $slug)->first();
        return view('frontend.product.productDetails',compact('product'));
    }
}
