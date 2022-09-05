<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // show all category
    public function index() {

        // $category = DB::table('categories')->get();  // query builder

        $category = Category::all(); // eloquent ORM
        return view('admin.categories.category.index', compact('category'));
    }

    // store category
    public function store(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
            'icon'          => 'required',
        ]);
        $slug = Str::slug($request->category_name, '-');
        // Working with icon
        $icon     = $request->icon;
        $iconName = $slug . '.' . $icon->getClientOriginalExtension();
        Image::make($icon)->resize(32, 32)->save('files/category/' . $iconName);

        // // Query Builder
        // $data = [];
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        // Eloquent ORM

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'icon'          => ('files/category/' . $iconName),
        ]);
        $notification = ['messege' => 'Category Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    // Deletee Category
    public function destroy($id) {
        // Query Builder
        // DB::table('categories')->where('id',$id)->delete();

        // Eloquent ORM
        $data = Category::findorfail($id);
        $icon = $data->icon;
        if (File::exists(public_path($icon))) {
            unlink(public_path($icon));
        }
        Category::find($id)->delete();
        $notification = ['messege' => 'Category Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // Edit Category
    public function edit($id) {
        // // query Builder
        // $data = DB::table('categories')->where('id',$id)->first();

        // Eloquent ORM
        $data = Category::find($id);
        return view('admin.categories.category.edit', compact('data'));
    }

    // Update Category
    public function update(Request $request) {
        $slug=Str::slug($request->category_name, '-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=$slug;
        $data['home_page']=$request->home_page;
        if ($request->icon) {
              if (File::exists($request->old_icon)) {
                     unlink($request->old_icon);
                }
              $photo=$request->icon;
              $photoname=$slug.'.'.$photo->getClientOriginalExtension();
              Image::make($photo)->resize(32,32)->save('files/category/'.$photoname); 
              $data['icon']='files/category/'.$photoname; 
              DB::table('categories')->where('id',$request->id)->update($data); 
              $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
              return redirect()->back()->with($notification);
        }else{
          $data['icon']=$request->old_icon;   
          DB::table('categories')->where('id',$request->id)->update($data); 
          $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
        }
    }

    // get subcategory
    public function getSubCategory($id) {
        $data = DB::table('sub_categories')->where('category_id', $id)->get();
        return response()->json($data);
    }

    // get ChildCategory
    public function getChildCategory($id) {
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);
    }

}
