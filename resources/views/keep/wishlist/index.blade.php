
<!DOCTYPE html>
<html class="no-js" lang="en">


@include('headerlink')
<body>
@include('head')
<main class="main">
     <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="" rel="nofollow">Home</a>
                    <span></span> wishlist
                   
                </div>
            </div>
        </div>




        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                      
                        <div class="row product-grid-3">

      @if($wishlists->isEmpty())
        <p>No items in your wishlist yet.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $wishlist)
                    <tr>
                        <td><img src="{{ asset($wishlist->product->featured_image) }}" alt="{{ $wishlist->product->name }}" width="60"></td>
                        <td>{{ $wishlist->product->name }}</td>
<td>
    @if($wishlist->product->converted_sale_price && $wishlist->product->converted_regular_price)
        @php
            $discount = 100 - (($wishlist->product->converted_sale_price / $wishlist->product->converted_regular_price) * 100);
        @endphp

        <span class="text-danger">
            {{ $displayCurrency->symbol }} {{ number_format($wishlist->product->converted_sale_price, 2) }}
        </span>
        <del class="text-muted">
            {{ $displayCurrency->symbol }} {{ number_format($wishlist->product->converted_regular_price, 2) }}
        </del>
        <small class="text-success">(-{{ number_format($discount, 0) }}%)</small>
    @else
        {{ $displayCurrency->symbol }} {{ number_format($wishlist->product->converted_regular_price, 2) }}
    @endif
</td>



                        <td>
                            @if($wishlist->product->stock_quantity > 0)
                                <span class="text-success">In Stock</span>
                            @else
                                <span class="text-danger">Out of Stock</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('wishlist.remove', $wishlist->product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>

                            @if($wishlist->product->stock_quantity > 0)
                                <form action="{{ route('wishlist.moveToCart', $wishlist->product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>



</main>


    
 
@include('footer')
 </body>

</html>