<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Product create page
    public function create() {
        $category    = DB::table('categories')->get();
        $brand       = DB::table('brands')->get();
        $pickuppoint = DB::table('pickuppoints')->get();
        $warehouse   = DB::table('warehouses')->get();
        return view('admin.product.create', compact('category', 'brand', 'pickuppoint', 'warehouse'));

    }

    // store product
    public function store(Request $request) {
        $validated = $request->validate([
            'name'           => 'required',
            'code'           => 'required',
            'category_id'    => 'required',
            'subcategory_id' => 'required',
            'brand_id'       => 'required',
            'selling_price'  => 'required',
            'warehouse_id'   => 'required',
            'color'          => 'required',
            'size'           => 'required',
            'description'    => 'required',
            'thumbnail'      => 'required',
        ]);
        $slug = Str::slug($request->name, '-');

        $data                     = [];
        $data['name']             = $request->name;
        $data['slug']             = $slug;
        $data['code']             = $request->code;
        $data['category_id']      = $request->category_id;
        $data['subcategory_id']   = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id']         = $request->brand_id;
        $data['pickup_point']     = $request->pickup_point;
        $data['unit']             = $request->unit;
        $data['tags']             = $request->tags;
        $data['purchase_price']   = $request->purchase_price;
        $data['selling_price']    = $request->selling_price;
        $data['discount_price']   = $request->discount_price;
        $data['warehouse_id']     = $request->warehouse_id;
        $data['stock_quantity']   = $request->stock_quantity;
        $data['color']            = $request->color;
        $data['size']             = $request->size;
        $data['description']      = $request->description;
        $data['video']            = $request->video;
        $data['featured']         = $request->featured;
        $data['today_deal']       = $request->today_deal;
        $data['status']           = $request->status;
        $data['product_slider']   = $request->product_slider;
        $data['trendy']           = $request->trendy;
        $data['admin_id']         = Auth::id();
        $data['date']             = date('d-m-Y');
        $data['month']            = date('F');

        //working with thumbnail
        $thumbnail     = $request->thumbnail;
        $thumbnailname = $slug . '.' . $thumbnail->getClientOriginalExtension();
        Image::make($thumbnail)->resize(600, 600)->save('files/products/' . $thumbnailname); //image intervention
        $data['thumbnail'] = $thumbnailname; // files/brand/plus-point.jpg


        //multiple images
       $images = array();
       if($request->hasFile('images')){
           foreach ($request->file('images') as $key => $image) {
               $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(600,600)->save('files/products/'.$imageName);
               array_push($images, $imageName);
           }
           $data['images'] = json_encode($images);
       }

        DB::table('products')->insert($data);
        $notification = ['messege' => 'Product Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }
}
