<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 flex items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Filter Navbar -->
            <nav class="mb-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="flex justify-between items-center px-4 py-3">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2 w-full sm:w-auto">
                        <input type="text" name="search" placeholder="Search by name or location" value="{{ request('search') }}" class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Search</button>
                    </form>

                    <!-- Filter Dropdown -->
                    <div class="relative">
                        <button class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none" id="filterDropdownButton">
                            Filters
                        </button>
                        <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-md z-10">
                            <a href="{{ route('dashboard', ['filter' => 'cheapest']) }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Cheapest</a>
                            <a href="{{ route('dashboard', ['filter' => 'expensive']) }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Most Expensive</a>
                            <a href="{{ route('dashboard', ['filter' => 'recent']) }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Recently Added</a>
                            <a href="{{ route('dashboard', ['filter' => 'oldest']) }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Oldest Added</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Destinations Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($destinations as $destination)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->name }}" class="w-full h-48 object-cover rounded-t-lg cursor-pointer" onclick="openZoom('{{ asset('storage/' . $destination->image_path) }}')">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $destination->name }}</h3>
                            <p class="text-green-600 font-bold">₱{{ number_format($destination->price, 2) }}</p>
                            <p class="text-gray-600">{{ $destination->location }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('booking.create', ['id' => $destination->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Book Now</a>
                                <a href="{{ route('destination.packages', ['id' => $destination->id]) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff" class="mr-1">
                                        <path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/>
                                    </svg>
                                    See Packages
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Zoom Modal -->
    <div id="zoomModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="relative">
            <button class="absolute top-2 right-2 text-white text-2xl font-bold" onclick="closeZoom()">X</button>
            <img id="zoomedImage" src="" alt="Zoomed Image" class="max-w-full max-h-screen rounded-lg">
        </div>
    </div>

    <script>
        // Toggle filter dropdown
        document.getElementById('filterDropdownButton').addEventListener('click', function () {
            const dropdown = document.getElementById('filterDropdown');
            dropdown.classList.toggle('hidden');
        });

        function openZoom(imageSrc) {
            const zoomModal = document.getElementById('zoomModal');
            const zoomedImage = document.getElementById('zoomedImage');
            zoomedImage.src = imageSrc;
            zoomModal.classList.remove('hidden');
        }

        function closeZoom() {
            const zoomModal = document.getElementById('zoomModal');
            zoomModal.classList.add('hidden');
        }
    </script>
</x-app-layout>
