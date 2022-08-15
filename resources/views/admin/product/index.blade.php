@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pickup Point Table</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                Add New
                            </button>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Pickup Point</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped table-sm ytable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Thumbnail</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Brand</th>
                                                <th>Featured</th>
                                                <th>Today Deal</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            // Pickup Point table index
            $(function pickuppoint() {
                table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('product.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'thumbnail',
                            name: 'thumbnail'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        },
                        {
                            data: 'subcategory_name',
                            name: 'subcategory_name'
                        },
                        {
                            data: 'brand_name',
                            name: 'brand_name'
                        },
                        {
                            data: 'featured',
                            name: 'featured'
                        },
                        {
                            data: 'today_deal',
                            name: 'today_deal'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: true,
                            orderable: true
                        },
                    ]
                })
            })
        </script>

        {{-- Active & deactive Featured,Today_deal,Status --}}
        <script type="text/javascript">
            $(document).ready(function() {
                
                // Deactive Featured
                $('body').on('click', '.featured_deactive', function(data) {
                    let featured_id = $(this).data('id');
                    var url = "{{ url('product/deactive_featured') }}/" + featured_id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data) {
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });

                // Active Featured
                $('body').on('click', '.featured_active', function(data) {
                    let featured_id = $(this).data('id');
                    var url = "{{ url('product/active_featured') }}/" + featured_id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data) {
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });

                // Deactive Today deal
                $('body').on('click', '.deal_deactive', function(data) {
                    let deal_id = $(this).data('id');
                    var url = "{{ url('product/deactive_today_deal') }}/" + deal_id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data) {
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });

                // Active Today deal
                $('body').on('click', '.deal_active', function(data) {
                    let deal_id = $(this).data('id');
                    var url = "{{ url('product/active_today_deal') }}/" + deal_id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data) {
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });

                // Deactive Status
                $('body').on('click', '.status_deactive', function(data) {
                    let status_id = $(this).data('id');
                    var url = "{{ url('product/deactive_status') }}/" + status_id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data) {
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });

                // Active Featured
                $('body').on('click', '.status_active', function(data) {
                    let status_id = $(this).data('id');
                    var url = "{{ url('product/active_status') }}/" + status_id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data) {
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });


            });
        </script>
    @endsection
