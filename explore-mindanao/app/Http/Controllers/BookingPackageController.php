<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\BookingPackage;

class BookingPackageController extends Controller
{
    public function create($id)
    {
        $package = Package::findOrFail($id);
        return view('book-now', compact('package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'booking_date' => 'required|date|after:today',
        ]);

        BookingPackage::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Booking successfully submitted!');
    }
}
