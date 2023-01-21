<div class="row align-items-center bg-white border rounded mb-3">
    <div class="col-auto">
        <img src="{{  $product['product']->image ? Storage::url('products/sm/'.$product['product']->image) : asset('img/sm/product.jpg') }}"
             alt="{{ $product['product']->name }}" class="img-fluid rounded">
    </div>
    <div class="col-4">
        <a href="{{route('products.show', $product['product']->slug) }}" class="h5 d-block">
            {{$product['product']->name }}
        </a>
        <div class="h6">
            <a href="{{route('categories.show', $product['product']->category->slug)}}" class="link-secondary">
                {{$product['product']->category->name }}
            </a>
            <span class="mx-1">.</span>
            <a href="{{route('brands.show', $product['product']->brand->slug)}}" class="link-secondary">
                {{$product['product']->brand->name}}
            </a>
        </div>
        <div class="h6">
            <i class="bi-upc-scan"></i>
            {{$product['product']->barcode}}
        </div>
    </div>
    <div class="col text-center">
        <div class="h6">
            {{number_format($product['product']->price, 2, '.', '')}}
            <small>TMT</small>
        </div>
    </div>
    <div class="col text-center">
        <div class="h6 text-danger mb-0">{{$product['count']}}</div>
    </div>
    <div class="col text-center">
        <div class="h6">
            {{number_format($product['product']->price * $product['count'], 2, '.', ' ')}}
            <small>TMT</small>
        </div>
    </div>
    <div class="col-auto text-center">
        <a href="{{route('cart.remove', $product['product']->id)}}" class="btn btn-secondary btn-sm my-2">
            <i class="bi-x-lg"></i>
        </a>
    </div>
</div>