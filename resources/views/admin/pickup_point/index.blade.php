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
                                                <th>Pickup Point Name</th>
                                                <th>Pickup Point Address</th>
                                                <th>Pickup Point Phone</th>
                                                <th>Pickup Point 2nd Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <form action="" method="delete" id="deleted_form">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Child Category Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Pickup Point</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pickuppoint.store') }}" method="POST" id="add_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="pickUpPointName">Pickup Point Name</label>
                                <input type="text" class="form-control" id="pickUpPointName" name="pickUpPointName"
                                    placeholder="Enter Pickup Point Name" required>
                            </div>

                            <div class="form-group">
                                <label for="pickUpPointAddress">Pickup Point Address</label>
                                <input type="text" class="form-control" id="pickUpPointAddress" name="pickUpPointAddress"
                                    placeholder="Enter Pickup Point Address" required>
                            </div>

                            <div class="form-group">
                                <label for="pickUpPointPhone">Pickup Point Phone</label>
                                <input type="text" class="form-control" id="pickUpPointPhone" name="pickUpPointPhone"
                                    placeholder="Enter Pickup Point Phone" required>
                            </div>

                            <div class="form-group">
                                <label for="pickUpPointPhoneTwo">Pickup Point Phone Two</label>
                                <input type="text" class="form-control" id="pickUpPointPhoneTwo"
                                    name="pickUpPointPhoneTwo" placeholder="Enter Pickup Point Phone Two" required>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modal_body">

                    </div>
                </div>
            </div>
        </div>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            // Pickup Point table index
            $(function pickuppoint() {
                table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pickuppoint.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'pickUpPointName',
                            name: 'pickUpPointName'
                        },
                        {
                            data: 'pickUpPointAddress',
                            name: 'pickUpPointAddress'
                        },
                        {
                            data: 'pickUpPointPhone',
                            name: 'pickUpPointPhone'
                        },
                        {
                            data: 'pickUpPointPhoneTwo',
                            name: 'pickUpPointPhoneTwo'
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

            //Coupon add with ajax
            $('#add_form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $('.loader').removeClass('d-none');
                $('.submit_btn').addClass('d-none');
                $.ajax({
                    url: url,
                    type: 'post',
                    data: request,
                    success: function(data) {
                        toastr.success(data);
                        $("#addModal").modal('hide');
                        $('#add_form')[0].reset();
                        $('.loader').addClass('d-none');
                        $('.submit_btn').removeClass('d-none');
                        table.ajax.reload();
                    }
                });
            });

            // Edit Coupon
            $('body').on('click', '.edit', function(data) {
                let pickup_id = $(this).data('id');
                $.get("pickuppoint/edit/" + pickup_id, function(data) {
                    $("#modal_body").html(data);
                });
            });

        </script>

        {{-- Delete with ajax --}}
        <script type="text/javascript">
            $(document).ready(function() {
                // swal open
                $(document).on("click", "#delete", function(e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $("#deleted_form").attr('action', url);
                    swal({
                        title: "Are you Want to delete?",
                        text: "Once Delete, This will be Permanently Delete!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if(willDelete){
                            $("#deleted_form").submit();
                        }else{
                            swal("Safe Data");
                        }
                    })
                })

                

                // Data passed through here
                $('#deleted_form').submit(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var request = $(this).serialize();
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: request,
                        success: function(data) {
                            toastr.success(data);
                            $('#deleted_form')[0].reset();
                            table.ajax.reload();
                        }
                    });
                });
            });
        </script>
    @endsection
