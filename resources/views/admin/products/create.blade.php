
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
								<h4 class="fw-bold">Add new product</h4>
							 
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




<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

<div class="card">
<div class="card-body">

      <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Product Name</label>
    <input class="form-control" type="text" name="name" required>
       </div>
      </div>

       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Short Description</label>
<textarea  id="editor" name="shortdescription"></textarea>
      </div>
      </div>


             <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Product Description</label>
<textarea  id="editor2" name="description"></textarea>
      </div>
      </div>

     	</div></div> <!----end of card-body--->


<!-- Pricing -->
<div class="card">
    <div class="card-body">
        <div class="row">

            <!-- Regular Price -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Regular Price</label>

                    <div class="input-group">
                        <span class="input-group-text">{{ $baseCurrency->symbol ?? '' }}</span>
                        <input class="form-control" type="number" step="0.01"
                               id="regular_price"
                               name="regular_price" 
                                required>
                    </div>
 
                </div>
            </div>
<!-- Sale Price -->


<!-- Sale Price -->
<div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Sale Price</label>

        <div class="input-group">
            <span class="input-group-text">{{ $baseCurrency->symbol ?? '' }}</span>

            <input class="form-control" type="number" step="0.01"
                   id="sale_price"
                   name="sale_price" 
                   >
        </div>
 

        <!-- Custom error BELOW small -->
        <small id="sale_price_error" class="text-danger d-none">
            Sale price should not be higher than regular price.
        </small>
    </div>
</div>


        </div></div></div>

        <div class="card mb-2">
    <div class="card-header">
        <strong>Inventory</strong>
    </div>
    <div class="card-body">
        <div class="row">

            <!-- SKU -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">SKU</label>
                    <input class="form-control" type="text" name="sku" required>
                </div>
            </div>

            <!-- Stock Status -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Stock Status</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock_status" id="inStock" value="in_stock" checked>
                            <label class="form-check-label" for="inStock">In stock</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock_status" id="outStock" value="out_of_stock">
                            <label class="form-check-label" for="outStock">Out of stock</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock_status" id="onBackorder" value="on_backorder">
                            <label class="form-check-label" for="onBackorder">On backorder</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Quantity -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input class="form-control" type="number" name="stock_quantity" min="0" value="0">
                    <p class="text-muted small">Enter the number of units available. This will be reduced automatically when customers purchase.</p>
                </div>
            </div>

        </div><!-- end of row -->
    </div><!-- end of card-body -->
</div><!-- end of card -->

 
        <div class="card">
<div class="card-body">
<div class="row">
 
<div class="col-md-12">
    <div class="mb-3">
        <label class="form-label">Attributes</label>
        <p class="text-muted small">
            Add descriptive pieces of information that customers can use to search for this product,
            such as "Material", "Color", or "Size".
        </p>

        <!-- Loop through all attributes -->
        <div id="attributes-block">
      @foreach($attributes as $attribute)
    <div class="card mb-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>{{ $attribute->name }}</strong>
            <button type="button" class="btn btn-sm btn-outline-primary toggle-terms"
                    data-target="#attribute-{{ $attribute->id }}">
                Configure {{ $attribute->name }}
            </button>
        </div>

        <div class="card-body d-none" id="attribute-{{ $attribute->id }}">
            <div class="mb-2">
                <label>Values:</label>
                <div class="d-flex flex-wrap term-list">
                    @foreach($attribute->terms as $term)
                        <div class="form-check me-3">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="attribute_terms[{{ $attribute->id }}][]"
                                   value="{{ $term->id }}"
                                   id="term-{{ $term->id }}">
                            <label class="form-check-label" for="term-{{ $term->id }}">
                                {{ $term->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       name="visible_attributes[]" value="{{ $attribute->id }}"
                       id="visible-{{ $attribute->id }}" checked>
                <label class="form-check-label" for="visible-{{ $attribute->id }}">
                    Visible on product page
                </label>
            </div>
        </div>
    </div>
@endforeach

  </div>
    </div>
</div>

    

</div><!----end of row ----->

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
    <input type="text" name="seo_title" id="seoTitle" class="form-control" placeholder="Enter SEO Title" maxlength="70">

    <p class="small mb-1">
        Keep it under 60–70 characters for best results.
        <span id="seoTitleCount" class="text-muted">0 / 70</span>
    </p>

    <!-- Progress bar -->
    <div class="progress" style="height: 6px;">
        <div id="seoTitleProgress" 
             class="progress-bar bg-success" 
             role="progressbar" 
             style="width: 0%;" 
             aria-valuenow="0" 
             aria-valuemin="0" 
             aria-valuemax="70">
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">SEO Description</label>
    <textarea name="seo_description" 
              id="seoDescription" 
              class="form-control" 
              rows="3" 
              maxlength="160"></textarea>
    <p class="small mb-1">
        Keep it under 160 characters for best results.
        <span id="seoDescriptionCount" class="text-muted">0 / 160</span>
    </p>

    <!-- Progress bar -->
    <div class="progress" style="height: 6px;">
        <div id="seoDescriptionProgress" 
             class="progress-bar bg-success" 
             role="progressbar" 
             style="width: 0%;" 
             aria-valuenow="0" 
             aria-valuemin="0" 
             aria-valuemax="160">
        </div>
    </div>
</div>




<div class="mb-3">
<label class="form-label">Google SEO Web Preview</label>

<x-product-seo-preview 
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
        <strong>Product Gallery</strong>
    </div>
    <div class="card-body">
        <ul id="product-gallery-preview" class="d-flex flex-wrap list-unstyled"></ul>

        <div>
            <label class="btn btn-link p-0" for="gallery">
                Add product gallery images
            </label>
         <input type="file" name="gallery[]" id="gallery" 
       class="d-none" multiple 
       accept=".jpg,.jpeg,.png,.gif">

        </div>
    </div>
</div>


<div class="card mb-2">
    <div class="card-header">
        <strong>Product Categories</strong>
    </div>
    <div class="card-body" style="max-height:250px; overflow-y:auto;">
        <ul class="list-unstyled">
            @foreach($categories as $category)
                @if($category->parent_id === null)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="categories[]" value="{{ $category->id }}" 
                                   id="cat-{{ $category->id }}">
                            <label class="form-check-label" for="cat-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>

                        @if($category->children->count())
                            <ul class="ms-4 list-unstyled">
                                @foreach($category->children as $child)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="categories[]" value="{{ $child->id }}" 
                                                   id="cat-{{ $child->id }}">
                                            <label class="form-check-label" for="cat-{{ $child->id }}">
                                                {{ $child->name }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>


<div class="card mb-2">
    <div class="card-header">
        <strong>Brands</strong>
    </div>
    <div class="card-body" style="max-height:250px; overflow-y:auto;">
        @foreach($brands as $brand)
            <div class="form-check">
                <input type="checkbox" name="brands[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                <label for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
            </div>
        @endforeach
 
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
document.addEventListener('DOMContentLoaded', function () {
    // Inputs
    const titleInput    = document.getElementById('seoTitle');
    const descInput     = document.getElementById('seoDescription');
    const keywordsInput = document.getElementById('seoKeywords');
    const slugInput     = document.getElementById('slug'); // optional if you have a slug field

    // Counters & Progress Bars
    const titleCounter = document.getElementById('seoTitleCount');
    const descCounter  = document.getElementById('seoDescriptionCount');
    const titleBar     = document.getElementById('seoTitleProgress');
    const descBar      = document.getElementById('seoDescriptionProgress');

    // Preview Elements
    const previewTitle    = document.getElementById('seo-preview-title');
    const previewDesc     = document.getElementById('seo-preview-description');
    const previewKeywords = document.getElementById('seo-preview-keywords');
    const previewSlug     = document.getElementById('seo-preview-slug');

    // Update Title Counter + Progress
    function updateTitleCounter() {
        const length = titleInput.value.length;
        titleCounter.textContent = length + ' / 70';
        const percent = Math.min((length / 70) * 100, 100);
        titleBar.style.width = percent + '%';
        titleBar.setAttribute('aria-valuenow', length);

        if (length > 70) {
            titleCounter.classList.replace('text-muted', 'text-danger');
            titleBar.classList.replace('bg-success', 'bg-danger');
        } else {
            titleCounter.classList.replace('text-danger', 'text-muted');
            titleBar.classList.replace('bg-danger', 'bg-success');
        }
    }

    // Update Description Counter + Progress
    function updateDescCounter() {
        const length = descInput.value.length;
        descCounter.textContent = length + ' / 160';
        const percent = Math.min((length / 160) * 100, 100);
        descBar.style.width = percent + '%';
        descBar.setAttribute('aria-valuenow', length);

        if (length > 160) {
            descCounter.classList.replace('text-muted', 'text-danger');
            descBar.classList.replace('bg-success', 'bg-danger');
            previewDesc.style.color = '#d9534f'; // 🔴 highlight preview text if too long
        } else {
            descCounter.classList.replace('text-danger', 'text-muted');
            descBar.classList.replace('bg-danger', 'bg-success');
            previewDesc.style.color = '#545454'; // reset to normal gray
        }
    }

    // Update Preview Snippet
    function updatePreview() {
        previewTitle.textContent    = titleInput?.value || 'SEO Title Preview';
        previewDesc.textContent     = descInput?.value || 'SEO description preview will appear here. Keep it between 150–160 characters for best results.';
        previewKeywords.textContent = keywordsInput?.value ? 'Keywords: ' + keywordsInput.value : 'Keywords preview will appear here';
        if (slugInput) {
            previewSlug.textContent = slugInput.value || 'your-slug';
        }
    }

    // Bind events
    [titleInput, descInput, keywordsInput, slugInput].forEach(el => {
        if (el) el.addEventListener('input', function () {
            updateTitleCounter();
            updateDescCounter();
            updatePreview();
        });
    });

    // Initialize on page load
    updateTitleCounter();
    updateDescCounter();
    updatePreview();
});
</script>



 
@include('admin.include.footer')


</body>
</html>