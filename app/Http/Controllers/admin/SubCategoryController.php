<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;


class SubCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Show all Subcategory // Query Builder
    public function index(){

        // // Query Builder
        // $data = DB::table('sub_categories')
        //         ->leftJoin('categories','sub_categories.category_id','categories.id')
        //         ->select('sub_categories.*','categories.category_name')->get();
        // $category = DB::table('categories')->get();

        // Eloquent ORM
        $data = SubCategory::all();
        $category = Category::all();
        return view('admin.categories.subcategory.index',compact('data','category'));
    }

    // store subcategory
    public function store(Request $request){
        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        // // Query Builder
        // $data = [];
        // $data['category_id'] = $request->category_id;
        // $data['subcategory_name'] = $request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('sub_categories')->insert($data);

        // Eloquent ORM
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);
        $notification = array('messege' => 'SubCategory Inserted', 'alert-type' => 'success');
        return redirect()->route('subcategory.index')->with($notification);
    }

    
    // Edit Subcategory
    public function edit($id){
        // // Query Builder
        // $data = DB::table('sub_categories')->where('id', $id)->first();
        // $category = DB::table('categories')->get();

        // Eloquent ORM
        $data = SubCategory::find($id);
        $category = Category::all();
        return view('admin.categories.subcategory.edit', compact('data','category'));
    }

    // Update Category
    public function update(Request $request){
        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);
        $sid = $request->id;

        // // Query Builder
        // $data = [];
        // $data['category_id'] = $request->category_id;
        // $data['subcategory_name'] = $request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('sub_categories')->where('id', $sid)->update($data);

        // Eloquent ORM
        $subcategory = SubCategory::find($sid);
        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);
        $notification = array('messege' => 'SubCategory Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('subcategory.index')->with($notification);
    }
    
    // Delete Category
    public function destroy($id){
        // // Query Builder
        // DB::table('sub_categories')->where('id',$id)->delete();

        // Eloquent ORM
        SubCategory::find($id)->delete();
        $notification = array('messege' => 'SubCategory Deleted Successfully', 'alert-type' => 'success');
        return redirect()->route('subcategory.index')->with($notification);
    }

}