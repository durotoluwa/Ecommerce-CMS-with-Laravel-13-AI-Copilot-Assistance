<div class="col-6 col-md-4 col-lg-4 col-xl-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <span class="product-label label-new">New</span>
                                            <a href="{{ route('product.details', $product->slug) }}">
    @if(!empty($product->featured_image) && file_exists(public_path($product->featured_image)))
        <img src="{{ asset($product->featured_image) }}" 
             alt="{{ $product->name }}" 
             class="product-image" 
             style="background-color: #ebebeb;">
        <img src="{{ asset($product->featured_image) }}" 
             alt="{{ $product->name }}" 
             class="product-image-hover" 
             style="background-color: #ebebeb;">
    @else
        <img src="{{ asset('admin/assets/image/productimage.jpg') }}" 
             alt="Default product image" 
             class="product-image" 
             style="background-color: #ebebeb;">
        <img src="{{ asset('admin/assets/image/productimage.jpg') }}" 
             alt="Default product image" 
             class="product-image-hover" 
             style="background-color: #ebebeb;">
    @endif
</a>
            <div class="product-action-vertical">
                @auth('customer')
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" aria-label="Add To Wishlist" class="action-btn hover-up">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('user.login') }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                @endauth
                <a href="{{ route('product.quickview', $product->id) }}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
            </div>
            <div class="product-action">
                <a href="{{ route('cart.add', $product->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>
            </div>
        </figure>
        <div class="product-body">
            <div class="product-cat">
                @foreach($product->categories as $category)
                    <a href="">{{ $category->name }}@if(!$loop->last), @endif</a>
                @endforeach
            </div>
            <h3 class="product-title"><a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a></h3>
            <div class="product-price">
                <span style="margin-right: 20px;">
                    {{ $displayCurrency->symbol }} {{ number_format($product->converted_regular_price, 2) }}
                </span>
                @if($product->converted_sale_price)
                    <span class="old-price">
                        {{ $displayCurrency->symbol }} {{ number_format($product->converted_sale_price, 2) }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
