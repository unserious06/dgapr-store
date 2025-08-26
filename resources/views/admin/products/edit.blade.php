<x-app-layout>
    <x-flash-messages />

    <div class="container mt-4">
        <h1>Modifier le produit</h1>

        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @method('PUT')
            @include('admin.products._form')
        </form>

        <hr class="my-4"> {{-- ligne de separation --}}

        <h4>Images du produit</h4>
        <form action="{{ route('admin.products.images.store', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Ajouter une image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <button class="btn btn-primary">Ajouter</button>
        </form>

        @if($product->images->count())
            <div class="row mt-4">
                @foreach ($product->images as $image)
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <img src="{{ asset($image->path) }}" class="card-img-top img-fluid object-fit-cover" alt="..."  style="height: 300px; overflow: hidden;">

                            <div class="card-body text-center">
                                @if(!$image->is_main)
                                    <form method="POST" action="{{ route('admin.products.images.setMain', [$product, $image]) }}">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-outline-primary mb-1">Définir principale</button>
                                    </form>
                                @else
                                    <div class="text-success fw-bold">Principale</div>
                                @endif

                                <form method="POST" action="{{ route('admin.products.images.updateOrder', [$product, $image]) }}">
                                    @csrf @method('PATCH')
                                    <button name="direction" value="up" class="btn btn-sm btn-light">⬆</button>
                                    <button name="direction" value="down" class="btn btn-sm btn-light">⬇</button>
                                </form>

                                @if(!$image->is_main)
                                    <form method="POST" action="{{ route('admin.products.images.destroy', [$product, $image]) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger mt-2">🗑 Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>