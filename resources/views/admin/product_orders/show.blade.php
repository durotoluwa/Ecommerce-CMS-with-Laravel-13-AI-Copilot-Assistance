
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
								<h4 class="fw-bold">Order Details </h4>
							 
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
 
<h2>Order #{{ $order->order_no }}</h2>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th>Customer</th>
            <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $order->customer->email }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($order->status === 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($order->status === 'confirmed')
                    <span class="badge bg-success">Confirmed</span>
                @elseif($order->status === 'processing')
                    <span class="badge bg-info text-dark">Processing</span>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                @endif
            </td>
        </tr>
        @if($order->discount > 0)
        <tr>
            <th>Coupon Discount</th>
            <td>
                <strong>({{ $order->coupon_code }})</strong> 
                -{{ $displayCurrency->symbol }} {{ number_format($order->discount, 2) }}
            </td>
        </tr>
        @endif
        <tr>
            <th>Total</th>
            <td>{{ $displayCurrency->symbol }}{{ number_format($order->total, 2) }}</td>
        </tr>
    </tbody>
</table><br><br>


{{-- Shipping Address --}}
<h3>Shipping Details</h3><br>
<table class="table table-bordered">
    <tbody>

         <tr>
            <th>Name</th>
            <td>{{ $order->shippingAddress->fullname ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Street</th>
            <td>{{ $order->shippingAddress->address ?? 'N/A' }}</td>
        </tr>
       
        <tr>
            <th>Phone</th>
            <td>{{ $order->shippingAddress->phone ?? 'N/A' }}</td>
        </tr>
    </tbody>
</table><br><br>


<h3>Items</h3>
<table class="table table-striped">
    <thead>
        <tr>
              <th> </th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                   <td><img src="{{ asset($item->product->featured_image) }}" width="30" height="30"></td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $displayCurrency->symbol }}{{ number_format($item->price, 2) }}</td>
                <td>{{ $displayCurrency->symbol }}{{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


</div></div>
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