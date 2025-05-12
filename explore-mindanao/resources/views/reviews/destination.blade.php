<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $destination->name }} - Reviews
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 mb-4 md:mb-0">
                            <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->name }}" class="w-full h-48 object-cover rounded-lg">
                        </div>
                        <div class="md:w-2/3 md:pl-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $destination->name }}</h2>
                            <p class="text-green-600 text-lg font-semibold">₱{{ number_format($destination->price, 2) }}</p>
                            <p class="text-gray-600 dark:text-gray-300 mt-2"><strong>Location:</strong> {{ $destination->location }}</p>
                            <p class="text-gray-600 dark:text-gray-300 mt-1">{{ $destination->description }}</p>
                            
                            @php
                                $avgRating = $destination->reviews->avg('rating') ?? 0;
                                $totalReviews = $destination->reviews->count();
                            @endphp
                            
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $avgRating)
                                                <span class="text-yellow-400">★</span>
                                            @elseif ($i - 0.5 <= $avgRating)
                                                <span class="text-yellow-400">★</span>
                                            @else
                                                <span class="text-gray-300">★</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="ml-2 text-gray-600 dark:text-gray-300">
                                        {{ number_format($avgRating, 1) }} out of 5 ({{ $totalReviews }} {{ Str::plural('review', $totalReviews) }})
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('reviews.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Write a Review
                                </a>
                                <a href="{{ route('booking.create', $destination->id) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Reviews</h3>
                    
                    @forelse($reviews as $review)
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $review->user->name }}</p>
                                    <div class="flex text-yellow-400 my-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <span>★</span>
                                            @else
                                                <span class="text-gray-300">★</span>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">No reviews yet. Be the first to review!</p>
                    @endforelse
                    
                    <div class="mt-4">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
