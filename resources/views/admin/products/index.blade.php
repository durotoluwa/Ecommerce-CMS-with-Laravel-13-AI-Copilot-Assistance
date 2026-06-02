
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
								<h4 class="fw-bold">All products</h4>
							 
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

<div class="card">
<div class="card-body">
 

<div class="table-responsive product-list">
<form id="bulk-delete-form" action="{{ route('admin.products.bulkDelete') }}" method="POST">
    @csrf
    @method('DELETE')

    <div class="table-responsive">
        <table id="products-table" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <!-- Select All checkbox -->
                    <th><input type="checkbox" id="select-all"></th>
                    <th>S/N</th>
                    <th>Product</th>
                    
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="product-checkbox">
                        </td>
                        <td>{{ $index + 1 }}</td>
                          <td>
                    <div class="productimgname">
    <a href="#" class="product-img stock-img">
        <img src="{{ asset($product->featured_image) }}" width="30" height="30" alt="{{ $product->name }}">
    </a>
    <a href="#">{{ Str::limit($product->name, 22) }}</a>
</div>

                    </td>
                      
                        <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                        <td>{{ $product->storeBrands->pluck('name')->implode(', ') }}</td>
                      <td>
    @if($product->sale_price)
        <span class="text-muted text-decoration-line-through">
            {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_regular_price, 2) }}
        </span><br>
        <span class="fw-bold text-dark">
            {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_sale_price, 2) }}
        </span>
    @else
        <span class="fw-bold text-dark">
            {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_regular_price, 2) }}
        </span>
    @endif
</td>
                        <td>
                            @if ($product->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif ($product->status === 'draft')
                                <span class="badge bg-danger">Draft</span>
                            @else
                                <span class="badge bg-secondary">Other</span>
                            @endif
                        </td>
                      <td>
    <a href="javascript:void(0)" 
       class="toggle-featured" 
       data-id="{{ $product->id }}">
        @if($product->featured)
            <i class="fas fa-star text-warning"></i> <!-- bold star -->
        @else
            <i class="far fa-star text-muted"></i> <!-- outline star -->
        @endif
    </a>
</td>
                        <td>
                          <a class="me-2 edit-icon p-2" href="{{ route('admin.products.show', $product->id) }}">
    <i data-bs-toggle="tooltip" title="View Product" data-feather="eye"></i>
</a>


                        <a class="me-2 p-2" href="{{ route('admin.products.edit', $product->id) }}">
    <i data-bs-toggle="tooltip" title="Edit Product" data-feather="edit"></i>
</a>


                            <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#deleteproduct{{ $product->id }}">
                                <i data-bs-toggle="tooltip" title="Delete Product" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bulk delete button -->
    <button type="submit" class="btn btn-danger mt-3">
        Delete Selected
    </button>
</form>


</div>

</div>


</div></div> <!----end of card-body--->
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


<script>

document.querySelectorAll('.toggle-featured').forEach(el => {
    el.addEventListener('click', function() {
        let productId = this.dataset.id;

        fetch(`/admin/products/${productId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (data.featured) {
                    this.innerHTML = '<i class="fas fa-star text-warning"></i>';
                } else {
                    this.innerHTML = '<i class="far fa-star text-muted"></i>';
                }
            }
        });
    });
});

document.getElementById('select-all').addEventListener('change', function() {
    document.querySelectorAll('.product-checkbox').forEach(cb => cb.checked = this.checked);
});

 


</script>






	@include('admin.include.footer')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#products-table').DataTable({
        searching: true,   // enables search box
        paging: true,      // enables pagination
        ordering: true     // enables column sorting
    });
});
</script>

</body>
</html>