<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Str;

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

    // store category
    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        // // Query Builder
        // $data = [];
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        // Eloquent ORM
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ]);
       
        
    }

    // Deletee Category
    public function destroy($id){
        // Query Builder
        // DB::table('categories')->where('id',$id)->delete();

        // Eloquent ORM
        Category::find($id)->delete();
        $notification = array('messege' => 'Category Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Edit Category
    public function edit($id){
        // // query Builder
        // $data = DB::table('categories')->where('id',$id)->first();

        // Eloquent ORM
        $data = Category::find($id);
        return response()->json($data);
    }

    // Update Category
    public function update(Request $request){
        $validated = $request->validate([
            'category_name' => 'required',
        ]);
        $id = $request->id;

        // // query builder
        // $category = [];
        // $category['category_name'] = $request->category_name;
        // $category['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->where('id',$id)->update($category);

        // Eloquent ORM
        $category = Category::find($id);
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name,'-'),
        ]);
        $notification = array('messege' => 'Category Updated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // get subcategory
    public function getSubCategory($id){
        $data = DB::table('sub_categories')->where('category_id', $id)->get();
        return response()->json($data);
    } 
    
    // get ChildCategory
    public function getChildCategory($id){
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);
    }

}
