<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset($image->path) }}" class="d-block w-100" alt="">
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

            <div class="col-md-6">
                <h2>{{ $product->title }}</h2>
                <p class="text-primary fw-bold">{{ $product->price }} MAD</p>
                <h6>Description :</h6>
                <p>{{ $product->description }}</p>

                <div class="border"></div>
            
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <x-error />
                <form action="{{ route('products.reserve', $product->id) }}" method="POST" class="mt-4">
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

                    <button class="btn btn-primary">Réserver</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>