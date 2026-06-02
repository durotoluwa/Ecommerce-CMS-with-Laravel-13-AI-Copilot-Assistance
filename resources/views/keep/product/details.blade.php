
<!DOCTYPE html>
<html class="no-js" lang="en">
@include('headerlink')
<body>
 @include('head')
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href=" " rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> {{ $product->name }}
                </div>
            </div>
        </div>


 <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
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
        <div class="thumbnail">
            <img src="{{ asset($product->featured_image) }}" 
                 alt="{{ $product->name }}">
        </div>
    @endif

    @if($product->galleries->count())
        @foreach($product->galleries as $gallery)
            <div class="thumbnail">
                <img src="{{ asset($gallery->file_path) }}" 
                     alt="{{ $product->name }}">
            </div>
        @endforeach
    @endif
</div>

</div>
 <!-- End Gallery -->
                                    <div class="social-icons single-share">
                                     @php
    $productUrl = route('product.details', $product->id);
@endphp

<ul class="text-grey-5 d-inline-block">
    <li><strong class="mr-10">Share this:</strong></li>

    <li class="social-facebook">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($productUrl) }}" target="_blank">
            <i class="fa-brands fa-facebook-f"></i>
        </a>
    </li>

    <li class="social-twitter">
        <a href="https://twitter.com/intent/tweet?url={{ urlencode($productUrl) }}&text={{ urlencode($product->name) }}" target="_blank">
            <i class="fa-brands fa-x-twitter"></i>
        </a>
    </li>

    <li class="social-instagram">
        <!-- Instagram does not support direct web share links -->
        <a href="https://www.instagram.com/" target="_blank">
            <i class="fa-brands fa-instagram"></i>
        </a>
    </li>

    <li class="social-linkedin">
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($productUrl) }}&title={{ urlencode($product->name) }}" target="_blank">
            <i class="fa-brands fa-linkedin-in"></i>
        </a>
    </li>
</ul>

                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                               <span>Brands: 
        @foreach($product->storeBrands as $brand)
            <a href=" ">
                {{ $brand->name }}
            </a>@if(!$loop->last), @endif
        @endforeach
    </span>
                                            </div>
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <!----
                                                <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                                                ------->
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
  {!! Str::words($product->shortdescription, 20, '...') !!}                                        </div>
                                        <div class="product_sort_info font-xs mb-30">
                                            <!------
                                            <ul>
                                                <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand Warranty</li>
                                                <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                                <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                            </ul>--->
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
                                            </div>
                                               <div class="product-extra-link2">

                                               @auth('customer')
    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" aria-label="Add To Wishlist" class="action-btn hover-up">
            <i class="fa-solid fa-heart"></i>
        </button>
    </form>
@else
    <a aria-label="Login to add wishlist" class="action-btn hover-up" href="{{ route('user.login') }}">
        <i class="fa-solid fa-heart"></i>
    </a>
@endauth
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
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                    </li>
                                 
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews  </a>
                                    </li>
                                </ul>

                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            
                                            {!! $product->description !!}
                                          
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                           
                                             
                                            </div>
                                        </div>
                                        <!--comment form-->
                                        <div class="comment-form">
                                            <h4 class="mb-15">Add a review</h4>
                                            <div class="product-rate d-inline-block mb-30">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <form class="form-contact comment_form" action="#" id="commentForm">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Submit
                                                                Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Related products</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">



    @foreach($relatedProducts as $related)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="shop-product-right.html" tabindex="0">
                                                            <img class="default-img" src="{{ asset($related->featured_image) }}" alt="">
                                                            <img class="hover-img" src="{{ asset($related->featured_image) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal{{ $product->id }}"><i class="fa-solid fa-eye"></i></a>
@auth('customer')
    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" aria-label="Add To Wishlist" class="action-btn hover-up">
            <i class="fa-solid fa-heart"></i>
        </button>
    </form>
@else
    <a aria-label="Login to add wishlist" class="action-btn hover-up" href="{{ route('user.login') }}">
        <i class="fa-solid fa-heart"></i>
    </a>
@endauth  
                                            <a aria-label="Compare" class="action-btn hover-up" href=""><i class="fa-solid fa-shuffle"></i></a>
                                                    </div>
                                                    <!---
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Hot</span>
                                                    </div>-->
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href=" " tabindex="0">{{ $related->name }}</a></h2>
                                                 
                                                    
<div class="product-price">
                                                                   <span>
          {{ $displayCurrency->symbol }}
        
        {{ number_format($related->converted_regular_price, 2) }}
    </span>
    @if($related->converted_sale_price)
        <span class="old-price">
             {{ $displayCurrency->symbol }}
            {{ number_format($related->converted_sale_price, 2) }}
        </span>
    @endif
                
@if($related->converted_sale_price && $related->converted_regular_price)
    @php
        $discount = 100 - (($related->converted_sale_price / $related->converted_regular_price) * 100);
    @endphp
    <small>Discount:</small> 
    <span>{{ number_format($discount, 0) }}%</span>
@endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

    @endforeach

                                        

                                    </div>
                                </div>
                            </div>
                         


                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                     @foreach($categorysection as $category)
                                <li><a href="{{ route('shop.show', $category->slug) }}">{{ $category->name }}</a></li>
                         @endforeach
                            </ul>
                        </div>

                        <!-- Fillter By Price 
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Fill by price</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900">Color</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                        <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                        <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                    </div>
                                    <label class="fw-900 mt-15">Item Condition</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                        <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                        <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                    </div>
                                </div>
                            </div>
                            <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                        </div>
                        Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">New products</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>

@foreach($newproductlist as $product)
    <div class="single-post clearfix">
        <div class="image">
         <img class=" " src="{{ asset($product->featured_image) }}" alt="">
        </div>
        <div class="content pt-10">
            <h5>
                <a href="{{ route('product.details', $product->id) }}">
                    {{ $product->name }}
                </a>
            </h5>
            <p class="price mb-0 mt-5">
                 <span>
          {{ $displayCurrency->symbol }}
        
        {{ number_format($product->converted_regular_price, 2) }}
    </span>
    @if($product->converted_sale_price)
        <span class="old-price">
             {{ $displayCurrency->symbol }}
            {{ number_format($product->converted_sale_price, 2) }}
        </span>
    @endif
                
@if($product->converted_sale_price && $product->converted_regular_price)
    @php
        $discount = 100 - (($product->converted_sale_price / $product->converted_regular_price) * 100);
    @endphp
    <small>Discount:</small> 
    <span>{{ number_format($discount, 0) }}%</span>
@endif
            </p>
        </div>
    </div>
@endforeach

 

                        </div>
                  



                    </div>
                </div>
            </div>
        </section>





</main>

@include('footer')
 </body>

</html>