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
                            <li class="breadcrumb-item active">SMTP Setting</li>
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
                                <h3 class="card-title">Your SMTP Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('smtp.setting.update',$smtp->id)}}" method="Post">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="mailer_name">Mailer Name</label>
                                        <input type="text" class="form-control @error('mailer_name') is-invalid @enderror" name="mailer_name"
                                            id="mailer_name" placeholder="Enter Mailer Name" @if($smtp->mailer) value="{{$smtp->mailer}}" @endif>
                                            <small>Example: smtp</small>
                                            @error('mailer_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="host_name">Host Name</label>
                                        <input type="text" class="form-control @error('host_name') is-invalid @enderror" name="host_name"
                                            id="host_name" placeholder="Enter Host Name" value="{{$smtp->host}}">
                                            <small>Example: smtp.mailtrap.io</small>
                                            @error('host_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="port_name">Port Name</label>
                                        <input type="text" class="form-control @error('port_name') is-invalid @enderror" name="port_name"
                                            id="port_name" placeholder="Enter Port Name" value="{{$smtp->port}}">
                                            <small>Example: 2314</small>
                                            @error('port_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="user_name">User Name</label>
                                        <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                                            id="user_name" placeholder="Enter User Name" value="{{$smtp->user_name}}">
                                            <small>Example: f11e36dji34jrk</small>
                                            @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="Enter Password" value="{{$smtp->password}}">
                                            <small>Example: d3er69d0324254</small>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
