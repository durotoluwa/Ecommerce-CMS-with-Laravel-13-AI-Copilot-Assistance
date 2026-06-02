

    
    <footer class="main">
       
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">&copy; 2026, <strong class="text-brand">fashionchain </strong> - Online Store</p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        Designed by <a href=" " target="_blank">Toludevop</a>. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>

    

 
    <!-- Vendor JS-->
   <script src="{{ asset('web/js/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('web/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('web/js/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('web/js/slick.js') }}"></script>
<script src="{{ asset('web/js/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('web/js/wow.js') }}"></script>
<script src="{{ asset('web/js/jquery-ui.js') }}"></script>
<script src="{{ asset('web/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('web/js/magnific-popup.js') }}"></script>
<script src="{{ asset('web/js/select2.min.js') }}"></script>
<script src="{{ asset('web/js/waypoints.js') }}"></script>
<script src="{{ asset('web/js/counterup.js') }}"></script>
<script src="{{ asset('web/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('web/js/images-loaded.js') }}"></script>
<script src="{{ asset('web/js/isotope.js') }}"></script>
    <script src="{{asset('web/js/scrollup.js')}}"></script>
    <script src="{{asset('web/js/jquery.vticker-min.js ')}}"></script>
    <script src="{{asset('web/js/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('web/js/jquery.elevatezoom.js')}}"></script>
    <!-- Template  JS -->
    <script src="{{asset('web/js/main.js')}}"></script>
    <script src="{{asset('web/js/shop.js')}}"></script>

<script>
const currencySymbol = "{{ $displayCurrency->symbol }}";

document.getElementById('search-input').addEventListener('keyup', function() {
    let query = this.value;
    const productDetailsBaseUrl = "{{ url('/product') }}";

    if (query.length > 2) {
        fetch("{{ route('products.search') }}?q=" + query)
            .then(response => response.json())
            .then(data => {
                let resultsDiv = document.getElementById('search-results');
                resultsDiv.innerHTML = '';

                if (data.length === 0) {
                    resultsDiv.innerHTML = '<div class="search-item">No products found.</div>';
                }

             data.forEach(product => {
    let priceHtml = '';

    if (product.converted_sale_price && product.converted_regular_price) {
        let discount = 100 - ((product.converted_sale_price / product.converted_regular_price) * 100);
        priceHtml = `
            <span class="search-price text-danger">${currencySymbol} ${parseFloat(product.converted_sale_price).toFixed(2)}</span>
            <del class="search-price text-muted">${currencySymbol} ${parseFloat(product.converted_regular_price).toFixed(2)}</del>
            <small class="text-success">(-${Math.round(discount)}%)</small>
        `;
    } else if (product.converted_regular_price) {
        priceHtml = `<span class="search-price">${currencySymbol} ${parseFloat(product.converted_regular_price).toFixed(2)}</span>`;
    }

  resultsDiv.innerHTML += `
    <a href="${productDetailsBaseUrl}/${product.id}" class="search-item">
        <img src="{{ asset('') }}${product.featured_image}" width="40" alt="${product.name}">
        <div class="search-info">
            <span class="search-name">${product.name}</span>
            ${priceHtml}
        </div>
    </a>
    `;
});

            })
            .catch(error => console.error('Search error:', error));
    } else {
        document.getElementById('search-results').innerHTML = '';
    }
});
</script>

