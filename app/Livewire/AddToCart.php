<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $product;
    public $quantity = 1;

    public function increase()
    {
        $this->quantity++;
    }

    public function decrease()
    {
        if ($this->quantity > 1) $this->quantity--;
    }

    public function addToCart()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('product_id', $this->product->id)->first();

        if ($item) {
            $item->increment('quantity', $this->quantity);
        } else {
            $cart->items()->create([
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
        }

        $this->emit('itemAdded'); // updates sidebar
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
