<x-app-layout>
    <div class="container py-4">
        <h1>Réservations</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.reservations.index') }}" class=" mb-3">
            <div class="d-inline-flex align-items-center gap-2">
                <label for="status" class="form-label mb-0">Filtrer par statut :</label>
                <select name="status" id="status"
                        class="form-select form-select-sm"
                        style="width: auto; min-width: 150px;"
                        onchange="this.form.submit()">
                <option value="">Tous</option>
                @foreach(['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Rejetée', 'done' => 'Terminée'] as $key => $label)
                    <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
                </select> 
            </div>  
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Quantité</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->product->title }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->email ?? '-' }}</td>
                        <td>{{ $reservation->quantity }}</td>
                        <td>{{ Str::limit($reservation->message, 30, '...') ?? '-' }}</td>
                        <td>
                            <form action="{{ route('admin.reservations.updateStatus', $reservation) }}" method="POST" class="d-inline">
                                @method('PATCH')
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    @foreach(['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Rejetée', 'done' => 'Terminée'] as $key => $label)
                                        <option value="{{ $key }}" {{ $reservation->status === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                        <td><!-- No delete/edit buttons --></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reservations->links() }}
    </div>
</x-app-layout>