<x-app-layout>
    <div class="container py-4">
        <h1>Détails de la commande #{{ $order->id }}</h1>

        <!-- Flash success -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <div class="card mb-4">
            <div class="card-header">Informations client</div>
            <div class="card-body">
                <p><strong>Nom :</strong> {{ $order->name }}</p>
                <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
                <p><strong>Email :</strong> {{ $order->email ?? '-' }}</p>
                <p><strong>Adresse :</strong> {{ $order->shipping_address ?? '-' }}</p>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">Produits</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }} MAD</td>
                                <td>{{ number_format($item->quantity * $item->price, 2) }} MAD</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <span><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</span>
                <span><strong>Total :</strong> {{ number_format($order->total, 2) }} MAD</span>
            </div>
        </div>


        <div class="card">
            <div class="card-header">Statut de la commande</div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="form-select w-auto">
                        @foreach(['pending'=>'En attente','accepted'=>'Acceptée','rejected'=>'Rejetée','done'=>'Terminée'] as $key=>$label)
                            <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>


        <div class="mt-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Retour aux commandes</a>
        </div>
    </div>
</x-app-layout>
