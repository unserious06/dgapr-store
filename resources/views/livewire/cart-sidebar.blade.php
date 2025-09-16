<div>
    <!-- Sidebar -->
    <div 
        class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg transform transition-transform duration-300"
        style="z-index: 9999; {{ $showSidebar ? 'translate-x-0' : 'translate-x-full' }}">
        
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-bold">Your Cart</h2>
            <button wire:click="$set('showSidebar', false)">✕</button>
        </div>

        <div class="p-4 space-y-2">
            @if($cart->items->count() > 0)
                @foreach($cart->items as $item)
                    <div class="flex justify-between items-center border-b pb-2">
                        <span>{{ $item->product->name }} - ${{ $item->product->price }}</span>
                        <button wire:click="removeItem({{ $item->id }})" class="text-red-500">Remove</button>
                    </div>
                @endforeach
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
    </div>
</div>
