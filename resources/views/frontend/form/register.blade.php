<div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/phone.png" alt=""></div>{{ $setting->phone_one }}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="mailto:{{ $setting->main_email }}">{{ $setting->main_email }}</a></div>
                        <div class="top_bar_content ml-auto">
                           
                            @if(Auth::check())
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown" >
                                    <li>
                                        <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                        <ul style="width:200px;">
                                            <li><a href="{{ route('home') }}">Profile</a></li>
                                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
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
                                            <strong>login your account</strong><br>
                                            <br>
                                               <form action="{{ route('login') }}" method="post">
                                                @csrf
                                                   <div class="form-group">
                                                       <label>Email Address</label>
                                                       <input type="email" class="form-control" name="email" autocomplete="off" required="">
                                                   </div>
                                                   <div class="form-group">
                                                       <label>Password</label>
                                                       <input type="password" class="form-control" name="password" required="">
                                                   </div>
                                                   <div class="form-group row">
                                                       <div class="offset-md-2">
                                                           <div class="form-check">
                                                               <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

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
                                                 <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-sm btn-block text-white">Login WIth Google</a>
                                                </div>
                                           </div>
                                        </ul>
                                    </li>
                                    <li>
                                    <a href="{{ route('register') }}">Register</a>
                                    </li>
                                </ul>
                            </div>  
                            @endguest
                        </div>
                    </div>
                </div>
            </div>      
        </div>