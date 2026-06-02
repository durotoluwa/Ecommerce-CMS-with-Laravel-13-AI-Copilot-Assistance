    

    
    
    <!-- Plugins JS File -->
    <script src="{{asset('web/js/jquery.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('web/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{asset('web/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('web/js/superfish.min.js')}}"></script>
    <script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('web/js/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('web/js/jquery.magnific-popup.min.js')}} "></script>
    <script src="{{asset('web/js/jquery.countdown.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{asset('web/js/script.js')}}"></script>
    <script src="{{asset('web/js/main.js')}}"></script>

 
    




<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.addToCartForm').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let actionUrl = this.action;

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {

                    // Update cart count
                    document.querySelector('.cart-count').innerText = data.cart_count;

                    // Update total
                    //document.querySelector('.cart-total-amount').innerText =
                      //  '₦ ' + Number(data.cart_total).toLocaleString();
                       
                      document.querySelector('.header-cart-total').innerText =
    '₦ ' + Number(data.cart_total).toLocaleString();

document.querySelector('.dropdown-cart-total-amount').innerText =
    '₦ ' + Number(data.cart_total).toLocaleString();

                    // Update cart dropdown
                    let cartContainer = document.querySelector('.cart-items-container');

                    cartContainer.innerHTML = '';

                  data.items.forEach(item => {

cartContainer.innerHTML += `
    <div class="product">
        <div class="product-cart-details">
            <h4 class="product-title">
                <a href="/product/${item.id}">${item.name}</a>
            </h4>
            <span class="cart-product-info">
                <span class="cart-product-qty">${item.quantity}</span>
                × ₦ ${Number(item.price).toLocaleString()}
            </span>
            ${item.color ? `<div>Color: <span style="text-transform:capitalize">${item.color}</span></div>` : ''}
            ${item.size ? `<div>Size: <span>${item.size}</span></div>` : ''}
        </div>
        <figure class="product-image-container">
            <a href="/product/${item.id}" class="product-image">
                <img src="/${item.image}" alt="${item.name}" width="60" height="60">
            </a>
        </figure>
        <button type="button"
                class="btn-remove remove-cart-item"
                data-url="/cart/remove/${item.cart_key}"
                title="Remove Product">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
`;

});

                    // Toastr success
                    toastr.success('Product added to cart');

                } else {
                    toastr.error(data.message || 'Something went wrong');
                }

            })
            .catch(error => {
                console.log(error);
                toastr.error('Error adding product to cart');
            });

        });

    });

});
</script>
 





<script>
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.remove-cart-item');
    if (!btn) return;

    e.preventDefault();

    fetch(btn.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Remove product row
            const productRow = btn.closest('.product');
            if (productRow) productRow.remove();

            // Update cart count
           // Update cart count
const countEl = document.getElementById('cart-count');
if (countEl) countEl.textContent = data.cart_count;

// Update totals or clear if empty
if (data.cart_count === 0) {
    document.querySelectorAll('.cart-total-amount').forEach(el => {
        el.textContent = '₦0.00';
    });
    const totalsSection = document.querySelector('.dropdown-cart-total');
    if (totalsSection) totalsSection.style.display = 'none';
    const container = document.querySelector('.cart-items-container');
    if (container) container.innerHTML = '<p class="empty-cart">Your cart is empty.</p>';
} else {
    // Update totals everywhere
    document.querySelectorAll('.cart-total-amount').forEach(el => {
        el.textContent = '₦ ' + Number(data.cart_total).toLocaleString();
    });
    const totalsSection = document.querySelector('.dropdown-cart-total');
    if (totalsSection) totalsSection.style.display = '';
}


        }
    })
    .catch(err => console.error(err));
});
</script>




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


<script>

document.addEventListener('DOMContentLoaded', function () {

    const slider = document.getElementById('price-slider');

    const symbol = slider.dataset.symbol;

    const maxPrice = Number(slider.dataset.max);

    noUiSlider.create(slider, {

        start: [0, maxPrice],

        connect: true,

        step: 10,

        range: {
            min: 0,
            max: maxPrice
        }

    });

    const priceRange = document.getElementById(
        'filter-price-range'
    );

    slider.noUiSlider.on('update', function (values) {

        const min = Math.round(values[0]);

        const max = Math.round(values[1]);

        document.getElementById('min-price').value = min;

        document.getElementById('max-price').value = max;

        priceRange.innerHTML = `
            ${symbol}${min.toLocaleString()}
            —
            ${symbol}${max.toLocaleString()}
        `;
    });

    /*
    |--------------------------------------------------------------------------
    | Apply Price Filter
    |--------------------------------------------------------------------------
    */

    document.getElementById('apply-price-filter')

        .addEventListener('click', function () {

            filterProducts();

        });

});

</script>
