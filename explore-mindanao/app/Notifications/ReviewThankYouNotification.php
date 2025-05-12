<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReviewThankYouNotification extends Notification
{
    use Queueable;
    protected $review;
    protected $itemName;

    public function __construct(Review $review, $itemName = null)
    {
        $this->review = $review;
        $this->itemName = $itemName;
    }

    public function via($notifiable)
    {
        return ['database']; // Only use database notifications
    }

    public function toArray($notifiable)
    {
        return [
            'review_id' => $this->review->id,
            'message' => 'Thank you for your review of ' . $this->itemName . '!',
            'rating' => $this->review->rating,
            'item_name' => $this->itemName,
            'type' => 'review_thanks'
        ];
    }
}
