<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\BookingPackage;
use App\Models\MonthlySales;
use Carbon\Carbon;

class CalculateMonthlySales extends Command
{
    protected $signature = 'sales:calculate-monthly {--month=} {--year=}';
    protected $description = 'Calculate and store monthly sales data';

    public function handle()
    {
        // Get month and year from options or use current month
        $month = $this->option('month') ?: Carbon::now()->month;
        $year = $this->option('year') ?: Carbon::now()->year;
        
        $this->info("Calculating sales for {$month}/{$year}...");
        
        // Calculate regular bookings
        $bookingsTotal = Booking::where('status', 'confirmed')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('total');
        
        $bookingsCount = Booking::where('status', 'confirmed')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();
        
        // Calculate package bookings
        $packagesTotal = BookingPackage::with('package')
            ->where('status', 'confirmed')
            ->whereMonth('booking_date', $month)
            ->whereYear('booking_date', $year)
            ->get()
            ->sum(function($booking) {
                return $booking->package ? $booking->package->price : 0;
            });
        
        $packagesCount = BookingPackage::where('status', 'confirmed')
            ->whereMonth('booking_date', $month)
            ->whereYear('booking_date', $year)
            ->count();
        
        // Total sales for the month
        $totalSales = $bookingsTotal + $packagesTotal;
        
        // Update or create monthly sales record
        MonthlySales::updateOrCreate(
            ['month' => $month, 'year' => $year],
            [
                'total' => $totalSales,
                'bookings_count' => $bookingsCount,
                'packages_count' => $packagesCount
            ]
        );
        
        $this->info("Monthly sales for {$month}/{$year} calculated: ₱" . number_format($totalSales, 2));
        return Command::SUCCESS;
    }
}
