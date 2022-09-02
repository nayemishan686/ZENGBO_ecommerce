<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller {
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
                ->editColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return '<span class="badge badge-success">active</span>';
                    } else {
                        return '<span class="badge badge-danger">deactive</span>';
                    }
                })
                ->addColumn('action', function ($campaign) {
                    $action_btn = '<a href="" class="btn btn-primary edit" data-id= "' . $campaign->id . '" data-toggle="modal" data-target="#editModal"><i
                    class="fas fa-edit"></i></a> <a href="' . route('campaign.delete', [$campaign->id]) . '" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></a>';
                    return $action_btn;
                })

                ->rawColumns(['action', 'status'])
                ->make([true]);
        }
        return view('admin.offers.campaign.index');
    }

    // Store Brand Data
    public function store(Request $request) {
        $slug               = Str::slug($request->title, '-');
        $data               = [];
        $data['title']      = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date']   = $request->end_date;
        $data['status']     = $request->status;
        $data['discount']   = $request->discount;
        $data['month']      = date('F');
        $data['year']       = date('Y');
        //working with image
        $photo     = $request->image;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(468, 90)->save('files/campaigns/' . $photoname); //image intervention

        $data['image'] = '/files/campaigns/' . $photoname; // files/brand/plus-point.jpg
        DB::table('campaigns')->insert($data);
        $notification = ['messege' => 'Campaigns Created Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // Delete Campaign
    public function destroy($id) {
        $data  = DB::table('campaigns')->where('id', $id)->first();
        $image = $data->image;
        if (File::exists(public_path($image))) {
            unlink(public_path($image));
        }
        DB::table('campaigns')->where('id', $id)->delete();
        $notification = ['messege' => 'Campaign Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // Edit Campaign
    public function edit($id) {
        $data = DB::table('campaigns')->where('id', $id)->first();
        return view('admin.offers.campaign.edit', compact('data'));
    }

    // Update Campaign Data
    public function update(Request $request) {
        $slug               = Str::slug($request->title, '-');
        $data               = [];
        $data['title']      = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date']   = $request->end_date;
        $data['status']     = $request->status;
        $data['discount']   = $request->discount;
        $data['month']      = date('F');
        $data['year']       = date('Y');
        //working with image
        if ($request->image) {
            $image = $request->old_image;
            if (File::exists(public_path($image))) {
                unlink(public_path($image));
            }
            $photo     = $request->image;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(468, 90)->save('files/campaigns/' . $photoname); //image intervention
            $data['image'] = '/files/campaigns/' . $photoname; // files/brand/plus-point.jpg
        } else {
            $data['image'] = $request->old_image;
        }
        DB::table('campaigns')->update($data);
        $notification = ['messege' => 'Campaigns Created Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

}
