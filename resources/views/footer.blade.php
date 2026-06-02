<footer class="footer footer-2">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xl-2-5col">
                            <div class="widget widget-about">
<img src="{{ asset($websiteConfig->footer_logo) }}" class="footer-logo" alt="Footer Logo" width="82" height="22">
                                
                               {{ $websiteConfig->footer_content }}
                                
                                <div class="widget-about-info">                                  
                                                              
                                </div><!-- End .widget-about-info -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-md-12 col-xl-2-5col-->

<div class="col-md-12 col-xl-3-5col">              
<div class="row">
    <div class="col-md-4">
        <div class="widget">
            <h4 class="widget-title text-white">{{ $footer->footer_colunm1_headline }}</h4>
            <ul class="widget-list">
                @foreach($footer->footer_colunm1 ?? [] as $link)
                    <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="widget">
            <h4 class="widget-title text-white">{{ $footer->footer_colunm2_headline }}</h4>
            <ul class="widget-list">
                @foreach($footer->footer_colunm2 ?? [] as $link)
                    <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="widget">
            <h4 class="widget-title text-white">{{ $footer->footer_colunm3_headline }}</h4>
            <ul class="widget-list">
                @foreach($footer->footer_colunm3 ?? [] as $link)
                    <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

 



                
                          
                
                             
                            </div><!--End .row-->
                        </div><!--End .col-md-12 col-xl-3-5col-->                        
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!--End .footer-middle-->
            
            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">{{ $websiteConfig->copywrite_text }}</p><!-- End .footer-copyright -->
                  

                    <div class="social-icons social-icons-color">
                        <span class="social-label">Social Media</span>
                        <a href="{{ $websiteConfig->facebook_link }}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="{{ $websiteConfig->x_link }}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="{{ $websiteConfig->instagram_link }}" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="{{ $websiteConfig->linkedin_link }}" class="social-icon social-youtube" title="linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                     </div><!-- End .soial-icons -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->

        </footer><!-- End .footer -->
    </div>

      <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form id="search-form" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="search-input" placeholder="Search in..." required>
                    <div id="search-results" class="search-results"></div>
            </form>


            
    
    
            
 <nav class="mobile-nav">
    <ul class="mobile-menu">
        @foreach(getMenus() as $menu)

            {{-- MULTILEVEL MENU (mega or normal) --}}
            @if($menu->children->count())
                <li>
                    <a href="{{ menuUrl($menu) }}">
                        {{ $menu->title }}
                    </a>

                    <ul>
                        @foreach($menu->children as $child)

                            {{-- If child has its own children, render nested list --}}
                            <li>
                                <a href="{{ menuUrl($child) }}">
                                    {{ $child->title }}
                                </a>

                                @if($child->children->count())
                                    <ul>
                                        @foreach($child->children as $grandchild)
                                            <li>
                                                <a href="{{ menuUrl($grandchild) }}">
                                                    {{ $grandchild->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>

                        @endforeach
                    </ul>
                </li>

            {{-- SINGLE MENU --}}
            @else
                <li>
                    <a href="{{ menuUrl($menu) }}">
                        {{ $menu->title }}
                    </a>
                </li>
            @endif

        @endforeach
    </ul>
</nav>


            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                 <form method="POST" action="{{ route('user.login.post') }}">
                                                 @csrf
                                        <div class="form-group">
                                            <label for="singin-email">Username</label>
                                            <input type="text" class="form-control" id="singin-email"  name="username" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <!---
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6  
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div>  End .col-6 
                                        </div>  End .row  
                                    </div> End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                            <div class="form-group">
                                            <label for="register-email">First Name</label>
                                            <input type="text" class="form-control"    name="first_name" required>
                                        </div><!-- End .form-group -->


                                          <div class="form-group">
                                            <label for="register-email">Last Name</label>
                                            <input type="text" class="form-control"    name="last_name" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <!---
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    