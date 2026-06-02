  @if($homesectionConfig->testimony_status == 1)
 <div class="container">
 
 <h2 class="title title-reviews font-weight-semibold">{{ $homesectionConfig->testimony_heading }}</h2><!-- End .title -->

                <hr>

                <div class="owl-carousel owl-theme owl-reviews" data-toggle="owl" data-owl-options='{
                        "dots": true,
                        "nav": true, 
                        "autoplay": {{ $homesectionConfig->testimony_autoplay }},
                         "autoplayTimeout": {{ $homesectionConfig->testimony_autoplaytimeout }},
                        "margin": 20,
                        "responsive": {
                            "0": {
                                "items": 1,
                                "dots": true
                            },
                            "768": {
                                "items": {{ $homesectionConfig->testimony_responsive576 }},
                                "dots": false
                            },
                            "992": {
                                "items": {{ $homesectionConfig->testimony_responsive992 }}
                            }
                        }
                    }'> 


@foreach($alltestimony as $testimony)
<div class="testimonial">                    
    <div class="avatar">
        <img src="{{ asset($testimony->customer_image ?? 'images/default-avatar.png') }}" 
             alt="{{ $testimony->customer_name }}" width="98" height="98">
    </div><!--End .avatar-->   

    <div class="content">
        <div class="ratings-container">
            <div class="ratings">
                <div class="ratings-val" style="width: {{ ($testimony->rating / 5) * 100 }}%;"></div>
            </div><!-- End .ratings -->
        </div><!-- End .rating-container -->                                   

        <div class="comment-title font-weight-semibold">
            {{ $testimony->title ?? 'Customer Review' }}
        </div>

        <p class="comment">{{ $testimony->review }}</p>

        <div class="commenter">
            <span class="name font-weight-normal">{{ $testimony->customer_name }}</span>
        </div>
    </div><!--End .content-->                                           
</div><!--End .testimonial-->
@endforeach
 </div><!--End .owl-carousel-->   

 </div>

    @endif