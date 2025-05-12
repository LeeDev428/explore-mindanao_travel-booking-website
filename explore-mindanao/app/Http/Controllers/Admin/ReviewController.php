<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'destination', 'package']);
        
        // Filter by username
        if ($request->filled('username')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->username . '%');
            });
        }
        
        // Filter by item name (destination or package)
        if ($request->filled('item_name')) {
            $itemName = $request->item_name;
            $query->where(function($q) use ($itemName) {
                $q->whereHas('destination', function($q) use ($itemName) {
                    $q->where('name', 'like', '%' . $itemName . '%');
                })->orWhereHas('package', function($q) use ($itemName) {
                    $q->where('name', 'like', '%' . $itemName . '%');
                });
            });
        }
        
        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Get reviews with pagination
        $reviews = $query->latest()->paginate(10);
        
        // Mark all review notifications as read
        if (auth()->check()) {
            auth()->user()->unreadNotifications
                ->where('type', 'App\Notifications\AdminReviewNotification')
                ->markAsRead();
        }
        
        return view('admin.reviews.index', compact('reviews'));
    }
    
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully');
    }
}
