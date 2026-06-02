
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
								<h4 class="fw-bold">Add new Post</h4>
							 
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
					               

					<div class="row">
<div class="col-sm-8">
<form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf  

<div class="card">
<div class="card-body">

      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Post title</label>
    <input class="form-control" type="text" name="title" required>
       </div>
      </div>

      

             <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Post Content</label>
<textarea  id="editor2" name="content"></textarea>
      </div>
      </div>

     	</div></div> <!----end of card-body--->

 
 
<div class="card mb-2">
    <div class="card-header">
        <strong>SEO</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">


<div class="mb-3">
    <label class="form-label">SEO Keywords</label>
    <input type="text" name="seo_keywords" id="seoKeywords" class="form-control" placeholder="e.g. online course, web development">
<p class="text-muted small">Comma-separated keywords to help search engines understand your product.</p>

</div>

<div class="mb-3">
    <label class="form-label">SEO Title</label>
    <input type="text" name="seo_title" id="seoTitle" class="form-control" placeholder="Enter SEO Title">
        <p class="text-muted small">This title appears in search engine results.</p>
</div>

<div class="mb-3">
    <label class="form-label">SEO Description</label>
    <textarea name="seo_description" id="seoDescription" class="form-control" rows="3" maxlength="160"></textarea>
           <p class="text-muted small">Keep it under 160 characters for best results.</p>
</div>

 
<div class="mb-3">
<label class="form-label">Google SEO Web Preview</label>

<x-seo-preview 
    :title="old('title')" 
    :description="old('seo_description')" 
    :keywords="old('seo_keywords')" 
    :slug="'new-post'" 
/>
</div>

            </div>
        </div>
    </div>
</div>




   




							
						</div>
                        <!--====== end of  col-sm-5 =========--->


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
      

<div class="form-check">
    <input class="form-check-input" type="radio" name="publish_type" id="publish-now" value="immediately" checked>
    <label class="form-check-label" for="publish-now">Immediately</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="publish_type" id="publish-schedule" value="schedule">
    <label class="form-check-label" for="publish-schedule">Schedule</label>
</div>



        <div class="mt-2 d-none" id="publish-date-wrapper">
            <label for="publish-date">Publish Date:</label>
            <input type="datetime-local" class="form-control" name="publish_date" id="publish-date">
        </div>

        <div class="row mt-3">
    <div class="col-lg-9">
 <button type="submit" class="btn btn-sm btn-primary mb-4 open">Publish</button>
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
            <input type="file" name="featured_image" id="featured_image"
                   class="d-none"
                   accept=".jpg,.jpeg,.png,.gif">
        </div>
    </div>
</div>


 

<div class="card mb-2">
    <div class="card-header">
        <strong>Post Categories</strong>
    </div>
    <div class="card-body" style="max-height:250px; overflow-y:auto;">
                 <select name="blog_category_id" class="form-control wide">
                @foreach ($postCategories as $postcategorys)
<option value="{{$postcategorys->id }}">{{$postcategorys->name }} </option>
@endforeach    
</select>
    </div>
</div>

 



</div> <!--====== end of  col-sm-7 =========--->
</form>

</div><!--====== end of row =========--->






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

    /* =====================================
       GALLERY (PREVIEW + REMOVE + SORT)
    ===================================== */
    const galleryInput = get('gallery');
    const galleryPreview = get('product-gallery-preview');

    if (galleryInput && galleryPreview) {

        galleryInput.addEventListener('change', function () {
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const li = document.createElement('li');
                    li.className = 'me-2 mb-2 position-relative';

                    li.innerHTML = `
                        <img src="${e.target.result}" class="img-thumbnail"
                             style="width:100px;height:100px;object-fit:cover;">
                        <button type="button"
                                class="btn-close position-absolute top-0 end-0 remove-image">
                        </button>
                    `;

                    galleryPreview.appendChild(li);
                };

                reader.readAsDataURL(file);
            });
        });

        galleryPreview.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-image')) {
                e.target.closest('li').remove();
            }
        });

        if (typeof Sortable !== 'undefined') {
            new Sortable(galleryPreview, {
                animation: 150,
                ghostClass: 'sortable-ghost'
            });
        }
    }

    /* =====================================
       PRICE VALIDATION
    ===================================== */
    const regularInput = get('regular_price');
    const saleInput = get('sale_price');
    const errorMsg = get('sale_price_error');

    if (regularInput && saleInput && errorMsg) {

        let hasInteracted = false;

        function validatePrices() {
            let regular = parseFloat(regularInput.value) || 0;
            let sale = parseFloat(saleInput.value) || 0;

            if (!hasInteracted) return;

              if (sale > regular) {
                saleInput.classList.add('is-invalid');
                errorMsg.classList.remove('d-none');
            } else {
                saleInput.classList.remove('is-invalid');
                errorMsg.classList.add('d-none');
            }
        }

        saleInput.addEventListener('input', () => {
            hasInteracted = true;
            validatePrices();
        });

        regularInput.addEventListener('input', () => {
            hasInteracted = true;
            validatePrices();
        });
    }

    /* =====================================
       PUBLISH DATE TOGGLE
    ===================================== */
    const scheduleRadio = get('publish-schedule');
    const nowRadio = get('publish-now');
    const dateWrapper = get('publish-date-wrapper');

    if (scheduleRadio && nowRadio && dateWrapper) {

        function toggleDate() {
            dateWrapper.classList.toggle('d-none', !scheduleRadio.checked);
        }

        scheduleRadio.addEventListener('change', toggleDate);
        nowRadio.addEventListener('change', toggleDate);

        toggleDate(); // run on load
    }

    /* =====================================
       ATTRIBUTES (JQUERY)
    ===================================== */
    if (typeof $ !== 'undefined') {

        $('.toggle-terms').on('click', function (e) {
            e.preventDefault();
            $($(this).data('target')).toggleClass('d-none');
        });

        $('.select-all').on('click', function () {
            $($(this).data('target')).find('input').prop('checked', true);
        });

        $('.select-none').on('click', function () {
            $($(this).data('target')).find('input').prop('checked', false);
        });

        $('.create-value').on('click', function(e) {
            e.preventDefault();

            let attributeId = $(this).data('attribute');
            let newValue = prompt("Enter new value:");
            if (!newValue) return;

            $.ajax({
                url: `/admin/attributes/${attributeId}/terms`,
                type: 'POST',
                data: {
                    name: newValue,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (term) {
                    let html = `
                        <div class="form-check me-3">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="attribute_terms[${attributeId}][]"
                                   value="${term.id}"
                                   id="term-${term.id}">
                            <label class="form-check-label" for="term-${term.id}">
                                ${term.name}
                            </label>
                        </div>`;

                    $(`#attribute-${attributeId} .term-list`).append(html);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Server error while creating term');
                }
            });
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('seoTitle');
    const descInput = document.getElementById('seoDescription');
    const keywordsInput = document.getElementById('seoKeywords');

    const previewTitle = document.querySelector('.seo-preview h3');
    const previewDesc = document.querySelector('.seo-preview p');
    const previewKeywords = document.querySelector('.seo-preview small');

    titleInput.addEventListener('input', () => {
        previewTitle.textContent = titleInput.value || 'SEO Title Preview';
    });

    descInput.addEventListener('input', () => {
        previewDesc.textContent = descInput.value || 'SEO description preview will appear here.';
    });

    keywordsInput.addEventListener('input', () => {
        if(previewKeywords){
            previewKeywords.textContent = 'Keywords: ' + keywordsInput.value;
        }
    });
});
</script>


@include('admin.include.footer')


</body>
</html>