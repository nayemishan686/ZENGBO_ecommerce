<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $category = Category::all();
        $bannerProduct = Product::where('product_slider',1)->first();
        return view('frontend.index', compact('category','bannerProduct'));
    }
}
