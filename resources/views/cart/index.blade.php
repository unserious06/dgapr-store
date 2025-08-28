
<x-app-layout>
   

<div class="container my-4">
    <h2 class="mb-4">🛒 Your Cart</h2>

    @if($items->isEmpty())
        <div class="alert alert-info">
            Your cart is empty.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Checkout button 
                <div class="text-end">
                    <a href="{{-- route('checkout.index') --}}" class="btn btn-success">
                        Proceed to Checkout
                    </a>
                </div>-->
            </div>
        </div>
    @endif
</div>


    
</x-app-layout>