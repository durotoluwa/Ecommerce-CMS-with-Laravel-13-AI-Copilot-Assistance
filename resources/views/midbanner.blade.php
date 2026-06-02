  
   <div class="container">
  
  
  <div class="banners">
<div class="row banner-group-1">

                        <div class="col-md-6">
                            <div class="banner banner-1 banner-overlay">
                                <a href="{{ $homesectionConfig->secbannerlink1 }}">
                                    <img src="{{ asset($homesectionConfig->secbannerimg1) }}" alt="Banner" width="688" height="400" style="background-color: #f9c8c8;">
                                </a>
        
                                <div class="banner-content banner-content-center">
                                    <h4 class="  ">{{ $homesectionConfig->secbannertext1 }}</h4><!-- End .banner-subtitle -->
                                   
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-6 -->
        


                        <div class="col-md-6">
                            <div class="banner banner-2 banner-overlay">
                                <a href="{{ $homesectionConfig->secbannerlink2 }}">
                                    <img src="{{ asset($homesectionConfig->secbannerimg2) }}" alt="Banner" width="688" height="400" style="background-color: #b9a5bc; ">
                                </a>
        
                                <div class="banner-content banner-content-center">
                                    <h4 class=" ">{{ $homesectionConfig->secbannertext2 }}</h4><!-- End .banner-subtitle -->
                                   
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-6 -->




                    </div><!-- End .row -->    
                    
               <!-- Owl Carousel wrapper -->
                @if($homesectionConfig->status == 1)
<div class="owl-carousel owl-theme owl-banner-group-2" 
     data-toggle="owl" 
     data-owl-options='{
       
        "dots": true,
        "nav": true, 
        "margin": 20,
        "autoplay": {{ $homesectionConfig->autoplay }},
        "autoplayTimeout": {{ $homesectionConfig->autoplaytimeout }},
        "autoplayHoverPause": true,
        "responsive": {
            "0": { "items": 1 },
            "576": { "items": {{ $homesectionConfig->responsive576 }} },
            "992": { "items": {{ $homesectionConfig->responsive992 }} }
        }
     }'>            

  <!-- Catalog items -->


@if($homesectionConfig->selection === 'featured')
    @foreach($featuredcategorysection as $category)
        <div class="item">
            <a href="{{ route('product-category.index', $category->slug) }}">
                <img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}">
                <h3>{{ $category->name }}</h3>
            </a>
        </div>
    @endforeach
@elseif($homesectionConfig->selection === 'all')
    @foreach($categorysection as $category)
        <div class="item">
            <a href="{{ route('product-category.index', $category->slug) }}">
                <img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}">
                <h3>{{ $category->name }}</h3>
            </a>
        </div>
    @endforeach
@endif




  
</div>
             
                </div>
   @endif
                <!--=============End .banners ====================-->  
                
   </div>