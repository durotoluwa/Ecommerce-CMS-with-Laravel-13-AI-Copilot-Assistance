<div class="row justify-content-center">
    @foreach($products as $product)
        @include('shop.partials.product-card', ['product' => $product])
    @endforeach
</div>

 
 