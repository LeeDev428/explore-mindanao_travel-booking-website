<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDatabaseViews extends Migration
{
    public function up()
    {
        // Destination Analytics View
        DB::statement('
            CREATE OR REPLACE VIEW vw_destination_analytics AS
            SELECT 
                d.id,
                d.name,
                d.location,
                d.price,
                COUNT(DISTINCT b.id) AS total_bookings,
                SUM(b.total) AS total_revenue,
                COALESCE(AVG(r.rating), 0) AS average_rating,
                COUNT(DISTINCT r.id) AS review_count
            FROM 
                destinations d
            LEFT JOIN 
                bookings b ON d.id = b.destination_id
            LEFT JOIN 
                reviews r ON d.id = r.destination_id
            GROUP BY 
                d.id, d.name, d.location, d.price
        ');

        // Add other views similarly...
    }

    public function down()
    {
        // Drop views if rolled back
        DB::statement('DROP VIEW IF EXISTS vw_destination_analytics');
        // Drop other views...
    }
}