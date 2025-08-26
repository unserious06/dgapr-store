<x-app-layout>
    <x-flash-messages />

    <div class="container mt-4">
        <h1>Créer un produit</h1>

        <form method="POST" action="{{ route('admin.products.store') }}">
            @include('admin.products._form')
        </form>
    </div>
</x-app-layout>
