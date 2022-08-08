<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class WareHouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Show All Warehouse 
    public function index(Request $request){
        if($request->ajax()){
        $data = DB::table('warehouses')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($warehouse){
                // '.$warehouse->id.'
                $action_btn ='<a href="" class="btn btn-primary edit" data-id= "'.$warehouse->id.'"data-toggle="modal" data-target="#editModal"><i
                class="fas fa-edit"></i></a> <a href="'.route('warehouse.delete', [$warehouse->id]).'" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                return $action_btn;
            })
            ->rawColumns(['action'])
            ->make([true]);
        }

        return view('admin.categories.warehouse.index');
    }

    // Store Ware House
    public function store(Request $request){
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);

        $data = [];
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;
        DB::table('warehouses')->insert($data);
        $notification = array('messege' => 'Warehouse Created Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Warehouse Edit
    public function edit($id){
        $warehouse = DB::table('warehouses')->where('id', $id)->first();
        return view('admin.categories.warehouse.edit', compact('warehouse'));
    }

    // Warehouse Update
    public function update(Request $request){
        $validated = $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);
        $id = $request->id;
        $data = [];
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;
        DB::table('warehouses')->where('id', $id)->update($data);
        $notification = array('messege' => 'Warehouse Updated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // WareHouse Delete
    public function destroy($id){
        $warehouse = DB::table('warehouses')->where('id', $id)->delete();
        $notification = array('messege' => 'Warehouse Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

}
