@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
        integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript"
        src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="" method="post" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}" required="">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Product Code <span
                                                    class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" value="{{ old('code') }}"
                                                name="code" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Category<span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option disabled="" selected="">Select Category</option>
                                                @foreach($category as $cat)
                                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="subcategory_id">Subcategory<span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Child category<span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="childcategory_id" id="childcategory_id">

                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Brand <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="brand_id" id="brand_id">
                                                <option disabled="" selected="">Select Brand</option>
                                                @foreach($brand as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Pickup Point</label>
                                            <select class="form-control" name="pickup_point_id" id="pickup_point_id">
                                                <option disabled selected>Select Pickup Point</option>
                                                @foreach($pickuppoint as $pickpoint)
                                                    <option value="{{$pickpoint->id}}">{{$pickpoint->pickUpPointName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Unit <span class="text-danger">*</span> </label>
                                            <input type="text" class=form-control name="unit"
                                                value="{{ old('unit') }}" required="">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Tags</label><br>
                                            <input type="text" name="tags" class="form-control"
                                                value="{{ old('tags') }}" name="tags" data-role="tagsinput">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInput">Purchase Price </label>
                                            <input type="text" class="form-control" {{ old('purchase_price') }}
                                                name="purchase_price">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInput">Selling Price <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="selling_price" value="{{ old('selling_price') }}"
                                                class="form-control" required="">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInput">Discount Price </label>
                                            <input type="text" name="discount_price"
                                                value="{{ old('discount_price') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Warehouse <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="warehouse">
                                                <option disabled selected>Select Warehouse</option>
                                                @foreach($warehouse as $warehouse)
                                                    <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Stock</label>
                                            <input type="text" name="stock_quantity"
                                                value="{{ old('stock_quantity') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Color</label><br>
                                            <input type="text" class="form-control" value="{{ old('color') }}"
                                                data-role="tagsinput" name="color" />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Size</label><br>
                                            <input type="text" class="form-control" value="{{ old('size') }}"
                                                data-role="tagsinput" name="size" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputPassword1">Product Details</label>
                                            <textarea class="form-control textarea" name="description" id="summernote">{{ old('description') }}</textarea>
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
                                        <input type="file" name="thumbnail" required="" accept="image/*"
                                            class="dropify">
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
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <script src="{{ asset('admin') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


    <script type="text/javascript">
        $('.dropify').dropify(); //dropify image
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
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
