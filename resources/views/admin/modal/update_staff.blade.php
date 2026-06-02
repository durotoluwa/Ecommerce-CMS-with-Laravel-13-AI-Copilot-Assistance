<div class="modal fade" id="updateuser{{$post->id}}">
    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
    <div class="modal-content">
    <div class="page-wrapper-new p-0">
    <div class="content">
    <div class="modal-header border-0 custom-modal-header">
    <div class="page-title">
    <h4>Update User Details</h4>
    </div>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body custom-modal-body">

  <form action="{{ route('admin.users.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="col-lg-6">
            <div class="input-blocks search-form mb-10">
            <label>First Name</label>
            <input value="{{$post->first_name }}" required type="text" class="form-control" placeholder="Enter First Name" name="first_name">

            </div>
            </div>


                <div class="col-lg-6">
            <div class="input-blocks search-form mb-10">
            <label>Last Name</label>
            <input value="{{$post->last_name }}" required type="text" class="form-control" placeholder="Enter Last Name" name="last_name">

            </div>
            </div>

               <div class="col-lg-6">
            <div class="input-blocks search-form mb-10">
            <label>Username</label>
            <input value="{{$post->username }}" required type="text" class="form-control" placeholder="Enter username" name="username">

            </div>
            </div>

            <div class="col-lg-6">
                <div class="input-blocks search-form mb-10">
                <label> Email</label>
                <input  value="{{$post->email }}" required type="email" class="form-control" placeholder="example@gmail.com" name="email">
              
                </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-blocks search-form mb-10">
                    <label> Phone No.</label>
                    <input value="{{$post->phone }}" required type="text" class="form-control" placeholder="234-8123456789" name="phone">

                    </div>
                    </div> 

 
    <div class="col-lg-12">
    <div class="input-blocks">
    <label>Status</label>
<select class="select" name="status" required>
    <option value="">Choose</option>
    <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
    <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
</select>

    </div>
    </div>
 

    </div>
    <div class="modal-footer-btn">
    <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-submit">Update</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>


