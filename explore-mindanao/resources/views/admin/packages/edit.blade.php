@extends('admin.layout')

@section('title', 'Edit Vacation Package')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Edit Vacation Package</h2>
    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="destination_id" class="block text-sm font-medium text-gray-700">Destination</label>
            <select name="destination_id" id="destination_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}" {{ $package->destination_id == $destination->id ? 'selected' : '' }}>
                        {{ $destination->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Package Name</label>
            <input type="text" name="name" id="name" value="{{ $package->name }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ $package->description }}</textarea>
        </div>
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" id="price" value="{{ $package->price }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Package
            </button>
        </div>
    </form>
</div>
@endsection
