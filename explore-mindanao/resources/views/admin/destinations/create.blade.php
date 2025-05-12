@extends('admin.layout')

@section('title', 'Manage Destinations')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Middle: Destinations Table -->
    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md overflow-y-auto max-h-[500px]">
        <h2 class="text-xl font-semibold mb-6">Existing Destinations</h2>
        <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                <tr>
                    <td colspan="5" class="px-6 py-4">
                        <div class="flex justify-between items-center">
                            <!-- Search Bar -->
                            <form method="GET" action="{{ route('admin.destinations.create') }}" class="flex items-center gap-2 w-full sm:w-auto">
                                <input type="text" name="search" placeholder="Search by name or location" value="{{ request('search') }}" class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg shadow focus:ring focus:ring-blue-300">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Search</button>
                            </form>

                            <!-- Filter Dropdown -->
                            <div class="relative">
                                <button class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="filterDropdownButton">
                                    Filters
                                </button>
                                <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg z-10">
                                    <a href="{{ route('admin.destinations.create', ['filter' => 'cheapest']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cheapest</a>
                                    <a href="{{ route('admin.destinations.create', ['filter' => 'expensive']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Most Expensive</a>
                                    <a href="{{ route('admin.destinations.create', ['filter' => 'recent']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Recently Added</a>
                                    <a href="{{ route('admin.destinations.create', ['filter' => 'oldest']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Oldest Added</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($destinations as $destination)
                    <tr>
                        <td class="px-6 py-4 text-center">
                            <img src="{{ asset('storage/' . $destination->image_path) }}" alt="{{ $destination->name }}" class="w-40 h-16 object-cover rounded-lg mx-auto">
                        </td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $destination->name }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">₱{{ number_format($destination->price, 2) }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $destination->location }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="inline-flex items-center px-2 py-1 text-xs font-medium rounded shadow text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Edit</a>
                            <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this destination?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 text-xs font-medium rounded shadow text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Right Side: Add Destination Form -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-6">Add New Destination</h2>
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Add Destination
            </button>
        </form>
    </div>
</div>

<script>
    // Toggle filter dropdown
    document.getElementById('filterDropdownButton').addEventListener('click', function () {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.toggle('hidden');
    });
</script>
@endsection
