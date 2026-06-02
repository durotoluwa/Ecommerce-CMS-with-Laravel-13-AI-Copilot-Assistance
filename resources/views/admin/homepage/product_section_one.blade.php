
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
								<h4 class="fw-bold">Product Section one</h4>
								<h6>Update  this Section</h6>
							</div>
						</div>
					 <!---
						<div class="page-btn">
<a href="#" class="btn btn-primary rounded-pill rounded-pill" data-bs-toggle="modal" data-bs-target="#add-user"><i class="ti ti-circle-plus me-1"></i>Add Permission</a>						</div>	
                        
						<div class="page-btn import">
							<a href="#" class="btn btn-secondary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
								data-feather="download" class="me-1"></i> dfsfsf</a>
						</div>--->
					</div>               

                    
	<form action="{{ route('product_section_one.update', $section->id) }}" method="POST">
    @csrf
    @method('PUT')
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
 
<div class="row">
 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label"> Heading (h3)</label>
    
    <input type="text" class="form-control" name="productsectionone_heading" value="{{ $section->productsectionone_heading }}"   >
  </div>
 </div><!--=== Col Ends ======-->


  <div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="productsectionone_selection">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->productsectionone_selection == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->productsectionone_selection == 'new' ? 'selected' : '' }}>New Arrival</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->


<div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="productsectionone_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->productsectionone_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->productsectionone_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>
</div><!--=== Col Ends ======-->




 <div class="col-md-12">
  <div class="mb-3">
    <label class="form-label">View More Link </label>
    <input type="text" class="form-control" name="productsectionone_link" value="{{ $section->productsectionone_link }}"   >

   </div>
 </div><!--=== Col Ends ======-->
</div><!--=== Row Ends ======-->

 </div></div></div>

 

 <div class="col-md-2">
            <div class="mb-3 form-check">
                <input type="checkbox" name="productsectionone_status" value="1" class="form-check-input" {{ $section->productsectionone_status ? 'checked' : '' }}>
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