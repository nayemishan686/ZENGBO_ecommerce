@extends('layouts.app')

@section('content')
    @push('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">
    @endpush
    <!-- Cart -->

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container pb-5">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($data as $item)
                                    @php
                                        $product = DB::table('products')
                                            ->where('id', $item->id)
                                            ->first();
                                        $colors = explode(',', $product->color);
                                        $sizes = explode(',', $product->size);
                                    @endphp
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img
                                                src="{{ asset('public/files/products/' . $product->thumbnail) }}"
                                                alt="{{ $item->name }}"></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $product->name }}</div>
                                            </div>
                                            @if($sizes != null)
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Size</div>
                                                <div class="cart_item_text">
                                                    <select class="custom-select form-control-sm color" name="color"  style="min-width: 100px;">
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size }}" @if($size == $item->options->size) selected  @endif>{{ $size }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            @if($colors != null)
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Color</div>
                                                <div class="cart_item_text">
                                                    <select class="custom-select form-control-sm color" name="color"  style="min-width: 100px;">
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color }}" @if($color == $item->options->color) selected  @endif>{{ $color }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text">{{$item->qty}}</div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">{{$setting->currency}}{{$item->price}}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">{{$setting->currency}}{{$item->price*$item->qty}}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Order Total -->
                        @if(Cart::Total()>0)
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order SubTotal:</div>
                                <div class="order_total_amount">{{$setting->currency}}{{Cart::SubTotal()}}</div>
                            </div>
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Tax:</div>
                                <div class="order_total_amount">{{$setting->currency}}{{Cart::Tax()}}</div>
                            </div>
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">{{$setting->currency}}{{Cart::Total()}}</div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            <button type="button" class="button cart_button_clear">Clear Cart</button>
                            <button type="button" class="button cart_button_checkout">Add to Cart</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
