<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingPackage;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Review;
use App\Models\MonthlySales;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Card Metrics
        $totalBookings = Booking::count() + BookingPackage::count();
        
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total') +
                        BookingPackage::with('package')
                            ->where('status', 'confirmed')
                            ->get()
                            ->sum(function($booking) {
                                return $booking->package ? $booking->package->price : 0;
                            });
        
        $pendingBookings = Booking::where('status', 'pending')->count() + 
                          BookingPackage::where('status', 'pending')->count();
                          
        $totalReviews = Review::count();

        // Destination Sales Chart Data
        $destinationData = Booking::where('status', 'confirmed')
            ->select('destination_id', DB::raw('SUM(total) as total_sales'))
            ->groupBy('destination_id')
            ->with('destination')
            ->get();
        
        $destinationSales = $destinationData->pluck('total_sales')->toArray();
        $destinationNames = $destinationData->map(function($booking) {
            return $booking->destination ? $booking->destination->name : 'Unknown';
        })->toArray();

        // Monthly Sales Chart Data
        $monthlySalesData = MonthlySales::orderBy('year')->orderBy('month')->take(12)->get();
        
        // Check if we have monthly sales data, if not, generate it
        if ($monthlySalesData->isEmpty()) {
            // Generate data for the last 12 months
            $monthlySales = [];
            $monthlyMonths = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $month = $date->month;
                $year = $date->year;
                $monthlyMonths[] = $date->format('M Y');
                
                // Calculate bookings for this month/year
                $destinationSalesMonthly = Booking::where('status', 'confirmed')
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->sum('total');
                
                // Calculate package sales for this month/year
                $packageSalesMonthly = BookingPackage::where('status', 'confirmed')
                    ->whereMonth('booking_date', $month)
                    ->whereYear('booking_date', $year)
                    ->get()
                    ->sum(function($booking) {
                        return $booking->package ? $booking->package->price : 0;
                    });
                
                // Total sales for this month
                $monthlySales[] = $destinationSalesMonthly + $packageSalesMonthly;
            }
        } else {
            $monthlySales = $monthlySalesData->pluck('total')->toArray();
            $monthlyMonths = $monthlySalesData->map(function($sale) {
                return date('M Y', mktime(0, 0, 0, $sale->month, 1, $sale->year));
            })->toArray();
        }

        // Package Sales Chart Data
        $packageData = BookingPackage::where('status', 'confirmed')
            ->with('package')
            ->get()
            ->groupBy('package_id')
            ->map(function($bookings) {
                return $bookings->sum(function($booking) {
                    return $booking->package ? $booking->package->price : 0;
                });
            });
            
        $packages = Package::whereIn('id', $packageData->keys())->get();
        
        $packageSales = [];
        $packageNames = [];
        
        foreach ($packages as $package) {
            $packageNames[] = $package->name;
            $packageSales[] = $packageData[$package->id] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalBookings', 
            'totalRevenue', 
            'pendingBookings', 
            'totalReviews',
            'destinationSales',
            'destinationNames',
            'monthlySales',
            'monthlyMonths',
            'packageSales',
            'packageNames'
        ));
    }
}
