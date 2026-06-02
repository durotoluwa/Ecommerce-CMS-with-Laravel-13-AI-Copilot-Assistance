
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

<div id="product-page">
<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Add new Testimony</h4>
							 
							</div>
						</div>
 </div>	 

  @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
					               


 <form action="{{ route('testimonies.store') }}" method="POST"  enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-sm-8">

<div class="card">
<div class="card-body">

  <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Customer Name</label>
    <input class="form-control" type="text" name="customer_name" required>
       </div>
      </div>

      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Title</label>
    <input class="form-control" type="text" name="title" required>
       </div>
      </div>


<div class="col-md-12">
<div class="mb-3">
<label class="form-label">Review</label>
<textarea class="form-control" name="review" ></textarea>
      </div>
      </div>

<div class="card mb-2">
    <div class="card-header">
        <strong>Rating</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

   <select name="rating" class="form-control">
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            </div>
        </div>
    </div>
</div>



</div></div>
<!--====== end of card-body =========--->


</div><!--====== end of col-sm-8 =========--->

<div class="col-sm-4">



<div class="card mb-2">
<div class="card-header">
<strong>Status</strong>
</div>
<div class="card-body">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status-active" value="active" checked>
            <label class="form-check-label" for="status-active">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status-pending" value="pending">
            <label class="form-check-label" for="status-pending">Pending Review</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status-draft" value="draft">
            <label class="form-check-label" for="status-draft">Draft</label>
        </div>
    </div>
</div>



<div class="card mb-2">
    <div class="card-header">
        <strong>Publish</strong>
    </div>

    <div class="card-body">
    <div class="row mt-3">
    <div class="col-lg-9">
 <button type="submit" class="btn btn-sm btn-primary mb-4">Publish</button>
</div>
</div>
</div>
</div>


<div class="card mb-2">
    <div class="card-header">
        <strong>Featured Image</strong>
    </div>
    <div class="card-body">
        <div id="featured-preview" class="mb-2"></div>

        <div>
            <label class="btn btn-link p-0" for="featured_image">
                Add featured image
            </label>
            <input type="file" name="customer_image" id="featured_image"
                   class="d-none"
                   accept=".jpg,.jpeg,.png,.gif">
        </div>
    </div>
</div>


</div><!--====== end of col-sm-4 =========--->


</div><!--====== end of row =========--->
</form>











	</div></div></div>
    <!--=======end of content and page-wrapper========-->



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log("All scripts initialized");

    /* =====================================
       HELPER
    ===================================== */
    const get = (id) => document.getElementById(id);

    /* =====================================
       THUMBNAIL PREVIEW (GLOBAL)
    ===================================== */
    window.previewThumbnail = function(event) {
        const preview = get('thumbnail-preview');
        if (!preview) return;

        preview.innerHTML = '';
        const file = event.target.files[0];

        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100%';
            preview.appendChild(img);
        }
    };

    /* =====================================
       FEATURED IMAGE PREVIEW
    ===================================== */
    const featuredInput = get('featured_image');
    const featuredPreview = get('featured-preview');

    if (featuredInput && featuredPreview) {
        featuredInput.addEventListener('change', function (e) {
            featuredPreview.innerHTML = '';

            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.width = 150;
                img.classList.add('me-2','mb-2','border');
                featuredPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
 
 

});
</script>

  
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  </script>

    <script>
    ClassicEditor
      .create(document.querySelector('#editor2'))
      .catch(error => {
        console.error(error);
      });
  </script>


 


@include('admin.include.footer')


</body>
</html>