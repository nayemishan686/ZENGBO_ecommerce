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

        <!-- Category Index AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(function childcategory(){
            var table = $('.ytable').DataTable({
                processing : true,
                serverSide : true,
                ajax : "{{route('childcategory.index')}}",
                columns : [
                    {data:'DT_RowIndex' ,name: 'DT_RowIndex'},
                    {data:'childcategory_name' ,name: 'childcategory_name'},
                    {data:'childcategory_slug' ,name: 'childcategory_slug'},
                    {data:'category_name' ,name: 'category_name'},
                    {data:'subcategory_name' ,name: 'subcategory_name'},
                    {data:'action' ,name: 'action', searchable: true, orderable: true},
                ]
            });
        });
    //     $(function childcategory(){
	// 	var table=$('.ytable').DataTable({
	// 		processing:true,
	// 		serverSide:true,
	// 		ajax:"{{ route('childcategory.index') }}",
	// 		columns:[
	// 			{data:'DT_RowIndex',name:'DT_RowIndex'},
	// 			{data:'childcategory_name'  ,name:'childcategory_name'},
	// 			{data:'category_name',name:'category_name'},
	// 			{data:'subcategory_name',name:'subcategory_name'},
	// 			{data:'action',name:'action',orderable:true, searchable:true},
	// 		]
	// 	});
	// });
    </script>
@endsection
