<div class="bg-white border rounded">
    <div class="row">
        <div class="col-5">
            <img src="{{$product->image ? Storage::url('products/sm/'.$product->image) : asset('img/sm/product.jpg') }}"
                 alt="{{$product->name}}" class="img-fluid rounded">
        </div>
        <div class="col py-3">
            <a href="{{route('products.show', $product->slug)}}" class="h6 d-block">
                {{$product->name}}
            </a>
            <div class="h6 small">
                <a href="{{route('categories.show', $product->category->slug)}}" class="link-secondary">
                    {{$product->category->name}}
                </a>
                <span class="mx-1">.</span>
                <a href="{{route('brands.show', $product->brand->slug)}}" class="link-secondary">
                    {{$product->brand->name}}
                </a>
            </div>
            <div class="h6 small">
                <i class="bi-upc-scan"></i>
                {{$product->barcode}}
            </div>
            <div class="small h6">
                {{number_format($product->price, 2, '.', '')}}
                <small>TMT</small>
                <span class="text-secondary mx-2">|</span>
                <i class="bi-box-fill text-secondary"></i>
                {{ $product->stock }}
                <span class="mx-1">∙</span>
                <i class="bi-eye-fill text-secondary"></i>
                {{ $product->viewed }}
            </div>
            <button type="button" class="btn btn-dark btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->id }}">
                <i class="bi-trash-fill"></i> Delete
            </button>
            <div class="modal fade" id="deleteModal-{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModal-{{ $product->id }}Label"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModal-{{ $product->id }}Label">Delete Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>Are you sure to delete "{{ $product->name }}"?</div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('products.delete', $product->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-dark btn-sm">
                                    <i class="bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success btn-sm mb-1">
                <i class="bi-pencil-fill"></i> Edit
            </a>
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-danger btn-sm mb-1">
                <i class="bi-plus-lg"></i> Add to cart
            </a>
        </div>        
    </div>
</div>