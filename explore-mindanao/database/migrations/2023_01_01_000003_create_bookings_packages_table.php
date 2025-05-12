<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade'); // Reference to packages
            $table->string('name'); // User's name
            $table->string('email'); // User's email
            $table->string('phone'); // User's phone
            $table->date('booking_date'); // Booking date
            $table->string('status')->default('pending'); // Booking status
            $table->boolean('user_is_read')->default(0); // Whether the user has read the status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings_packages');
    }
};
