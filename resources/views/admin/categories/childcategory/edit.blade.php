<form action="{{route('childcategory.update')}}" method="POST">
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
                        <option value="{{ $subcat->id }}" @if ($subcat->id == $data->subcategory_id) selected @endif>---{{ $subcat->subcategory_name }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <input type="hidden" name="childcategory_id" value="{{$data->id}}">
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="subcategory_name">ChildCategory Name</label>
            <input type="text" class="form-control" id="childcategory_name" name="childcategory_name"
                value = "{{$data->childcategory_name}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>