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
                            $action_btn = '<a href="" class="btn btn-primary edit" data-id= "{{$child_cat->id}}" data-toggle="modal" data-target="#editModal"><i
                            class="fas fa-edit"></i></a> <a href="" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                        return $action_btn;
                    })
                        ->rawColumns(['action'])
                        ->make([true]);
        }

        return view('admin.categories.childcategory.index');
    }

}
