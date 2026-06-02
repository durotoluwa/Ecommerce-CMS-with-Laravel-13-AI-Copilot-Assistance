
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
								<h4 class="fw-bold">Manage Terms for Attribute: {{ $attribute->name }}</h4>
								 
							</div>
						</div>
 </div>	 
					               

					<div class="row">
						<div class="col-sm-4">
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
                                    
 <form action="{{ route('admin.attribute_terms.store', $attribute->id) }}" method="POST">
            @csrf
      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Name</label>
    <input class="form-control" type="text" name="name" required>
    <small>The name is how it appears on your site.</small>
       </div>
      </div>
       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Slug</label>
    <input class="form-control" type="text" name="slug"  >
    <small>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
     </div>
      </div>
  

    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Add New</button>
</form>



								</div>
							</div>
						</div>
                        <!--====== end of  col-sm-5 =========--->


                        	<div class="col-sm-8">
							<div class="card">
								<div class="card-body">
 
                                    
<div class="table-responsive no-search">
<table class="table datatable">
<thead class="thead-light">
        <tr>
     <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      @foreach($terms as $term)
                    <tr>
                        <td><strong>{{ $term->name }}</strong></td>
                        <td>{{ $term->slug }}</td>
                        <td>
                            <a href="{{ route('admin.attribute_terms.edit', [$attribute->id, $term->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.attribute_terms.destroy', [$attribute->id, $term->id]) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this term?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
    </tbody>
</table>

</div>


								</div>
							</div>
						</div>
                        <!--====== end of  col-sm-7 =========--->

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