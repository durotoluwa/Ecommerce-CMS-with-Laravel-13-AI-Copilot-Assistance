       <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
   <style>
.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-top: none;
    max-height: 300px;
    overflow-y: auto;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 999;
}

.search-item {
    display: flex;
    align-items: center;
    padding: 8px;
    text-decoration: none;
    color: #333;
    transition: background 0.2s ease;
}

.search-item img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    margin-right: 10px;
    border-radius: 4px;
}

.search-info {
    display: flex;
    flex-direction: column;
}

.search-name {
    font-size: 14px;
    font-weight: 500;
}

.search-price {
    font-size: 13px;
    color: #007bff;
}

.search-item:hover {
    background: #f5f5f5;
}

</style>

   <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                      @auth('customer')
                            Hi! {{ Auth::guard('customer')->user()->first_name }} {{ Auth::guard('customer')->user()->last_name }}
                        @else
                            Welcome, Guest
                        @endauth
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                          
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                           <ul>
                            @auth('customer')
                                <li>
                                    <i class="fa-solid fa-user"></i>
                                    <a href="{{ route('myaccount') }}"> My Account</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('user.logout') }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="color:white; text-decoration:none; padding:5px;">
                                            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <i class="fa-solid fa-user"></i>
                                    <a href="{{ route('user.login') }}">Log In / Sign Up</a>
                                </li>
                            @endauth
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href=""><img src="{{ asset('web/images/logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
<form id="search-form" autocomplete="off" style="position:relative;">
    <input type="text" id="search-input" placeholder="Search for Products...." class="form-control">
    <div id="search-results" class="search-results"></div>
</form>



                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="{{ route('wishlist.index') }}">
                                        <img class="svgInject" alt="Evara" src="{{asset('web/images/icon-heart.svg')  }}">
                                      @auth('customer')
    <span class="pro-count blue">
        {{ \App\Models\Wishlist::where('customer_id', Auth::guard('customer')->id())->count() }}
    </span>
@else
    <span class="pro-count blue">0</span>
@endauth

                                    </a>
                                </div>
                                <div class="header-action-icon-2">
<a class="mini-cart-icon" href="{{ route('checkout.index') }}">
<img alt="Evara" src="{{asset('web/images/icon-cart.svg')  }}">
<span class="pro-count blue">
    {{ collect(session('cart', []))->sum('quantity') }}
</span>


</a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            <li>
                                               @foreach(session('cart', []) as $item)
        <li>
          <div class="shopping-cart-img">
    <a href="{{ route('admin.product.show', $item['id']) }}">
        <img alt="{{ $item['name'] }}" src="{{ asset($item['image']) }}">
    </a>
</div>

            <div class="shopping-cart-title">
                <h4><a href="{{ route('admin.product.show', $item['id']) }}">{{ $item['name'] }}</a></h4>
                <h4><span>{{ $item['quantity'] }} × </span>{{ $displayCurrency->symbol }} {{ number_format($item['price'], 2) }}</h4>
            </div>
            <div class="shopping-cart-delete">
                <a href="{{ route('cart.remove', $item['id']) }}"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </li>
    @endforeach
                                        </ul>
                                  <div class="shopping-cart-footer">
    <div class="shopping-cart-total">
        <h4>Total <span>{{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}</span></h4>
    </div>
    <div class="shopping-cart-button">
        <a href="{{ route('cart.index') }}" class="outline">View cart</a>
        <a href="{{ route('checkout.index') }}">Checkout</a>
    </div>
</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href=""><img src="{{ asset('web/images/logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                         
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>
                                 
                                     
                                                
                                   <li>
                                 <a href="{{ route('welcome') }}">Home</a>
                                    </li>

                                    
                                    <li>
                                        <a href="{{ route('cart.index') }}">Cart</a>
                                    </li>

                                     <li>
                                        <a href="{{ route('checkout.index') }}">Checkout</a>
                                    </li>


                                        <li>
                                        <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                                    </li>

                                        <li>
                                        <a href="{{ route('myaccount') }}">My Account</a>
                                    </li>

                                     <li>
                                        <a href="{{ route('shop.index') }}">Shop</a>
                                    </li>
                                </ul>
                          
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                   <li>
                                 <a href="{{ route('welcome') }}">Home</a>
                                    </li>

                                    
                                    <li>
                                        <a href="{{ route('cart.index') }}">Cart</a>
                                    </li>

                                     <li>
                                        <a href="{{ route('checkout.index') }}">Checkout</a>
                                    </li>

                                        <li>
                                        <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                                    </li>

                                        <li>
                                        <a href="{{ route('myaccount') }}">My Account</a>
                                    </li>


                                     <li>
                                        <a href="{{ route('shop.index') }}">Shop</a>
                                    </li>
                               
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                      
                    </div>
                     <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist.index') }}">
                                    <img alt="Evara" src="{{asset('web/images/icon-cart.svg')  }}">
                                 @auth('customer')
    <span class="pro-count blue">
        {{ \App\Models\Wishlist::where('customer_id', Auth::guard('customer')->id())->count() }}
    </span>
@else
    <span class="pro-count blue">0</span>
@endauth

                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                        <a class="mini-cart-icon" href="{{ route('checkout.index') }}">
<img alt="Evara" src="{{asset('web/images/icon-cart.svg')  }}">
<span class="pro-count blue">
    {{ collect(session('cart', []))->sum('quantity') }}
</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                           @foreach(session('cart', []) as $item)
        <li>
          <div class="shopping-cart-img">
    <a href="{{ route('admin.product.show', $item['id']) }}">
        <img alt="{{ $item['name'] }}" src="{{ asset($item['image']) }}">
    </a>
</div>

            <div class="shopping-cart-title">
                <h4><a href="{{ route('admin.product.show', $item['id']) }}">{{ $item['name'] }}</a></h4>
                <h4><span>{{ $item['quantity'] }} × </span>{{ $displayCurrency->symbol }} {{ number_format($item['price'], 2) }}</h4>
            </div>
            <div class="shopping-cart-delete">
                <a href="{{ route('cart.remove', $item['id']) }}"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </li>
    @endforeach
                                    </ul>
                               <div class="shopping-cart-footer">
    <div class="shopping-cart-total">
        <h4>Total <span>{{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}</span></h4>
    </div>
    <div class="shopping-cart-button">
        <a href="{{ route('cart.index') }}" class="outline">View cart</a>
        <a href="{{ route('checkout.index') }}">Checkout</a>
    </div>
</div>


                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href=""><img src="{{ asset('web/images/logo.png') }}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">

                 <form action="#" id="search-form">
    <input type="text" id="search-input" placeholder="Search for items…">
    <button type="submit"><i class="fi-rs-search"></i></button>
</form>

<div id="search-results" class="search-results"></div>

                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                  
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                             <li>
                                 <a href="{{ route('welcome') }}">Home</a>
                                    </li>

                                    
                                    <li>
                                        <a href="{{ route('cart.index') }}">Cart</a>
                                    </li>

                                     <li>
                                        <a href="{{ route('checkout.index') }}">Checkout</a>
                                    </li>

                                        <li>
                                        <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                                    </li>

                                        <li>
                                        <a href="{{ route('myaccount') }}">My Account</a>
                                    </li>


                                     <li>
                                        <a href="{{ route('shop.index') }}">Shop</a>
                                    </li>
                      
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
               
                    <div class="single-mobile-header-info">
                        <a href=" ">Log In / Sign Up </a>
                    </div>

                       <!---

                             <div class="single-mobile-header-info mt-30">
                        <a href="page-contact.html"> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">(+01) - 2345 - 6789 </a>
                    </div>-->
                </div>
             <!---====
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                </div> ====--->
            </div>
        </div>
    </div>