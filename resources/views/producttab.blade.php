 @if($homesectionConfig->producttab_status == 1)

<div class="container pt-6 new-arrivals">
              <div class="heading heading-center mb-3">
    <h2 class="title">{!! $homesectionConfig->producttab_section_title !!}</h2>

 
    <ul class="nav nav-pills justify-content-center" role="tablist">
        @foreach($productTabs as $index => $tab)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                   id="tab{{ $index }}-link"
                   data-toggle="tab"
                   href="#tab{{ $index }}"
                   role="tab"
                   aria-controls="tab{{ $index }}"
                   aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                   {{ $tab['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="tab-content">
    @foreach($productTabs as $index => $tab)
        <div class="tab-pane p-0 fade {{ $loop->first ? 'show active' : '' }}"
             id="tab{{ $index }}"
             role="tabpanel"
             aria-labelledby="tab{{ $index }}-link">
            <div class="products">
                <div class="row justify-content-center">
                    @foreach($tab['products'] as $product)
                        @include('partials.product_tab_card', ['product' => $product])
                    @endforeach
                </div>
            </div>
            <div class="more-container text-center mt-1 mb-3">
                <a href="{{ $tab['shoplink'] }}" class="btn btn-outline-primary-2 btn-round btn-more">
                    Load more
                </a>
            </div>
        </div>
    @endforeach
</div>

            </div><!-- End .container -->

                  @endif