
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
								<h4 class="fw-bold">Edit Blog Category</h4>
							 
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
                                    
 
    <form action="{{ route('blog_category.update', $blog_category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Category</label>
    <input class="form-control" type="text" name="name" value="{{ old('name', $blog_category->name) }}" required>
    <small>The name is how it appears on your site.</small>
       </div>
      </div>
       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Slug</label>
    <input class="form-control" type="text" name="slug"  value="{{ old('name', $blog_category->slug) }}" >
    <small>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
     </div>
      </div>

     <div class="col-md-6">
        <div class="mb-3">
        <label class="form-label">Parent category</label>
        <select name="parent_id" class="form-control">
            <option value="">None</option>
            @foreach($categories as $parent)
                <option value="{{ $parent->id }}" {{ $blog_category->parent_id == $parent->id ? 'selected' : '' }}>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
        <p>Assign a parent brand to create a hierarchy.</p>
    </div></div>


 <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea  class="form-control" name="description">{{ old('description', $blog_category->description) }}</textarea>
    <small>The description is not prominent by default; however, some themes may show it.</small>
     </div>
      </div>
 
        


    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Category</button>
</form>



								</div>
							</div>
						</div>
                        <!--====== end of  col-sm-5 =========--->

 

					</div><!--====== end of roe =========--->






	</div></div>
    <!--=======end of content and page-wrapper========-->

    




<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-featured').forEach(el => {
        el.addEventListener('click', function() {
            const id = this.dataset.id;

            fetch(`/admin/category/${id}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.innerHTML = data.featured
                        ? '<i class="fas fa-star text-warning"></i>'
                        : '<i class="far fa-star text-muted"></i>';
                }
            });
        });
    });
});


</script>
 
 
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