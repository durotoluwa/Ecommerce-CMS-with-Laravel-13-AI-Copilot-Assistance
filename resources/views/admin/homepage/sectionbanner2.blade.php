
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
								<h4 class="fw-bold">Card Box Section </h4>
								<h6>Manage Box Section</h6>
							</div>
						</div>
 </div>            

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

			

<form action="{{ route('cardbox.update', $section->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
<div class="col-xl-6">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Card Box Image 1</label>
    
            <div class="image-frame2" id="imagePreview" style="margin-bottom: 30px;">
                @if ($section->cardbox1image)
                <img src="{{ asset($section->cardbox1image) }}" id="previewImage">
            @else
                <span id="placeholderText">No image selected</span>
            @endif
            </div>
        
            <input class="form-control mb-3" name="cardbox1image" type="file" id="imageInput" accept="image/*">
   <div class="mb-3"> 
            <label> Card Box Heading 1</label>
 <input name="carbox1heading1" type="text" value="{{ $section->carbox1heading1 }}" class="form-control ">
    </div>
 <div class="mb-3">
         <label> Card Box Heading 2</label>
 <input name="carbox1heading2" type="text" value="{{ $section->carbox1heading2 }}" class="form-control ">
        </div> 

         <div class="mb-3">
         <label> Card Box Link Title</label>
 <input name="carbox1linktitle" type="text" value="{{ $section->carbox1linktitle }}" class="form-control ">
        </div> 

             <div class="mb-3">
         <label> Card Box Link </label>
 <input name="carbox1link" type="text" value="{{ $section->carbox1link }}" class="form-control ">
        </div> 
    
    
    </div>
    
      
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->


 



<div class="col-xl-6">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Card Box Image 2</label>
    
            <div class="image-frame2" id="imagePreview2" style="margin-bottom: 30px;">
                @if ($section->cardbox2image)
                <img src="{{ asset($section->cardbox2image) }}" id="previewImage2">
            @else
                <span id="placeholderText">No image selected</span>
            @endif
            </div>
        
            <input class="form-control mb-3" name="cardbox2image" type="file" id="imageInput2" accept="image/*">
   <div class="mb-3"> 
            <label> Card Box Heading 1</label>
 <input name="carbox2heading1" type="text" value="{{ $section->carbox2heading1 }}" class="form-control ">
    </div>
 <div class="mb-3">
         <label> Card Box Heading 2</label>
 <input name="carbox2heading2" type="text" value="{{ $section->carbox2heading2 }}" class="form-control ">
        </div> 

         <div class="mb-3">
         <label> Card Box Link Title</label>
 <input name="carbox2linktitle" type="text" value="{{ $section->carbox2linktitle }}" class="form-control ">
        </div> 

             <div class="mb-3">
         <label> Card Box Link </label>
 <input name="carbox2link" type="text" value="{{ $section->carbox2link }}" class="form-control ">
        </div> 
    
    
    </div>
    
      
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->



<div class="col-xl-6">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Card Box Image 3</label>
    
            <div class="image-frame2" id="imagePreview3" style="margin-bottom: 30px;">
                @if ($section->cardbox3image)
                <img src="{{ asset($section->cardbox3image) }}" id="previewImage3">
            @else
                <span id="placeholderText">No image selected</span>
            @endif
            </div>
        
            <input class="form-control mb-3" name="cardbox3image" type="file" id="imageInput3" accept="image/*">
   <div class="mb-3"> 
            <label> Card Box Heading 1</label>
 <input name="carbox3heading1" type="text" value="{{ $section->carbox3heading1 }}" class="form-control ">
    </div>
 <div class="mb-3">
         <label> Card Box Heading 2</label>
 <input name="carbox3heading2" type="text" value="{{ $section->carbox3heading2 }}" class="form-control ">
        </div> 

         <div class="mb-3">
         <label> Card Box Link Title</label>
 <input name="carbox3linktitle" type="text" value="{{ $section->carbox3linktitle }}" class="form-control ">
        </div> 

             <div class="mb-3">
         <label> Card Box Link </label>
 <input name="carbox3link" type="text" value="{{ $section->carbox3link }}" class="form-control ">
        </div> 
    
    
    </div>
    
      
       <div class="col-xl-5">
        <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Section</button>
            </div>
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->



         


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