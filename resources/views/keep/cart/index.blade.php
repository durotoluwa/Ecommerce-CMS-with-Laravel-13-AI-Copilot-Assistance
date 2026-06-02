
<!DOCTYPE html>
<html class="no-js" lang="en">


@include('headerlink')
<body>
@include('head')
<main class="main">
     <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>



   <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                          <form action="{{ route('cart.update') }}" method="POST">
    @csrf
    <table class="table shopping-summery text-center clean">
             <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
        <tbody>
            @foreach(session('cart', []) as $item)
                <tr>
                    <td class="image product-thumbnail">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    </td>
                    <td class="product-des product-name">
                        <h5 class="product-name">{{ $item['name'] }}</h5>
                    </td>
                    <td class="price" data-title="Price">
                        <span>{{ $displayCurrency->symbol }} {{ number_format($item['price'], 2) }}</span>
                    </td>
                    <td class="text-center" data-title="Quantity">
                        <input type="number"
                               name="quantities[{{ $item['id'] }}]"
                               value="{{ $item['quantity'] }}"
                               min="1"
                               max="{{ $item['stock_quantity'] }}"
                               class="form-control qty-val"
                               style="width: 70px; text-align: center;">
                    </td>
                    <td class="text-right" data-title="Subtotal">
                        <span>{{ $displayCurrency->symbol }} {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </td>
                    <td class="action" data-title="Remove">
                        <a href="{{ route('cart.remove', $item['id']) }}" class="text-muted">
                           <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cart-action text-end">
        <button type="submit" class="btn mr-10 mb-sm-15">
            <i class="fa-solid fa-shuffle"></i> Update Cart
        </button>
  <a href="{{ route('shop.index') }}" class="btn">
    <i class="fa-solid fa-bag-shopping"></i> Continue Shopping
</a>

    </div>
</form>

                        </div>
                    
                         <div class="row mb-50">
                         
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                           <table class="table">
    <tbody>
        <tr>
            <td class="cart_total_label">Cart Subtotal</td>
            <td class="cart_total_amount">
                <span class="font-lg fw-900 text-brand">
                    {{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}
                </span>
            </td>
        </tr>
        <tr>
            <td class="cart_total_label">Total</td>
            <td class="cart_total_amount">
                <strong>
                    <span class="font-xl fw-900 text-brand">
                        {{ $displayCurrency->symbol }} {{ number_format(session('cart_total', 0), 2) }}
                    </span>
                </strong>
            </td>
        </tr>
    </tbody>
</table>

                                    </div>
<a href="{{ route('checkout.index') }}" class="btn">
    <i class="fa-solid fa-bag-shopping"></i> Proceed To Checkout
</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



</main>


    
 
@include('footer')
 </body>

</html>