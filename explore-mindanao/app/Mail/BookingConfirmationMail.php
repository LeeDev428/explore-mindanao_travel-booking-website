<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Booking Confirmation - Explore Mindanao')
                    ->markdown('emails.bookings.confirmation')
                    ->with([
                        'booking' => $this->booking,
                        'destination' => $this->booking->destination
                    ]);
    }
}
