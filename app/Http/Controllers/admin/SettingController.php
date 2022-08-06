<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class SettingController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }
/********************
SEO Setting Start
 ********************/
    // SEO Show
    public function seoIndex() {
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }

    // SEO Update
    public function seoUpdate(Request $request, $id) {
        $validated = $request->validate([
            'meta_title'   => 'required',
            'meta_tag'     => 'required',
            'meta_keyword' => 'required',
        ]);
        $data                        = [];
        $data['meta_title']          = $request->meta_title;
        $data['meta_author']         = Auth::user()->name;
        $data['meta_tag']            = $request->meta_tag;
        $data['meta_description']    = $request->meta_description;
        $data['meta_keyword']        = $request->meta_keyword;
        $data['google_verification'] = $request->google_verification;
        $data['google_analytics']    = $request->google_analytics;
        $data['alexa_verification']  = $request->alexa_verification;
        $data['google_adsense']      = $request->google_adsense;
        DB::table('seos')->where('id', $id)->update($data);
        $notification = ['messege' => 'SEO Setting Updated Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
    /********************
    SEO Setting END
     *******************/

    /********************
    SMTP setting start
     *******************/
    // SMTP show
    public function smtpIndex() {
        $smtp = DB::table('smtps')->first();
        return view('admin.setting.smtp_setting', compact('smtp'));
    }

    // SMTP update
    public function smtpUpdate(Request $request, $id) {
        $data              = [];
        $data['mailer']    = $request->mailer_name;
        $data['host']      = $request->host_name;
        $data['port']      = $request->port_name;
        $data['user_name'] = $request->user_name;
        $data['password']  = $request->password;
        DB::table('smtps')->where('id', $id)->update($data);
        $notification = ['messege' => 'SMTP Setting Updated Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /********************
    SMTP setting END
     *******************/

    /**********************************
    Dynamic Page Creation Setting Start
     ***********************************/
    // Page Show
    public function pageIndex() {
        $page = DB::table('pages')->get();
        return view('admin.setting.page.index', compact('page'));
    }

    // Page Show
    public function pageCreate() {
        return view('admin.setting.page.create');
    }

    // Page Store
    public function pageStore(Request $request) {
        $data                     = [];
        $data['page_position']    = $request->page_position;
        $data['page_name']        = $request->page_name;
        $data['page_slug']        = Str::slug($request->page_name, '-');
        $data['page_title']       = $request->page_title;
        $data['page_description'] = $request->page_description;
        DB::table('pages')->insert($data);
        $notification = ['messege' => 'Page Created Successfully', 'alert-type' => 'success'];
        return redirect()->route('page.index')->with($notification);

    }

    // Page Destroy
    public function pageDestroy($id) {
        DB::table('pages')->where('id', $id)->delete();
        $notification = ['messege' => 'Page Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    // Page Edit
    public function pageEdit($id) {
        $page = DB::table('pages')->where('id', $id)->first();
        return view('admin.setting.page.edit', compact('page'));
    }

    // Page Update
    public function pageUpdate(Request $request, $id) {
        $data                     = [];
        $data['page_position']    = $request->page_position;
        $data['page_name']        = $request->page_name;
        $data['page_slug']        = Str::slug($request->page_name, '-');
        $data['page_title']       = $request->page_title;
        $data['page_description'] = $request->page_description;
        DB::table('pages')->where('id', $id)->update($data);
        $notification = ['messege' => 'Page Updated Successfully', 'alert-type' => 'success'];
        return redirect()->route('page.index')->with($notification);
    }

    // Website Setting index
    public function website() {
        $website = DB::table('settings')->first();
        return view('admin.setting.web_setting', compact('website'));
    }

    // Website Setting Update
    public function websiteUpdate(Request $request, $id) {
        $data                    = [];
        $data['currency']        = $request->currency;
        $data['title']           = $request->title;
        $data['website_name']    = $request->website_name;
        $data['phone_one']       = $request->phone_one;
        $data['phone_two']       = $request->phone_two;
        $data['primary_email']   = $request->primary_email;
        $data['secondary_email'] = $request->secondary_email;
        $data['address']         = $request->address;
        $data['facebook']        = $request->facebook;
        $data['whatsapp']        = $request->whatsapp;
        $data['linkdin']         = $request->linkdin;
        $data['instagram']       = $request->instagram;
        $data['yahoo']           = $request->yahoo;
        $data['youtube']         = $request->youtube;
        $data['twitter']         = $request->twitter;
        //working with logo
        if ($request->logo) {
            $logo_image = $request->old_logo;
            if (File::exists(public_path($logo_image))) {
                unlink(public_path($logo_image));
            }
            $logo     = $request->logo;
            $logoname = uniqid() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save('files/logo/' . $logoname);
            $data['logo'] = 'files/logo/' . $logoname;

        } else {
            $data['logo'] = $request->old_logo;
        }

        // work with favicon
        if ($request->favicon) {
            $favicon_image = $request->old_favicon;
            if(File::exists(public_path($favicon_image))){
                unlink(public_path($favicon_image));
            }
            $favicon     = $request->favicon;
            $faviconName = uniqid() . '.' . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32, 32)->save('files/favicon/' . $faviconName);
            $data['favicon'] = 'files/favicon/' . $faviconName;
        }else{
            $data['favicon'] = $request->old_favicon;
        }

        DB::table('settings')->where('id', $id)->update($data);
        $notification = ['messege' => 'Website Setting Update Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }
}
