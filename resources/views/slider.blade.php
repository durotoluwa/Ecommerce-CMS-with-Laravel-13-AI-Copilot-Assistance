   <div class="intro-slider-container">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
                        "dots": true,
                        "nav": false, 
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>


                @foreach($bannerSliders as $slider)
    <div class="intro-slide" style="background-image: url({{ asset($slider->slider_image) }});">
        <div class="container">
            <div class="intro-content text-center">
                <h3 class="intro-subtitle text-white">{!! $slider->heading1 !!}</h3>
                <h1 class="intro-title text-white">{!! $slider->heading2 !!}</h1>

                @if($slider->button_link && $slider->button_title)
                    <a href="{!! $slider->button_link !!}" class="btn btn-primary font-weight-semibold">
                        <span>{!! $slider->button_title !!}</span>
                        <i class="icon-angle-right"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endforeach


                            
                        </div><!-- End .container -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .intro-slider owl-carousel owl-theme -->
        
                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

           -