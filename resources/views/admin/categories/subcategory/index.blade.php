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
                                data-target="#subcategoryModal">
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
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category Name</th>
                                                <th>Category Slug</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $subcat)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $subcat->category->category_name }}</td>
                                                    <td>{{ $subcat->subcategory_name }}</td>
                                                    <td>{{ $subcat->subcategory_slug }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-primary edit"
                                                            data-id="{{ $subcat->id }}" data-toggle="modal"
                                                            data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('subcategory.delete', $subcat->id) }}"
                                                            class="btn btn-danger" id="delete"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
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

        <!-- Category insert Modal -->
        <div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New SubCategory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_id">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="0" selected disabled>Select One</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="subcategory_name">SubCategory Name</label>
                                <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('body').on('click', '.edit', function(data) {
            let subcat_id = $(this).data('id');
            $.get("edit/" + subcat_id, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>
@endsection
