
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
	
<style>
.image-frame {
    width: 50%;
    height: 300px;
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

.image-frame img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.image-frame input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.upload-label {
    text-align: center;
    color: #666;
    font-size: 16px;
    pointer-events: none;
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
								<h4 class="fw-bold">Footer Settings</h4>
								<h6>Manage your footer content</h6>
							</div>
						</div>
 </div>
 
 
 
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
 <form action="{{ route('updateFooter') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

  <input type="hidden" name="id" value="{{ $footerconfig->id }}">
  
   <div class="row">
    <div class="col-md-12">
     <div class="mb-3">
       <label class="form-label">Footer Content - (Max-Lenght: 102 sentences)</label>
      
    <textarea maxlength="105" class="form-control" name="footer_content" rows="3" placeholder="Enter Footer Content" >{{ $footerconfig->footer_content }}</textarea>
     
    </div>
    </div><!--=== Col Ends ======-->
   
    <div class="col-md-12">
       <div class="mb-3">
         <label class="form-label">Footer Copywrite</label>
         <input class="form-control" name="copywrite_text" value="{{ $footerconfig->copywrite_text }}">
         </div>
      </div><!--=== Col Ends ======-->


     <div class="col-md-12">
       <div class="mb-3">
   <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update</button>

       </div></div> 

</form>

</div></div></div></div>
    <!--=======end of content and page-wrapper========-->

                    

    

 
   
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
 
	@include('admin.include.footer')
</html>