
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
 
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
								<h4 class="fw-bold">Homapage Blog Section</h4>
								<h6>Blog Section</h6>
							</div>
						</div>
					 
						  <!---<div class="page-btn">
<a href="#" class="btn btn-primary rounded-pill rounded-pill" data-bs-toggle="modal" data-bs-target="#add-user"><i class="ti ti-circle-plus me-1"></i>Add Permission</a>						</div>	
                      
						<div class="page-btn import">
							<a href="#" class="btn btn-secondary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
								data-feather="download" class="me-1"></i> dfsfsf</a>
						</div>--->
					</div>               

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

			

<form action="{{ route('blogsection.update', $section->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
    
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label">Heading Title</label>
                <input type="text" class="form-control" name="blog_heading" value="{{ old('blog_heading', $section->blog_heading) }}">
            </div>
        </div>

    <div class="col-md-4">
    <div class="mb-3">
        <label class="form-label">Autoplay</label>
        <select class="form-control" name="blog_autoplay">
            <option value="1" {{ old('blog_autoplay', $section->autoplay) == true ? 'selected' : '' }}>true</option>
            <option value="0" {{ old('blog_autoplay', $section->autoplay) == false ? 'selected' : '' }}>false</option>
        </select>
    </div>
</div>


        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Autoplay Timeout</label>
                <input type="text" class="form-control" name="blog_autoplaytimeout" value="{{ old('blog_autoplaytimeout', $section->blog_autoplaytimeout) }}" placeholder="Enter Autoplay Timeout">
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Responsive screen (992px)</label>
                <input type="number" class="form-control" name="blog_responsive992" value="{{ old('blog_responsive992', $section->blog_responsive992) }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Responsive screen (768px)</label>
                <input type="number" class="form-control" name="blog_responsive576" value="{{ old('blog_responsive576', $section->blog_responsive576) }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3 form-check">
                <input type="checkbox" name="blog_status" value="1" class="form-check-input" {{ $section->blog_status ? 'checked' : '' }}>
                <label class="form-check-label">Visibility</label>
            </div>
        </div>
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