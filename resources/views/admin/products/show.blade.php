
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
								<h4 class="fw-bold">Preview products</h4>
							 
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


   <div class="col-lg-8 col-sm-12">
<div class="card">
<div class="card-body">

<div class="productdetails">
    <ul class="product-bar">
 <li>
    <h4>Product name</h4>
    <h6>{{ $productdetails->name }}</h6>
</li>

<li>
    <h4>Category</h4>
    <h6>
        @foreach($productdetails->categories as $category)
            {{ $category->name }}@if(!$loop->last), @endif
        @endforeach
    </h6>
</li>

<li>
    <h4>Brand</h4>
    <h6>
        @foreach($productdetails->storeBrands as $brand)
            {{ $brand->name }}@if(!$loop->last), @endif
        @endforeach
    </h6>
</li>

@php
    // Group attributeProducts by attribute name
    $groupedAttributes = $productdetails->attributeProducts->groupBy(function($attrProd) {
        return $attrProd->attribute->name;
    });
@endphp

@foreach($groupedAttributes as $attributeName => $attrProds)
    <li>
        <h4>{{ ucfirst($attributeName) }}</h4>
        <h6>
            {{ $attrProds->map(fn($ap) => $ap->term->name)->implode(', ') }}
        </h6>
    </li>
@endforeach



<li>
    <h4>Product SKU</h4>
    <h6>{{ $productdetails->sku }}</h6>
</li>

<li>
    <h4>Stock Unit</h4>
    <h6>{{ $productdetails->stock_quantity }}</h6>
</li>

<li>
    <h4>Regular Price</h4>
    <h6>
        {{ $displayCurrency->symbol }}
        {{ number_format($productdetails->converted_regular_price, 2) }}
    </h6>
</li>

<li>
    <h4>Sale Price</h4>
    <h6>
        {{ $displayCurrency->symbol }}
        {{ number_format($productdetails->converted_sale_price, 2) }}
    </h6>
</li>


<li>
    <h4>Status</h4>
    <h6>
    @if ($productdetails->status === 'active')
        <span class="badge bg-success">Active</span>
    @elseif ($productdetails->status === 'draft')
        <span class="badge bg-danger">Draft</span>
    @elseif ($productdetails->status === 'pending')
        <span class="badge bg-warning text-dark">Pending</span>
    @else
        <span class="badge bg-secondary">Unknown</span>
    @endif
    </h6>
</li>
<li>
    <h4>Publish date Created</h4>
    <h6>{{ $productdetails->created_at->format('Y-m-d H:i') }}</h6>
</li>
<li>
    <h4>Short Description</h4>
    <h6>{!! $productdetails->shortdescription !!}</h6>
</li>




<li>
    <h4>Product Description</h4>
    <h6>{!!$productdetails->description !!}</h6>
</li>

    </ul>
    </div>




</div></div> <!----end of card-body--->
</div><!----end col-8---->



<div class="col-lg-4 col-sm-12">

<div class="card">
    <div class="card-body">
        <h4>Edit Product</h4><br>
        <div class="row mt-3">
            <div class="col-lg-9">
                <a href="{{ route('admin.products.edit', $productdetails->id) }}" 
                   class="btn btn-sm btn-primary mb-4">
                    Edit Product
                </a>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <h4>Featured Image</h4><br>
        @if($productdetails->featured_image)
            <img src="{{ asset($productdetails->featured_image) }}" 
                 alt="{{ $productdetails->name }}" 
                 class="img-fluid rounded border" 
                 style="max-width: 250px;">
        @else
            <p class="text-muted">No featured image uploaded.</p>
        @endif
    </div>
</div> <!-- end of card-body -->


<div class="card">
    <div class="card-body">
        <h4>Product Gallery</h4><br>
        @if($productdetails->galleries->count())
            <div class="d-flex flex-wrap">
                @foreach($productdetails->galleries as $gallery)
                    <img src="{{ asset($gallery->file_path) }}"
                         alt="{{ $productdetails->name }}"
                         class="img-thumbnail me-2 mb-2"
                         style="width: 120px; height: 120px; object-fit: cover;">
                @endforeach
            </div>
        @else
            <p class="text-muted">No gallery images available.</p>
        @endif
    </div>
</div>



</div><!----end col-4---->

</div><!--====== end of roe =========--->






	</div></div></div>
    <!--=======end of content and page-wrapper========-->

    

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


<script>
$(document).ready(function () {

    // Toggle attribute terms block
    $('.toggle-terms').on('click', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        $(target).toggleClass('d-none');
    });

    // Select all
    $('.select-all').on('click', function () {
        let target = $(this).data('target');
        $(target).find('input[type="checkbox"]').prop('checked', true);
    });

    // Select none
    $('.select-none').on('click', function () {
        let target = $(this).data('target');
        $(target).find('input[type="checkbox"]').prop('checked', false);
    });

    // Create new attribute term
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
    let termHtml = `
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

    $(`#attribute-${attributeId} .term-list`).append(termHtml);
},
            error: function (xhr) {
                console.log(xhr.responseText);
                alert('Server error while creating term');
            }
        });
    });

});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const scheduleRadio = document.getElementById('publish-schedule');
    const nowRadio = document.getElementById('publish-now');
    const dateWrapper = document.getElementById('publish-date-wrapper');

    function toggleDate() {
        if (scheduleRadio.checked) {
            dateWrapper.classList.remove('d-none');
        } else {
            dateWrapper.classList.add('d-none');
        }
    }

    scheduleRadio.addEventListener('change', toggleDate);
    nowRadio.addEventListener('change', toggleDate);
});
</script>



 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const preview = document.getElementById('product-gallery-preview');

    // Enable drag & drop reordering
    new Sortable(preview, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function (evt) {
            // Capture new order if needed
            const order = Array.from(preview.children).map(li => li.dataset.index);
            console.log('New order:', order);
            // You can send `order` back to your backend via AJAX
        }
    });

    // Remove image
    preview.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('li').remove();
        }
    });
});
</script>




	@include('admin.include.footer')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

</body>
</html>