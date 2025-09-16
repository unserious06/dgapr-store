<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();

        
        return view('cart.index', compact('items'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $quantity = max(1, (int) $request->input('quantity', 1));

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        //return redirect()->route('cart.index')->with('success', 'Product added to cart');
        $count = $cart->items()->sum('quantity');
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'count' => $count
        ]);
    }

    public function remove(CartItem $item)
    {
        // Ensure the item belongs to the logged-in user's cart
        if ($item->cart->user_id === Auth::id()) {
            $item->delete();
        }

        //return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $count = $cart->items()->sum('quantity');

        return response()->json([
        'success' => true,
        'message' => 'Item removed from cart',
        'count' => $count
        ]);
    
    }

    public function count()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $count = $cart->items()->sum('quantity');

        return response()->json(['count' => $count]);
    }

    public function sidebar()
{
    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    $items = $cart->items()->with('product')->get();

    return response()->json([
        'items' => $items->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->product->title,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'image' => asset(optional($item->product->images->first())->path ?? 'placeholder.jpg'),
            ];
        })
    ]);
}


}
