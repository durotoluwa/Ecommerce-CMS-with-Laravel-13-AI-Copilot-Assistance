



        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">All Product</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                        </li>
                    
                      
                    </ul>
                 </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade " id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">


@foreach($featuredproductsection as $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="">
                                                <img class="default-img" src="{{ asset($product->featured_image) }}" alt="">
                                                <img class="hover-img" src="{{ asset($product->featured_image) }}" alt="">
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
                                        <!-----
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>---->
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
       @foreach($product->categories as $category)
    <a href="">
        {{ $category->name }}@if(!$loop->last), @endif
    </a>
@endforeach
</div>
<h2>
    <a href="{{ route('product.details', $product->id) }}">
        {{ $product->name }}
    </a>
</h2>



@if($product->converted_sale_price && $product->converted_regular_price)
    @php
        $discount = 100 - (($product->converted_sale_price / $product->converted_regular_price) * 100);
    @endphp
    <small>Discount:</small> 
    <span>{{ number_format($discount, 0) }}%</span>
@endif
                                         
                                       
<div class="product-price">
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
</div>
<div class="product-action-1 show">
    <a aria-label="Add To Cart" 
       class="action-btn hover-up" 
       href="{{ route('cart.add', $product->id) }}">
        <i class="fa-solid fa-bag-shopping"></i>
    </a>
</div>
 @include('quick_view')
</div>
</div>
</div>
       



@endforeach



 






                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade show active" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">
                           
                           
                       
@foreach($allproductsection as $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="">
                                                <img class="default-img" src="{{ asset($product->featured_image) }}" alt="">
                                                <img class="hover-img" src="{{ asset($product->featured_image) }}" alt="">
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
 <a aria-label="Add To Wishlist" class="action-btn hover-up" href=" "><i class="fa-solid fa-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href=" l"><i class="fa-solid fa-shuffle"></i></a>
                                        </div>
                                        <!-----
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>---->
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
       @foreach($product->categories as $category)
    <a href="">
        {{ $category->name }}@if(!$loop->last), @endif
    </a>
@endforeach
</div>
<h2>
    <a href="{{ route('product.details', $product->id) }}">
        {{ $product->name }}
    </a>
</h2>
@if($product->converted_sale_price && $product->converted_regular_price)
    @php
        $discount = 100 - (($product->converted_sale_price / $product->converted_regular_price) * 100);
    @endphp
    <small>Discount:</small> 
    <span>{{ number_format($discount, 0) }}%</span>
@endif
                                         
                                       
<div class="product-price">
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
</div>

<div class="product-action-1 show">
    <a aria-label="Add To Cart" 
       class="action-btn hover-up" 
       href="{{ route('cart.add', $product->id) }}">
        <i class="fa-solid fa-bag-shopping"></i>
    </a>
</div>
</div>
</div>
</div>
       
 @include('quick_view')


@endforeach




                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two (Popular)-->
                    
                </div>
                <!--End tab-content-->
            </div>
        </section>
       