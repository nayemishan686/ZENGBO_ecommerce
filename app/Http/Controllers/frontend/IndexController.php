<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class IndexController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('frontend.index', compact('category'));
    }
}
