<!-- Dropify CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<form action="{{route('category.update')}}" method="POST"  enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="e_category_name" name="category_name"
                value="{{$data->category_name}}">
            <input type="hidden" name="id" id="e_category_id" value="{{$data->id}}">
        </div>
        <div class="form-group">
            <label for="icon">Category Icon</label>
            <input type="file" class="dropify" id="icon" name="icon">
            <input type="hidden" name="old_icon" value="{{$data->icon}}">
            <small id="emailHelp" class="form-text text-muted">Place an icon for your categories</small>
        </div>
        <div class="form-group">
            <label for="home_page">Show On HomePage</label>
            <select name="home_page" id="home_page" class="form-control">
                <option value="1" @if($data->home_page == 1) selected  @endif>Yes</option>
                <option value="0" @if($data->home_page == 0) selected  @endif>No</option>
            </select>
            <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home
                page</small>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
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