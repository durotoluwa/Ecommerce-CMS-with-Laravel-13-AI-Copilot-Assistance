
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
								<h4 class="fw-bold">Style & Color</h4>
								<h6>Manage your Website Style & Color</h6>
							</div>
						</div>
					 
				 
 
					</div>               

                    

	 <form action="{{ route('updateWebsiteColor') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
<div class="col-sm-4">
<div class="card">
<div class="card-body">

  <input type="hidden" name="id" value="{{ $colorconfig->id }}">
  <div class="row" style="margin-bottom: 20px">


    <div class="col-xl-12">
  <div class="mb-3">
    <label class="form-label">Primary Colour</label>
    <input type="color" class="complex-colorpicker form-control" name="primary_color" value="{{ $colorconfig->primary_color }}">
</div></div><!--==== end of col ======---->

<div class="col-xl-12">
    <div class="mb-3">
      <label class="form-label">Secondary Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="secondary_color" value="{{ $colorconfig->secondary_color }}">
  </div></div><!--==== end of col ======---->




<div class="col-xl-12">
    <div class="mb-3">
      <label class="form-label">Body Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="body_color" value="{{ $colorconfig->body_color }}">
  </div></div><!--==== end of col ======---->


  <div class="col-xl-12">
    <div class="mb-3">
      <label class="form-label">Text Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="text_color" value="{{ $colorconfig->text_color }}">
  </div></div><!--==== end of col ======---->


</div><!--====end of row ======---->

<div class="row" style="margin-bottom: 20px">
 <div class="col-xl-12">
    <div class="mb-3">
      <label class="form-label">Footer BG Colour</label>
      <input type="color" class="complex-colorpicker form-control" name="footer_bgcolor" value="{{ $colorconfig->footer_bgcolor }}">
  </div></div><!--==== end of col ======---->
  
  <div class="col-xl-12">
      <div class="mb-3">
        <label class="form-label">Footer Title Colour</label>
        <input type="color" class="complex-colorpicker form-control" name="footer_titlecolor" value="{{ $colorconfig->footer_titlecolor }}">
    </div></div><!--==== end of col ======---->
  
  
 <div class="col-xl-12">
      <div class="mb-3">
        <label class="form-label">Footer Text Colour</label>
        <input type="color" class="complex-colorpicker form-control" name="footer_textcolor" value="{{ $colorconfig->footer_textcolor }}">
    </div></div><!--==== end of col ======---->
 
  </div><!--====end of row ======---->

  <div class="row" style="margin-bottom: 20px">
  <div class="col-xl-12">
        <div class="mb-3">
          <label class="form-label">Heading Colour (H1, H2...) </label>
          <input type="color" class="complex-colorpicker form-control" name="heading_colour" value="{{ $colorconfig->heading_colour }}">
      </div></div><!--==== end of col ======---->
    
 

<div class="col-xl-12">
        <div class="mb-3">
          <label class="form-label">Copywrite Text </label>
          <input type="color" class="complex-colorpicker form-control" name="copywrite_textcolor" value="{{ $colorconfig->copywrite_textcolor }}">
      </div></div><!--==== end of col ======---->
   
    </div><!--====end of row ======---->
 
 



</div></div></div>
<!--====end of col-4- ==========--->





<div class="col-sm-4">
<div class="card">
<div class="card-body">

  <input type="hidden" name="id" value="{{ $colorconfig->id }}">
  <div class="row" style="margin-bottom: 20px">


    <div class="col-xl-12">
<div class="mb-3">
    <label for="heading_font_style" class="form-label">Heading fonts (H1–H6)</label>
     <select name="heading_font_style" id="heading_font_style" class="form-select">
        <option value="" {{ $colorconfig->heading_font_style == '' ? 'selected' : '' }}>Theme Default</option>
        @foreach($fonts as $font)
            <option value="{{ $font }}" {{ $colorconfig->heading_font_style == $font ? 'selected' : '' }}>
                {{ $font }}
            </option>
        @endforeach
    </select>
    
</div>
</div><!--==== end of col ======---->


<div class="col-xl-12">
    <div class="mb-3">
        <label for="heading_weight" class="form-label">Heading Font Weight</label>
        <select name="heading_weight" id="heading_weight" class="form-select">
            <option value="" {{ $colorconfig->heading_weight == '' ? 'selected' : '' }}>Theme Default</option>
            <option value="500" {{ $colorconfig->heading_weight == '500' ? 'selected' : '' }}>Bold 500</option>
            <option value="600" {{ $colorconfig->heading_weight == '600' ? 'selected' : '' }}>Bold 600</option>
            <option value="700" {{ $colorconfig->heading_weight == '700' ? 'selected' : '' }}>Bold 700</option>
            <option value="800" {{ $colorconfig->heading_weight == '800' ? 'selected' : '' }}>Bold 800</option>
            <option value="900" {{ $colorconfig->heading_weight == '900' ? 'selected' : '' }}>Bold 900</option>
        </select>
    </div>
</div><!--==== end of col ======---->




    <div class="col-xl-12">
<div class="mb-3">
    <label for="text_font" class="form-label">Text fonts (paragraphs, etc..)</label>
     <select name="text_font" id="text_font" class="form-select">
        <option value="" {{ $colorconfig->text_font == '' ? 'selected' : '' }}>Theme Default</option>
        @foreach($fonts as $font)
            <option value="{{ $font }}" {{ $colorconfig->text_font == $font ? 'selected' : '' }}>
                {{ $font }}
            </option>
        @endforeach
    </select>
    
</div>
</div><!--==== end of col ======---->


<div class="col-xl-12">
    <div class="mb-3">
        <label for="text_weight" class="form-label">Text Font Weight</label>
        <select name="text_weight" id="text_weight" class="form-select">
            <option value="" {{ $colorconfig->text_weight == '' ? 'selected' : '' }}>Theme Default</option>
            <option value="100" {{ $colorconfig->text_weight == '100' ? 'selected' : '' }}> 100</option>
            <option value="200" {{ $colorconfig->text_weight == '200' ? 'selected' : '' }}> 200</option>
            <option value="300" {{ $colorconfig->text_weight == '300' ? 'selected' : '' }}> 300</option>
            <option value="400" {{ $colorconfig->text_weight == '400' ? 'selected' : '' }}> 400</option>
             <option value="500" {{ $colorconfig->text_weight == '500' ? 'selected' : '' }}> 500</option>
              <option value="600" {{ $colorconfig->text_weight == '600' ? 'selected' : '' }}> 600</option>
               <option value="700" {{ $colorconfig->text_weight == '700' ? 'selected' : '' }}> 700</option>
                <option value="800" {{ $colorconfig->text_weight == '800' ? 'selected' : '' }}> 800</option>
         </select>
    </div>
</div><!--==== end of col ======---->


    <div class="col-xl-12">
<div class="mb-3">
    <label for="menu_font" class="form-label">Menu fonts </label>
     <select name="menu_font" id="menu_font" class="form-select">
        <option value="" {{ $colorconfig->menu_font == '' ? 'selected' : '' }}>Theme Default</option>
        @foreach($fonts as $font)
            <option value="{{ $font }}" {{ $colorconfig->menu_font == $font ? 'selected' : '' }}>
                {{ $font }}
            </option>
        @endforeach
    </select>
    
</div>
</div><!--==== end of col ======---->


<div class="col-xl-12">
    <div class="mb-3">
        <label for="menu_weight" class="form-label">Menu Font Weight</label>
        <select name="menu_weight" id="menu_weight" class="form-select">
            <option value="" {{ $colorconfig->menu_weight == '' ? 'selected' : '' }}>Theme Default</option>
            <option value="100" {{ $colorconfig->menu_weight == '100' ? 'selected' : '' }}> 100</option>
            <option value="200" {{ $colorconfig->menu_weight == '200' ? 'selected' : '' }}> 200</option>
            <option value="300" {{ $colorconfig->menu_weight == '300' ? 'selected' : '' }}> 300</option>
            <option value="400" {{ $colorconfig->menu_weight == '400' ? 'selected' : '' }}> 400</option>
            <option value="500" {{ $colorconfig->menu_weight == '500' ? 'selected' : '' }}> 500</option>
            <option value="600" {{ $colorconfig->menu_weight == '600' ? 'selected' : '' }}> 600</option>
            <option value="700" {{ $colorconfig->menu_weight == '700' ? 'selected' : '' }}> 700</option>
            <option value="800" {{ $colorconfig->menu_weight == '800' ? 'selected' : '' }}> 800</option>
         </select>
    </div>
</div><!--==== end of col ======---->
 

</div><!--====end of row ======---->

 
 



</div></div></div>
<!--====end of col-4- ==========--->



<div class="col-sm-4">
<div class="card">
<div class="card-body">

 <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Style & Color</button>

    </div></div></div>
<!--====end of col-4- ==========--->


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