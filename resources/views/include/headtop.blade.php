 
  @if($homesectionConfig->header_status == 1)
 <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel:#"><i class="fa-solid fa-phone"></i> Call: {{ $websiteConfig->phone1 }}</a>                                
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="social-icons social-icons-color">   
                       
                   <a class="social-icon social-facebook" href="{{ $websiteConfig->facebook_link }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> 

                        <a  class="social-icon social-twitter" href="{{ $websiteConfig->x_link }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a> 

                   <a class="social-icon social-instagram" href="{{ $websiteConfig->instagram_link }}" target="_blank"><i class="fa-brands fa-instagram"></i></a> 

                     <a class="social-icon social-pinterest"  href="{{ $websiteConfig->linkedin_link }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a> 

                        <a class="social-icon social-pinterest" href="{{ $websiteConfig->youtube_link }}" target="_blank"><i class="fab fa-youtube"></i></a> 
                        </div><!--End .social-icons-->

                   
                       
                        
                    </div><!-- End .header-right -->
                </div><!--End .container-->
            </div><!--End .header-top-->
      @endif     
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="fa-solid fa-magnifying-glass"></i></a>
                           
<form id="search-form" autocomplete="off" style="position:relative;">
    <input type="text" id="search-input" placeholder="Search for Products...." class="form-control">
    <div id="search-results" class="search-results"></div>
</form>


       


                        </div><!-- End .header-search -->
                    </div><!--End .header-left-->

                    <div class="header-center">
                    
                                <a href="{{ route('welcome') }}" class="logo">
                                    <img id="logo" src="{{ asset($websiteConfig->main_logo) }}" alt="{{ $websiteConfig->companyName }}" width="{{ $websiteConfig->main_logosize }}" />
                         
                        </a><!--End .logo-->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <a href="{{ route('wishlist.index') }}" class="wishlist-link">
                        <i class="fa-solid fa-heart"></i>
                                 @auth('customer')
    <span class="wishlist-count">
        {{ \App\Models\Wishlist::where('customer_id', Auth::guard('customer')->id())->count() }}
    </span>
@else
    <span class="wishlist-count">0</span>
@endauth
<span class="wishlist-txt">My Wishlist</span>
</a><!--End .wishlist-link-->

 



<div class="dropdown cart-dropdown">
<a href="{{ route('checkout.index') }}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
<i class="fa-solid fa-bag-shopping"></i>
<span id="cart-count" class="cart-count">
    {{ collect(session('cart', []))->sum('quantity') }}
</span>

 <span class="cart-txt font-weight-semibold header-cart-total cart-total-amount">
    {{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}
</span>
  </a><!--End .dropdown-toggle-->

 

<div class="dropdown-menu dropdown-menu-right">
   <div class="dropdown-cart-products cart-items-container">
    @foreach(session('cart', []) as $item)
        <div class="product">

            <div class="product-cart-details">
                <h4 class="product-title">
                    <a href="{{ route('admin.product.show', $item['id']) }}">
                        {{ $item['name'] }}
                    </a>
                </h4>

                <span class="cart-product-info">
                    <span class="cart-product-qty">
                        {{ $item['quantity'] }}
                    </span>
                    × {{ $displayCurrency->symbol }}
                    {{ number_format($item['price'], 2) }}
                </span>

                @if(!empty($item['color']))
    <div>
        Color:
        <span style="text-transform: capitalize;">
            {{ $item['color'] }}
        </span>
    </div>
@endif

@if(!empty($item['size']))
    <div>
        Size:
        <span>
            {{ $item['size'] }}
        </span>
    </div>
@endif
            </div>

            <figure class="product-image-container">
                <a href="{{ route('admin.product.show', $item['id']) }}"
                   class="product-image">

                    <img src="{{ asset($item['image']) }}"
                         alt="{{ $item['name'] }}"
                         width="60"
                         height="60">

                </a>
            </figure>

 
<button type="button"
        class="btn-remove remove-cart-item"
        data-url="{{ route('cart.remove', $item['cart_key']) }}"
        title="Remove Product">

    <i class="fa-solid fa-xmark"></i>

</button>

        </div>
    @endforeach
</div>

    <div class="dropdown-cart-total">
        <span>Total</span>
    <span class="cart-total-price dropdown-cart-total-amount cart-total-amount">
    {{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}
</span>
    </div><!-- End .dropdown-cart-total -->

    <div class="dropdown-cart-action">
        <a href="{{ route('cart.index') }}" class="btn btn-primary">View Cart</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary-2">
            <span>Checkout</span><i class="fa-solid fa-arrow-right"></i>
        </a>
    </div><!-- End .dropdown-cart-action -->
 



                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .cart-dropdown -->
                    </div><!--End .header-right-->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
       