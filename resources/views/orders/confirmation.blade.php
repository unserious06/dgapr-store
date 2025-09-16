<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Merci pour votre commande !</h1>
                        
                        <p class="text-center text-muted">Commande #{{ $order->id }}</p>
                        
                        <ul class="list-group mb-3">
                            @foreach($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->product->title }} ({{ $item->quantity }} × {{ $item->price }} MAD)
                                    <span class="badge bg-primary rounded-pill">{{ $item->subtotal }} MAD</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="d-flex justify-content-end">
                            <h5>Total : <span class="text-success">{{ $order->total }} MAD</span></h5>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
