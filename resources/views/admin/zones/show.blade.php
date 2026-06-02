
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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Shipping Zone: {{ $shippingZone->name }}</h4>
                               
					 
							</div>
						</div>
					 
			 
 
					</div>               

                    
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
 
 @if($shippingZone->locations->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shippingZone->locations as $loc)
                <tr>
                    <td>{{ $loc->country }}</td>
                    <td>{{ $loc->state }}</td>
                    <td>{{ $loc->city }}</td>
                    <td>{{ $loc->postal_code }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.zones.location.destroy', [$shippingZone, $loc]) }}" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this location?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No locations added yet.</p>
@endif


<form method="POST" action="{{ route('admin.zones.location.store', $shippingZone) }}">
    @csrf
            <div class="row g-2">

                 <div class="col"><input type="text" name="country" class="form-control" placeholder="Country"></div>
                <div class="col"><input type="text" name="state" class="form-control" placeholder="State"></div>
                <div class="col"><input type="text" name="city" class="form-control" placeholder="City"></div>
                <div class="col"><input type="text" name="postal_code" class="form-control" placeholder="Postal Code"></div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Add Location</button>
                </div>
            </div>
        </form>
 




</div></div></div></div>

<!-- Methods -->
<div class="card mb-4">
    <div class="card-header"><strong>Methods</strong></div>
    <div class="card-body">
@if($shippingZone->methods->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Method Type</th>
                <th>Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shippingZone->methods as $method)
                <tr>
                    <td>{{ ucfirst($method->method_type) }}</td>
                    <td>
                        @if($method->rate)
                            ₦{{ number_format($method->rate, 2) }}
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.zones.method.destroy', [$shippingZone, $method]) }}" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this method?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No methods added yet.</p>
@endif


<form method="POST" action="{{ route('admin.zones.method.store', $shippingZone) }}">
    @csrf
            <div class="row g-2">
                <div class="col">
                    <select name="method_type" class="form-select">
                        <option value="flat_rate">Flat Rate</option>
                        <option value="free_shipping">Free Shipping</option>
                        <option value="local_pickup">Local Pickup</option>
                    </select>
                </div>
                <div class="col">
                    <input type="number" step="0.01" name="rate" class="form-control" placeholder="Rate">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Add Method</button>
                </div>
            </div>
        </form>
    </div>
</div>

<a href="{{ route('admin.zones.index') }}" class="btn btn-secondary">Back to Zones</a>




	</div></div>
    <!--=======end of content and page-wrapper========-->

     
 
	@include('admin.include.footer')
</html>