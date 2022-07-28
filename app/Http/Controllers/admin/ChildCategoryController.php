<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class ChildCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Show all child-category
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('childcategories')
                    ->leftJoin('categories', 'childcategories.category_id', 'categories.id')
                    ->leftJoin('sub_categories', 'childcategories.subcategory_id', 'sub_categories.id')
                    ->select('childcategories.*','categories.category_name','sub_categories.subcategory_name')->get();

                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($child_cat){
                            $action_btn = '<a href="" class="btn btn-primary edit" data-id= "'.$child_cat->id.'" data-toggle="modal" data-target="#editModal"><i
                            class="fas fa-edit"></i></a> <a href="'.route('childcategory.delete',[$child_cat->id]).'" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                        return $action_btn;
                    })
                        ->rawColumns(['action'])
                        ->make([true]);
        }
        $category = DB::table('categories')->get();
        return view('admin.categories.childcategory.index',compact('category'));
    }

    
    // Store Child Category
    public function store(Request $request){
        $validated = $request->validate([
            'subcategory_id' => 'required',
            'childcategory_name' => 'required',
        ]);
        $category = DB::table('sub_categories')->where('id',$request->subcategory_id)->first();
        $data = [];
        $data['category_id'] = $category->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        DB::table('childcategories')->insert($data);
        $notification = array('messege' => 'ChildCategory Created Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    // Delete Child Category
    public function destroy($id){
        $child_cat = DB::table('childcategories')->where('id', $id)->delete();
        $notification = array('messege' => 'ChildCategory Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    // Edit Child Category
    public function edit($id){
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id', $id)->first();
        return view('admin.categories.childcategory.edit', compact('category', 'data'));
    }

    // Update Child Category
    public function update(Request $request){
        $validated = $request->validate([
            'subcategory_id' => 'required',
            'childcategory_name' => 'required',
        ]);
        $id = $request->childcategory_id;
        $category = DB::table('sub_categories')->where('id',$request->subcategory_id)->first();
        $data = [];
        $data['category_id'] = $category->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        DB::table('childcategories')->where('id', $id)->update($data);
        $notification = array('messege' => 'ChildCategory Updated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }


}
