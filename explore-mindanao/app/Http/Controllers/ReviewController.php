<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReviewThankYouNotification;

class ReviewController extends Controller
{
    public function create()
    {
        $destinations = Destination::all();
        $packages = Package::all();
        
        return view('reviews.create', compact('destinations', 'packages'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'nullable|exists:destinations,id',
            'package_id' => 'nullable|exists:packages,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);
        
        // Ensure user is selecting either destination or package
        if (empty($validated['destination_id']) && empty($validated['package_id'])) {
            return back()->withErrors(['error' => 'Please select either a destination or a package to review.']);
        }
        
        $review = new Review();
        $review->user_id = Auth::id();
        $review->destination_id = $validated['destination_id'] ?? null;
        $review->package_id = $validated['package_id'] ?? null;
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->save();
        
        // Get the name of the reviewed item
        $itemName = "Unknown";
        if ($review->destination_id) {
            $itemName = Destination::find($review->destination_id)->name ?? 'this destination';
        } elseif ($review->package_id) {
            $itemName = Package::find($review->package_id)->name ?? 'this package';
        }
        
        // Show success message with rating info
        return redirect()->route('dashboard')->with('success', "Thank you for your {$review->rating}/5 star review of {$itemName}!");
    }
    
    public function showDestinationReviews($id)
    {
        $destination = Destination::findOrFail($id);
        $reviews = Review::where('destination_id', $id)->with('user')->latest()->paginate(5);
        
        return view('reviews.destination', compact('destination', 'reviews'));
    }
    
    public function showPackageReviews($id)
    {
        $package = Package::findOrFail($id);
        $reviews = Review::where('package_id', $id)->with('user')->latest()->paginate(5);
        
        return view('reviews.package', compact('package', 'reviews'));
    }
}
