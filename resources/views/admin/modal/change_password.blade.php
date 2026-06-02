<div class="modal fade" id="change_password{{$post->id}}">
    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
    <div class="modal-content">
    <div class="page-wrapper-new p-0">
    <div class="content">
    <div class="modal-header border-0 custom-modal-header">
    <div class="page-title">
    <h4>Change User Password</h4>
    </div>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body custom-modal-body">

   <form action="{{ route('change_password', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <div class="input-blocks search-form mb-10">
                <label>New Password</label>
                <input required type="password" class="form-control" name="password" placeholder="Enter New Password">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="input-blocks search-form mb-10">
                <label>Confirm Password</label>
                <input required type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password">
            </div>
        </div>
    </div>

    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Update Password</button>
    </div>
</form>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>


