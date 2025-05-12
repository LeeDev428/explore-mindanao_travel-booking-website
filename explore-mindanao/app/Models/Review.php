<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ReviewThankYouNotification;
use App\Notifications\AdminReviewNotification;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_id',
        'package_id', // Nullable if review is for a destination only
        'rating',
        'comment',
    ];

    protected static function booted()
    {
        // This acts like an AFTER INSERT trigger
        static::created(function ($review) {
            // Get the user who wrote the review
            $user = User::find($review->user_id);
            
            if ($user) {
                // Send thank you notification (database only)
                $user->notify(new ReviewThankYouNotification($review));
            }
            
            // Notify all admins about the new review
            $admins = User::where('is_admin', 1)->get();
            foreach ($admins as $admin) {
                $admin->notify(new AdminReviewNotification($review));
            }
        });
    }

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
