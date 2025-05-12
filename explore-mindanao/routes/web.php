<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // Alias for Admin DashboardController
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController; // Alias for Admin DestinationController
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\DashboardController; // User DashboardController
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController; // Alias for Admin BookingController
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\BookingController; // User BookingController
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DestinationController; // Non-admin DestinationController
use App\Http\Controllers\Admin\PackageController; // Correct import for Admin PackageController
use App\Http\Controllers\BookingPackageController;
use App\Http\Controllers\ReviewController; // Import ReviewController

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // User dashboard route

Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.create'); // User booking route
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store'); // Add this line

Route::get('/cart', [CartController::class, 'index'])->name('cart'); // Add this line

Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/notifications/fetch', [NotificationController::class, 'fetch'])->name('notifications.fetch');

// Add this with your other notification routes:
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
    ->name('notifications.markAllAsRead');

Route::get('/destination/{id}/packages', [DestinationController::class, 'packages'])->name('destination.packages');

Route::get('/book-now/{id}', [BookingPackageController::class, 'create'])->name('bookings.create');
Route::post('/book-now', [BookingPackageController::class, 'store'])->name('bookings.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reviews routes
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/destination/{id}/reviews', [ReviewController::class, 'showDestinationReviews'])->name('destination.reviews');
    Route::get('/package/{id}/reviews', [ReviewController::class, 'showPackageReviews'])->name('package.reviews');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard'); // Admin dashboard route
    Route::get('/admin/destinations/create', [AdminDestinationController::class, 'create'])->name('admin.destinations.create');
    Route::post('/admin/destinations', [AdminDestinationController::class, 'store'])->name('admin.destinations.store');
    Route::get('/admin/destinations/{id}/edit', [AdminDestinationController::class, 'edit'])->name('admin.destinations.edit');
    Route::put('/admin/destinations/{id}', [AdminDestinationController::class, 'update'])->name('admin.destinations.update');
    Route::delete('/admin/destinations/{id}', [AdminDestinationController::class, 'destroy'])->name('admin.destinations.destroy');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index'); // Admin booking route
    Route::patch('/admin/bookings/{id}/confirm', [AdminBookingController::class, 'confirm'])->name('admin.bookings.confirm');
    Route::delete('/admin/bookings/{id}/decline', [AdminBookingController::class, 'decline'])->name('admin.bookings.decline'); // Ensure DELETE method
    Route::patch('/admin/bookings/{id}/confirm', [AdminBookingController::class, 'confirm'])->name('admin.bookings.confirm');
    Route::patch('/admin/bookings/{id}/decline', [AdminBookingController::class, 'decline'])->name('admin.bookings.decline');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::resource('/admin/packages', PackageController::class, ['as' => 'admin']); // Fix the route prefix and name

    // Reviews routes for admin
    Route::get('/admin/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});

require __DIR__.'/auth.php';
