<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DashboardController extends Controller
{
    public function index(Request $request)
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

        return view('dashboard', compact('destinations'));
    }
}
