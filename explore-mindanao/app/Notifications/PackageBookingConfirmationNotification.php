<?php

namespace App\Notifications;

use App\Models\BookingPackage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PackageBookingConfirmationNotification extends Notification
{
    use Queueable;
    protected $bookingPackage;

    public function __construct(BookingPackage $bookingPackage)
    {
        $this->bookingPackage = $bookingPackage;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->bookingPackage->id,
            'message' => 'Your package booking has been received and is pending confirmation.',
            'package' => $this->bookingPackage->package->name ?? 'Unknown package',
            'date' => $this->bookingPackage->booking_date->format('Y-m-d'),
            'name' => $this->bookingPackage->package->name ?? 'Unknown',
            'status' => $this->bookingPackage->status,
            'type' => 'package'
        ];
    }
}
