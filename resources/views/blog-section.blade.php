   @if($homesectionConfig->blog_status == 1)
 <div class="container">
                <div class="heading heading-flex heading-blog">
                    <div class="heading-left">
                        <h2 class="title font-weight-semibold">{{ $homesectionConfig->blog_heading }}</h2><!-- End .title -->
                    </div><!-- End .heading-left -->
        
                    <div class="heading-right">
                        <a href="#" class="title-link font-weight-normal">VIEW MORE <i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .heading-right -->
                </div><!-- End .heading -->

                <hr class="mb-3">

                <div class="owl-carousel owl-simple owl-entry" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": false,
                        "items": 3,
                        "margin": 20,
                         "autoplay": {{ $homesectionConfig->blog_autoplay }},
                         "autoplayTimeout": {{ $homesectionConfig->blog_autoplaytimeout }},
                        "loop": true,
                        "responsive": {
                            "0": {
                                "items":1,
                                "dots": true
                            },
                            "576": {
                                "items":2,
                                "dots": true
                            },
                            "768": {
                                "items":{{ $homesectionConfig->blog_responsive576 }}
                            },
                            "992": {
                                "items":{{ $homesectionConfig->blog_responsive992 }}
                            }
                        }
                    }'>


                  @foreach($allblogpost as $post)
<article class="entry">
    <figure class="entry-media banner-overlay">
        <a href="{{ route('blog.show', $post->slug) }}">
            <img src="{{ asset($post->featured_image ?? 'images/default-blog.jpg') }}" 
                 alt="{{ $post->title }}" style="background-color: #ccc;">
        </a>
    </figure><!-- End .entry-media -->

    <div class="entry-body">
        <div class="entry-meta">
            <a href="#">
                {{ $post->publish_date ? $post->publish_date->format('M d, Y') : $post->created_at->format('M d, Y') }}
            </a> <span class="mx-2">|</span>
            
          <a href="#">
        {{ $post->category->name ?? 'Uncategorized' }}
    </a>
        </div><!-- End .entry-meta -->

        <h3 class="entry-title">
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3><!-- End .entry-title -->

        <div class="entry-content">
            {!! Str::limit($post->short_description ?? $post->content, 150) !!}
        </div><!-- End .entry-content -->
    </div><!-- End .entry-body -->
</article><!-- End .entry -->
@endforeach

 </div><!-- End .owl-carousel -->
</div><!--End .container-->    
</div>

  @endif