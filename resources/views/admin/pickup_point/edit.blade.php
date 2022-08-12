<form action="{{ route('pickuppoint.update') }}" method="POST" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="pickUpPointName">Pickup Point Name</label>
            <input type="text" class="form-control" id="pickUpPointName" name="pickUpPointName"
                value="{{ $pickup->pickUpPointName }}" required>
                <input type="hidden" name="id" id="" value="{{$pickup->id}}">
        </div>

        <div class="form-group">
            <label for="pickUpPointAddress">Pickup Point Address</label>
            <input type="text" class="form-control" id="pickUpPointAddress" name="pickUpPointAddress"
                value="{{ $pickup->pickUpPointAddress }}" required>
        </div>

        <div class="form-group">
            <label for="pickUpPointPhone">Pickup Point Phone</label>
            <input type="text" class="form-control" id="pickUpPointPhone" name="pickUpPointPhone"
            value="{{ $pickup->pickUpPointPhone }}" required>
        </div>

        <div class="form-group">
            <label for="pickUpPointPhoneTwo">Pickup Point Phone Two</label>
            <input type="text" class="form-control" id="pickUpPointPhoneTwo" name="pickUpPointPhoneTwo"
            value="{{ $pickup->pickUpPointPhoneTwo }}" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i>
                Loading..</span> <span class="submit_btn"> Submit
            </span> </button>
    </div>
</form>

<script type="text/javascript">
    $('#edit_form').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            data: request,
            success: function(data) {
                toastr.success(data);
                $("#editModal").modal('hide');
                $('#edit_form')[0].reset();
                table.ajax.reload();
            }
        });
    });
</script>
