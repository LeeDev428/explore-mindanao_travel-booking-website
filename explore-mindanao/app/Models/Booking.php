<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\BookingConfirmationNotification;
use Illuminate\Support\Facades\Auth;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'email',
        'phone',
        'date',
        'per_head',
        'user_is_read',
        'status',
        'total',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static function booted()
    {
        // This acts like an AFTER INSERT trigger
        static::created(function ($booking) {
            // Find user with this email or use currently authenticated user
            $user = User::where('email', $booking->email)->first() ?? Auth::user();
            
            if ($user) {
                // Send thank you notification through database
                $user->notify(new BookingConfirmationNotification($booking));
            }
        });

        static::updated(function ($booking) {
            if ($booking->status === 'confirmed') {
                // Add to monthly sales
                $month = $booking->date->format('Y-m');
                \App\Models\SalesData::updateOrCreate(
                    ['type' => 'monthly', 'key' => $month],
                    ['total' => \App\Models\SalesData::where('type', 'monthly')->where('key', $month)->sum('total') + $booking->total, 'booking_id' => $booking->id]
                );

                // Add to destination sales
                \App\Models\SalesData::updateOrCreate(
                    ['type' => 'destination', 'key' => $booking->destination_id],
                    ['total' => \App\Models\SalesData::where('type', 'destination')->where('key', $booking->destination_id)->sum('total') + $booking->total, 'booking_id' => $booking->id]
                );
            }
        });
    }
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
