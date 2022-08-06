@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Website Setting</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-8 m-auto">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Your Website Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('website.setting.update',$website->id)}}" method="Post" enctype="multipart/form-data" autocomplete="on">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <select class="form-control" name="currency" id="currency">
                                            <option disabled selected value="0">Select One</option>
                                            <option value="৳" @if ($website->currency == "৳") selected @endif>TAKA (৳)</option>
                                            <option value="$" @if ($website->currency == "$") selected @endif>USD ($)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Website Title</label>
                                        <input type="text" class="form-control" name="title"
                                            id="title" value="{{$website->title}}" placeholder="Enter Website Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="website_name">Website Name</label>
                                        <input type="text" class="form-control" name="website_name"
                                            id="website_name" value="{{$website->website_name}}" placeholder="Enter Website Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_one">Primary Phone</label>
                                        <input type="number" class="form-control" name="phone_one"
                                            id="phone_one" value="{{$website->phone_one}}" placeholder="Enter Your Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_two">Secondary Phone</label>
                                        <input type="number" class="form-control" name="phone_two"
                                            id="phone_two" value="{{$website->phone_two}}" placeholder="Enter Backup Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="primary_email">Primary E-mail</label>
                                        <input type="email" class="form-control" name="primary_email"
                                            id="primary_email" value="{{$website->primary_email}}" placeholder="Enter Your E-mail">
                                    </div>

                                    <div class="form-group">
                                        <label for="secondary_email">Secondary E-mail</label>
                                        <input type="email" class="form-control" name="secondary_email"
                                            id="secondary_email" value="{{$website->secondary_email}}" placeholder="Enter Backup E-mail">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Addres</label>
                                        <textarea class="form-control" name="address" id="summernote" cols="30" rows="10">{{$website->address}}</textarea>
                                    </div>

                                    <strong class="text-info">Social Link</strong>

                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook"
                                            id="facebook" value="{{$website->facebook}}" placeholder="Enter Your Facebook Link">
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp">WhatsApp</label>
                                        <input type="text" class="form-control" name="whatsapp"
                                            id="whatsapp" value="{{$website->whatsapp}}" placeholder="Enter Your WhatsApp Link">
                                    </div>

                                    <div class="form-group">
                                        <label for="linkdin">Linkdin</label>
                                        <input type="text" class="form-control" name="linkdin"
                                            id="linkdin" value="{{$website->linkdin}}" placeholder="Enter Your Linkdin Link">
                                    </div>

                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" name="instagram"
                                            id="instagram" value="{{$website->instagram}}" placeholder="Enter Your Instagram Link">
                                    </div>

                                    <div class="form-group">
                                        <label for="yahoo">Yahoo!</label>
                                        <input type="text" class="form-control" name="yahoo"
                                            id="yahoo" value="{{$website->yahoo}}" placeholder="Enter Your Yahoo! Link">
                                    </div>

                                    <div class="form-group">
                                        <label for="youtube">YouTube</label>
                                        <input type="text" class="form-control" name="youtube"
                                            id="youtube" value="{{$website->youtube}}" placeholder="Enter Your YouTube Link">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter"
                                            id="twitter" value="{{$website->twitter}}" placeholder="Enter Your Twitter Link">
                                    </div>

                                    <strong class="text-info">Logo & Favicon</strong>

                                    <div class="form-group">
                                        <label for="logo">Main Logo</label>
                                        <input type="file" class="form-control" name="logo">
                                        <img src="{{asset($website->logo)}}" alt="" width="240" height="120">
                                        <input type="hidden" name="old_logo" value="{{$website->logo}}">
                                        <small>Select Logo for Your website in 320px * 120px</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="favicon">Favicon</label>
                                        <input type="file" class="form-control" name="favicon" >
                                        <img src="{{asset($website->favicon)}}" alt="favicon" width="100" height="100">
                                        <input type="hidden" name="old_favicon" value="{{$website->favicon}}">
                                        <small>Select Favicon for Your website in 32px * 32px</small>
                                    </div>
                                <!-- /.card-body -->

                                <div class="">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
