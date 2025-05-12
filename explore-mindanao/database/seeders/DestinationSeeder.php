<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        DB::table('destinations')->insert([
            [
                'name' => 'Mount Apo',
                'price' => 1500,
                'location' => 'Davao',
                'description' => 'Mount Apo is the highest mountain in the Philippines, offering breathtaking views and challenging hiking trails.',
                'image_path' => 'destinations/mount-apo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pearl Farm',
                'price' => 2000,
                'location' => 'Davao',
                'description' => 'Pearl Farm is a luxurious beach resort known for its pristine waters, white sand beaches, and relaxing ambiance.',
                'image_path' => 'destinations/pearl-farm.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tinago Falls',
                'price' => 1000,
                'location' => 'Lanao Del Norte',
                'description' => 'Tinago Falls is a hidden gem surrounded by lush greenery, featuring a majestic waterfall and a serene swimming area.',
                'image_path' => 'destinations/tinago-falls.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'People\'s Park',
                'price' => 1000,
                'location' => 'Davao',
                'description' => 'People\'s Park is a cultural and recreational park in Davao City, showcasing sculptures, gardens, and local artistry.',
                'image_path' => 'destinations/peoples-park.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Camp Sabros',
                'price' => 1000,
                'location' => 'Davao Del Sur',
                'description' => 'Camp Sabros is an adventure park offering zip lines, scenic views, and a cool mountain breeze.',
                'image_path' => 'destinations/camp-sabros.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
