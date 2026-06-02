
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
								<h4 class="fw-bold">Edit product</h4>
							 
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
    

  <!-- Post URL link -->
<div class="alert alert-info mb-3 d-flex align-items-center justify-content-between">
    <div>
        Public URL: 
        <a href="{{ $publicLink }}" target="_blank">
            {{ $publicLink }}
        </a>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary ms-2" 
            onclick="navigator.clipboard.writeText('{{ $publicLink }}').then(() => {
                // Optional: replace alert with toast
                alert('Public URL copied to clipboard!');
            })">
        Copy Link
    </button>
</div>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Product Info -->
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name', $product->name) }}" required>
                </div>
            </div>

     
       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Short Description</label>
<textarea  id="editor" name="shortdescription">{{ old('description', $product->shortdescription) }}</textarea>
      </div>
      </div>


       <div class="col-md-12">
       <div class="mb-3">
    <label class="form-label">Product Description</label>
<textarea  id="editor2" name="description">{{ old('description', $product->description) }}</textarea>
      </div>
      </div>

        </div>
    </div>

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
                               value="{{ old('regular_price', $product->regular_price) }}" required>
                    </div>

                    <small class="text-muted">
                        Current: {{ $baseCurrency->symbol ?? '' }}{{ number_format($product->regular_price, 2) }}
                    </small>
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
                   value="{{ old('sale_price', $product->sale_price) }}">
        </div>

        <small class="text-muted d-block">
            Current: {{ $baseCurrency->symbol ?? '' }}{{ number_format($product->sale_price, 2) }}
        </small>

        <!-- Custom error BELOW small -->
        <small id="sale_price_error" class="text-danger d-none">
            Sale price should not be higher than regular price.
        </small>
    </div>
</div>


        </div></div></div>
    

    <!-- Inventory -->
    <div class="card mb-2">
        <div class="card-header"><strong>Inventory</strong></div>
        <div class="card-body">
            <div class="row">
                <!-- SKU -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input class="form-control" type="text" name="sku" value="{{ old('sku', $product->sku) }}" required>
                    </div>
                </div>

                <!-- Stock Status -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Stock Status</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stock_status" id="inStock" value="in_stock" {{ old('stock_status', $product->stock_status) === 'in_stock' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inStock">In stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stock_status" id="outStock" value="out_of_stock" {{ old('stock_status', $product->stock_status) === 'out_of_stock' ? 'checked' : '' }}>
                                <label class="form-check-label" for="outStock">Out of stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stock_status" id="onBackorder" value="on_backorder" {{ old('stock_status', $product->stock_status) === 'on_backorder' ? 'checked' : '' }}>
                                <label class="form-check-label" for="onBackorder">On backorder</label>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Stock Quantity -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input class="form-control" type="number" name="stock_quantity" min="0" value="{{ old('stock_quantity', $product->stock_quantity) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

 
 <!-- Attributes -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Attributes</label>
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
                                                           id="term-{{ $term->id }}"
                                                           {{ $product->attributeTerms->contains($term->id) ? 'checked' : '' }}>
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
                                               id="visible-{{ $attribute->id }}"
                                               {{ $product->attributeTerms->where('pivot.attribute_id', $attribute->id)->where('pivot.visible', true)->count() ? 'checked' : '' }}>
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
        </div>
    </div>
</div>




<div class="card mb-2">
    <div class="card-header">
        <strong>SEO</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">


                <div class="mb-3">
                    <label for="seo_keywords" class="form-label">Keywords</label>
                    <input type="text" class="form-control" id="seo_keywords" name="seo_keywords"
                           value="{{ old('seo_keywords', $product->seo_keywords) }}"
                           placeholder="e.g. watches, luxury, accessories">
                    <p class="text-muted small">Comma-separated keywords to help search engines understand your product.</p>
                </div>
 <div class="mb-3">
    <label class="form-label">SEO Title</label>
    <input type="text" name="seo_title" id="seoTitle" class="form-control"
           value="{{ old('seo_title', $product->seo_title) }}"
           placeholder="Enter SEO Title" maxlength="70">

    <p class="small mb-1">
        Keep it under 60–70 characters for best results.
        <span id="seoTitleCount" class="text-muted">0 / 70</span>
    </p>

    <div class="progress" style="height: 6px;">
        <div id="seoTitleProgress" class="progress-bar bg-success"
             role="progressbar" style="width: 0%;" aria-valuenow="0"
             aria-valuemin="0" aria-valuemax="70"></div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">SEO Description</label>
    <textarea name="seo_description" id="seoDescription" class="form-control"
              rows="3" maxlength="160">{{ old('seo_description', $product->seo_description) }}</textarea>

    <p class="small mb-1">
        Keep it under 160 characters for best results.
        <span id="seoDescriptionCount" class="text-muted">0 / 160</span>
    </p>

    <div class="progress" style="height: 6px;">
        <div id="seoDescriptionProgress" class="progress-bar bg-success"
             role="progressbar" style="width: 0%;" aria-valuenow="0"
             aria-valuemin="0" aria-valuemax="160"></div>
    </div>
</div>







<div class="mb-3">
<label class="form-label">Google SEO Web Preview</label>

<div class="product-seo-preview border p-3 rounded"
     style="max-width:600px; background:#fff; font-family:Arial, sans-serif;">
    <div class="mb-1" style="color:#006621; font-size:14px;">
        {{ url('/') }}/product-details/<span id="seo-preview-slug">{{ $product->slug }}</span>
    </div>

    <h3 id="seo-preview-title" style="color:#1a0dab; font-size:18px; margin:0; line-height:1.3;">
        {{ old('seo_title', $product->seo_title) ?: 'SEO Title Preview' }}
    </h3>

    <p id="seo-preview-description" style="color:#545454; font-size:14px; margin:0; line-height:1.4;">
        {{ old('seo_description', $product->seo_description) ?: 'SEO description preview will appear here.' }}
    </p>

    <small id="seo-preview-keywords" style="color:#70757a; font-size:12px;">
        {{ old('seo_keywords', $product->seo_keywords) ?: 'Keywords preview will appear here' }}
    </small>
</div>



</div>

            </div>
        </div>
    </div>
</div>




							
</div>
<!--====== end of  col-sm-5 =========--->

<div class="col-sm-4">


    <!-- Status -->
    <div class="card mb-2">
        <div class="card-header">
            <strong>Status</strong>
        </div>
        <div class="card-body">
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-active" value="active"
                       {{ old('status', $product->status) === 'active' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-active">Active</label>
            </div>


            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-pending" value="pending"
                       {{ old('status', $product->status) === 'pending' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-pending">Pending Review</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-draft" value="draft"
                       {{ old('status', $product->status) === 'draft' ? 'checked' : '' }}>
                <label class="form-check-label" for="status-draft">Draft</label>
            </div>

        </div>
    </div>








    <!-- Publish -->
    <div class="card mb-2">
        <div class="card-header">
            <strong>Publish</strong>
        </div>
        <div class="card-body">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="publish_type" id="publish-now" value="immediately"
                       {{ old('publish_type', $product->publish_type) === 'immediately' ? 'checked' : '' }}>
                <label class="form-check-label" for="publish-now">Immediately</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="publish_type" id="publish-schedule" value="schedule"
                       {{ old('publish_type', $product->publish_type) === 'schedule' ? 'checked' : '' }}>
                <label class="form-check-label" for="publish-schedule">Schedule</label>
            </div>

            <div class="mt-2 {{ old('publish_type', $product->publish_type) === 'schedule' ? '' : 'd-none' }}" id="publish-date-wrapper">
                <label for="publish-date">Publish Date:</label>
               <input type="datetime-local" class="form-control" name="publish_date" id="publish-date"
       value="{{ old('publish_date', $product->publish_date ? date('Y-m-d\TH:i', strtotime($product->publish_date)) : '') }}">

            </div>

            <div class="row mt-3">
                <div class="col-lg-9">
                    <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Product</button>
                </div>
            </div>


        </div>
    </div>






<div class="card mb-2">
    <div class="card-header">
        <strong>Featured Image</strong>
    </div>
    <div class="card-body">
        <div id="featured-preview" class="mb-2">
            @if($product->featured_image)
                <img src="{{ asset($product->featured_image) }}" 
                     width="100" height="100" 
                     alt="{{ $product->name }}" class="img-thumbnail">
            @endif
        </div>

        <div>
            <label class="btn btn-link p-0" for="featured_image">
                Change featured image
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
<ul id="product-gallery-preview" class="d-flex flex-wrap list-unstyled">
    @foreach($product->galleries as $gallery)
        <li class="me-2 mb-2 position-relative" id="gallery-{{ $gallery->id }}">
            <img src="{{ asset($gallery->file_path) }}" 
                 width="100" height="100" 
                 alt="{{ $product->name }} gallery" 
                 class="img-thumbnail">

            <button type="button" 
                    class="btn btn-sm btn-danger position-absolute top-0 end-0 delete-gallery" 
                    data-id="{{ $gallery->id }}">
                ×
            </button>
        </li>
    @endforeach
</ul>
        <div>
            <label class="btn btn-link p-0" for="gallery">
                Add or replace gallery images
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
                                   id="cat-{{ $category->id }}"
                                   {{ $product->categories->contains($category->id) ? 'checked' : '' }}>
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
                                                   id="cat-{{ $child->id }}"
                                                   {{ $product->categories->contains($child->id) ? 'checked' : '' }}>
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
                <input type="checkbox" name="brands[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}"
                       {{ $product->storeBrands->contains($brand->id) ? 'checked' : '' }}>
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
    document.querySelectorAll('.delete-gallery').forEach(button => {
        button.addEventListener('click', function () {
            const galleryId = this.dataset.id;
            const productId = "{{ $product->id }}";

            if (!confirm('Delete this image?')) return;

            fetch(`/admin/products/${productId}/gallery/${galleryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`gallery-${galleryId}`).remove();
                } else {
                    alert('Failed to delete image.');
                }
            })
            .catch(() => alert('Error deleting image.'));
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateProgress(inputId, countId, progressId, max) {
        const input = document.getElementById(inputId);
        const count = document.getElementById(countId);
        const progress = document.getElementById(progressId);

        function refresh() {
            const length = input.value.length;
            count.textContent = `${length} / ${max}`;
            const percent = Math.min((length / max) * 100, 100);
            progress.style.width = percent + '%';
            progress.setAttribute('aria-valuenow', length);

            if (length > max) {
                progress.classList.remove('bg-success');
                progress.classList.add('bg-danger');
            } else {
                progress.classList.remove('bg-danger');
                progress.classList.add('bg-success');
            }
        }

        input.addEventListener('input', refresh);
        refresh(); // run once on load
    }

    // Progress bars
    updateProgress('seoTitle', 'seoTitleCount', 'seoTitleProgress', 70);
    updateProgress('seoDescription', 'seoDescriptionCount', 'seoDescriptionProgress', 160);

    // Preview updates
    const titleInput = document.getElementById('seoTitle');
    const descInput  = document.getElementById('seoDescription');
    const keywordsInput = document.getElementById('seo_keywords');

    const previewTitle = document.getElementById('seo-preview-title');
    const previewDesc  = document.getElementById('seo-preview-description');
    const previewKeywords = document.getElementById('seo-preview-keywords');

    if (titleInput) {
        titleInput.addEventListener('input', () => {
            previewTitle.textContent = titleInput.value || 'SEO Title Preview';
        });
    }

    if (descInput) {
        descInput.addEventListener('input', () => {
            previewDesc.textContent = descInput.value || 'SEO description preview will appear here.';
        });
    }

    if (keywordsInput) {
        keywordsInput.addEventListener('input', () => {
            previewKeywords.textContent = keywordsInput.value || 'Keywords preview will appear here';
        });
    }
});
</script>





@include('admin.include.footer')

 



</body>
</html>