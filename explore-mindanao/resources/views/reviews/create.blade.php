<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Write a Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('reviews.store') }}" class="space-y-6">
                        @csrf
                        
                        <div>
                            <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">What would you like to review?</div>
                            <div class="mt-2">
                                <div class="flex items-center mb-2">
                                    <input type="radio" id="destination" name="review_type" value="destination" class="mr-2"
                                        onchange="toggleReviewTarget('destination')"> 
                                    <label for="destination">A Destination</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="package" name="review_type" value="package" class="mr-2"
                                        onchange="toggleReviewTarget('package')">
                                    <label for="package">A Package</label>
                                </div>
                            </div>
                        </div>
                        
                        <div id="destination_select" class="hidden">
                            <label for="destination_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Select Destination</label>
                            <select name="destination_id" id="destination_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select a destination</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div id="package_select" class="hidden">
                            <label for="package_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Select Package</label>
                            <select name="package_id" id="package_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select a package</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="rating" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Rating</label>
                            <div class="flex items-center mt-1">
                                <div class="flex flex-row-reverse items-center"> <!-- Changed to normal flex direction -->
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" required>
                                        <label for="star{{ $i }}" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 peer-checked:text-yellow-400" title="{{ $i }} stars">★</label>
                                    @endfor
                                </div>
                                <span class="ml-3 text-sm text-gray-500 rating-text">Select rating</span>
                            </div>
                        </div>
                        
                        <div>
                            <label for="comment" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Your Review</label>
                            <textarea id="comment" name="comment" rows="4" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 transition">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function toggleReviewTarget(type) {
            if (type === 'destination') {
                document.getElementById('destination_select').classList.remove('hidden');
                document.getElementById('package_select').classList.add('hidden');
                document.getElementById('package_id').value = '';
            } else {
                document.getElementById('package_select').classList.remove('hidden');
                document.getElementById('destination_select').classList.add('hidden');
                document.getElementById('destination_id').value = '';
            }
        }
    </script>

    <!-- Add JavaScript for better star rating experience -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingLabels = document.querySelectorAll('label[for^="star"]');
            const ratingText = document.querySelector('.rating-text');
            const ratingDescriptions = {
                1: 'Poor',
                2: 'Fair',
                3: 'Good',
                4: 'Very Good',
                5: 'Excellent'
            };
            
            ratingLabels.forEach(label => {
                const value = label.getAttribute('for').replace('star', '');
                
                label.addEventListener('click', () => {
                    ratingText.textContent = `${value} Stars - ${ratingDescriptions[value]}`;
                });
                
                label.addEventListener('mouseover', () => {
                    ratingText.textContent = `${value} Stars - ${ratingDescriptions[value]}`;
                    
                    // Highlight current and previous stars
                    ratingLabels.forEach(l => {
                        const lValue = l.getAttribute('for').replace('star', '');
                        if (lValue <= value) {
                            l.classList.add('text-yellow-400');
                            l.classList.remove('text-gray-300');
                        } else {
                            l.classList.add('text-gray-300');
                            l.classList.remove('text-yellow-400');
                        }
                    });
                });
            });
            
            // Reset on mouse leave
            document.querySelector('.flex.items-center').addEventListener('mouseleave', () => {
                const selectedRating = document.querySelector('input[name="rating"]:checked');
                if (selectedRating) {
                    const value = selectedRating.value;
                    ratingText.textContent = `${value} Stars - ${ratingDescriptions[value]}`;
                    
                    ratingLabels.forEach(l => {
                        const lValue = l.getAttribute('for').replace('star', '');
                        if (lValue <= value) {
                            l.classList.add('text-yellow-400');
                            l.classList.remove('text-gray-300');
                        } else {
                            l.classList.add('text-gray-300');
                            l.classList.remove('text-yellow-400');
                        }
                    });
                } else {
                    ratingText.textContent = 'Select rating';
                    ratingLabels.forEach(l => {
                        l.classList.add('text-gray-300');
                        l.classList.remove('text-yellow-400');
                    });
                }
            });
        });
    </script>
</x-app-layout>
