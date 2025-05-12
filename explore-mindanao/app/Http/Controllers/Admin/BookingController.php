<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingPackage;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending'); // Default to 'pending'
        $bookings = Booking::where('status', $status)->get();
        $bookingsPackages = BookingPackage::with('package')->where('status', $status)->get();

        return view('admin.bookings.index', compact('bookings', 'bookingsPackages'));
    }

    public function confirm($id, Request $request)
    {
        $type = $request->input('type', 'booking');
        
        if ($type === 'package') {
            $booking = BookingPackage::findOrFail($id);
        } else {
            $booking = Booking::findOrFail($id);
        }
        
        $booking->update(['status' => 'confirmed']);

        return redirect()->route('admin.bookings.index', ['status' => 'pending'])
            ->with('success', 'Booking confirmed successfully.');
    }

    public function decline($id, Request $request)
    {
        $type = $request->input('type', 'booking');
        
        if ($type === 'package') {
            $booking = BookingPackage::findOrFail($id);
        } else {
            $booking = Booking::findOrFail($id);
        }
        
        $booking->update(['status' => 'declined']);

        return redirect()->route('admin.bookings.index', ['status' => 'pending'])
            ->with('success', 'Booking declined successfully.');
    }
}
