<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Book Package: {{ $destination->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-12 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Side: Destination Details -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->name }}" class="w-full h-64 object-cover rounded-lg mb-4">
            @if ($package)
                <h2 class="text-2xl font-semibold mb-2">{{ $package->name }}</h2>
                <p class="text-green-600 font-bold text-lg">₱{{ number_format($package->price, 2) }}</p>
                <p class="text-gray-600 mb-2"><strong>Location:</strong> {{ $destination->location }}</p>
                <p class="text-gray-600"><strong>Description:</strong> {{ $package->description }}</p>
            @else
                <p class="text-gray-600">No packages available for this destination.</p>
            @endif
        </div>

        <!-- Right Side: Booking Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if ($package)
                <h2 class="text-xl font-semibold mb-6">Booking Form</h2>
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="booking_date" class="block text-sm font-medium text-gray-700">Booking Date</label>
                        <input type="date" name="booking_date" id="booking_date" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Submit Booking
                    </button>
                </form>
            @else
                <p class="text-gray-600">No packages available for this destination.</p>
            @endif
        </div>
    </div>
</x-app-layout>
