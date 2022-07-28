@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SubCategory Table</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#childcategoryModal">
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
                                    <h3 class="card-title">All SubCategories</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped table-sm ytable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Child Category Name</th>
                                                <th>Child Category Slug</th>
                                                <th>Category Name</th>
                                                <th>Sub Category name</th>
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
        <div class="modal fade" id="childcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New ChildCategory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('childcategory.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_id">Category/SubCategory Name</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="0" selected disabled>Select One</option>
                                    @foreach ($category as $cat)
                                        @php
                                            $subcategory = DB::table('sub_categories')
                                                ->where('category_id', $cat->id)
                                                ->get();
                                        @endphp
                                        <option disabled style="color: rgb(255, 0, 0)">{{ $cat->category_name }}</option>
                                        @foreach ($subcategory as $subcat)
                                            <option value="{{ $subcat->id }}">---{{ $subcat->subcategory_name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="subcategory_name">ChildCategory Name</label>
                                <input type="text" class="form-control" id="childcategory_name" name="childcategory_name"
                                    placeholder="SubCategory Name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
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
            $(function childcategory() {
                var table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('childcategory.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'childcategory_name',
                            name: 'childcategory_name'
                        },
                        {
                            data: 'childcategory_slug',
                            name: 'childcategory_slug'
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
                            data: 'action',
                            name: 'action',
                            searchable: true,
                            orderable: true
                        },
                    ]
                });
            });


            $('body').on('click','.edit',function(data){
                let childcat_id = $(this).data('id');
                $.get("edit/"+childcat_id, function(data){
                    $("#modal_body").html(data);
                });
            });
        </script>
    @endsection
