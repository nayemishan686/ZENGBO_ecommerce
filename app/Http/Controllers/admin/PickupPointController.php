<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class PickupPointController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // show all pickup point
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('pickuppoints')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($pickup){
                $action_btn ='<a href="" class="btn btn-primary edit" data-id= "'.$pickup->id.'"data-toggle="modal" data-target="#editModal"><i
                class="fas fa-edit"></i></a> <a href="'.route('pickuppoint.delete', [$pickup->id]).'" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                return $action_btn;
            })
            ->rawColumns(['action'])
            ->make([true]);   
        }

        return view('admin.pickup_point.index');
    }

    // Pickup Point store
    public function store(Request $request){
        $data = [];
        $data['pickUpPointName'] = $request->pickUpPointName;
        $data['pickUpPointAddress'] = $request->pickUpPointAddress;
        $data['pickUpPointPhone'] = $request->pickUpPointPhone;
        $data['pickUpPointPhoneTwo'] = $request->pickUpPointPhoneTwo;
        DB::table('pickuppoints')->insert($data);
        return response()->json('Pickup Point added successfully');
    }

    // Coupon edit
    public function edit($id){
        $pickup = DB::table('pickuppoints')->where('id', $id)->first();
        return view('admin.pickup_point.edit', compact('pickup'));
    }

    // Coupon Update
    public function update(Request $request){
        $data = [];
        $data['pickUpPointName'] = $request->pickUpPointName;
        $data['pickUpPointAddress'] = $request->pickUpPointAddress;
        $data['pickUpPointPhone'] = $request->pickUpPointPhone;
        $data['pickUpPointPhoneTwo'] = $request->pickUpPointPhoneTwo;
        DB::table('pickuppoints')->where('id',$request->id)->update($data);
        return response()->json('Pickup Point Updated successfully');
    }

    // Pickup point Delete
    public function destroy($id){
        DB::table('pickuppoints')->where('id', $id)->delete();
        return response()->json('Pickup Point deleted successfully');
    }
}
