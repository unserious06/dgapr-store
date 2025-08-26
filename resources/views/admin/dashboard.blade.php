<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">Tableau de bord</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <a href="{{ route('admin.products.index') }}" class="col-md-4 no-underline">
                            <h5 class="card-title" style="color: white;">Produits</h5>
                        </a>
                        <p class="card-text display-6">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <a href="{{ route('admin.reservations.index') }}" class="col-md-4 no-underline">
                            <h5 class="card-title" style="color: white;">Réservations</h5>
                        </a>
                        <p class="card-text display-6">{{ $totalReservations }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <a href="{{ route('admin.categories.index') }}" class="col-md-4 no-underline">
                            <h5 class="card-title" style="color: white;">Categories</h5>
                        </a>
                        <p class="card-text display-6">{{ $totalCategories }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h4>Réservations par statut</h4>
        <div class="row">
            @foreach(['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Rejetée', 'done' => 'Terminée'] as $status => $label)
                <div class="col-md-3">
                    <div class="card mb-3 border">
                        <div class="card-body text-center">
                            <h6>{{ $label }}</h6>
                            <p class="display-6">{{ $reservationsByStatus[$status] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>