
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
								<h4 class="fw-bold">Maintenance mode</h4>
								<h6>Manage your Maintenance mode </h6>
							</div>
						</div>
	 
					</div>               

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
   <form action="{{ route('updateMaintenance') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <input type="hidden" name="id" value="{{ $mainconfig->id }}">

        <div class="mb-3">
            <label class="form-label">Maintenance Status</label>
            <select name="maintenance_status" class="default-select  form-control wide">
                <option selected value="{{ $mainconfig->maintenance_status }}">{{ $mainconfig->maintenance_status }}</option>
                 <option value="active">Active</option>
                <option value="hidden">Hidden</option>
                
              </select>
          </div>
    
        <div class="mb-3">
            <label class="form-label">Maintenance mode</label>
    
            <div class="image-frame" id="imagePreview" style="margin-bottom: 30px;">
                @if ($mainconfig->error_page)
                <img src="{{ asset($mainconfig->maintenance_image) }}" alt="Current Error Page" id="previewImage">
            @else
                <span id="placeholderText">No image selected</span>
            @endif
            </div>
    
            <input class="form-control" name="maintenance_image" type="file" id="imageInput" accept="image/*">
        </div>

        
        <div class="mb-3">
            <label class="form-label">Announcement Text</label>
<textarea class="form-control" name="maintenance_text" rows="4">{{ $mainconfig->maintenance_text }}</textarea>
        </div>
    
        <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update</button>
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
 
	@include('admin.include.footer')
</html>