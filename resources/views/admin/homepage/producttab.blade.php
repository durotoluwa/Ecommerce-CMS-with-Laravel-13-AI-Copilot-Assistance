
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
								<h4 class="fw-bold">Product Tab Section </h4>
								<h6>Manage Product Tab Section</h6>
							</div>
						</div>
 </div>            

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

			

<form action="{{ route('producttab.update', $section->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
<div class="col-xl-12">
<div class="card h-auto">
<div class="card-body">
   <div class="mb-3"> 
            <label> Section Title</label>
 <input name="producttab_section_title" type="text" value="{{ $section->producttab_section_title }}" class="form-control ">
    </div>
</div></div></div>


<div class="col-xl-4">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Product Tab1</label>
    
    <div class="mb-3"> 
            <label> Title</label>
 <input name="producttab1_title" type="text" value="{{ $section->producttab1_title }}" class="form-control ">
    </div>
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="producttab1_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->producttab1_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->producttab1_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="producttab1_seletion">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->producttab1_seletion == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->producttab1_seletion == 'new' ? 'selected' : '' }}>New Arrival</option>
   <option value="all-product" {{ $section->producttab1_seletion == 'all-product' ? 'selected' : '' }}>All Product</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->

 

             <div class="mb-3">
         <label>View More Link </label>
 <input name="producttab1_shoplink" type="text" value="{{ $section->producttab1_shoplink }}" class="form-control ">
        </div> 
    
 
      
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->


 
<div class="col-xl-4">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Product Tab2</label>
    
    <div class="mb-3"> 
            <label> Title</label>
 <input name="producttab2_title" type="text" value="{{ $section->producttab2_title }}" class="form-control ">
    </div>
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="producttab2_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->producttab2_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->producttab2_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="producttab2_seletion">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->producttab2_seletion == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->producttab2_seletion == 'new' ? 'selected' : '' }}>New Arrival</option>
     <option value="all-product" {{ $section->producttab2_seletion == 'all-product' ? 'selected' : '' }}>All Product</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->

 

             <div class="mb-3">
         <label>View More Link </label>
 <input name="producttab2_shoplink" type="text" value="{{ $section->producttab2_shoplink }}" class="form-control ">
        </div> 
  
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->





<div class="col-xl-4">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Product Tab3</label>
    
    <div class="mb-3"> 
            <label> Title</label>
 <input name="producttab3_title" type="text" value="{{ $section->producttab3_title }}" class="form-control ">
    </div>
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="producttab3_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->producttab3_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->producttab3_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="producttab3_seletion">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->producttab3_seletion == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->producttab3_seletion == 'new' ? 'selected' : '' }}>New Arrival</option>
       <option value="all-product" {{ $section->producttab3_seletion == 'all-product' ? 'selected' : '' }}>All Product</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->

 

             <div class="mb-3">
         <label>View More Link </label>
 <input name="producttab3_shoplink" type="text" value="{{ $section->producttab3_shoplink }}" class="form-control ">
        </div> 
  
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->

<div class="col-xl-4">
<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Product Tab3</label>
    
    <div class="mb-3"> 
            <label> Title</label>
 <input name="producttab4_title" type="text" value="{{ $section->producttab4_title }}" class="form-control ">
    </div>
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="producttab4_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->producttab4_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->producttab4_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="producttab4_seletion">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->producttab4_seletion == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->producttab4_seletion == 'new' ? 'selected' : '' }}>New Arrival</option>
       <option value="all-product" {{ $section->producttab4_seletion == 'all-product' ? 'selected' : '' }}>All Product</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->

 

             <div class="mb-3">
         <label>View More Link </label>
 <input name="producttab4_shoplink" type="text" value="{{ $section->producttab4_shoplink }}" class="form-control ">
        </div> 
  
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->









<div class="col-xl-4">

<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Product Tab5</label>
    
    <div class="mb-3"> 
            <label> Title</label>
 <input name="producttab5_title" type="text" value="{{ $section->producttab5_title }}" class="form-control ">
    </div>
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="producttab5_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->producttab5_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->producttab5_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="producttab5_seletion">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->producttab5_seletion == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->producttab5_seletion == 'new' ? 'selected' : '' }}>New Arrival</option>
       <option value="all-product" {{ $section->producttab5_seletion == 'all-product' ? 'selected' : '' }}>All Product</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->

 

             <div class="mb-3">
         <label>View More Link </label>
 <input name="producttab5_shoplink" type="text" value="{{ $section->producttab5_shoplink }}" class="form-control ">
        </div> 
  
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->









<div class="col-xl-4">

<div class="card h-auto">
<div class="card-body">
   

        <div class="mb-3">
            <label class="form-label">Product Tab6</label>
    
    <div class="mb-3"> 
            <label> Title</label>
 <input name="producttab6_title" type="text" value="{{ $section->producttab6_title }}" class="form-control ">
    </div>
  <div class="mb-3">
    <label class="form-label">Category Selection</label>
    <select class="form-control" name="producttab6_category">
        <option value="">Select Option</option>
        <option value="all" {{ $section->producttab6_category == 'all' ? 'selected' : '' }}>
            All Categories
        </option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $section->producttab3_category == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Selection</label>
                <select class="form-control" name="producttab6_seletion">
    <option value="">Select Option</option>
    <option value="featured" {{ $section->producttab6_seletion == 'featured' ? 'selected' : '' }}>Featured Products</option>
    <option value="new" {{ $section->producttab6_seletion == 'new' ? 'selected' : '' }}>New Arrival</option>
       <option value="all-product" {{ $section->producttab6_seletion == 'all-product' ? 'selected' : '' }}>All Product</option>
</select>
  </div>
 </div><!--=== Col Ends ======-->

 

             <div class="mb-3">
         <label>View More Link </label>
 <input name="producttab6_shoplink" type="text" value="{{ $section->producttab6_shoplink }}" class="form-control ">
        </div> 
  
    
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->




 <div class="col-md-2">
            <div class="mb-3 form-check">
                <input type="checkbox" name="producttab_status" value="1" class="form-check-input" {{ $section->producttab_status ? 'checked' : '' }}>
                <label class="form-check-label">Visibility</label>
            </div>
        </div>
    
      
       <div class="col-xl-5">
        <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Section</button>
            </div>
         


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