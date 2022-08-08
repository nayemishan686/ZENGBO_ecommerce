<form action="{{route('warehouse.update')}}" method="POST" id="add_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="warehouse_name">Warehouse Name</label>
            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name"
                value="{{$warehouse->warehouse_name}}">
        </div>
        <input type="hidden" name="id" value="{{ $warehouse->id }}">

        <div class="form-group">
            <label for="warehouse_address">Warehouse Address</label>
            <textarea class="form-control" name="warehouse_address" cols="30" rows="5" required>{{$warehouse->warehouse_address}}</textarea>
        </div>

        <div class="form-group">
            <label for="warehouse_phone">Warehouse Phone</label>
            <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone"
                value="{{$warehouse->warehouse_phone}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Submit </span> </button>
    </div>
</form>