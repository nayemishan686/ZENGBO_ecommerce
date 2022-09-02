<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<form action="{{ route('campaign.update') }}" method="POST" enctype="multipart/form-data" id="add_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="title-name">Campaign Title <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="title" required value="{{$data->title}}">
        </div>
        <input type="hidden" name="brand_id" value="{{$data->id}}">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="start_date">Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="start_date" required value="{{$data->start_date}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="end_date">End Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="end_date" required value="{{$data->end_date}}">>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="status">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                        <option value="1" @if($data->status == 1) selected @endif>Active</option>
                        <option value="0" @if($data->status == 0) selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="discount">Discount (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="discount" required
                        value="{{$data->discount}}">

                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="brand-name">Brand Logo <span class="text-danger">*</span></label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="image">
            <input type="hidden" name="old_image" value="{{$data->image}}">
            <small id="emailHelp" class="form-text text-muted">This is your campaign banner </small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i>
                Loading..</span> <span class="submit_btn"> Submit
            </span> </button>
    </div>
</form>
<!-- Dropify JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>
