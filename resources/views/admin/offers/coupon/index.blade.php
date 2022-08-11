@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Warehouse Table</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#warehouseModal">
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
                                    <h3 class="card-title">All Warehouse</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped table-sm ytable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Coupon Code</th>
                                                <th>Coupon Amount</th>
                                                <th>Coupon Date</th>
                                                <th>Coupon Status</th>
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

        <!-- Child Category Add Modal -->
        <div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New ChildCategory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('warehouse.store') }}" method="POST" id="add_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="warehouse_name">Coupon Code</label>
                                <input type="text" class="form-control" id="warehouse_name" name="warehouse_name"
                                    placeholder="Enter Warehouse Name" required>
                            </div>

                            <div class="form-group">
                                <label for="warehouse_address">Coupon Amount</label>
                                <textarea class="form-control" name="warehouse_address" cols="30" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="warehouse_phone">Coupon Date</label>
                                <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone"
                                    placeholder="Enter Warehouse Phone" required>
                            </div>

                            <div class="form-group">
                                <label for="warehouse_phone">Coupon Status</label>
                                <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone"
                                    placeholder="Enter Warehouse Phone" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i
                                        class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Submit
                                </span> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- SubCategory Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modal_body">

                    </div>
                </div>
            </div>
        </div>




        <!-- Category Index AJAX -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(function coupon() {
                var table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('coupon.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'coupon_code',
                            name: 'coupon_code'
                        },
                        {
                            data: 'coupon_amount',
                            name: 'coupon_amount'
                        },
                        {
                            data: 'valid_date',
                            name: 'valid_date'
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

            $('body').on('click', '.edit', function(data) {
                let warehouse_id = $(this).data('id');
                $.get("warehouse/edit/" + warehouse_id, function(data) {
                    $("#modal_body").html(data);
                });
            });

            $('#add_form').on('submit', function() {
                $('.loader').removeClass('d-none')
                $('.submit_btn').addClass('d-none')
            })
        </script>
    @endsection
