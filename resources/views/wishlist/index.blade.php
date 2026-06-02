
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
        			<h1 class="page-title">Wishlist</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=" ">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Wishlist</a></li>
                       
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->


 <div class="page-content">
            	<div class="container">
					<table class="table table-wishlist table-mobile">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Stock Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    @if($wishlists->isEmpty())

        <tr>
            <td colspan="5" class="text-center">
                No items in your wishlist yet.
            </td>
        </tr>

    @else

        @foreach($wishlists as $wishlist)

            <tr>

                <!-- PRODUCT -->
                <td class="productcard-col">

                    <div class="productcol">

                        <figure class="product-media">

                            <a href="#">

                                <img
                                    src="{{ asset($wishlist->product->featured_image) }}"
                                    alt="{{ $wishlist->product->name }}">

                            </a>

                        </figure>

                        <h3 class="product-title">

                            <a href="#">

                                {{ $wishlist->product->name }}

                            </a>

                        </h3>

                    </div>

                </td>

                <!-- PRICE -->
                <td class="price-col">

                    @if(
                        $wishlist->product->converted_sale_price &&
                        $wishlist->product->converted_regular_price
                    )

                        @php

                            $discount =
                                100 - (
                                    ($wishlist->product->converted_sale_price
                                    / $wishlist->product->converted_regular_price)
                                    * 100
                                );

                        @endphp

                        <span class="text-danger">

                            {{ $displayCurrency->symbol }}

                            {{ number_format($wishlist->product->converted_sale_price, 2) }}

                        </span>

                        <del class="text-muted">

                            {{ $displayCurrency->symbol }}

                            {{ number_format($wishlist->product->converted_regular_price, 2) }}

                        </del>

                        <small class="text-success">

                            (-{{ number_format($discount, 0) }}%)

                        </small>

                    @else

                        {{ $displayCurrency->symbol }}

                        {{ number_format($wishlist->product->converted_regular_price, 2) }}

                    @endif

                </td>

                <!-- STOCK -->
                <td class="stock-col">

                    @if($wishlist->product->stock_quantity > 0)

                        <span class="in-stock">

                            In stock

                        </span>

                    @else

                        <span class="out-of-stock">

                            Out of stock

                        </span>

                    @endif

                </td>

                <!-- ADD TO CART -->
                <td class="action-col">

                    @if($wishlist->product->stock_quantity > 0)

                        <form
                            action="{{ route('wishlist.moveToCart', $wishlist->product->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-block btn-outline-primary-2">

                                <i class="icon-cart-plus"></i>

                                Add to Cart

                            </button>

                        </form>

                    @else

                        <button
                            class="btn btn-block btn-outline-primary-2 disabled"
                            disabled>

                            Out of Stock

                        </button>

                    @endif

                </td>

                <!-- REMOVE -->
                <td class="remove-col">

                    <form
                        action="{{ route('wishlist.remove', $wishlist->product->id) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn-remove">

                            <i class="icon-close"></i>

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

    @endif

    </tbody>

</table>
                    <!---
	            	<div class="wishlist-share">
	            		<div class="social-icons social-icons-sm mb-2">
	            			<label class="social-label">Share on:</label>
	    					<a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
	    					<a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
	    					<a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
	    					<a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
	    					<a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
	    				</div>   
	            	</div>  End .wishlist-share -->
            	</div><!-- End .container -->
            </div><!-- End .page-content -->











 </main><!--End .main-->
@include('footer')   
@include('include/footerlink')
 

</body>
</html>