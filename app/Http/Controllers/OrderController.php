<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart, CartItem, Order, OrderItem, Product , User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    

public function storeFromCart(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:30',
        'shipping_address' => 'required|string|max:1000',
    ]);

    $cart = Cart::with('items.product')
                ->where('user_id', Auth::id())
                ->firstOrFail();

    if ($cart->items->isEmpty()) {
        return back()->with('error', 'Votre panier est vide.');
    }

    $order = null;

    DB::transaction(function () use ($validated, $cart, &$order) {
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'shipping_address' => $validated['shipping_address'] ?? null,
            'status' => 'pending',
            'total' => 0,
        ]);

        $total = 0;

        foreach ($cart->items as $item) {
            $subtotal = $item->product->price * $item->quantity;
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $subtotal,
            ]);
        }

        $order->update(['total' => $total]);

        $cart->items()->delete();
        $cart->delete();
    });

    return redirect()
        ->route('orders.confirmation', $order) 
        ->with('success', 'Votre commande a bien été enregistrée.');
}


public function storeSingle(Request $request, int $productId)
{
    $validated = $request->validate([
        'name'             => 'required|string|max:255',
        'email'            => 'required|email',
        'phone'            => 'required|string|max:30',
        'quantity'         => 'required|integer|min:1',
        'shipping_address' => 'required|string|max:1000',
    ]);

    $product = Product::findOrFail($productId);

    $order = Order::create([
        'user_id'          => Auth::id(),
        'name'             => $validated['name'],
        'email'            => $validated['email'] ,
        'phone'            => $validated['phone'],
        'shipping_address' => $validated['shipping_address'],
        'status'           => 'pending',
        'total'            => $product->price * $validated['quantity'],
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => $validated['quantity'],
        'price' => $product->price,
        'subtotal' => $product->price * $validated['quantity'],
    ]);

    return redirect()
        ->route('orders.confirmation', $order)
        ->with('success', 'Votre commande a bien été enregistrée.');
}

 public function confirmation(Order $order)
    {
        if (auth()->id() !== $order->user_id && !auth()->user()->hasRole('admin|super_admin')) {
            abort(403, 'You are not allowed to view this order.');
        }

        return view('orders.confirmation', compact('order'));
    }

}
