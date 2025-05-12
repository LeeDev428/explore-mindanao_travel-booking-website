@extends('admin.layout')

@section('title', 'Manage Reviews')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Customer Reviews</h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Search and Filter Form -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg border">
        <h3 class="text-lg font-medium mb-3">Search & Filter Reviews</h3>
        <form action="{{ route('admin.reviews.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Username Search -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ request('username') }}" placeholder="Search by username" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                
                <!-- Item Name Search -->
                <div>
                    <label for="item_name" class="block text-sm font-medium text-gray-700">Item Name</label>
                    <input type="text" name="item_name" id="item_name" value="{{ request('item_name') }}" placeholder="Search destinations/packages" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                
                <!-- Rating Filter -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                    <select name="rating" id="rating" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == 5 ? 'selected' : '' }}>★★★★★ (5 Stars)</option>
                        <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>★★★★☆ (4 Stars)</option>
                        <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>★★★☆☆ (3 Stars)</option>
                        <option value="2" {{ request('rating') == 2 ? 'selected' : '' }}>★★☆☆☆ (2 Stars)</option>
                        <option value="1" {{ request('rating') == 1 ? 'selected' : '' }}>★☆☆☆☆ (1 Star)</option>
                    </select>
                </div>
                
                <!-- Date Range -->
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                    <div class="grid grid-cols-2 gap-2"> <!-- Changed from flex to grid -->
                        <div>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <span class="text-xs text-gray-500">From</span>
                        </div>
                        <div>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <span class="text-xs text-gray-500">To</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition mr-2">
                    Reset
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Add height constraint and vertical scrolling -->
    <div class="overflow-x-auto">
        <div class="max-h-[500px] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                <thead class="bg-gray-50 sticky top-0">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $review->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            @if($review->destination)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Destination
                                </span>
                                {{ $review->destination->name }}
                            @elseif($review->package)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Package
                                </span>
                                {{ $review->package->name }}
                            @else
                                Unknown
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <span>★</span>
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <!-- Add max-width to comment column to prevent horizontal expansion -->
                        <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate">
                            <div class="tooltip" title="{{ $review->comment }}">
                                {{ Str::limit($review->comment, 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $review->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No reviews found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>

    <!-- Tooltip script for comment preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tooltips = document.querySelectorAll('.tooltip');
            tooltips.forEach(tooltip => {
                tooltip.addEventListener('mouseover', function() {
                    const title = this.getAttribute('title');
                    if (!title) return;
                    
                    this.setAttribute('data-tooltip', title);
                    this.removeAttribute('title');
                    
                    const tooltipEl = document.createElement('div');
                    tooltipEl.classList.add('tooltip-popup');
                    tooltipEl.style.position = 'absolute';
                    tooltipEl.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
                    tooltipEl.style.color = '#fff';
                    tooltipEl.style.padding = '5px 10px';
                    tooltipEl.style.borderRadius = '4px';
                    tooltipEl.style.fontSize = '14px';
                    tooltipEl.style.zIndex = '100';
                    tooltipEl.style.maxWidth = '300px';
                    tooltipEl.innerText = this.getAttribute('data-tooltip');
                    document.body.appendChild(tooltipEl);
                    
                    const rect = this.getBoundingClientRect();
                    tooltipEl.style.top = (rect.top + window.scrollY - tooltipEl.offsetHeight - 10) + 'px';
                    tooltipEl.style.left = (rect.left + window.scrollX) + 'px';
                    
                    this.addEventListener('mouseleave', function() {
                        document.body.removeChild(tooltipEl);
                        this.setAttribute('title', this.getAttribute('data-tooltip'));
                        this.removeAttribute('data-tooltip');
                    }, { once: true });
                });
            });
        });
    </script>
</div>
@endsection
