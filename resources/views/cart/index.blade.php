
<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.headerlink')
    
</head>

<body>
<div class="page-wrapper">
<header class="header header-6">
@include('include.headtop')
@include('include.headbottom')    
</header>
<!--========= End .header ============-->
<main class="main">
 <div class="page-header text-center" style="background-image: url('{{ $websiteConfig->breadcrumb }}')">
        		<div class="container">
        			<h1 class="page-title"> Cart</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=" ">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Cart</a></li>
                       
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->


  <div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-9">
                    <form action="{{ route('cart.updatecart') }}" method="POST">
                        @csrf
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach(session('cart', []) as $cartKey => $item)
                                    <tr>
                                        <td class="productcard-col">
                                            <div class="productcol">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                                                    </a>
                                                </figure>
                                                <h3 class="product-title">
                                                    <a href="#">{{ $item['name'] }}</a>
                                                </h3>
                                            </div>
                                        </td>
                                        <td class="price-col">
                                            {{ $displayCurrency->symbol }} {{ number_format($item['price'], 2) }}
                                        </td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input type="number"
                                                     name="quantities[{{ $cartKey }}]"
                                                       value="{{ $item['quantity'] }}"
                                                       min="1"
                                                       max="{{ $item['stock_quantity'] }}"
                                                       class="form-control"
                                                       required>
                                            </div>
                                        </td>
                                        <td class="total-col">
                                            {{ $displayCurrency->symbol }} {{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </td>
                                        <td class="remove-col">
                                            <a href="{{ route('cart.removecart', $cartKey) }}" class="btn-remove">
                                                <i class="icon-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="cart-action text-end mt-3">
                            <button type="submit" class="btn btn-outline-primary-2 btn-order">
                                <i class="fa-solid fa-shuffle"></i> Update Cart
                            </button>
                            <a href="{{ route('shop.index') }}" class="btn btn-outline-dark-2">
                                <span>Continue Shopping</span> <i class="icon-refresh"></i>
                            </a>
                        </div>
                    </form>
                </div><!-- End .col-lg-9 -->

                <!-- Cart Totals -->
                <aside class="col-lg-3">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">Cart Total</h3>
                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td>
                                        {{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}
                                    </td>
                                </tr>
                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td>
                                        {{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary-2 btn-order" style="padding: 10px;">
                            PROCEED TO CHECKOUT
                        </a>
                    </div>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->











 </main><!--End .main-->
@include('footer')   
@include('include/footerlink')
 

</body>
</html>