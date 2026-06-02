
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
	
<style>


.image-frame2 {
    width: 200px;
    height: 200px;
    padding: 20px;
    border:2px dotted #dde0de;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
    position: relative;
    cursor: pointer;
}

.image-frame2 img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.image-frame2 input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}


    </style>
</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!--========= Header =========-->
		@include('admin.include.header')
		<!--=========== /Header =======-->
	

		<!--====== Sidebar ===========-->
		@include('admin.include.sidebar')
		<!--========= /Sidebar =========-->

	     <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

<div id="product-page">
<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
							 <h4>Manage User</h4>
        <h6>Manage All User</h6>
							 
							</div>
						</div>
 </div>	 

  @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
					               

<div class="row">

<div class="card">
<div class="card-body">
<a data-bs-toggle="modal" data-bs-target="#add-units" class="btn btn-primary mb-3">Add New User</a>
 <div class="table-responsive">
            <table class="table  datanew">

            <thead>
            <tr>
            <th class="no-sort">S/N</th>
            <th>Full Name</th>
              <th>Username</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Status</th>
    
            <th class="no-sort">Action</th>
            </tr>
            </thead>



            <tbody>
                <?php $no = 1; ?>
                @foreach ($userlist as $post)
            <tr>
                <td>{{ $no }}</td>
                <td>{{$post->first_name }} {{$post->last_name }} </td>
                 <td>{{$post->username }} </td>
            <td>{{$post->email }} </td>
            <td>{{$post->phone }}</td>
           

         <td>
    @if ($post->status == 1)
        <span class="badge badge-success">Active</span>
    @elseif ($post->status == 0)
        <span class="badge badge-danger">Inactive</span>
    @endif
</td>


         
           
            <td class="action-table-data">
            <div class="edit-delete-action">
                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#change_password{{$post->id}}">
                    <i data-bs-toggle="tooltip"  title="Change Password" data-feather="key" class="feather-key"></i>
                    </a>

                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#viewuser{{$post->id}}">
                    <i data-bs-toggle="tooltip"  title="View Staff Details" data-feather="eye" class="feather-eye"></i>
                    </a>

            <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#updateuser{{$post->id}}">
            <i data-bs-toggle="tooltip"  title="Update Staff Details" data-feather="edit" class="feather-edit"></i>
            </a>
            <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#delete_user{{$post->id}}">
            <i data-bs-toggle="tooltip"  title="Delete Staff Details" data-feather="trash-2" class="feather-trash-2"></i>
            </a>
            </div>
            </td>
          
            @include('admin.modal.change_password')
            @include('admin.modal.viewuser')
            @include('admin.modal.update_staff')
            @include('admin.modal.delete_user')

            </tr>

            
    <?php $no++; ?>
    @endforeach
            </tbody>
            </table>
            </div>

</div>


</div></div> <!----end of card-body--->
</div><!--====== end of roe =========--->




<!------------------- create  store  modal-------------------->
            <div class="modal fade" id="add-units">
                <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
                <div class="modal-content">
                <div class="page-wrapper-new p-0">
                <div class="content">
                <div class="modal-header border-0 custom-modal-header">
                <div class="page-title">
                <h4>Add New User Login</h4>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body custom-modal-body">

                    <form action="{{route('createstaff')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="input-blocks search-form mb-10">
                        <label>First Name</label>
                        <input required type="text" class="form-control" placeholder="Enter First Name" name="first_name">
         
                        </div>
                        </div>

                          <div class="col-lg-6">
                        <div class="input-blocks search-form mb-10">
                        <label>Last Name</label>
                        <input required type="text" class="form-control" placeholder="Enter Last Name" name="last_name">
         
                        </div>
                        </div>

                           <div class="col-lg-12">
                                <div class="input-blocks search-form mb-10">
                                <label> Username</label>
                                <input required type="text" class="form-control" placeholder="Enter Username" name="username">
                               
                                </div>
                                </div>
                               

                        <div class="col-lg-6">
                            <div class="input-blocks search-form mb-10">
                            <label> Email</label>
                            <input required type="email" class="form-control" placeholder="example@gmail.com" name="email">
                          
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-blocks search-form mb-10">
                                <label> Phone No.</label>
                                <input required type="text" class="form-control" placeholder="234-8123456789" name="phone">
    
                                </div>
                                </div> 

 

                         
 

                                     
 
             <div class="col-lg-12">
    <div class="input-blocks">
        <label>Status</label>
        <select class="select" name="status" required>
            <option value="">Choose</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>
</div>

           
                <div class="col-lg-12">
                    <div class="input-blocks search-form mb-10">
                    <label> Password</label>
                    <input required type="password" class="form-control"   name="password">
                   
                    </div>
                    </div>

                         <div class="col-lg-12">
                    <div class="input-blocks search-form mb-10">
                    <label> Confirm Password</label>
                    <input required type="password" class="form-control"   name="password_confirmation">
                   
                    </div>
                    </div>
            

                </div>
                <div class="modal-footer-btn">
                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-submit">Create</button>
                </div>
                </form>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>




	</div></div></div>
    <!--=======end of content and page-wrapper========-->

     
	@include('admin.include.footer')
 

</body>
</html>