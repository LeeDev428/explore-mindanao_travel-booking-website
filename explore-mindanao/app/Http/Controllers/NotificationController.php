<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingPackage;

class NotificationController extends Controller
{
    public function fetch(Request $request)
    {
        // Get regular bookings notifications
        $bookingNotifications = Booking::whereIn('status', ['confirmed', 'declined'])
            ->where('user_is_read', 0)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'name' => $booking->name,
                    'status' => $booking->status,
                    'type' => 'booking'
                ];
            });

        // Get package bookings notifications
        $packageNotifications = BookingPackage::with('package')
            ->whereIn('status', ['confirmed', 'declined'])
            ->where('user_is_read', 0)
            ->get()
            ->map(function ($bookingPackage) {
                return [
                    'id' => $bookingPackage->id,
                    'name' => $bookingPackage->name . ' (Package: ' . ($bookingPackage->package->name ?? 'Unknown') . ')',
                    'status' => $bookingPackage->status,
                    'type' => 'package'
                ];
            });

        // Merge and sort by ID
        $allNotifications = $bookingNotifications->concat($packageNotifications)
            ->sortByDesc('id')
            ->values()
            ->all();

        // Count of unread notifications
        $unreadCount = count($allNotifications);

        return response()->json([
            'notifications' => $allNotifications,
            'unreadCount' => $unreadCount
        ]);
    }

    public function markAsRead(Request $request)
    {
        $type = $request->input('type', 'booking');
        $id = $request->input('id');
        
        if ($type === 'package') {
            BookingPackage::where('id', $id)->update(['user_is_read' => 1]);
        } else {
            Booking::where('id', $id)->update(['user_is_read' => 1]);
        }
        
        return response()->json(['success' => true]);
    }
}
