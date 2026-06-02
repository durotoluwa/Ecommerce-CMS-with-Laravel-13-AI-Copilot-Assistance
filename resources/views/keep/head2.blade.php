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
                    <!-- center content -->
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
</header>



    <header class="header-area header-style-1 header-height-2">
       
     <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="index.html"><img src="assets/imgs/theme/logo.svg" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <select class="select-active">
                                    <option>All Categories</option>
                                  
                                </select>
                                <input type="text" placeholder="Search for items...">
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Evara" src="{{asset('web/images/icon-heart.svg')  }}">
                                        <span class="pro-count blue"> 0</span>
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



                                    <!--========== end of cart-dropdown-wrap  ====-------->




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
                        <a href="index.html"><img src="assets/imgs/theme/logo.svg" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">


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
                                <a href=" ">
                                    <img alt="Evara" src="{{asset('web/images/icon-heart.svg')  }}">
                                    <span class="pro-count white"> </span>
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
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                menu
                                   
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
                    <a href="index.html"><img src="assets/imgs/theme/logo.svg" alt="logo"></a>
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
                    <form action="#">
                        <input type="text" placeholder="Search for items…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                  
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="index.html">Home</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                </ul>
                            </li>

                            
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="page-contact.html"> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login-register.html">Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>