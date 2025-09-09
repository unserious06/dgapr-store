<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartSidebar extends Component
{
    public $cart;
    public $showSidebar = false;

    protected $listeners = ['itemAdded' => 'refreshCart'];

    public function mount()
    {
        // Get current user's cart or create one if it doesn't exist
        $this->cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        // Load items with product info
        $this->cart->load('items.product');
    }

    // Refresh the cart when an item is added
    public function refreshCart()
    {
        $this->cart->load('items.product');
        $this->showSidebar = true; // slide sidebar in
    }

    // Remove item from cart
    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item && $item->cart_id == $this->cart->id) {
            $item->delete();
            $this->refreshCart();
        }
    }

    public function render()
    {
        return view('livewire.cart-sidebar');
    }
}
