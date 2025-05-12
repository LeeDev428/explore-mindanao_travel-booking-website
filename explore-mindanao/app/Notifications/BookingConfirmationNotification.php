<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingConfirmationNotification extends Notification
{
    use Queueable;
    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'message' => 'Your booking has been received and is pending confirmation.',
            'destination' => $this->booking->destination->name ?? 'Unknown destination',
            'date' => $this->booking->date->format('Y-m-d'),
            'total' => $this->booking->total,
            'type' => 'booking_confirmation'
        ];
    }
}
