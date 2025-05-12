@component('mail::message')
# Booking Confirmation

Thank you for booking with Explore Mindanao!

**Booking Details:**
- Destination: {{ $destination->name }}
- Date: {{ $booking->date->format('F j, Y') }}
- Number of People: {{ $booking->per_head }}
- Total Amount: ₱{{ number_format($booking->total, 2) }}

Your booking is currently pending confirmation. We will notify you once it's confirmed.

@component('mail::button', ['url' => url('/dashboard')])
View Booking
@endcomponent

Thank you for choosing Explore Mindanao!

Regards,<br>
{{ config('app.name') }}
@endcomponent
