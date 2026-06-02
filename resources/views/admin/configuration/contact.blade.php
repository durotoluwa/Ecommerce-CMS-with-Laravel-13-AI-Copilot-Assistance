
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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Contact Information</h4>
								<h6>Manage your contact details</h6>
							</div>
						</div>
					 
			 
 
					</div>               

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

	 <form action="{{ route('updateContact') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

  <input type="hidden" name="id" value="{{ $contactconfig->id }}">
<div class="row">
 <div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Company Name</label>
    <input type="text" class="form-control" name="companyName" value="{{ $contactconfig->companyName }}" placeholder="Enter Company Name" >
  </div>
 </div><!--=== Col Ends ======-->


  <div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Tagline</label>
    <input type="text" class="form-control" name="tagline" value="{{ $contactconfig->tagline }}" placeholder="Enter Tagline" >
  </div>
 </div><!--=== Col Ends ======-->
 <div class="col-md-4">
  <div class="mb-3">
    <label class="form-label">Phone 1</label>
    <input type="text" class="form-control" name="phone1" value="{{ $contactconfig->phone1 }}" placeholder="Enter Phone 1" >
  </div>
 </div><!--=== Col Ends ======-->

 <div class="col-md-4">
    <div class="mb-3">
      <label class="form-label">Phone 2</label>
      <input type="text" class="form-control" name="phone2" value="{{ $contactconfig->phone2 }}" placeholder="Enter Phone 2" >
    </div>
   </div><!--=== Col Ends ======-->


   <div class="col-md-4">
    <div class="mb-3">
      <label class="form-label">Phone 3</label>
      <input type="text" class="form-control" name="phone3" value="{{ $contactconfig->phone3 }}" placeholder="Enter Phone 3" >
    </div>
   </div><!--=== Col Ends ======-->

</div><!--=== Row Ends ======-->

<div class="row">
    <div class="col-md-4">
     <div class="mb-3">
       <label class="form-label">Email 1</label>
       <input type="text" class="form-control" name="email1" value="{{ $contactconfig->email1 }}" placeholder="Enter Email 1" >
     </div>
    </div><!--=== Col Ends ======-->
   
    <div class="col-md-4">
       <div class="mb-3">
         <label class="form-label">Email 2</label>
         <input type="text" class="form-control" name="email2" value="{{ $contactconfig->email2 }}" placeholder="Enter Email 2" >
       </div>
      </div><!--=== Col Ends ======-->
   
   
      <div class="col-md-4">
       <div class="mb-3">
         <label class="form-label">Email 3</label>
         <input type="text" class="form-control" name="email3" value="{{ $contactconfig->email3 }}" placeholder="Enter Email 3" >
       </div>
      </div><!--=== Col Ends ======-->
   
   </div><!--=== Row Ends ======-->




   <div class="row">
    <div class="col-md-6">
     <div class="mb-3">
       <label class="form-label">Address</label>
      
    <textarea class="form-control" name="address" rows="3" placeholder="Enter Address" >{{ $contactconfig->address }}</textarea>
     
    </div>
    </div><!--=== Col Ends ======-->
   
    <div class="col-md-6">
       <div class="mb-3">
         <label class="form-label">Google Embed Map Link</label>
         
       <textarea class="form-control" name="google_map" rows="3" placeholder="Enter Google Map Link" >{{ $contactconfig->google_map }}</textarea>
        </div>
      </div><!--=== Col Ends ======-->
   
   
       
   
   </div><!--=== Row Ends ======-->




   <div class="row">
    <div class="col-md-6">
     <div class="mb-3">
       <label class="form-label">Facebook Link</label>
       <input type="text" class="form-control" name="facebook_link" value="{{ $contactconfig->facebook_link }}" placeholder="Enter Facebook Link" >
     </div>
    </div><!--=== Col Ends ======-->
   
    <div class="col-md-6">
       <div class="mb-3">
         <label class="form-label">X Link</label>
         <input type="text" class="form-control" name="x_link" value="{{ $contactconfig->x_link }}" placeholder="Enter X Link" >
       </div>
      </div><!--=== Col Ends ======-->
   
   
      <div class="col-md-6">
       <div class="mb-3">
         <label class="form-label">Instagram Link</label>
         <input type="text" class="form-control" name="instagram_link" value="{{ $contactconfig->instagram_link }}" placeholder="Enter Instagram Link" >
       </div>
      </div><!--=== Col Ends ======-->


      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label">Linkedin Link</label>
          <input type="text" class="form-control" name="linkedin_link" value="{{ $contactconfig->linkedin_link }}" placeholder="Enter Linkedin Link" >
        </div>
       </div><!--=== Col Ends ======-->
 <div class="col-md-12">
        <div class="mb-3">
          <label class="form-label">Youtube Link</label>
          <input type="text" class="form-control" name="youtube_link" value="{{ $contactconfig->youtube_link }}" placeholder="Enter Youtube Link" >
        </div>
       </div><!--=== Col Ends ======-->


       
   
   </div><!--=== Row Ends ======-->

  <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update</button>
</form>
								</div>
							</div>
						</div>
					</div>






	</div></div>
    <!--=======end of content and page-wrapper========-->

    


    <!-- Add Permission -->
		<div class="modal fade" id="add-user">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header">
								<div class="page-title">
									<h4>Add Permission</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							 <form method="POST" action="{{ route('permissions.store') }}">
        @csrf
        <div class="modal-body">
<div class="row">
<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Permission Name<span class="text-danger ms-1">*</span></label>
												<input type="text" class="form-control" name="name" required>
											</div>
										</div>

</div></div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary rounded-pill rounded-pill">Save Permission</button>
                    </div>
                     </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Permission -->


         
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image">`;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '<span>No image selected</span>';
        }
    });
</script>

<script>
    const imageInput2 = document.getElementById('imageInput2');
    const imagePreview2 = document.getElementById('imagePreview2');

    imageInput2.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview2.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image">`;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview2.innerHTML = '<span>No image selected</span>';
        }
    });
</script>



<script>
    const imageInput3 = document.getElementById('imageInput3');
    const imagePreview3 = document.getElementById('imagePreview3');

    imageInput3.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview3.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image">`;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview3.innerHTML = '<span>No image selected</span>';
        }
    });
</script>




<script>
    const imageInput4 = document.getElementById('imageInput4');
    const imagePreview4 = document.getElementById('imagePreview4');

    imageInput4.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview4.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image">`;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview4.innerHTML = '<span>No image selected</span>';
        }
    });
</script>
 
	@include('admin.include.footer')
</html>