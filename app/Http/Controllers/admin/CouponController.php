<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // show all coupon
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('coupons')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($coupon){
                $action_btn ='<a href="" class="btn btn-primary edit" data-id= "'.$coupon->id.'"data-toggle="modal" data-target="#editModal"><i
                class="fas fa-edit"></i></a> <a href="'.route('coupon.delete', [$coupon->id]).'" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                return $action_btn;
            })
            ->rawColumns(['action'])
            ->make([true]);   
        }

        return view('admin.offers.coupon.index');
    }

    // Coupon Store
    public function store(Request $request){
        $data = [];
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_type'] = $request->coupon_type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['valid_date'] = $request->coupon_date;
        $data['status'] = $request->coupon_status;
        DB::table('coupons')->insert($data);
        return response()->json("Coupon Inserted Successfully");
    }

    // Coupon edit
    public function edit($id){
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.offers.coupon.edit', compact('coupon'));
    }

    // Coupon Update
    public function update(Request $request){
        $data = [];
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_type'] = $request->coupon_type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['valid_date'] = $request->coupon_date;
        $data['status'] = $request->coupon_status;
        DB::table('coupons')->where('id',$request->id)->update($data);
        return response()->json("Coupon Updated Successfully");
    }

    
    // Coupon Delete
    public function destroy($id){
        DB::table('coupons')->where('id', $id)->delete();
        return response()->json('Coupon deleted!');
    }

}
