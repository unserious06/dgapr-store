<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Reservation;


class ReservationController extends Controller
{
    public function store(Request $request, int $product)
    {

        $reservation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:30',
            'quantity' => 'required|integer|min:1',
            'message' => 'nullable|string|max:1000',
        ]);

        $reservation['product_id'] = $product;
        $reservation['status'] = 'pending'; // Default status
        //dd($product);

        Reservation::create($reservation);

        return redirect()->back()->with('success', 'Votre réservation a bien été envoyée.');
    }
}
