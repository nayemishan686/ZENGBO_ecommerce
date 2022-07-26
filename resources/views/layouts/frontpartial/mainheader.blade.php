@php
$wishlistCount = DB::table('wishlists')
    ->where('user_id', Auth::id())
    ->count();
@endphp
<div class="header_main">
    <div class="container">
        <div class="row">

            <!-- Logo -->
            <div class="col-lg-2 col-sm-3 col-3 order-1">
                <div class="logo_container">
                    <div class="logo"><a href="{{ url('/') }}">{{ $setting->website_name }}</a></div>
                </div>
            </div>

            <!-- Search -->
            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                <div class="header_search">
                    <div class="header_search_content">
                        <div class="header_search_form_container">
                            <form action="#" class="header_search_form clearfix">
                                <input type="search" required="required" class="header_search_input"
                                    placeholder="Search for products...">
                                <div class="custom_dropdown">
                                    <div class="custom_dropdown_list">
                                        <span class="custom_dropdown_placeholder clc">All Categories</span>
                                        <i class="fas fa-chevron-down"></i>

                                        <ul class="custom_list clc">
                                            @foreach ($category as $cat)
                                                <li><a class="clc" href="#">{{ $cat->category_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="header_search_button trans_300" value="Submit"><img
                                        src="{{ asset('frontend') }}/images/search.png" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist -->
            <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                    <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                        <div class="header-action-wishlist">
                            <a class="btn-wishlist" href="#">
                                <span class="cart-count">{{ $wishlistCount }}</span>
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Cart -->
                    <div class="cart">
                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <div class="cart_icon">
                                <img src="images/cart.png" alt="">
                                <div class="cart_count"><span class="cart_qty">{{ Cart::count() }}</span></div>
                            </div>
                            <div class="cart_content">
                                <div class="cart_text"><a href="{{route('cart')}}">Cart</a></div>
                                <div class="cart_price"><span
                                        class="cart_total">{{ $setting->currency }}{{ Cart::total() }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Index AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8">
    function cart() {
        $.ajax({
            type: 'get',
            url: '{{ route('all.cart') }}',
            dataType: 'json',
            success: function(data) {
                $('.cart_qty').empty();
                $('.cart_total').empty();
                $('.cart_qty').append(data.qty);
                $('.cart_total').append(data.total);
            }
        })
    }

    $(document).ready(function(event){
        cart();
    });
    
</script>
