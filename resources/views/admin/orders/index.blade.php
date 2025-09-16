<x-app-layout>
    <div class="container py-4">
        <h1>Commandes</h1>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Status filter -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-3">
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

        <!-- Orders table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Commande #</th>
                    <th>Client</th>
                    <th>Produits</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            {{ $order->name }}<br>
                            {{ $order->phone }}<br>
                            {{ $order->email ?? '-' }}
                        </td>
                        <td>
                            @foreach($order->items as $item)
                                {{ $item->product->title }} 
                                ({{ $item->quantity }} × {{ number_format($item->price, 2) }} MAD)<br>
                            @endforeach
                        </td>
                        <td>{{ number_format($order->total, 2) }} MAD</td>
                        <td>
                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    @foreach(['pending'=>'En attente','accepted'=>'Acceptée','rejected'=>'Rejetée','done'=>'Terminée'] as $key=>$label)
                                        <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
</x-app-layout>
