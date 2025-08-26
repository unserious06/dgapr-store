<x-app-layout>
    <div class="container py-4">

        <form method="GET" action="{{ route('home') }}" class="mb-4">
    <div class="row g-2">
        <!-- Search bar -->
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search products..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> <!-- Bootstrap search icon -->
                </button>
            </div>
        </div>

        <!-- Category filter -->
        <div class="col-md-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
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


        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('products.show', $product->slug) }}" class="no-underline text-dark">
                        <div class="card shadow h-100">
                                <div style="height: 300px; overflow: hidden;">
                                    <img src="{{ asset(optional($product->images->first())->path ?? 'placeholder.jpg') }}"
                                        class="card-img-top img-fluid object-fit-cover w-100 h-100"
                                        alt="{{ $product->title }}">
                                </div>
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="text-primary fw-bold">{{ $product->price }} MAD</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>