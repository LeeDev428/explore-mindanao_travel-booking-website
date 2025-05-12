<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminReviewNotification extends Notification
{
    use Queueable;
    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $entityName = '';
        if ($this->review->destination_id) {
            $entityName = $this->review->destination->name ?? 'a destination';
        } elseif ($this->review->package_id) {
            $entityName = $this->review->package->name ?? 'a package';
        }

        return [
            'review_id' => $this->review->id,
            'message' => 'New review submitted for ' . $entityName,
            'rating' => $this->review->rating,
            'user' => $this->review->user->name ?? 'A user',
            'type' => 'admin_review'
        ];
    }
}
