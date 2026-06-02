
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
								<h4 class="fw-bold">Website Logo</h4>
								<h6>Manage your Website Logos</h6>
							</div>
						</div>
 
					</div>               

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

			

<form action="{{ route('updateWebsiteLogo',$logoconfig->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
      
        
           

<div class="col-xl-3">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Main Website Logo</label>
    
            <div class="image-frame2" id="imagePreview" style="margin-bottom: 30px;">
                @if ($logoconfig->main_logo)
                <img src="{{ asset($logoconfig->main_logo) }}" id="previewImage">
            @else
                <span id="placeholderText">No image selected</span>
            @endif
            </div>
        
            <input class="form-control mb-3" name="main_logo" type="file" id="imageInput" accept="image/*">

            <label> Logo Size (Width in px)</label>
 <input name="main_logosize" type="text" value="{{ $logoconfig->main_logosize }}" class="form-control ">
        </div>
    
      
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->





<div class="col-xl-3">
    <div class="card h-auto">
    <div class="card-body">
       
        
    
            <div class="mb-3">
                <label class="form-label">Website White Logo</label>
        
                <div class="image-frame2" id="imagePreview2" style="margin-bottom: 30px;">
                    @if ($logoconfig->white_logo)
                    <img src="{{ asset($logoconfig->white_logo) }}" id="previewImag2">
                @else
                    <span id="placeholderText">No image selected</span>
                @endif
                </div>
            
                <input class="form-control mb-3" name="white_logo" type="file" id="imageInput2" accept="image/*">
                    <label> Logo Size (Width in px)</label>
                  <input placeholder="Enter Logo Size (Width in px)" type="text" class="form-control" name="white_logosize" value="{{ $logoconfig->white_logosize }}">
            </div>
 
        
            
    </div><!--=== Card Body Ends ====-->
    </div><!--==== Card Ends =======-->
    </div><!--===== Col Ends =====-->




    <div class="col-xl-3">
        <div class="card h-auto">
        <div class="card-body">
           
            
                
            
                <div class="mb-3">
                    <label class="form-label">Footer Logo</label>
            
                    <div class="image-frame2" id="imagePreview3" style="margin-bottom: 30px;">
                        @if ($logoconfig->footer_logo)
                        <img src="{{ asset($logoconfig->footer_logo) }}" id="previewImage3">
                    @else
                        <span id="placeholderText">No image selected</span>
                    @endif
                    </div>
                
                    <input class="form-control" name="footer_logo" type="file" id="imageInput3" accept="image/*">
                </div>
            
               
        
        </div><!--=== Card Body Ends ====-->
        </div><!--==== Card Ends =======-->
        </div><!--===== Col Ends =====-->



        <div class="col-xl-3">
            <div class="card h-auto">
            <div class="card-body">
               
          
                
                    <div class="mb-3">
                        <label class="form-label">Favicon</label>
                
                        <div class="image-frame2" id="imagePreview4" style="margin-bottom: 30px;">
                            @if ($logoconfig->favicon)
                            <img src="{{ asset($logoconfig->favicon) }}" id="previewImage4">
                        @else
                            <span id="placeholderText">No image selected</span>
                        @endif
                        </div>
                    
                        <input class="form-control" name="favicon" type="file" id="imageInput4" accept="image/*">
                    </div>
                
                   
                
            </div><!--=== Card Body Ends ====-->
            </div><!--==== Card Ends =======-->
            </div><!--===== Col Ends =====-->
            <div class="col-xl-5">
        <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update</button>
            </div>


</div><!--===== Row Ends =====-->
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