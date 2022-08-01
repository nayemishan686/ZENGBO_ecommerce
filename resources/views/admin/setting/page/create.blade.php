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
                            <li class="breadcrumb-item active">Create Page</li>
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
                                <h3 class="card-title">Create New Page</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('page.store')}}" method="Post">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="page_position">Page Position</label>
                                        <select class="form-control" name="page_position" id="page_position">
                                            <option disabled selected value="0">Select One</option>
                                            <option value="1">Line 1</option>
                                            <option value="2">Line 2</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="page_name">Page Name</label>
                                        <input type="text" class="form-control" name="page_name"
                                            id="page_name" placeholder="Enter your page name">
                                    </div>

                                    <div class="form-group">
                                        <label for="page_title">Page Title</label>
                                        <input type="text" class="form-control" name="page_title"
                                            id="page_title" placeholder="Enter your page title">
                                    </div>

                                    <div class="form-group">
                                        <label for="page_description">Page Description</label>
                                        <textarea class="form-control" name="page_description" id="summernote" cols="30" rows="10"></textarea>
                                    </div>
                                <!-- /.card-body -->

                                <div class="">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
