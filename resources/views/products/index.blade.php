<x-app-layout>
    <div class="container py-4">

        {{-- Search + Category Filter --}}
        <form method="GET" action="{{ route('home') }}" class="mb-4">
            <div class="row g-2">
                {{-- Search bar --}}
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Rechercher produits..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                {{-- Category filter --}}
                <div class="col-md-4">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">Toutes les categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        {{-- Products Grid --}}
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                            {{-- Image --}}
                            <div class="position-relative" style="height: 250px; overflow: hidden;">
                                <img src="{{ asset(optional($product->images->first())->path ?? 'placeholder.jpg') }}"
                                     class="card-img-top w-100 h-100 object-fit-cover"
                                     alt="{{ $product->title }}">
                            </div>

                            {{-- Card Body --}}
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title mb-2">{{ $product->title }}</h5>
                                    <p class="text-primary fw-bold mb-0">{{ $product->price }} MAD</p>
                                </div>
                            </div>
                        </a>

                        {{-- Add to Cart --}}
                        @auth
                            <div class="d-flex align-items-center justify-content-center p-3 border-top">
                                <div class="input-group" style="width: 140px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty({{ $product->id }})">−</button>
                                    <input type="number" id="qty-{{ $product->id }}" class="form-control text-center" value="1" min="1">
                                    <button type="button" class="btn btn-outline-secondary" onclick="increaseQty({{ $product->id }})">+</button>
                                </div>
                                <button type="button" class="btn btn-primary ms-2" onclick="addToCart({{ $product->id }})">
                                    Au panier
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    
</x-app-layout>
