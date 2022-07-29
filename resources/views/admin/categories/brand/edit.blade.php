<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{$data->brand_name}}">
        </div>
        <input type="hidden" name="brand_id" value="{{$data->id}}">
        <div class="form-group">
            <label for="brand_logo">Brand Logo</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="brand_logo"
            >
            <img src="{{asset($data->brand_logo)}}" alt="" width="240" height="120">
            <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
            <small id="emailHelp" class="form-text text-muted">This is your Brand Logo </small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
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
