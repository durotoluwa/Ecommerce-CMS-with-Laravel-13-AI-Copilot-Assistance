
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


<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Brands</h4>
							 
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
<form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name', $brand->name) }}" required>
            <small>The name is how it appears on your site.</small>
       </div>
      </div>
       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Slug</label>
    <input class="form-control" type="text" name="slug" value="{{ old('slug', $brand->slug) }}" >
    <small>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
     </div>
      </div>

     <div class="col-md-12">
        <div class="mb-3">
        <label class="form-label">Parent Brand</label>
    <select class="form-control" name="parent_id">
    <option value="">None</option>
    @foreach($brands as $parent)
        <option value="{{ $parent->id }}" 
            {{ $brand->parent_id == $parent->id ? 'selected' : '' }}>
            {{ $parent->name }}
        </option>
    @endforeach
</select>

        <p>Assign a parent brand to create a hierarchy.</p>
    </div></div>


 <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea  class="form-control" name="description">{{ old('description', $brand->description) }}</textarea>
    <small>The description is not prominent by default; however, some themes may show it.</small>
     </div>
      </div>

 <div class="col-md-12">
       <div class="mb-3">
 
   <div class="form-group">
    <label for="thumbnail" class="form-label">Thumbnail</label>

    

    <!-- Hidden file input -->
    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" 
           style="display:none;" onchange="previewThumbnail(event)">

    <!-- Preview box below -->
      <div id="thumbnail-preview" style="margin-top:10px; width:120px; height:120px; border:1px solid #ccc; display:flex; align-items:center; justify-content:center;">
            @if(!empty($brand->thumbnail))
                <img src="{{ asset($brand->thumbnail) }}" alt="Brand Logo" style="max-width:100%; max-height:100%;">
            @else
                <span style="font-size:12px; color:#999;">No image</span>
            @endif
        </div>

    <!-- Upload button -->
    <button type="button" onclick="document.getElementById('thumbnail').click()">
        Upload/Add image
    </button>
    <p class="help-text">Upload/Add image for the brand logo.</p>
</div>


 
       </div></div>


    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Brand</button>
</form>



								</div>
							</div>
						</div>
                        <!--====== end of  col-sm-5 =========--->


                         

					</div><!--====== end of roe =========--->






	</div></div>
    <!--=======end of content and page-wrapper========-->

    

<script>
function previewThumbnail(event) {
    const preview = document.getElementById('thumbnail-preview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.maxWidth = '100%';
        img.style.maxHeight = '100%';
        preview.appendChild(img);
    }
}
</script>
 
 
 
	@include('admin.include.footer')
</html>