<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Product create page
    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $pickuppoint = DB::table('pickuppoints')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.create', compact('category','brand','pickuppoint','warehouse'));

    }
}
