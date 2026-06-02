
<!DOCTYPE html>
<html lang="en">

<head>
    @include('include/headerlink')
    
</head>

<body>
<div class="page-wrapper">
<header class="header header-6">
@include('include/headtop')
@include('include/headbottom')    
</header>
<!--========= End .header ============-->
<main class="main">
          <div class="page-header text-center" style="background-image: url('{{ $websiteConfig->breadcrumb }}')">
        		<div class="container">
        			<h1 class="page-title">   {{ $blog->title }}</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
      <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href=" ">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">
            {{ $blog->title }}
            </li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->


  <div class="page-content">
                <figure class="entry-media">
                    <img src="{{ asset($blog->featured_image ?? 'images/default-blog.jpg') }}" 
         alt="{{ $blog->title }}" 
         class="img-fluid">
                </figure><!-- End .entry-media -->
                <div class="container">
                   <article class="entry single-entry entry-fullwidth">
    <div class="row">
        <div class="col-lg-11">
            <div class="entry-body">
                <div class="entry-meta">
                    <span class="entry-author">
                        by <a href="#">{{ $blog->author->name ?? 'Admin' }}</a>
                    </span>
                    <span class="meta-separator">|</span>
                    <a href="#">
                        {{ $blog->publish_date ? $blog->publish_date->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                    </a>
                    <span class="meta-separator">|</span>
                    <a href="#">
                        {{ $blog->comments_count ?? 0 }} Comments
                    </a>
                </div><!-- End .entry-meta -->

                <h2 class="entry-title entry-title-big">
                    {{ $blog->title }}
                </h2><!-- End .entry-title -->

                <div class="entry-cats">
                    in <a href="#">{{ $blog->category->name ?? 'Uncategorized' }}</a>
                </div><!-- End .entry-cats -->

                <div class="entry-content editor-content">
                    {!! $blog->content !!}
                </div><!-- End .entry-content -->
            </div><!-- End .entry-body -->
        </div><!-- End .col-lg-11 -->

        <div class="col-lg-1 order-lg-first mb-2 mb-lg-0">
            <div class="sticky-content">
                <div class="social-icons social-icons-colored social-icons-vertical">
                    <span class="social-label">SHARE:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $blog->slug)) }}" 
                       class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}" 
                       class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('blog.show', $blog->slug)) }}&media={{ asset($blog->featured_image) }}&description={{ urlencode($blog->title) }}" 
                       class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $blog->slug)) }}&title={{ urlencode($blog->title) }}" 
                       class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                </div><!-- End .social-icons -->
            </div><!-- End .sticky-content -->
        </div><!-- End .col-lg-1 -->
    </div><!-- End .row -->
</article><!-- End .entry -->

 

                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3><!-- End .title -->
                        
                        <div class="owl-carousel owl-simple" data-toggle="owl" 
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
                                    }
                                }
                            }'>
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="single.html">
                                        <img src="assets/images/blog/grid/3cols/post-1.jpg" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">Nov 22, 2018</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#">2 Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">Cras ornare tristique elit.</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">Lifestyle</a>,
                                        <a href="#">Shopping</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->

                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="single.html">
                                        <img src="assets/images/blog/grid/3cols/post-2.jpg" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">Nov 21, 2018</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#">0 Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">Vivamus ntulla necante.</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">Lifestyle</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->

                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="single.html">
                                        <img src="assets/images/blog/grid/3cols/post-3.jpg" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">Nov 18, 2018</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#">3 Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">Utaliquam sollicitudin leo.</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">Fashion</a>,
                                        <a href="#">Lifestyle</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->

                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="single.html">
                                        <img src="assets/images/blog/grid/3cols/post-4.jpg" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">Nov 15, 2018</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#">4 Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">Fusce pellentesque suscipit.</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">Travel</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->

                    <div class="comments">
                        <h3 class="title">0 Comment</h3><!-- End .title -->
                    </div><!-- End .comments -->
                    <div class="reply">
                        <div class="heading">
                            <h3 class="title">Leave A Reply</h3><!-- End .title -->
                            <p class="title-desc">Your email address will not be published. Required fields are marked *</p>
                        </div><!-- End .heading -->

                        <form action="#">
                            <label for="reply-message" class="sr-only">Comment</label>
                            <textarea name="reply-message" id="reply-message" cols="30" rows="4" class="form-control" required placeholder="Comment *"></textarea>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="reply-name" class="sr-only">Name</label>
                                    <input type="text" class="form-control" id="reply-name" name="reply-name" required placeholder="Name *">
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <label for="reply-email" class="sr-only">Email</label>
                                    <input type="email" class="form-control" id="reply-email" name="reply-email" required placeholder="Email *">
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->

                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>POST COMMENT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </form>
                    </div><!-- End .reply -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->

 </main><!--End .main-->
@include('footer')   
@include('include/footerlink')
 
</body>
</html>