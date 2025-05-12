<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function create(Request $request)
    {
        $query = Destination::query();

        // Search by name or location
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        // Filter by price or date
        if ($request->filter === 'cheapest') {
            $query->orderBy('price', 'asc');
        } elseif ($request->filter === 'expensive') {
            $query->orderBy('price', 'desc');
        } elseif ($request->filter === 'recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->filter === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        $destinations = $query->get();

        return view('admin.destinations.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Store the image and get its path
        $imagePath = $request->file('image')->store('destinations', 'public');

        // Save the destination to the database
        Destination::create([
            'name' => $request->name,
            'price' => $request->price,
            'location' => $request->location,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.destinations.create')->with('success', 'Destination added successfully!');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::delete('public/' . $destination->image_path);

            // Store the new image and update the path
            $imagePath = $request->file('image')->store('destinations', 'public');
            $destination->image_path = $imagePath;
        }

        // Update the other fields
        $destination->update([
            'name' => $request->name,
            'price' => $request->price,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.destinations.create')->with('success', 'Destination updated successfully!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        Storage::delete('public/' . $destination->image_path); // Delete the image file
        $destination->delete(); // Delete the record
        return redirect()->route('admin.destinations.create')->with('success', 'Destination deleted successfully!');
    }
}
