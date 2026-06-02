 

<div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
@if($product->featured)
    <span class="product-label label-sale">Featured</span>
@endif

@php
    // Define how many days old a product can be to count as "new"
    $newThresholdDays = 30;

    $isNew = $product->created_at->gt(now()->subDays($newThresholdDays));
@endphp

@if($isNew)
    <span class="product-label label-primary">New</span>
@endif


{{-- If stock is 0, show Out Of Stock --}}
@if($product->stock_quantity == 0)
    <span class="product-label label-primary">Out Of Stock</span>
@else
    {{-- Show sale labels only if sale_price exists --}}
    @if($product->sale_price)
        <span class="product-label label-primary">sale</span>

        @php
            $discount = 100 - (($product->converted_sale_price / $product->converted_regular_price) * 100);
        @endphp

        @if($discount > 0)
            <span class="product-label label-sale">
                {{ number_format($discount, 0) }}% off
            </span>
        @endif
    @endif
@endif



 
<a href="{{ route('product.details', $product->slug) }}">
    @if(!empty($product->featured_image))
        <img src="{{ asset($product->featured_image) }}" 
             alt="{{ $product->name }}" 
             class="product-image" 
             style="background-color: #ebebeb;">
        <img src="{{ asset($product->featured_image) }}" 
             alt="{{ $product->name }}" 
             class="product-image-hover" 
             style="background-color: #ebebeb;">
    @else
        <img src="{{ asset('admin/assets/image/productimage.jpg') }}" 
             alt="Default product image" 
             class="product-image" 
             style="background-color: #ebebeb;">
        <img src="{{ asset('admin/assets/image/productimage.jpg') }}" 
             alt="Default product image" 
             class="product-image-hover" 
             style="background-color: #ebebeb;">
    @endif
</a>


                                    <div class="product-action-vertical">
                                     @auth('customer')
    <a href="{{ route('wishlist.add', $product->id) }}"
       class="btn-product-icon btn-wishlist btn-expandable"
       onclick="event.preventDefault(); document.getElementById('wishlist-form-{{ $product->id }}').submit();">
        <span>Add to wishlist</span>
    </a>

    <form id="wishlist-form-{{ $product->id }}" 
          action="{{ route('wishlist.add', $product->id) }}" 
          method="POST" 
          class="d-none">
        @csrf
    </form>
@else
    <a aria-label="Login to add wishlist" 
       class="btn-product-icon btn-wishlist btn-expandable" 
       href="{{ route('user.login') }}">
        <span>Add to wishlist</span>
    </a>
@endauth

<a href="{{ route('product.quickview', $product->id) }}" 
   class="btn-product-icon btn-quickview" 
   title="Quick view">
   <span>Quick view</span>
</a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <!----
<form action="{{ route('cart.add', $product->id) }}" method="POST" class="addToCartForm">
    @csrf
    <div class="product-details-action">
        <button type="submit" class="btn-product btn-cart">
            <span>Add to Cart</span>
        </button>
    </div>
</form>--->

              <a href="{{ route('cart.add', $product->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>
                                        
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                          
{{ $displayCurrency->symbol }}
        
        {{ number_format($product->converted_regular_price, 2) }}
    </span>
    @if($product->converted_sale_price)
        <span class="old-price" style="margin-left: 20px;">
             {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_sale_price, 2) }}
        </span>
    @endif
</div><!-- End .product-price -->
                               @php
    // Group attributeProducts by attribute name
    $groupedAttributes = $product->attributeProducts->groupBy(function($attrProd) {
        return strtolower($attrProd->attribute->name);
    });
@endphp

 

                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->