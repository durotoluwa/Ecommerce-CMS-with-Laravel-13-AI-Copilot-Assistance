  <div class="sticky-bar">
        <div class="container">
            <div class="row">


                
                <div class="col-6">
                    <figure class="product-media">
                  <a href="{{ route('product.details', $product->id) }}">
  <a href="{{ route('product.details', $product->slug) }}">
    @php
        $imagePath = !empty($product->featured_image)
            ? asset($product->featured_image)
            : asset('admin/assets/image/productimage.jpg');
    @endphp

    <img src="{{ $imagePath }}" 
         alt="{{ $product->name }}">
</a>


                    </figure><!-- End .product-media -->
                    <h4 class="product-title"><a href=" ">{{ $product->name }}</a></h4><!-- End .product-title -->
                </div><!-- End .col-6 -->

                <div class="col-6 justify-content-end">
                   <div class="product-price">
                                      <span class="text-brand" style="margin-right: 10px;">
            {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_regular_price, 2) }}
        </span>   
@if($product->converted_sale_price)
     
            <span class="old-price font-md ml-15">
                {{ $displayCurrency->symbol }}
                {{ number_format($product->converted_sale_price, 2) }}
            </span>
          @endif
  </div><!-- End .product-price -->


  
<form action="{{ route('cart.add', $product->id) }}" 
      method="POST" 
      class="addToCartForm">

    @csrf

                    <div class="product-details-quantity">
                <input name="quantity" type="number" id="sticky-cart-qty" class="form-control" value="1" min="1" max="{{ $product->stock_quantity }}" step="1" data-decimals="0" required>
                    </div><!-- End .product-details-quantity -->

                    <div class="product-details-action">
                      
                        <button type="submit" class="btn-product btn-cart"><span>Add to Cart</span></button>
                    </div>
<!-----======= end of Add to cart ===========---->
</form>


                        <div class="product-details-action">
                        @auth('customer')
    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" aria-label="Add To Wishlist" class="btn-product btn-wishlist">
            <i class="fa-solid fa-heart"></i> Add to Wishlist
        </button>
    </form>
@else
 <a  href="{{ route('user.login') }}" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
@endauth
                    </div><!-- End .product-details-action -->
                </div><!-- End .col-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .sticky-bar -->