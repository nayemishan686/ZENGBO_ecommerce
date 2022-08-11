<form action="{{ route('coupon.update') }}" method="POST" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                value="{{ $coupon->coupon_code }}" required>
            <input type="hidden" name="id" value="{{ $coupon->id }}">
        </div>


        <div class="form-group">
            <label for="coupon_type">Coupon Type </label>
            <select class="form-control" name="coupon_type" required>
                <option value="1" @if ($coupon->coupon_type == 1) selected @endif>Fixed</option>
                <option value="2" @if ($coupon->coupon_type == 2) selected @endif>Percentage</option>
            </select>
        </div>

        <div class="form-group">
            <label for="coupon_amount">Coupon Amount</label>
            <input type="text" class="form-control" id="coupon_amount" name="coupon_amount"
                value="{{ $coupon->coupon_amount }}" required>
        </div>

        <div class="form-group">
            <label for="coupon_date">Coupon Date</label>
            <input type="date" class="form-control" id="coupon_date" name="coupon_date"
                value="{{ $coupon->valid_date }}" required>
        </div>

        <div class="form-group">
            <label for="coupon_status">Coupon Status </label>
            <select class="form-control" name="coupon_status" required>
                <option value="active" @if ($coupon->status == 'active') selected @endif>Active</option>
                <option value="deactive" @if ($coupon->status == 'deactive') selected @endif>Deactive</option>
            </select>
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
