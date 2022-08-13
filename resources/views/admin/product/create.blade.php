@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">


    <style type="text/css">
        .bootstrap-tagsinput .tag {
            background: #428bca;
            ;
            border: 1px solid white;
            padding: 1 6px;
            padding-left: 2px;
            margin-right: 2px;
            color: white;
            border-radius: 4px;
        }
    </style>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Product Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" placeholder="Enter Product Name">
                                            @error('name')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Product Code <span
                                                    class="text-danger">*</span> </label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                value="{{ old('code') }}" name="code" placeholder="Enter Product Code">
                                            @error('code')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Category<span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                                <option disabled="" selected="">Select Category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="subcategory_id">Subcategory<span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('subcategory_id') is-invalid @enderror"
                                                name="subcategory_id" id="subcategory_id">
                                                <option disabled="" selected="">Select SubCategory</option>
                                            </select>
                                            @error('subcategory_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Child category<span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="childcategory_id" id="childcategory_id">
                                                <option disabled="" selected="">Select ChildCategory</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Brand <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('brand_id') is-invalid @enderror"
                                                name="brand_id" id="brand_id">
                                                <option disabled="" selected="">Select Brand</option>
                                                @foreach ($brand as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Pickup Point</label>
                                            <select class="form-control" name="pickup_point" id="pickup_point">
                                                <option disabled selected>Select Pickup Point</option>
                                                @foreach ($pickuppoint as $pickpoint)
                                                    <option value="{{ $pickpoint->id }}">{{ $pickpoint->pickUpPointName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Unit <span class="text-danger">*</span> </label>
                                            <input type="number" class=form-control name="unit"
                                                value="{{ old('unit') }}" placeholder="Enter Product Unit">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Tags</label><br>
                                            <input type="text" name="tags" class="form-control"
                                                value="{{ old('tags') }}" data-role="tagsinput"
                                                placeholder="Enter Tags">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInput">Purchase Price </label>
                                            <input type="number" class="form-control" {{ old('purchase_price') }}
                                                name="purchase_price" placeholder="Enter Purchase Price">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInput">Selling Price <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="selling_price"
                                                value="{{ old('selling_price') }}"
                                                class="form-control @error('selling_price') is-invalid @enderror"
                                                placeholder="Enter Selling Price">
                                            @error('selling_price')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInput">Discount Price </label>
                                            <input type="number" name="discount_price"
                                                value="{{ old('discount_price') }}" class="form-control"
                                                placeholder="Enter Discount Price">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Warehouse <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('warehouse_id') is-invalid @enderror"
                                                name="warehouse_id">
                                                <option disabled selected>Select Warehouse</option>
                                                @foreach ($warehouse as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('warehouse_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Stock</label>
                                            <input type="text" name="stock_quantity"
                                                value="{{ old('stock_quantity') }}" class="form-control"
                                                placeholder="Enter Stock Quantity">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Color</label><br>
                                            <input type="text"
                                                class="form-control @error('color') is-invalid @enderror"
                                                value="{{ old('color') }}" data-role="tagsinput" name="color"
                                                placeholder="Enter Available Colour" />
                                            @error('color')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Size</label><br>
                                            <input type="text"
                                                class="form-control @error('size') is-invalid @enderror"
                                                value="{{ old('size') }}" data-role="tagsinput" name="size"
                                                placeholder="Enter Available Size" />
                                            @error('size')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputPassword1">Product Details</label>
                                            <textarea class="form-control textarea @error('description') is-invalid @enderror" name="description" id="summernote">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputPassword1">Video Embed Code</label>
                                            <input class="form-control" name="video" value="{{ old('video') }}"
                                                placeholder="Only code after embed word">
                                            <small class="text-danger">Only code after embed word</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.card -->
                        <!-- right column -->
                        <div class="col-md-4">
                            <!-- Form Element sizes -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span>
                                        </label><br>
                                        <input type="file" name="thumbnail" accept="image/*"
                                            class="dropify @error('thumbnail') is-invalid @enderror">
                                        @error('thumbnail')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br>
                                    <div class="">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <div class="card-header">
                                                <h3 class="card-title">More Images (Click Add For More Image)</h3>
                                            </div>
                                            <tr>
                                                <td><input type="file" accept="image/*" name="images[]"
                                                        class="form-control name_list" /></td>
                                                <td><button type="button" name="add" id="add"
                                                        class="btn btn-success">Add</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card p-4">
                                        <h6>Featured Product</h6>
                                        <input type="checkbox" name="featured" value="1" checked
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Today Deal</h6>
                                        <input type="checkbox" name="today_deal" value="1" checked
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Slider Product</h6>
                                        <input type="checkbox" name="product_slider" value="1" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Trendy Product</h6>
                                        <input type="checkbox" name="trendy" value="1" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Status</h6>
                                        <input type="checkbox" name="status" value="1" checked
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <button class="btn btn-info ml-2" type="submit">Submit</button>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


    <script type="text/javascript">
        //ajax request send for collect childcategory




        $('.dropify').dropify(); //dropify image
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        // AJAX for subcategory data multiple dependency
        $("#category_id").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ url('/get-sub-category/') }}/" + id,
                type: 'get',
                success: function(data) {
                    $('select[name="subcategory_id"]').empty();
                    $.each(data, function(key, data) {
                        $('select[name="subcategory_id"]').append('<option value="' + data
                            .id + '">' + data.subcategory_name + '</option>');
                    });
                }
            });
        });


        // AJAX for childcategory data multiple dependency
        $("#subcategory_id").click(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ url('/get-child-category/') }}/" + id,
                type: 'get',
                success: function(data) {
                    $('select[name="childcategory_id"]').empty();
                    $.each(data, function(key, data) {
                        $('select[name="childcategory_id"]').append('<option value="' + data
                            .id + '">' + data.childcategory_name + '</option>');
                    });
                }
            });
        });




        $(document).ready(function() {
            var postURL = "<?php echo url('addmore'); ?>";
            var i = 1;


            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>
@endsection
