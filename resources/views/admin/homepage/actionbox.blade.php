
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
								<h4 class="fw-bold">Action box</h4>
								<h6>Update  Action box Section</h6>
							</div>
						</div>
			 
					</div>               

                    
	<form action="{{ route('actionbox.update', $section->id) }}" method="POST">
    @csrf
    @method('PUT')

	<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">

       <div class="row">
     
    <div class="col-md-4">
    <div class="mb-3">
      <label class="form-label">Icon Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="iconbox_icon_color" value="{{ $section->iconbox_icon_color }}">
  </div></div><!--==== end of col ======---->


      <div class="col-md-4">
    <div class="mb-3">
      <label class="form-label">Heading  Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="iconbox_heading_color" value="{{ $section->iconbox_heading_color }}">
  </div></div><!--==== end of col ======---->


    <div class="col-md-4">
    <div class="mb-3">
      <label class="form-label">Text (P) Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="iconbox_text_color" value="{{ $section->iconbox_text_color }}">
  </div></div><!--==== end of col ======---->



<div class="col-md-4">
<div class="mb-3">
<label class="form-label">Icon Size</label>
<input type="number" class="form-control" name="iconbox_icon_size" value="{{ $section->iconbox_icon_size }}">
</div></div>

<div class="col-md-4">
<div class="mb-3">
<label class="form-label">Heading Text Size</label>
<input type="number" class="form-control" name="iconbox_heading_size" value="{{ $section->iconbox_heading_size }}">
</div></div>


<div class="col-md-4">
<div class="mb-3">
<label class="form-label">Text Size</label>
<input type="number" class="form-control" name="iconbox_text_size" value="{{ $section->iconbox_text_size }}">
</div></div>

       </div>
</div></div></div>

					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
 
<div class="row">
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label"> Icon 1 - <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com version 7 </a> </label>
    
    <input type="text" class="form-control" name="boxicon1" value="{{ $section->boxicon1 }}"   >
  </div>
 </div><!--=== Col Ends ======-->


  <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Heading 1 (h3)</label>
    <input type="text" class="form-control" name="boxheading1" value="{{ $section->boxheading1 }}" placeholder="Enter Heading" >
  </div>
 </div><!--=== Col Ends ======-->
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Box Text 1 </label>
    <textarea class="form-control" name="boxtext1">{{ $section->boxtext1 }}</textarea>
   </div>
 </div><!--=== Col Ends ======-->
</div><!--=== Row Ends ======-->

 </div></div></div>




 <!--========================= action box2 =====================--->


						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
 
<div class="row">
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label"> Icon 2 - <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com version 7 </a> </label>
    
    <input type="text" class="form-control" name="boxicon2" value="{{ $section->boxicon2 }}"   >
  </div>
 </div><!--=== Col Ends ======-->


  <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Heading 2 (h3)</label>
    <input type="text" class="form-control" name="boxheading2" value="{{ $section->boxheading2 }}" placeholder="Enter Heading" >
  </div>
 </div><!--=== Col Ends ======-->
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Box Text 2 </label>
    <textarea class="form-control" name="boxtext2">{{ $section->boxtext2 }}</textarea>
   </div>
 </div><!--=== Col Ends ======-->

 
</div><!--=== Row Ends ======-->

 </div></div></div>






<!--========================= action box3 =====================--->


						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
 
<div class="row">
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label"> Icon 3 - <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com version 7 </a> </label>
    
    <input type="text" class="form-control" name="boxicon3" value="{{ $section->boxicon3 }}"   >
  </div>
 </div><!--=== Col Ends ======-->


  <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Heading 3 (h3)</label>
    <input type="text" class="form-control" name="boxheading3" value="{{ $section->boxheading3 }}" placeholder="Enter Heading" >
  </div>
 </div><!--=== Col Ends ======-->
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Box Text 3 </label>
    <textarea class="form-control" name="boxtext3">{{ $section->boxtext3 }}</textarea>
   </div>
 </div><!--=== Col Ends ======-->

 
</div><!--=== Row Ends ======-->

 </div></div></div>





 <!--========================= action box4 =====================--->


						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
 
<div class="row">
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label"> Icon 4 - <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com version 7 </a> </label>
    
    <input type="text" class="form-control" name="boxicon4" value="{{ $section->boxicon4 }}"   >
  </div>
 </div><!--=== Col Ends ======-->


  <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Heading 4 (h3)</label>
    <input type="text" class="form-control" name="boxheading4" value="{{ $section->boxheading4 }}" placeholder="Enter Heading" >
  </div>
 </div><!--=== Col Ends ======-->
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">Box Text 4 </label>
    <textarea class="form-control" name="boxtext4">{{ $section->boxtext4 }}</textarea>
   </div>
 </div><!--=== Col Ends ======-->

 


</div><!--=== Row Ends ======-->

 </div></div></div>

 <div class="col-md-2">
            <div class="mb-3 form-check">
                <input type="checkbox" name="actionboxstatus" value="1" class="form-check-input" {{ $section->actionboxstatus ? 'checked' : '' }}>
                <label class="form-check-label">Visibility</label>
            </div>
        </div>

 <div class="col-md-4">

  <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update</button>
 </div>



 
</form>
							
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