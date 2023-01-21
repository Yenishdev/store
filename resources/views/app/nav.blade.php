<nav class="navbar navbar-expand-lg navbar-dark bg-primary" aria-label="navbar">
    <div class="container-lg">
        <a class="navbar-brand" href="{{ route('home') }}">Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.create') }}">Add Product</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('categories.show', $category->slug) }}">
                                    {{ $category->name }}
                                    <span class="badge text-bg-light">{{ $category->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Brands</a>
                    <ul class="dropdown-menu">
                        @foreach($brands as $brand)
                            <li>
                                <a class="dropdown-item" href="{{ route('brands.show', $brand->slug) }}">
                                    {{ $brand->name }}
                                    <span class="badge text-bg-light">{{ $brand->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        Cart <span class="badge text-bg-danger">{{ $cartIds }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>