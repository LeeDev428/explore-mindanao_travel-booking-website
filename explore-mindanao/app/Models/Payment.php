<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'booking_type', // 'standard' or 'package'
        'amount',
        'payment_method',
        'transaction_id',
        'status',
    ];

    protected static function booted()
    {
        // This acts like an AFTER INSERT trigger
        static::created(function ($payment) {
            if ($payment->status === 'completed') {
                // Update booking status based on booking_type
                if ($payment->booking_type === 'standard') {
                    $booking = Booking::find($payment->booking_id);
                    if ($booking) {
                        $booking->update(['status' => 'confirmed']);
                    }
                } else if ($payment->booking_type === 'package') {
                    $bookingPackage = BookingPackage::find($payment->booking_id);
                    if ($bookingPackage) {
                        $bookingPackage->update(['status' => 'confirmed']);
                    }
                }
            }
        });
    }

    // Define relationships
    public function standardBooking()
    {
        return $this->belongsTo(Booking::class, 'booking_id')
            ->where('booking_type', 'standard');
    }

    public function packageBooking()
    {
        return $this->belongsTo(BookingPackage::class, 'booking_id')
            ->where('booking_type', 'package');
    }
}
