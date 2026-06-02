
<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.headerlink')
    
</head>

<body>
<div class="page-wrapper">
<header class="header header-6">
@include('include.headtop')
@include('include.headbottom')    
</header>
<!--========= End .header ============-->
<main class="main">
 <div class="page-header text-center" style="background-image: url('{{ $websiteConfig->breadcrumb }}')">
        		<div class="container">
        			<h1 class="page-title"> Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=" ">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                       
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->


            

<div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
                				<div class="toolbox-left">
                					<div class="toolbox-info">
                					<div class="toolbox-info">
    Showing <span>{{ $products->firstItem() }}–{{ $products->lastItem() }}</span> of {{ $products->total() }} Products
</div>
</div><!-- End .toolbox-info -->
</div><!-- End .toolbox-left -->



                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control">
												<option value="popularity" selected="selected">Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div><!-- End .toolbox-sort -->
                					 
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->



  <div id="product-list" class="products mb-3">
    <div class="row justify-content-center">
        @foreach($products as $product)
            @include('shop.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</div>

<div id="load-more-wrapper" class="d-flex justify-content-center mt-3">
    @if ($products->hasMorePages())
        <button id="load-more" class="btn btn-primary"
                data-url="{{ $products->nextPageUrl() }}">
            Load More
        </button>
    @endif
</div>



                		</div><!-- End .col-lg-9 -->

@include('include.product_sidebar')
 





                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->










 </main><!--End .main-->
@include('footer')   
@include('include/footerlink')
<script>

function collectFilters() {

    const selectedCategories = [];

    document.querySelectorAll('.filter-checkbox[data-type="category"]:checked')
        .forEach(cb => selectedCategories.push(cb.dataset.value));

    const selectedSizes = [];

    document.querySelectorAll('.filter-checkbox[data-type="size"]:checked')
        .forEach(cb => selectedSizes.push(cb.dataset.value));

    const selectedBrands = [];

    document.querySelectorAll('.filter-checkbox[data-type="brand"]:checked')
        .forEach(cb => selectedBrands.push(cb.dataset.value));

    const selectedColors = [];

    document.querySelectorAll('.filter-checkbox[data-type="color"]:checked')
        .forEach(cb => selectedColors.push(cb.dataset.value));

    /*
    |--------------------------------------------------------------------------
    | PRICE FILTER
    |--------------------------------------------------------------------------
    */

    const minPrice = document.getElementById('min-price')?.value || null;

    const maxPrice = document.getElementById('max-price')?.value || null;

    return {

        categories: selectedCategories,

        sizes: selectedSizes,

        brands: selectedBrands,

        colors: selectedColors,

        min_price: minPrice,

        max_price: maxPrice
    };
}

/*
|--------------------------------------------------------------------------
| FILTER PRODUCTS FUNCTION
|--------------------------------------------------------------------------
*/

function filterProducts(url = null) {

    const filters = collectFilters();

    fetch(url ?? "{{ route('shop.filter.categories') }}", {

        method: 'POST',

        headers: {

            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),

            'X-Requested-With': 'XMLHttpRequest',

            'Accept': 'application/json',

            'Content-Type': 'application/json'
        },

        body: JSON.stringify(filters)

    })

    .then(res => res.json())

    .then(data => {

        if (data.success) {

            document.getElementById('product-list').innerHTML = data.html;

            const wrapper = document.getElementById(
                'load-more-wrapper'
            );

            if (data.nextPage) {

                wrapper.innerHTML = `

                    <button
                        id="load-more"
                        class="btn btn-primary"
                        data-url="${data.nextPage}">

                        Load More

                    </button>
                `;

            } else {

                wrapper.innerHTML = '';
            }

            document.querySelector('.toolbox-info').innerHTML =

                `Showing <span>${data.firstItem}–${data.lastItem}</span>
                 of ${data.total} Products`;
        }
    });
}

/*
|--------------------------------------------------------------------------
| Checkbox Change
|--------------------------------------------------------------------------
*/

document.addEventListener('change', function(e) {

    const checkbox = e.target.closest('.filter-checkbox');

    const priceInput =
        e.target.closest('#min-price') ||
        e.target.closest('#max-price');

    if (!checkbox && !priceInput) return;

    filterProducts();
});

/*
|--------------------------------------------------------------------------
| PRICE BUTTON FILTER
|--------------------------------------------------------------------------
*/

document.addEventListener('click', function(e) {

    const btn = e.target.closest('#apply-price-filter');

    if (!btn) return;

    filterProducts();
});

/*
|--------------------------------------------------------------------------
| LOAD MORE
|--------------------------------------------------------------------------
*/

document.addEventListener('click', function(e) {

    const btn = e.target.closest('#load-more');

    if (!btn) return;

    const filters = collectFilters();

    fetch(btn.dataset.url, {

        method: 'POST',

        headers: {

            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),

            'X-Requested-With': 'XMLHttpRequest',

            'Accept': 'application/json',

            'Content-Type': 'application/json'
        },

        body: JSON.stringify(filters)

    })

    .then(res => res.json())

    .then(data => {

        if (data.success) {

            document.querySelector('#product-list .row')
                .insertAdjacentHTML('beforeend', data.html);

            if (data.nextPage) {

                btn.dataset.url = data.nextPage;

            } else {

                btn.remove();
            }

            document.querySelector('.toolbox-info').innerHTML =

                `Showing <span>${data.firstItem}–${data.lastItem}</span>
                 of ${data.total} Products`;
        }
    });
});

</script>


<script>
document.addEventListener('click', function(e) {
    const btn = e.target.closest('#load-more');
    if (!btn) return;

    fetch(btn.dataset.url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Append new products
            document.querySelector('#product-list .row').insertAdjacentHTML('beforeend', data.html);

            // Update button or remove if no more pages
            if (data.nextPage) {
                btn.dataset.url = data.nextPage;
            } else {
                btn.remove();
            }
        }
    });
});


</script>


</body>
</html>