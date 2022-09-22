@extends('layouts.app')
@section('content')
    {{-- <script src="{{ asset('public/js/share.js') }}"></script> --}}


    <style type="text/css">
        .checked {
            color: orange;
        }
    </style>

    {{-- Extra image --}}
    @php
        // Bulk image
        if (isset($product->images)) {
            $images = json_decode($product->images, true);
        }
        // Color
        if (isset($product->color)) {
            $color = explode(',', $product->color);
        }
        // Size
        if (isset($product->size)) {
            $size = explode(',', $product->size);
        }
        
        // Review
        $review_5 = App\Models\Reviews::where('product_id', $product->id)
            ->where('rating', '5')
            ->count();
        $review_4 = App\Models\Reviews::where('product_id', $product->id)
            ->where('rating', '4')
            ->count();
        $review_3 = App\Models\Reviews::where('product_id', $product->id)
            ->where('rating', '3')
            ->count();
        $review_2 = App\Models\Reviews::where('product_id', $product->id)
            ->where('rating', '2')
            ->count();
        $review_1 = App\Models\Reviews::where('product_id', $product->id)
            ->where('rating', '1')
            ->count();
        
        $sumrating = App\Models\Reviews::where('product_id', $product->id)->sum('rating');
        $countrating = App\Models\Reviews::where('product_id', $product->id)->count('rating');
        
    @endphp
    <!-- Single Product -->

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-1 order-lg-1 order-2">
                    <ul class="image_list">
                        @if (isset($product))
                            @foreach ($images as $item)
                                <li data-image="{{ asset('public/files/products/' . $item) }}"><img
                                        src="{{ asset('public/files/products/' . $item) }}" alt="">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset('public/files/products/' . $product->thumbnail) }}"
                            alt="{{ $product->name }}"></div>
                </div>


                <!-- Description -->
                <div class="col-lg-4 order-3">

                    <div class="product_description">
                        <div class="product_category">{{ $product->category->category_name }} >
                            {{ $product->subcategory->subcategory_name }}</div>
                        <div class="product_name" style="font-size: 20px;">{{ $product->name }}</div>
                        @isset($product->brand->brand_name)
                        <div class="product_category"><b> Brand: {{ $product->brand->brand_name }} </b></div>
                        @endisset
                        <div class="product_category"><b> Stock: {{ $product->stock_quantity }} </b></div>
                        <div class="product_category"><b> Unit: {{ $product->unit }} </b></div>
                        {{-- review star --}}
                        <div>
                            @if ($sumrating != null)
                                @if (intval($sumrating / $countrating) == 5)
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ml-2">
                                            {{ substr($sumrating / $countrating, 0, 4) }}
                                        </span>
                                    </div>
                                @elseif(intval($sumrating / $countrating) >= 4 && intval($sumrating / $countrating) < 5)
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }} </span>
                                    </div>
                                @elseif(intval($sumrating / $countrating) >= 3 && intval($sumrating / $countrating) < 4)
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }} </span>
                                    </div>
                                @elseif(intval($sumrating / $countrating) >= 2 && intval($sumrating / $countrating) < 3)
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }} </span>
                                    </div>
                                @elseif(intval($sumrating / $countrating) >= 1 && intval($sumrating / $countrating) < 2)
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }} </span>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div><br>

                            @if ($product->discount_price == null)
                                <div class="product_price">Price: {{ $setting->currency }}{{ $product->selling_price }}
                                </div>
                            @else
                                <div class="product_price">
                                    Price: <del
                                        class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del
                                        class="text-danger">

                                    {{ $setting->currency }}{{ $product->discount_price }}</div>
                            @endif
                        </div>


                        <div class="order_info d-flex flex-row">
                            <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_cart_form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                @if ($product->discount_price == null)
                                    <input type="hidden" name="price" value="{{ $product->selling_price }}">
                                @else
                                    <input type="hidden" name="price" value="{{ $product->discount_price }}">
                                @endif
                                <div class="form-group">
                                    <div class="row">
                                        @isset($product->size)
                                            <div class="col-lg-6">
                                                <label>Pick Size: </label>
                                                <select class="custom-select form-control-sm" name="size"
                                                    style="min-width: 120px;">
                                                    @foreach ($size as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset

                                        @isset($product->color)
                                            <div class="col-lg-6">
                                                <label>Pick Color: </label>
                                                <select class="custom-select form-control-sm" name="color"
                                                    style="min-width: 120px;">
                                                    @foreach ($color as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                                <br>
                                <div class="clearfix" style="z-index: 1000;">

                                    <!-- Product Quantity -->
                                    <div class="product_quantity clearfix ml-2">
                                        <span>Quantity: </span>
                                        <input id="quantity_input" type="text" name="qty" pattern="[1-9]*"
                                            min="1" value="1">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                    class="fas fa-chevron-up"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                    class="fas fa-chevron-down"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button_container">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            @if ($product->stock_quantity < 1)
                                                <button class="btn btn-outline-danger" disabled="">Stock Out</button>
                                            @else
                                                <button class="btn btn-outline-info" type="submit"
                                                    style="cursor: pointer"> <span class="loading d-none">....</span> Add
                                                    to cart</button>
                                            @endif

                                            @if (Auth::id())
                                                <a href="{{ route('add.wishlist', $product->id) }}"
                                                    class="btn btn-outline-primary" type="button"
                                                    style="cursor: pointer">Add to
                                                    wishlist</a>
                                            @else
                                                <button class="btn btn-outline-primary alert_wishlist" type="button"
                                                    style="cursor: pointer">Add to
                                                    wishlist</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>


                <div class="col-lg-3 order-3" style="border-left: 1px solid grey; padding-left: 10px;">
                    <strong class="text-muted">Pickup Point of this product</strong><br>
                    <i class="fa fa-map"> {{ $product->pickuppoint->pickupPointName }} </i>
                    <hr><br>
                    <strong class="text-muted"> Home Delivery :</strong><br>
                    -> (4-8) days after the order placed.<br>
                    -> Cash on Delivery Available.
                    <hr><br>
                    <strong class="text-muted"> Product Return & Warrenty :</strong><br>
                    -> 7 days return guarranty.<br>
                    -> Warrenty not available.
                    <hr><br>
                    @isset($product->video)
                        <strong>Product Video : </strong>
                        <iframe width="340" height="205" src="{{ $product->video }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    @endisset
                </div>

            </div><br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product details of {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ratings & Reviews of {{ $product->name }}</h4>
                        </div>



                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    Average Review of {{ $product->name }}:<br>
                                    @if ($sumrating != null)
                                        @if (intval($sumrating / $countrating) == 5)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="ml-2">
                                                    {{ substr($sumrating / $countrating, 0, 4) }}
                                                </span>
                                            </div>
                                        @elseif(intval($sumrating / $countrating) >= 4 && intval($sumrating / $countrating) < 5)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }}
                                                </span>
                                            </div>
                                        @elseif(intval($sumrating / $countrating) >= 3 && intval($sumrating / $countrating) < 4)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }}
                                                </span>
                                            </div>
                                        @elseif(intval($sumrating / $countrating) >= 2 && intval($sumrating / $countrating) < 3)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }}
                                                </span>
                                            </div>
                                        @elseif(intval($sumrating / $countrating) >= 1 && intval($sumrating / $countrating) < 2)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="ml-2"> {{ substr($sumrating / $countrating, 0, 4) }}
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    {{-- all review show --}}
                                    Total Review Of This Product:<br>
                                    @if ($review_5 > 0)
                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span> {{ $review_5 }} </span>
                                        </div>
                                    @endif
                                    @if ($review_4 > 0)
                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span> {{ $review_4 }} </span>
                                        </div>
                                    @endif
                                    @if ($review_3 > 0)
                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span> {{ $review_3 }} </span>
                                        </div>
                                    @endif
                                    @if ($review_2 > 0)
                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span> {{ $review_2 }} </span>
                                        </div>
                                    @endif
                                    @if ($review_1 > 0)
                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span> {{ $review_1 }} </span>
                                        </div>
                                    @endif

                                </div>
                                <div class="col-lg-6">
                                    <form action="{{ route('review.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="details">Write Your Review</label>
                                            <textarea type="text" class="form-control" name="review" required=""></textarea>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="form-group ">
                                            <label for="review">Write Your Review</label>
                                            <select class="custom-select form-control-sm" name="rating"
                                                style="min-width: 120px;">
                                                <option disabled="" selected="">Select Your Review</option>
                                                <option value="1">1 star</option>
                                                <option value="2">2 star</option>
                                                <option value="3">3 star</option>
                                                <option value="4">4 star</option>
                                                <option value="5">5 star</option>
                                            </select>

                                        </div>
                                        @if (Auth::check())
                                            <button type="submit" class="btn btn-sm btn-info"><span
                                                    class="fa fa-star "></span> submit review</button>
                                        @else
                                            <p>Please at first login to your account for submit a review.</p>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <br>

                            {{-- all review of this product --}}
                            <strong>All review of {{ $product->name }}</strong>
                            <hr>
                            <div class="row">
                                @foreach ($review as $row)
                                    <div class="card col-lg-5 m-4">
                                        <div class="card-header">
                                            {{ $row->user->name }} ( {{ date('d F , Y'), strtotime($row->review_date) }} )
                                        </div>
                                        <div class="card-body">
                                            {{ $row->review }}
                                            @if ($row->rating == 5)
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                </div>
                                            @elseif($row->rating == 4)
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                </div>
                                            @elseif($row->rating == 3)
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                </div>
                                            @elseif($row->rating == 2)
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                </div>
                                            @elseif($row->rating == 1)
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <!-- Related Product -->


    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Related Product</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Related Product Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">
                            @foreach ($related_product as $item)
                                <!-- Related Product Item -->
                                <div class="owl-item">
                                    <div
                                        class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img
                                                src="{{ asset('public/files/products/' . $item->thumbnail) }}"
                                                alt="{{ $item->name }}"></div>
                                        <div class="viewed_content text-center">
                                            @if ($item->discount_price == null)
                                                <div class="viewed_price">
                                                    {{ $setting->currency }}{{ $item->selling_price }}</div>
                                            @else
                                                <div class="viewed_price">
                                                    {{ $setting->currency }}{{ $item->discount_price }}
                                                    <span>{{ $setting->currency }}{{ $item->selling_price }}</span>
                                                </div>
                                            @endif


                                            <div class="viewed_name"><a
                                                    href="{{ route('product.details', $item->slug) }}">{{ substr($item->name, 0, 50) }}</a>
                                            </div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">new</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        //store Cart ajax call
        $('#add_cart_form').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                async: false,
                data: request,
                success: function(data) {
                    toastr.success(data);
                    $('#add_cart_form')[0].reset();
                    cart();
                }
            });
        });
    </script>
@endsection
