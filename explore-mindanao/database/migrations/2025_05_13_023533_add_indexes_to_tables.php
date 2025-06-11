<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToTables extends Migration
{
    public function up()
    {
        // Add indexes to destinations table
        Schema::table('destinations', function (Blueprint $table) {
            $table->index('location');
            $table->index('price');
            $table->index('name');
        });

        // Add indexes to bookings table
        Schema::table('bookings', function (Blueprint $table) {
            $table->index('status');
            $table->index('date');
            $table->index('email');
        });

        // Add indexes to bookings_packages table
        Schema::table('bookings_packages', function (Blueprint $table) {
            $table->index('status');
            $table->index('booking_date');
            $table->index('email');
        });

        // Add indexes to reviews table
        Schema::table('reviews', function (Blueprint $table) {
            $table->index('rating');
            $table->index('destination_id');
            $table->index('package_id');
        });

        // Add indexes to payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->index('status');
            $table->index('booking_type');
            $table->index('booking_id');
        });
    }

    public function down()
    {
        // Remove indexes if rolled back
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropIndex(['location', 'price', 'name']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['status', 'date', 'email']);
        });

        Schema::table('bookings_packages', function (Blueprint $table) {
            $table->dropIndex(['status', 'booking_date', 'email']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['rating', 'destination_id', 'package_id']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['status', 'booking_type', 'booking_id']);
        });
    }
}