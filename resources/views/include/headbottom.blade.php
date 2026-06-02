
            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                       @include('frontend.partials.navbar')

                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button><!--End .mobile-menu-toggler-->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        
                      
                        

                                      
   @auth('customer')
                            
                                    <i class="icon-user"></i> 
                                    <a style="font-size: 15px; font-weight:700; text-transform:uppercase;" href="{{ route('myaccount.index') }}"> My Account</a>
                                     @else
<i class="icon-user"></i> <a class="font-weight-semibold text-secondary" href="#signin-modal" style="font-size: 15px; font-weight:700; text-transform:uppercase;" data-toggle="modal"> Login & Signup</a>
 
                            @endauth
                       
                    </div><!--End .header-right-->
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->