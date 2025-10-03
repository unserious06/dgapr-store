
<x-app-layout>
   

<div class="container my-4">
    <h2 class="mb-4">Votre panier</h2>

<x-flash-messages />

    @if($items->isEmpty())
        <div class="alert alert-info">
            Votre panier est vide.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr id="cart-item-page-{{ $item->id }}">
                                <td>{{ $item->product->title }}</td>
                                <td>{{ number_format($item->product->price, 2) }} MAD</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-danger" onclick="removeFromCart({{ $item->id }})">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                 
                
            </div>
        </div>
        <div class="text-end">
                  {{--  <a href="{{-- route('checkout.index') " class="btn btn-">
                        Proceed to Checkout
                    </a>--}}
            <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                Réserver
            </button>

    <!-- Modal Form -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('orders.storeFromCart') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Informations pour la commande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Téléphone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Adresse</label>
                            <textarea name="shipping_address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Confirmer la commande</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
    @endif
</div>


    
</x-app-layout>