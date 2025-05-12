<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('cascade'); // Make booking_id nullable
            $table->string('type'); // 'monthly' or 'destination'Destination ID
            $table->string('key'); // Month (e.g., '2023-01') or Destination ID
            $table->decimal('total', 10, 2)->default(0); // Total sales
            $table->timestamps();
        });
    }

    public function down(): void
 
    { 
        Schema::dropIfExists('sales_data');
    }
};