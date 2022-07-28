@extends('layouts.admin')
@section('admin_content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="h1" style="color: #007bff"><b>ZENGBO</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your Work</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                        <div class="input-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Enter Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @if (session('error'))
                            <p style="color: red">{{ session('error') }}</p>
                        @endif
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Enter Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
