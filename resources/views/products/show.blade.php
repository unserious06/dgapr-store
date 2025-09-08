<x-app-layout>
    <div class="container py-4">

        <div class="row g-4">
            {{-- Left: Product Images --}}
            <div class="col-md-6">

                <h2 class="fw-bold">{{ $product->title }}</h2>
                <p class="text-primary fw-bold fs-4">{{ $product->price }} MAD</p>

                <h6 class="mt-3">Description:</h6>
                <p>{{ $product->description }}</p>

                <hr class="my-3">

                <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded shadow-sm">
                        @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <a href="{{ asset($image->path) }}" data-lightbox="gallery">
                                    <img src="{{ asset($image->path) }}" 
                                         class="d-block w-100"
                                         style="max-height: 400px; object-fit: cover;"  
                                         alt="Zoomable">
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            {{-- Right: Product Info & Actions --}}
            <div class="col-md-6 d-flex flex-column justify-content-start">
                

                {{-- Success / Error Messages --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <x-error />

                {{-- Reservation Form --}}
                <div class="card p-3 mb-4 shadow-sm border-0">
                    <form action="{{ route('products.reserve', $product->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email (facultatif)</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantité</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message (facultatif)</label>
                            <textarea name="message" id="message" class="form-control" rows="3"></textarea>
                        </div>

                        <button class="btn btn-primary w-100">Réserver</button>
                    </form>
                </div>

                {{-- Add to Cart --}}
                <div class="d-flex align-items-center mb-4">
                    
                        <div class="input-group" style="width: 140px;">
                            <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty({{ $product->id }})">−</button>
                            <input type="number" id="qty-{{ $product->id }}" name="quantity" class="form-control text-center" value="1" min="1">
                            <button type="button" class="btn btn-outline-secondary" onclick="increaseQty({{ $product->id }})">+</button>
                        </div>

                        <button type="submit" class="btn btn-primary ms-3 flex-grow-1" onclick="addToCart({{ $product->id }})">Add to Cart</button>
                    
                </div>

               
            </div>
        </div>
    </div>
</x-app-layout>
