
<!DOCTYPE html>
<html lang="en">
<head>
@include('include.product_headerlink') 
</head>
<body>
<div class="page-wrapper">
<header class="header header-6">
@include('include.headtop')
@include('include.headbottom')    
</header>
<!--========= End .header ============-->

     <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Default</li>
                    </ol>
<!--
                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav> End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
 <!-- MAIN IMAGE -->
<figure class="product-main-image">
    @php
        $mainImage = !empty($product->featured_image)
            ? asset($product->featured_image)
            : asset('admin/assets/image/productimage.jpg');
    @endphp

    <img id="product-zoom" 
         src="{{ $mainImage }}" 
         data-zoom-image="{{ $mainImage }}" 
         alt="{{ $product->name }}">

    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
        <i class="icon-arrows"></i>
    </a>
</figure><!-- End .product-main-image -->

<!-- GALLERY THUMBNAILS -->
<div id="product-zoom-gallery" class="product-image-gallery">
    <a class="product-gallery-item active" href="#"
       data-image="{{ $mainImage }}"
       data-zoom-image="{{ $mainImage }}">
        <img src="{{ $mainImage }}" alt="{{ $product->name }} featured">
    </a>

    @if($product->galleries->count())
        @foreach($product->galleries as $gallery)
            @php
                $galleryImage = !empty($gallery->file_path)
                    ? asset($gallery->file_path)
                    : asset('admin/assets/image/productimage.jpg');
            @endphp

            <a class="product-gallery-item" href="#"
               data-image="{{ $galleryImage }}"
               data-zoom-image="{{ $galleryImage }}">
                <img src="{{ $galleryImage }}" alt="{{ $product->name }} gallery">
            </a>
        @endforeach
    @endif
</div><!-- End .product-image-gallery -->





                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                                    <!--<div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings  
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div> End .rating-container -->

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

                                    <div class="product-content">
 {!! Str::words($product->shortdescription, 50, '...') !!}  
                                        


                                    </div><!-- End .product-content -->
 
 @php
    // Group attributeProducts by attribute name
    $groupedAttributes = $product->attributeProducts->groupBy(function($attrProd) {
        return strtolower($attrProd->attribute->name); // normalize to lowercase
    });
@endphp
 
<style>
.circle {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  display: inline-block;
  border: 1px solid #ccc;
  margin: 0 5px;
  cursor: pointer;
}

.color-radio:checked + .circle {
  border: 2px solid #000; /* highlight selected */
}

</style>
                            
<form action="{{ route('cart.add', $product->id) }}" 
      method="POST" 
      class="addToCartForm">

    @csrf


   @csrf

    {{-- COLOR --}}
    @if($groupedAttributes->has('color'))

    <div class="details-filter-row details-row-size">
        <label>Color:</label>

        <ul class="product-nav product-nav-thumbs">

            @foreach($groupedAttributes['color'] as $attrProd)

                @php
                    $colorName = strtolower(trim($attrProd->term->name));
                @endphp

                <li>
                    <label>

                        <input type="radio"
                               name="selected_color"
                               value="{{ $colorName }}"
                               class="d-none color-radio">

                        <span class="circle"
                              style="background-color: {{ $colorName }};"
                              title="{{ ucfirst($colorName) }}">
                        </span>

                    </label>
                </li>

            @endforeach

        </ul>
    </div>

    @endif


    {{-- SIZE --}}
    @if($groupedAttributes->has('size'))

    <div class="details-filter-row details-row-size">

        <label for="size">Size:</label>

        <div class="select-custom">

            <select name="selected_size"
                    id="size"
                    class="form-control">

                <option value="">Select Size</option>

                @foreach($groupedAttributes['size'] as $attrProd)

                    <option value="{{ strtoupper($attrProd->term->name) }}">
                        {{ strtoupper($attrProd->term->name) }}
                    </option>

                @endforeach

            </select>

        </div>

    </div>

    @endif

 

  <div class="details-filter-row details-row-size">
    <label for="qty">Qty:</label>

    <div class="product-details-quantity">
        <input name="quantity"
               type="number"
               class="form-control"
               value="1"
               min="1"
               max="{{ $product->stock_quantity }}"
               step="1"
               required>
    </div></div>

    <div class="product-details-action">
        <button type="submit" class="btn-product btn-cart">
            <span>Add to Cart</span>
        </button>
    </div>
</form>
 <div class="product-details-action">
    <div class="details-action-wrapper">
        @auth('customer')
            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" aria-label="Add To Wishlist" class="btn-product btn-wishlist">
                    <i class="fa-solid fa-heart"></i> Add to Wishlist
                </button>
            </form>
        @else
            <a href="{{ route('user.login') }}" class="btn-product btn-wishlist" title="Wishlist">
                <span>Add to Wishlist</span>
            </a>
        @endauth
    </div>
</div>
 

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                        @foreach($product->categories as $category)
                        <a href="{{ route('shop.show', $category->slug) }}">{{$category->name }}</a>,
                         @endforeach
                                        </div><!-- End .product-cat -->
                                    @php
    $productUrl = route('product.details', $product->slug);
@endphp
                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                         <a class="social-icon"  href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($productUrl) }}" target="_blank"> <i class="fa-brands fa-facebook-f"></i></a>
                                             <a class="social-icon" href="https://twitter.com/intent/tweet?url={{ urlencode($productUrl) }}&text={{ urlencode($product->name) }}" target="_blank"> <i class="fa-brands fa-x-twitter"></i></a>
                                            <a class="social-icon" href="#" class="social-icon" title="Instagram" target="_blank">    <i class="fa-brands fa-instagram"></i></a>
                                          <a class="social-icon" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($productUrl) }}&title={{ urlencode($product->name) }}" target="_blank">   <i class="fa-brands fa-linkedin-in"></i></a>

                                            
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                            </li>
                          
                            
                            <li class="nav-item">
                                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Product Information</h3>
                                      {!! $product->description !!}
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <h3>Information</h3>
                               
                                    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Color</th>
            <th>Size</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product->attributeProducts as $attrProd)
            @php
                $attrName = strtolower(trim($attrProd->attribute->name));
                $termName = ucfirst($attrProd->term->name);

                $colorName = $attrName === 'color' ? $termName : null;
                $sizeName  = $attrName === 'size' ? $termName : null;
            @endphp

            @if($colorName || $sizeName)
                <tr>
                    <td>
                        @if($colorName)
                            <span class="circle" style="background-color: {{ strtolower($colorName) }};"></span>
                            {{ $colorName }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $sizeName ?? '-' }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->




                            


                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                <div class="reviews">
                                    <h3>Reviews </h3>

                                        <!---
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">Samanta J.</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings
                                                </div><!-- End .rating-container 
                                                <span class="review-date">6 days ago</span>
                                            </div><!-- End .col  
                                            <div class="col">
                                                <h4>Good, perfect size</h4>

                                                <div class="review-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                                </div><!-- End .review-content 

                                                <div class="review-action">
                                                    <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                </div><!-- End .review-action 
                                            </div><!-- End .col-auto  
                                        </div><!-- End .row  
                                    </div><!-- End .review -->

                                  
                                    
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">Related products</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                        



                         @foreach($relatedProducts as $related)
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
    @php
        $imagePath = !empty($product->featured_image)
            ? asset($product->featured_image)
            : asset('admin/assets/image/productimage.jpg');
    @endphp

    <img src="{{ $imagePath }}" 
         alt="{{ $product->name }}" 
         class="product-image" 
         style="background-color: #ebebeb;">
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

                                   
                                   
                                    <a href="{{ route('product.quickview', $product->id) }}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                  <!---  <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>--->
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <a href="{{ route('cart.add', $product->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                 @foreach($product->categories as $category)
                        <a href="{{ route('shop.show', $category->slug) }}">{{$category->name }}</a>,
                         @endforeach
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{ route('product.details', $product->slug) }}">{{$product->name }}</a></h3><!-- End .product-title -->
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
                                <!----
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings 
                                    <span class="ratings-text">( 6 Reviews )</span>
                                </div><!-- End .rating-container -->
                            </di><!-- End .product-body -->
                        </div><!-- End .product -->

                      @endforeach



                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
 
         <!-- Sticky Bar -->
     @include('include.sticky-bar')  

    @include('footer')    


 









   <script src="{{asset('web/js/jquery.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('web/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{asset('web/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('web/js/superfish.min.js')}}"></script>
    <script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('web/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('web/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{asset('web/js/main.js')}}"></script>


//============== ADD CART SCRIPT


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.addToCartForm').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let actionUrl = this.action;

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {

                    // Update cart count
                    document.querySelector('.cart-count').innerText = data.cart_count;

                    // Update total
                    //document.querySelector('.cart-total-amount').innerText =
                      //  '₦ ' + Number(data.cart_total).toLocaleString();
                       
                      document.querySelector('.header-cart-total').innerText =
    '₦ ' + Number(data.cart_total).toLocaleString();

document.querySelector('.dropdown-cart-total-amount').innerText =
    '₦ ' + Number(data.cart_total).toLocaleString();

                    // Update cart dropdown
                    let cartContainer = document.querySelector('.cart-items-container');

                    cartContainer.innerHTML = '';

                  data.items.forEach(item => {

cartContainer.innerHTML += `
    <div class="product">
        <div class="product-cart-details">
            <h4 class="product-title">
                <a href="/product/${item.id}">${item.name}</a>
            </h4>
            <span class="cart-product-info">
                <span class="cart-product-qty">${item.quantity}</span>
                × ₦ ${Number(item.price).toLocaleString()}
            </span>
            ${item.color ? `<div>Color: <span style="text-transform:capitalize">${item.color}</span></div>` : ''}
            ${item.size ? `<div>Size: <span>${item.size}</span></div>` : ''}
        </div>
        <figure class="product-image-container">
            <a href="/product/${item.id}" class="product-image">
                <img src="/${item.image}" alt="${item.name}" width="60" height="60">
            </a>
        </figure>
        <button type="button"
                class="btn-remove remove-cart-item"
                data-url="/cart/remove/${item.cart_key}"
                title="Remove Product">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
`;

});

                    // Toastr success
                    toastr.success('Product added to cart');

                } else {
                    toastr.error(data.message || 'Something went wrong');
                }

            })
            .catch(error => {
                console.log(error);
                toastr.error('Error adding product to cart');
            });

        });

    });

});
</script>
 



//============== REMOVE CART SCRIPT


<script>
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.remove-cart-item');
    if (!btn) return;

    e.preventDefault();

    fetch(btn.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Remove product row
            const productRow = btn.closest('.product');
            if (productRow) productRow.remove();

            // Update cart count
           // Update cart count
const countEl = document.getElementById('cart-count');
if (countEl) countEl.textContent = data.cart_count;

// Update totals or clear if empty
if (data.cart_count === 0) {
    document.querySelectorAll('.cart-total-amount').forEach(el => {
        el.textContent = '₦0.00';
    });
    const totalsSection = document.querySelector('.dropdown-cart-total');
    if (totalsSection) totalsSection.style.display = 'none';
    const container = document.querySelector('.cart-items-container');
    if (container) container.innerHTML = '<p class="empty-cart">Your cart is empty.</p>';
} else {
    // Update totals everywhere
    document.querySelectorAll('.cart-total-amount').forEach(el => {
        el.textContent = '₦ ' + Number(data.cart_total).toLocaleString();
    });
    const totalsSection = document.querySelector('.dropdown-cart-total');
    if (totalsSection) totalsSection.style.display = '';
}


        }
    })
    .catch(err => console.error(err));
});
</script>



<script>
const currencySymbol = "{{ $displayCurrency->symbol }}";

document.getElementById('search-input').addEventListener('keyup', function() {
    let query = this.value;
    const productDetailsBaseUrl = "{{ url('/product') }}";

    if (query.length > 2) {
        fetch("{{ route('products.search') }}?q=" + query)
            .then(response => response.json())
            .then(data => {
                let resultsDiv = document.getElementById('search-results');
                resultsDiv.innerHTML = '';

                if (data.length === 0) {
                    resultsDiv.innerHTML = '<div class="search-item">No products found.</div>';
                }

             data.forEach(product => {
    let priceHtml = '';

    if (product.converted_sale_price && product.converted_regular_price) {
        let discount = 100 - ((product.converted_sale_price / product.converted_regular_price) * 100);
        priceHtml = `
            <span class="search-price text-danger">${currencySymbol} ${parseFloat(product.converted_sale_price).toFixed(2)}</span>
            <del class="search-price text-muted">${currencySymbol} ${parseFloat(product.converted_regular_price).toFixed(2)}</del>
            <small class="text-success">(-${Math.round(discount)}%)</small>
        `;
    } else if (product.converted_regular_price) {
        priceHtml = `<span class="search-price">${currencySymbol} ${parseFloat(product.converted_regular_price).toFixed(2)}</span>`;
    }

  resultsDiv.innerHTML += `
    <a href="${productDetailsBaseUrl}/${product.id}" class="search-item">
        <img src="{{ asset('') }}${product.featured_image}" width="40" alt="${product.name}">
        <div class="search-info">
            <span class="search-name">${product.name}</span>
            ${priceHtml}
        </div>
    </a>
    `;
});

            })
            .catch(error => console.error('Search error:', error));
    } else {
        document.getElementById('search-results').innerHTML = '';
    }
});
</script>


 
</body>
</html>