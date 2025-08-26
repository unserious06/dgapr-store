<x-app-layout>
    <x-flash-messages />

    <div class="container mt-4">
        <h1 class="mb-4">Produits</h1>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Ajouter un produit</a>

        @if($products->count())
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Prix (MAD)</th>
                        <th>Stock</th>
                        <th>Visibilité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="{{ !$product->is_visible ? 'table-secondary' : '' }}">
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.products.toggleVisibility', $product) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $product->is_visible ? 'btn-success' : 'btn-outline-secondary' }}">
                                    {{ $product->is_visible ? 'Visible' : 'Invisible' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-info">Modifier</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        @else
            <p>Aucun produit trouvé.</p>
        @endif
    </div>
</x-app-layout>