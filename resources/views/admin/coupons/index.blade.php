
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
 
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
								<h4 class="fw-bold">All Coupon</h4>
							 
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
        <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-3">Add Coupon</a>
<div class="table-responsive product-list">
    <table class="table datanew">
        <thead>
            <tr>
                     <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Expiry Date</th>
                        <th>Usage Limit</th>
                        <th>Times Used</th>
                        <th>Status</th>
                        <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @forelse($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>
                                @if($coupon->type === 'fixed')
                                    <span class="badge bg-info">Fixed</span>
                                @else
                                    <span class="badge bg-primary">Percent</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->type === 'fixed')
                                    ₦{{ number_format($coupon->value, 2) }}
                                @else
                                    {{ $coupon->value }}%
                                @endif
                            </td>
                            <td>{{ $coupon->expiry_date ? $coupon->expiry_date->format('M d, Y') : 'No expiry' }}</td>
                  <td>{{ $coupon->expiry_date ? $coupon->expiry_date->format('M d, Y') : 'No expiry' }}</td>

                            <td>{{ $coupon->times_used }}</td>
                            <td>
                                @if(($coupon->expiry_date && $coupon->expiry_date < now()) || 
                                    ($coupon->usage_limit && $coupon->times_used >= $coupon->usage_limit))
                                    <span class="badge bg-danger">Expired</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete this coupon?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No coupons found.</td>
                        </tr>
                    @endforelse
        </tbody>
    </table>
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

</script>




	@include('admin.include.footer')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

</body>
</html>