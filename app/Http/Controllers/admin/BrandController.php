<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;

class BrandController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Show all Brand
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('brands')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($brand) {
                    $action_btn = '<a href="" class="btn btn-primary edit" data-id= "' . $brand->id . '" data-toggle="modal" data-target="#editModal"><i
                    class="fas fa-edit"></i></a> <a href="' . route('brand.delete', [$brand->id]) . '" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                    return $action_btn;
                })

                ->rawColumns(['action'])
                ->make([true]);
        }
        return view('admin.categories.brand.index');
    }

    // Store Brand Data
    public function store(Request $request) {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name',
            'brand_logo' => 'required',
        ]);

        $slug               = Str::slug($request->brand_name, '-');
        $data               = [];
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = $slug;
        //working with image
        $photo     = $request->brand_logo;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        // $photo->move('files/brand/',$photoname);  //without image intervention
        Image::make($photo)->resize(240, 120)->save('public/files/brands/' . $photoname); //image intervention

        $data['brand_logo'] = 'public/files/brands/' . $photoname; // files/brand/plus-point.jpg
        DB::table('brands')->insert($data);
        $notification = ['messege' => 'Brands Created Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // Delete Brand
    public function destroy($id) {
        $data  = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;
        if (File::exists($image)) {
            unlink($image);
        }
        DB::table('brands')->where('id', $id)->delete();
        $notification = ['messege' => 'Brands Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // Edit Brand
    public function edit($id) {
        $data = DB::table('brands')->where('id', $id)->first();
        return view('admin.categories.brand.edit', compact('data'));
    }

    // update Brand
    public function update(Request $request) {
        $slug               = Str::slug($request->brand_name, '-');
        $data               = [];
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = $slug;
        if ($request->brand_logo) {
            $image = $request->old_logo;
            if (File::exists($image)) {
                unlink($image);
            }
            $photo     = $request->brand_logo;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(240, 120)->save('public/files/brands/' . $photoname);
            $data['brand_logo'] = 'public/files/brands/' . $photoname;
        } else {
            $data['brand_logo'] = $request->old_logo;
        }
        
        DB::table('brands')->where('id', $request->brand_id)->update($data);
        $notification = ['messege' => 'Brands Updated Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
