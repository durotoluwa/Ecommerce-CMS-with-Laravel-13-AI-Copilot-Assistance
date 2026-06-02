

   
   
   <!-- Quick view -->
    <div class="modal fade custom-modal" id="quickViewModal{{ $product->id }}" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <!-- MAIN SLIDES -->
                               <!-- MAIN SLIDES -->
<div class="product-image-slider">
    @if($product->featured_image)
        <figure class="border-radius-10">
            <img src="{{ asset($product->featured_image) }}" 
                 alt="{{ $product->name }}">
        </figure>
    @endif

    @if($product->galleries->count())
        @foreach($product->galleries as $gallery)
            <figure class="border-radius-10">
                <img src="{{ asset($gallery->file_path) }}" 
                     alt="{{ $product->name }}">
            </figure>
        @endforeach
    @endif
</div>

<!-- THUMBNAILS -->
<div class="slider-nav-thumbnails pl-15 pr-15">
    @if($product->featured_image)
        <div>
            <img src="{{ asset($product->featured_image) }}" 
                 alt="{{ $product->name }}">
        </div>
    @endif

    @if($product->galleries->count())
        @foreach($product->galleries as $gallery)
            <div>
                <img src="{{ asset($gallery->file_path) }}" 
                     alt="{{ $product->name }}">
            </div>
        @endforeach
    @endif
</div>

                            </div>
                            <!-- End Gallery -->
                            <div class="social-icons single-share">
                                <ul class="text-grey-5 d-inline-block">
                                    <li><strong class="mr-10">Share this:</strong></li>
                                    <li class="social-facebook"><a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                    <li class="social-twitter"> <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                    <li class="social-instagram"><a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                    <li class="social-linkedin"><a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h3 class="title-detail mt-30">{{ $product->name }}</h3>
                                <div class="product-detail-rating">
                                    <div class="pro-details-brand">
                                      <div class="pro-details-brand">
    <span>Brands: 
        @foreach($product->storeBrands as $brand)
            <a href=" ">
                {{ $brand->name }}
            </a>@if(!$loop->last), @endif
        @endforeach
    </span>
</div>

                                    </div>
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:90%">
                                            </div>
                                        </div>
                                        <!---
                                        <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                                        _-->
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                 <div class="product-price primary-color float-left">
    <ins>
        <span class="text-brand">
            {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_regular_price, 2) }}
        </span>
    </ins>

    @if($product->converted_sale_price)
        <ins>
            <span class="old-price font-md ml-15">
                {{ $displayCurrency->symbol }}
                {{ number_format($product->converted_sale_price, 2) }}
            </span>
        </ins>

        @php
            $discount = 100 - (($product->converted_sale_price / $product->converted_regular_price) * 100);
        @endphp

        @if($discount > 0)
            <span class="save-price font-md color3 ml-15">
                {{ number_format($discount, 0) }}% Off
            </span>
        @endif
    @endif
</div>

                                </div>
                                <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                <div class="short-desc mb-30">
                                    <p class="font-sm">
                                       {!! Str::words($product->shortdescription, 20, '...') !!}

                                    </p>
                                </div>

                              {{-- Color Attribute --}}
@php
    // Group attributeProducts by attribute name
    $groupedAttributes = $product->attributeProducts->groupBy(function($attrProd) {
        return strtolower($attrProd->attribute->name); // normalize to lowercase
    });
@endphp

{{-- Color Attribute --}}
@if($groupedAttributes->has('color'))
    <div class="attr-detail attr-color mb-15">
        <strong class="mr-10">Color</strong>
        <ul class="list-filter color-filter">
            @foreach($groupedAttributes['color'] as $attrProd)
                @php $colorName = ucfirst($attrProd->term->name); @endphp
                <li>
                    <div class="circle" 
                         data-color="{{ $colorName }}" 
                         style="background-color: {{ strtolower($colorName) }};">
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<style>
.circle {
  width: 20px;
  height: 20px;
  border-radius: 50%; /* makes it a circle */
  display: inline-block;
  border: 1px solid #ccc; /* optional border */
}
</style>


{{-- Size Attribute --}}
@if($groupedAttributes->has('size'))
    <div class="attr-detail attr-size">
        <strong class="mr-10">Size</strong>
        <ul class="list-filter size-filter font-small">
            @foreach($groupedAttributes['size'] as $attrProd)
                <li><a href="#">{{ strtoupper($attrProd->term->name) }}</a></li>
            @endforeach
        </ul>
    </div>
@endif


                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="detail-extralink">
<div class="detail-qty">
    <input type="number" 
           name="quantity" 
           value="1" 
           min="1" 
           max="{{ $product->stock_quantity }}" 
           class="form-control qty-val" 
           style="width: 70px; text-align: center;">
</div>

                                    
                                    <div class="product-extra-link2">
                                          <a aria-label="Add To Cart" 
       class="action-btn hover-up" 
       href="{{ route('cart.add', $product->id) }}">
        <i class="fa-solid fa-bag-shopping"></i> 
    </a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href=" "><i class="fa-solid fa-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href=" "><i class="fa-solid fa-shuffle"></i></a>
                                    </div>
                                </div>
                                <ul class="product-meta font-xs color-grey mt-50">
                                    <li class="mb-5">SKU: <a href="#">{{ $product->sku }}</a></li>
                                 
                               <li>
    Availability:
    @if($product->stock_quantity > 0)
        <span class="in-stock text-success ml-5">
            {{ $product->stock_quantity }} Items In Stock
        </span>
    @else
        <span class="out-of-stock text-danger ml-5">
            Out of Stock
        </span>
    @endif
</li>

                                </ul>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


