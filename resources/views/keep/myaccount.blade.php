
<!DOCTYPE html>
<html class="no-js" lang="en">


@include('headerlink')
<body>

 @include('head')
<main class="main">
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                
                    <span></span> Account
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fa-solid fa-bag-shopping"></i> Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"> <i class="fa-solid fa-bag-shopping"></i> Track Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fa-sharp fa-solid fa-location-dot"></i> Shipping Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fa-solid fa-lock"></i> Security Settings</a>
                                        </li>
<li class="nav-item">
    <a class="nav-link" href="#" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</li>

<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
    @csrf
</form>


                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">                                                 
@auth
        Hello {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!
    @else
        
    @endauth
</h5>
</div>
<div class="card-body">
<p> My profile </p>
<form method="POST" action="{{ route('profile.update') }}">
    @csrf

 <div class="row">
<div class="col-md-6">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required placeholder="First Name">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required placeholder="Last Name">
    </div></div>
<div class="col-md-6">
    <div class="form-group">
        <label>Email Address <small>(cannot be changed)</small></label>
        <input readonly type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Email Address">
    </div></div>

    <div class="col-md-6">
    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required placeholder="Phone Number">
    </div></div>
 </div>
    <div class="form-group">
        <button type="submit" class="btn btn-fill-out btn-block hover-up">Update Profile</button>
    </div>
</form>

</div>
</div>
</div>
<!--=======================end of Dashbosr content ===========-->

<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Your Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->order_no }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                               <td>
    @if($order->status === 'pending')
        <span class="badge bg-warning text-dark">Pending</span>
    @elseif($order->status === 'confirmed')
        <span class="badge bg-success">Confirmed</span>
    @elseif($order->status === 'cancelled')
        <span class="badge bg-danger">Cancelled</span>
    @else
        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
    @endif
</td>

                                <td>
                                    {{ $displayCurrency->symbol }}
                                    {{ number_format($order->total, 2) }}
                                    for {{ $order->items->sum('quantity') }} item(s)
                                </td>
                                <td>
                                    <!-- Button triggers modal -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                        View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Place modals OUTSIDE the table -->
@foreach($orders as $order)
<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order #{{ $order->order_no }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
          <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

{{-- Show subtotal, discount, and final total --}}
<p><strong>Subtotal:</strong> {{ $displayCurrency->symbol }} 
    {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 2) }}
</p>

@if($order->discount > 0)
    <p><strong>Coupon Discount ({{ $order->coupon_code }}):</strong> 
        -{{ $displayCurrency->symbol }} {{ number_format($order->discount, 2) }}
    </p>
@endif

<p><strong>Total:</strong> {{ $displayCurrency->symbol }} {{ number_format($order->total, 2) }}</p>

                <h6>Items:</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item->product->featured_image) }}" alt="{{ $item->product->name }}" width="60">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $displayCurrency->symbol }} {{ number_format($item->price, 2) }}</td>
                                <td>{{ $displayCurrency->symbol }} {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h6>Shipping Address:</h6>
<table class="table table-sm">
    <tr>
        <th>Full Name</th>
        <td>{{ optional($order->shippingAddress)->fullname ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ optional($order->shippingAddress)->phone ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ optional($order->shippingAddress)->address ?? 'N/A' }}</td>
    </tr>
</table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
 
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Orders tracking</h5>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id" placeholder="Found in your order confirmation email" type="text" class="square">
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email" placeholder="Email you used during checkout" type="email" class="square">
                                                            </div>
                                                            <button class="submit submit-auto-width" type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



<!--==================SHIPPING ADDRESS ===========----------->

<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
<div class="row">
<div class="col-lg-6 mb-10">
<button type="button" class="submit submit-auto-width" data-bs-toggle="modal" data-bs-target="#addShippingModal">
    Add Shipping Address
</button></div>
<div class="col-lg-12">
@foreach($user->shippingAddresses as $address)
  <div class="card mb-3">
       <div class="card-header">
<h5>Shipping  Address</h5>
</div>
    <div class="card-body">
      <p><strong>{{ $address->fullname }}</strong></p>
      <p>{{ $address->phone }}</p>
      <p>{{ $address->address }}</p>

      <!-- Edit Trigger -->
      <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editShippingModal{{ $address->id }}">
        Edit
      </button>

      <!-- Delete Trigger -->
      <form method="POST" action="{{ route('shipping.delete', $address->id) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
      </form>
    </div>
  </div>
@include('editshippingaddressmodal')
  
@endforeach
</div>
</div>
@include('shippingaddressmodal')
                                    </div>
                                    
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Security Settings </h5>
                                            </div>
                                            <div class="card-body">
                                          
<form method="POST" action="{{ route('profile.changePassword') }}">
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label>Current Password <span class="required">*</span></label>
            <input required class="form-control square" name="password" type="password">
        </div>
        <div class="form-group col-md-12">
            <label>New Password <span class="required">*</span></label>
            <input required class="form-control square" name="npassword" type="password">
        </div>
        <div class="form-group col-md-12">
            <label>Confirm Password <span class="required">*</span></label>
            <input required class="form-control square" name="cpassword" type="password">
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-fill-out submit">Save</button>
        </div>
    </div>
</form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</main>


    
 
@include('footer')
 </body>

</html>