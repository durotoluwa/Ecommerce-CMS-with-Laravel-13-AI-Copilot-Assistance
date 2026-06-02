
<!DOCTYPE html>
<html class="no-js" lang="en">


@include('headerlink')
<body>
@include('head')
<main class="main">
     <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> CheckOut
                </div>
            </div>
        </div>

 
 <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">


  <!--============================ Already have an account area ===================---->

               {{-- Show login form only if customer is NOT logged in --}}
@guest('customer')
<div class="col-lg-6 mb-sm-15">
    <div class="toggle_info">
        <span>
            <i class="fi-rs-user mr-10"></i>
            <span class="text-muted">Already have an account?</span>
            <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">
                Click here to login
            </a>
        </span>
    </div>
    <div class="panel-collapse collapse login_form" id="loginform">
        <div class="panel-body">
            <p class="mb-30 font-sm">
                If you have shopped with us before, please enter your details below.
                If you are a new customer, please proceed to the Billing &amp; Shipping section.
            </p>
            <form method="POST" action="{{ route('user.login') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="login_footer form-group">
                    <div class="custome-checkbox">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember"><span>Remember me</span></label>
                    </div>
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md">Log in</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endguest




                    <!--============================ coupon area ===================---->
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                     <form action="{{ route('checkout.applyCoupon') }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="coupon_code" placeholder="Enter Coupon Code..." class="form-control" required>
    </div>
    <div class="form-group">
        <button class="btn btn-md btn-primary">Apply Coupon</button>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>


 
<form method="POST" action="{{ route('checkout.storeOrder') }}" id="checkoutForm">
    @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   
                     {{-- If customer is logged in --}}
@auth('customer')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Shipping Address</h5>
            </div>
            <div class="card-body">
                {{-- Loop through saved addresses --}}
                @foreach(Auth::guard('customer')->user()->shippingAddresses as $address)
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" 
                               name="shipping_address_id" 
                               id="address{{ $address->id }}" 
                               value="{{ $address->id }}" 
                               {{ $loop->first ? 'checked' : '' }}>
                        <label class="form-check-label" for="address{{ $address->id }}">
                            <strong>{{ $address->fullname }}</strong><br>
                            {{ $address->address }}<br>
                            {{ $address->phone }}
                        </label>
                    </div>
                @endforeach

                {{-- Add new address button --}}
                <button type="button" class="btn btn-link p-0 m-0 align-baseline" 
                        style="color:white; text-decoration:none; padding:5px;" 
                        data-bs-toggle="modal" data-bs-target="#addShippingModal">
                    + Add New Address
                </button>

                {{-- Order notes --}}
                <div class="mt-4">
                    <label for="order_note">Order Notes (Optional)</label>
                    <textarea name="order_note" id="order_note" class="form-control" rows="3"
                              placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                </div>
            </div>
        </div>
    </div>

 
@endauth

{{-- If customer is NOT logged in, show billing form --}}
@guest('customer')
    @include('checkout.partials.billing-form')
@endguest




                    </div>


                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                          <div class="table-responsive order_table text-center">
 <table class="table">
    <thead>
        <tr>
            <th colspan="2">Product</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach(session('cart', []) as $item)
            <tr>
                <td class="image product-thumbnail">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                </td>
                <td>
                    <h5>{{ $item['name'] }}</h5>
                    <span class="product-qty">x {{ $item['quantity'] }}</span>
                </td>
                <td>
                    {{ $displayCurrency->symbol }} {{ number_format($item['price'] * $item['quantity'], 2) }}
                </td>
            </tr>
        @endforeach

        {{-- Subtotal --}}
        <tr>
            <th>SubTotal</th>
            <td class="product-subtotal" colspan="2">
                {{ $displayCurrency->symbol }}
                {{ number_format(
                    collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['quantity']),
                    2
                ) }}
            </td>
        </tr>

        {{-- Coupon discount if applied --}}
        @if(session('coupon'))
            <tr>
                <th>Coupon ({{ session('coupon') }})</th>
                <td colspan="2" class="product-subtotal text-success">
                    - {{ $displayCurrency->symbol }} {{ number_format(session('discount'), 2) }}
                    <form action="{{ route('checkout.removeCoupon') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger ms-2">Remove</button>
                    </form>
                </td>
            </tr>
        @endif

        {{-- Shipping --}}
     

        {{-- Final total --}}
        <tr>
            <th>Total</th>
            <td colspan="2" class="product-subtotal">
                <span class="font-xl text-brand fw-900">
                    {{ $displayCurrency->symbol }}
                    {{ number_format(session('final_total', 
                        collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['quantity'])
                    ), 2) }}
                </span>
            </td>
        </tr>
    </tbody>
</table>


</div>

<div class="bt-1 border-color-1 mt-30 mb-30"></div>
  

 <!-- Payment Methods -->
    <div class="payment_method">
        <div class="mb-25">
            <h5>Payment Method</h5>
        </div>
        <div class="payment_option">

            <!-- Bank Transfer -->
            <div class="custome-radio mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                <label class="form-check-label" for="bank_transfer">Bank Transfer</label>
                <div class="mt-2 collapse" id="bankTransferDetails">
                    <p class="text-muted">Please transfer to the following account:</p>
                    <ul class="list-unstyled">
                        <li><strong>Bank:</strong> Example Bank</li>
                        <li><strong>Account Name:</strong> My Shop Ltd</li>
                        <li><strong>Account Number:</strong> 1234567890</li>
                    </ul>
                </div>
            </div>

            <!-- Paystack -->
 
@if($paystack->isActive())
    <div class="custome-radio mb-3">
        <input class="form-check-input" type="radio" name="payment_method" id="paystack" value="paystack">
        <label class="form-check-label" for="paystack">Pay with Paystack</label>
        <div class="mt-2 collapse" id="paystackDetails">
            <p class="text-muted">Secure payment via Paystack.</p>
        </div>
    </div>
@endif

 

            <!-- Pay on Delivery -->
            <div class="custome-radio mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="pay_on_delivery" value="pay_on_delivery">
                <label class="form-check-label" for="pay_on_delivery">Pay on Delivery</label>
                <div class="mt-2 collapse" id="podDetails">
                    <p class="text-muted">You will pay in cash or POS when your order is delivered.</p>
                </div>
            </div>

        </div>
    </div>









    <!-- Terms -->
<div class="form-group mt-3">
    <div class="custome-checkbox">
        <input class="form-check-input" type="checkbox" id="terms">
        <label class="form-check-label" for="terms">
            I have read and agree to the website Terms and Conditions *
        </label>
    </div>
</div>

 
<button type="submit" class="btn btn-md btn-danger mt-3" id="placeOrderBtn" disabled>
    <i class="fi-rs-credit-card mr-10"></i> Place Order
</button>



</form>

   {{-- Add Shipping Address Modal --}}
    <div class="modal fade" id="addShippingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('shipping.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Shipping Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



                    </div>
                </div>
            </div>
        </section>


</main>


  
<script>
    const termsCheckbox = document.getElementById('terms');
    const placeOrderBtn = document.getElementById('placeOrderBtn');

    termsCheckbox.addEventListener('change', function() {
        placeOrderBtn.disabled = !this.checked;
    });
</script>

 




 
@include('footer')
 </body>

</html>