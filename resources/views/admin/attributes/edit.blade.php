
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
								<h4 class="fw-bold">Attributes</h4>
								 
							</div>
						</div>
 </div>	 
					               

					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
 
                                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  
<form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Name</label>
    <input class="form-control" type="text" name="name" value="{{ old('name', $attribute->name) }}" required>
    <small>The name is how it appears on your site.</small>
       </div>
      </div>
       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Slug</label>
    <input class="form-control" type="text" name="slug" value="{{ old('slug', $attribute->slug) }}"  >
    <small>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
     </div>
      </div>
 <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Type</label>
     <select name="type" class="form-control">
        
            <option value="select" {{ $attribute->type == 'select' ? 'selected' : '' }}>Select</option>
            <option value="swatch" {{ $attribute->type == 'Swatch' ? 'selected' : '' }}>Swatch</option>
           
        </select>
    <small>Determines how this attribute's values are displayed.</small>
     </div>
      </div>

    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Attribute</button>
</form>



								</div>
							</div>
						</div>
                        <!--====== end of  col-sm-5 =========--->

 

					</div><!--====== end of roe =========--->






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
 
	@include('admin.include.footer')
</html>