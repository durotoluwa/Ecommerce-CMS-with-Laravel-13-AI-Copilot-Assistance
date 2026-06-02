<div class="row justify-content-center">
    @foreach($products as $product)
        @include('product-category.partials.product-card', ['product' => $product])
    @endforeach
</div>

 
 