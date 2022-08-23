<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-row">
                <div class="top_bar_contact_item">
                    <div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+38 068 005
                    3570
                </div>
                <div class="top_bar_contact_item">
                    <div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a
                        href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
                </div>
                <div class="top_bar_content ml-auto">
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="#">English<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">Italian</a></li>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">Japanese</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">EUR Euro</a></li>
                                    <li><a href="#">GBP British Pound</a></li>
                                    <li><a href="#">JPY Japanese Yen</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="user_icon"><img src="{{ asset('frontend') }}/images/user.svg" alt=""></div> --}}

                    @if(Auth::check())
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown" >
                            <li>
                                <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                <ul style="width:200px;">
                                    <li><a href="{{ route('home') }}">Profile</a></li>
                                    <li><a href="{{route('customer.logout')}}">Logout</a></li>
                                </ul>
                            </li>
                          
                        </ul>
                    </div>
                    @endif


                    @guest
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="#">Login<i class="fas fa-chevron-down"></i></a>
                                <ul style="width:300px; padding:10px;">
                                    <div>
                                        <strong>Login your account</strong><br>
                                        <br>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus placeholder="Enter Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="Enter Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Remember Me') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-info">login</button>
                                            </div>
                                        </form>
                                        <div class="form-group">
                                            <a href="{" class="btn btn-success btn-sm btn-block text-white">Login
                                                WIth Google</a>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('register')}}">Register</a>
                            </li>
                        </ul>
                    </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</div>
