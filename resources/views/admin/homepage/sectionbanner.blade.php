
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
								<h4 class="fw-bold">Section Banner</h4>
								<h6>Manage Section Banner</h6>
							</div>
						</div>
 </div>            

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

			

<form action="{{ route('sectionbanner.update', $section->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
<div class="col-xl-6">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Section Banner 1</label>
    
            <div class="image-frame2" id="imagePreview" style="margin-bottom: 30px;">
                @if ($section->secbannerimg1)
                <img src="{{ asset($section->secbannerimg1) }}" id="previewImage">
            @else
                <span id="placeholderText">No image selected</span>
            @endif
            </div>
        
            <input class="form-control mb-3" name="secbannerimg1" type="file" id="imageInput" accept="image/*">
   <div class="mb-3">
            <label> Section Text 1</label>
 <input name="secbannertext1" type="text" value="{{ $section->secbannertext1 }}" class="form-control ">
    </div>

 
   



 <div class="mb-3">
         <label> Section Link</label>
 <input name="secbannerlink1" type="text" value="{{ $section->secbannerlink1 }}" class="form-control ">
        </div> </div>
    
      
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->








</div><!--===== Col Ends =====-->





<div class="col-xl-6">
    <div class="card h-auto">
    <div class="card-body">
  <div class="mb-3">
<label class="form-label">Section Banner 2</label>
        <div class="image-frame2" id="imagePreview2" style="margin-bottom: 30px;">
                    @if ($section->secbannerimg2)
                    <img src="{{ asset($section->secbannerimg2) }}" id="previewImag2">
                @else
                    <span id="placeholderText">No image selected</span>
                @endif
                </div>
            
                <input class="form-control mb-3" name="secbannerimg2" type="file" id="imageInput2" accept="image/*">
                    <div class="mb-3">
                <label> Section Text 2</label>
 <input name="secbannertext2" type="text" value="{{ $section->secbannertext2 }}" class="form-control ">
  </div>
 <div class="mb-3">
     <label> Section link </label>
 <input name="secbannerlink2" type="text" value="{{ $section->secbannerlink2 }}" class="form-control ">
            </div> </div>
 
        
            
    </div><!--=== Card Body Ends ====-->
    </div><!--==== Card Ends =======-->
    </div><!--===== Col Ends =====-->

    



<div class="col-sm-12">
<div class="card">
<div class="card-body">
 <div class="mb-3">
      <label class="form-label">Heading  Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="sectionbanner_heading_color" value="{{ $section->sectionbanner_heading_color }}">
  </div> 

  <div class="mb-3">
<label class="form-label">Font Size</label>
<input type="number" class="form-control" name="sectionbanner_heading_size" value="{{ $section->sectionbanner_heading_size }}">
</div>

<div class="mb-3">
    <label for="sectionbanner_heading_font" class="form-label">Heading fonts </label>
     <select name="sectionbanner_heading_font" id="sectionbanner_heading_font" class="form-select">
        <option value="" {{ $colorconfig->sectionbanner_heading_font == '' ? 'selected' : '' }}>Theme Default</option>
        @foreach($fonts as $font)
            <option value="{{ $font }}" {{ $colorconfig->sectionbanner_heading_font == $font ? 'selected' : '' }}>
                {{ $font }}
            </option>
        @endforeach
    </select>
    
</div>


 <div class="col-md-2">
            <div class="mb-3 form-check">
                <input type="checkbox" name="carboxstatus" value="1" class="form-check-input" {{ $section->carboxstatus ? 'checked' : '' }}>
                <label class="form-check-label">Visibility</label>
            </div>
        </div>

    
            <div class="col-xl-5">
        <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Section</button>
            </div>

</div></div></div>


</div><!--===== Row Ends =====-->
</form>    
                                    







								</div>
							</div>
						</div>
					</div>






	</div></div>
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