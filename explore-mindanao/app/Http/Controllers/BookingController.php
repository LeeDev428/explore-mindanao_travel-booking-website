<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function create($id)
    {
        $destination = Destination::findOrFail($id);
        return view('usersbooking', compact('destination'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'date' => 'required|date|after:today',
            'per_head' => 'required|integer|min:1',
        ]);

        $destination = Destination::findOrFail($request->destination_id);

        try {
            $booking = Booking::create([
                'destination_id' => $request->destination_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date' => $request->date,
                'per_head' => $request->per_head,
                'user_is_read' => 0, // Default value
                'status' => 'pending', // Default value
                'total' => $request->per_head * $destination->price, // Calculate total
            ]);
            
            return redirect()->back()->with('success', 'Booking successfully submitted!');
        } catch (\Exception $e) {
            Log::error('Booking Error: ' . $e->getMessage());
            // If the booking was created but there was an error with notifications
            // we'll still show success
            if (isset($booking) && $booking->exists) {
                return redirect()->back()->with('success', 'Booking successfully submitted!');
            }
            return redirect()->back()->with('error', 'Failed to submit booking. Please try again.');
        }
    }
}
