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
                            <li class="breadcrumb-item active">On Page SEO</li>
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
                                <h3 class="card-title">Your SEO Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('seo.setting.update',$data->id)}}" method="Post">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title"
                                            id="meta_title" placeholder="Meta Title" value="{{$data->meta_title}}">
                                            @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_tag">Meta Tag</label>
                                        <input type="text" class="form-control @error('meta_tag') is-invalid @enderror" name="meta_tag"
                                            id="meta_tag" placeholder="Meta Tag" value="{{$data->meta_tag}}">
                                            @error('meta_tag')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_author">Meta Author</label>
                                        <input type="text" class="form-control @error('meta_author') is-invalid @enderror" name="meta_author"
                                            id="meta_author" value="{{$data->meta_author}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keyword</label>
                                        <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword"
                                            id="meta_keyword" placeholder="Meta Keyword" value="{{$data->meta_keyword}}">
                                            <small>Example:ecommerce,online shop,online market</small>
                                            @error('meta_keyword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="10">{{$data->meta_description}}</textarea>
                                    </div>

                                    <strong class="text-center text-success"> -- Other Option -- </strong><br>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Google Verification</label>
                                        <input type="text" class="form-control" name="google_verification" value="{{$data->google_verification}}" placeholder="Google Verification">
                                         <small>Put here only verification code</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Alexa verification </label>
                                        <input type="text" class="form-control" name="alexa_verification" value="{{$data->alexa_verification}}" placeholder="Alexa Verification">
                                         <small>Put here only verification code</small>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Google Analytics</label>
                                        <textarea class="form-control" name="google_analytics">{{$data->google_analytics}}</textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Google Adsense</label>
                                        <textarea class="form-control" name="google_adsense">{{$data->google_adsense}}</textarea>
                                      </div>
                                <!-- /.card-body -->

                                <div class="">
                                    <button type="submit" class="btn btn-primary">Update Setting</button>
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
