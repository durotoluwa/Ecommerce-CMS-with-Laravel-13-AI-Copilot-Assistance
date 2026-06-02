           		
                        
                        
                        
                        <aside class="col-lg-3 order-lg-first">
                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                					<label>Filters:</label>
                					<a href="#" class="sidebar-filter-clear">Clean All</a>
                				</div><!-- End .widget widget-clean -->


                			<div class="widget widget-collapsible">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
            Category
        </a>
    </h3>
    <div class="collapse show" id="widget-1">
        <div class="widget-body">
            <div class="filter-items filter-items-count">
                @foreach($categories as $category)
                    <div class="filter-item">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input filter-checkbox"
                                   id="cat-{{ $category->id }}"
                                   data-type="category"
                                   data-value="{{ $category->id }}">
                            <label class="custom-control-label" for="cat-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                        <span class="item-count">{{ $category->products_count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>





        				<div class="widget widget-collapsible">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-size" role="button" aria-expanded="true" aria-controls="widget-size">
            Size
        </a>
    </h3>
    <div class="collapse show" id="widget-size">
        <div class="widget-body">
            <div class="filter-items filter-items-count">
             @foreach($sizes as $size)
    <div class="filter-item">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input filter-checkbox"
                   id="size-{{ $size->id }}"
                   data-type="size"
                   data-value="{{ $size->id }}">
            <label class="custom-control-label" for="size-{{ $size->id }}">
                {{ $size->name }}
            </label>
        </div>
        <span class="item-count">{{ $size->products_count }}</span>
    </div>
@endforeach

            </div>
        </div>
    </div>
</div>



			<div class="widget widget-collapsible">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-size" role="button" aria-expanded="true" aria-controls="widget-size">
            Colour
        </a>
    </h3>
    <div class="collapse show" id="widget-size">
        <div class="widget-body">
            <div class="filter-items filter-items-count">
   @foreach($colors as $color)
    <div class="filter-item">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input filter-checkbox"
                   id="color-{{ $color->id }}"
                   data-type="color"
                   data-value="{{ $color->id }}">
            <label class="custom-control-label" for="color-{{ $color->id }}">
                <span class="color-swatch" style="background: {{ $color->slug ?? '#000' }};"></span>
                {{ $color->name }}
            </label>
        </div>
    </div>
@endforeach


            </div>
        </div>
    </div>
</div>



        					 

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-4">
										<div class="widget-body">
											<div class="filter-items">
											@foreach($brands as $brand)
    <div class="filter-item">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input filter-checkbox"
                   id="brand-{{ $brand->id }}"
                   data-type="brand"
                   data-value="{{ $brand->id }}">
            <label class="custom-control-label" for="brand-{{ $brand->id }}">
                {{ $brand->name }}
            </label>
        </div>
    </div>
@endforeach


												 

											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        			<!-- PRICE FILTER -->

   <div class="widget widget-collapsible">

    <h3 class="widget-title">
        <a data-toggle="collapse"
           href="#widget-price"
           role="button"
           aria-expanded="true"
           aria-controls="widget-price">

            Filter By Price

        </a>
    </h3>

    <div class="collapse show" id="widget-price">

        <div class="widget-body">

            <div class="price-filter-wrapper">

                <!-- Slider -->
              <div
    id="price-slider"
    data-symbol="{{ $displayCurrency->symbol }}"
    data-min="{{ $minPrice }}"
    data-max="{{ $maxPrice }}">
</div>

                <!-- Bottom -->
                <div class="price-bottom">

                    <button
                        type="button"
                        class="btn-price-filter"
                        id="apply-price-filter">

                        Filter

                    </button>

                    <div class="price-text">

                        Price:
                        <span id="filter-price-range"></span>

                    </div>

                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" id="min-price">
                <input type="hidden" id="max-price">

            </div>

        </div>

    </div>

</div>




                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
