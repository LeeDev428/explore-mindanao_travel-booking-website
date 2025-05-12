<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\PackageBookingConfirmationNotification;
use Illuminate\Support\Facades\Auth;

class BookingPackage extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'bookings_packages';

    protected $fillable = [
        'package_id',
        'name',
        'email',
        'phone',
        'booking_date',
        'status',
        'user_is_read',
    ];
    
    protected $casts = [
        'booking_date' => 'datetime',
    ];

    protected static function booted()
    {
        // This fires after a package booking is created (AFTER INSERT trigger)
        static::created(function ($bookingPackage) {
            // Find user with this email or use currently authenticated user
            $user = User::where('email', $bookingPackage->email)->first() ?? Auth::user();
            
            if ($user) {
                // Send confirmation notification
                $user->notify(new PackageBookingConfirmationNotification($bookingPackage));
            }
        });
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
