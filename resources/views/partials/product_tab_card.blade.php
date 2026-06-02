<div class="col-6 col-md-4 col-lg-3">
                                    <div class="product product-2">
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
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a>
                                            </div><!-- End .product-action -->

                                            <div class="product-action product-action-transparent">
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
                                            <div class="product-cat">

                                                    @foreach($product->categories as $category)
                        <a href="{{ route('shop.show', $category->slug) }}">{{$category->name }}</a>
                         @endforeach
                                                
                                            </div><!-- End .product-cat -->
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
                                            <!--
                                            <div class="product-nav product-nav-dots">
                                                <a href="#" class="active" style="background: #e5dcb1;"><span class="sr-only">Color name</span></a>
                                                <a href="#" style="background: #b9cbd8;"><span class="sr-only">Color name</span></a>
                                            </div>  End .product-nav -->
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->