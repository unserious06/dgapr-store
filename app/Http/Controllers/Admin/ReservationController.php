<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with('product')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,done'
        ]);

        $reservation->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    //
}
