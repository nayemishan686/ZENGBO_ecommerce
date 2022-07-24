<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // show all category
    public function index(){

        // $category = DB::table('categories')->get();  // query builder
        
        $category = Category::all();    // eloquent ORM
        return view('admin.categories.category.index',compact('category'));
    }

}
