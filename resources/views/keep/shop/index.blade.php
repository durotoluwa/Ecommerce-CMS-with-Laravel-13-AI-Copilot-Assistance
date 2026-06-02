
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
                   
                </div>
            </div>
        </div>




        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                        <div class="totall-product">
    <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for you!</p>
</div>

                            <div class="sort-by-product-area">
                              
                                <!---
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">Featured</a></li>
                                            <li><a href="#">Price: Low to High</a></li>
                                            <li><a href="#">Price: High to Low</a></li>
                                            <li><a href="#">Release Date</a></li>
                                            <li><a href="#">Avg. Rating</a></li>
                                        </ul>
                                    </div>
                                </div>---->
                            </div>
                        </div>
                        <div class="row product-grid-3">



                            
@foreach($products as $product)
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
@endauth                                            <a aria-label="Compare" class="action-btn hover-up" href=" l"><i class="fa-solid fa-shuffle"></i></a>
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
<h2><a href="">  {{ $product->name }}</a></h2>
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
                        <!--pagination-->
                   <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

                    </div>
                </div>
            </div>
        </section>
    </main>



</main>


    
 
@include('footer')
 </body>

</html>