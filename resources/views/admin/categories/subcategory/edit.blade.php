<form action="{{route('subcategory.update')}}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_id">Category Name</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="0" selected disabled>Select One</option>
                @foreach ($category as $cat)
                    <option value="{{$cat->id}}" @if($cat->id == $data->category_id) selected   @endif>{{$cat->category_name}}</option>
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{$data->id}}">
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="subcategory_name">SubCategory Name</label>
            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                placeholder="SubCategory Name" value="{{$data->subcategory_name}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>