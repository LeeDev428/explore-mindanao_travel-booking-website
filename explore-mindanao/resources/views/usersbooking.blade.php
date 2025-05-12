<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Destination') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-12 grid grid-cols-1 lg:grid-cols-2 gap-6">
        @if (session('success'))
            <div class="col-span-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="col-span-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow">
            <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->name }}" class="w-full h-64 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-semibold mb-2">{{ $destination->name }}</h2>
            <p class="text-green-600 font-bold text-lg">₱{{ number_format($destination->price, 2) }}</p>
            <p class="text-gray-600 mb-2"><strong>Location:</strong> {{ $destination->location }}</p>
            <p class="text-gray-600"><strong>Description:</strong> {{ $destination->description }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Booking Form</h2>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Booking Date</label>
                    <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="per_head" class="block text-sm font-medium text-gray-700">Number of People</label>
                    <input type="number" name="per_head" id="per_head" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Submit Booking</button>
            </form>
        </div>
    </div>
</x-app-layout>
