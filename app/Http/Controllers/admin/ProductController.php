<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;

class ProductController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // show all Product
    public function index(Request $request) {
        $imageUrl = 'files/products';
        $product  = "";
        $query    = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'products.subcategory_id', 'sub_categories.id')
            ->leftJoin('brands', 'products.brand_id', 'brands.id');

        if ($request->category_id) {
            $query->where('products.category_id', $request->category_id);
        }

        if ($request->brand_id) {
            $query->where('products.brand_id', $request->brand_id);
        }

        if ($request->warehouse_id) {
            $query->where('products.warehouse_id', $request->warehouse_id);
        }

        if ($request->status == 1) {
            $query->where('products.status', 1);
        }

        if ($request->status == 0) {
            $query->where('products.status', 0);
        }

        $product = $query->select('products.*', 'categories.category_name', 'sub_categories.subcategory_name', 'brands.brand_name')
            ->get();
        if ($request->ajax()) {
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('thumbnail', function ($row) use ($imageUrl) {
                    return '<img src="' . $imageUrl . '/' . $row->thumbnail . '"  height="40" width="60" >';
                })
                ->editColumn('featured', function ($row) {
                    if ($row->featured == 1) {
                        return '<a href="#" class="btn btn-danger btn-sm featured_deactive" data-id= "' . $row->id . '"><i
                        class="fas fa-thumbs-down"></i></a> <span class="badge badge-success">active</span>';
                    } else {
                        return '<a href="#" class="btn btn-success btn-sm featured_active" data-id= "' . $row->id . '"><i
                        class="fas fa-thumbs-up"></i></a> <span class="badge badge-danger">deactive</span>';
                    }
                })
                ->editColumn('today_deal', function ($row) {
                    if ($row->today_deal == 1) {
                        return '<a href="#" class="btn btn-danger btn-sm deal_deactive" data-id= "' . $row->id . '"><i
                        class="fas fa-thumbs-down"></i></a> <span class="badge badge-success">active</span>';
                    } else {
                        return '<a href="#" class="btn btn-success btn-sm deal_active" data-id= "' . $row->id . '"><i
                        class="fas fa-thumbs-up"></i></a> <span class="badge badge-danger">deactive</span>';
                    }
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<a href="#" class="btn btn-danger btn-sm status_deactive" data-id= "' . $row->id . '"><i
                        class="fas fa-thumbs-down"></i></a> <span class="badge badge-success">active</span>';
                    } else {
                        return '<a href="#" class="btn btn-success btn-sm status_active" data-id= "' . $row->id . '"><i
                        class="fas fa-thumbs-up"></i></a> <span class="badge badge-danger">deactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $action_btn = '<a href="#" class="btn btn-primary edit"><i class="fas fa-edit"></i></a>
                    <a href="' . route('product.delete', [$row->id]) . '" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>
                    <a href="#" class="btn btn-info edit"><i
                class="fas fa-eye"></i></a>';
                    return $action_btn;
                })
                ->rawColumns(['action', 'category_name', 'subcategory_name', 'brand_name', 'thumbnail', 'featured', 'today_deal', 'status'])
                ->make([true]);
        }
        $category  = DB::table('categories')->get();
        $brand     = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.index', compact('category', 'brand', 'warehouse'));
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
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('files/products/' . $imageName);
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);
        $notification = ['messege' => 'Product Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    // Product Delete
    public function destroy($id) {
        $product = DB::table('products')->where('id', $id)->first();
        if (File::exists('files/products/' . $product->thumbnail)) {
            FIle::delete('files/products/' . $product->thumbnail);
        }
        $images = json_decode($product->images, true);
        if (isset($images)) {
            foreach ($images as $key => $image) {
                if (File::exists('files/products/' . $image)) {
                    FIle::delete('files/products/' . $image);
                }
            }
        }
        DB::table('products')->where('id', $id)->delete();
        return response()->json("Product Deleted Successfully");
    }

    // Deactive Featured
    public function deactive_featured($id) {
        DB::table('products')->where('id', $id)->update(['featured' => 0]);
        return response()->json('Featured Product deactive');
    }

    // Active Featured
    public function active_featured($id) {
        DB::table('products')->where('id', $id)->update(['featured' => 1]);
        return response()->json('Featured Product active');
    }

    // Deactive Today deal
    public function deal_deactive($id) {
        DB::table('products')->where('id', $id)->update(['today_deal' => 0]);
        return response()->json('Today Deal Product deactive');
    }

    // Active Today deal
    public function deal_active($id) {
        DB::table('products')->where('id', $id)->update(['today_deal' => 1]);
        return response()->json('Today Deal Product active');
    }

    // Deactive status
    public function status_deactive($id) {
        DB::table('products')->where('id', $id)->update(['status' => 0]);
        return response()->json('Product Status deactive');
    }

    // Active status
    public function status_active($id) {
        DB::table('products')->where('id', $id)->update(['status' => 1]);
        return response()->json('Product Status active');
    }
}
