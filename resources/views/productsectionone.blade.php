   
 
 <div class="container">
 @if($homesectionConfig->productsectionone_status == 1)
  
  <div class="heading heading-flex">
                    <div class="heading-left">
                        <h2 class="title font-weight-semibold"> {!! $homesectionConfig->productsectionone_heading !!}</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                    <div class="heading-right">
                            <a href="{!! $homesectionConfig->productsectionone_link !!}" class="title-link font-weight-normal">VIEW MORE <i class="icon-long-arrow-right"></i></a>
                   
                   
                        </div><!-- End .heading-right -->
                </div><!-- End .heading -->

                <hr class="mb-3">

                <div class="products">
                    <div class="row">

@if($homesectionConfig->productsectionone_selection === 'featured')
    @foreach($featuredproductsection->where('categories.*.id', $homesectionConfig->productsectionone_category)->take(10) as $product)
        @include('partials.product_card', ['product' => $product])
    @endforeach

@elseif($homesectionConfig->productsectionone_selection === 'new')
    @foreach($newproductsection->filter(function($product) use ($homesectionConfig) {
        return $homesectionConfig->productsectionone_category === 'all' 
            || $product->categories->contains('id', $homesectionConfig->productsectionone_category);
    })->take(10) as $product)
        @include('partials.product_card', ['product' => $product])
    @endforeach
@endif




                    </div><!-- End .row -->
                </div><!-- End .products -->


                      <div class="more-container text-center mb-7">
                    <a href="{!! $homesectionConfig->productsectionone_link !!}" class="btn btn-outline-primary btn-more"><span class="font-weight-semibold">VIEW MORE PRODUCTS</span></a>
                </div><!-- End .more-container -->
              @endif

 </div>