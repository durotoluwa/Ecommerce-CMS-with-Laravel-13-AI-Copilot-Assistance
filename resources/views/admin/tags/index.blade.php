
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
								<h4 class="fw-bold">Product tags</h4>
								<h6>Manage your Product tags </h6>
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
                                    
<form action="{{ route('admin.tags.store') }}" method="POST">
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
 <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea  class="form-control" name="description"></textarea>
    <small>The description is not prominent by default; however, some themes may show it.</small>
     </div>
      </div>

    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Add New Tag</button>
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
            <th>Description</th>
            <th>Slug</th>
            <th>Count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->description ?? '-' }}</td>
                <td>{{ $tag->slug }}</td>
                <td>{{ $tag->count }}</td>
                <td>
                    <a class="btn btn-rounded btn-outline-primary"  href="{{ route('admin.tags.edit', $tag) }}">Edit</a>
                  

                    <button data-bs-toggle="modal" data-bs-target="#basicModal{{ $tag->id }}"  type="button" class="btn btn-rounded btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>        
                </td>






<!--==== Delete Permission =======-->
            <div class="modal fade" id="basicModal{{$tag->id }}">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete tag - {{$tag ->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">Are you sure you want to delete {{$tag ->name}} , you cant get it back again, once deleted</div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                     
                    

                         <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                    </form>

                   

                  </div>
                </div>
              </div>



                
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