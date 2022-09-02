<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller
{
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
            $data = DB::table('campaigns')->get();
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
        return view('admin.offers.campaign.index');
    }
}
