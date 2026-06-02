<div class="row justify-content-center">
    @foreach($products as $product)
        @include('brand.partials.product-card', ['product' => $product])
    @endforeach
</div>

 
 