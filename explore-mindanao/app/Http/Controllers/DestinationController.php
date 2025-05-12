<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Package;

class DestinationController extends Controller
{
    // ...existing code...

    public function packages($id)
    {
        $destination = Destination::findOrFail($id);
        $packages = Package::where('destination_id', $id)->get();

        // Check if there are any packages
        $package = $packages->first(); // Get the first package or null if none exist

        return view('destination-packages', compact('destination', 'packages', 'package'));
    }
}