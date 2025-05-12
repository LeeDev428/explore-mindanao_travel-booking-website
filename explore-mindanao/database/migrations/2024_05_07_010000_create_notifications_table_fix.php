<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First check if the table exists to avoid errors
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }

        // Check if the previous migration is registered but didn't create the table
        if (DB::table('migrations')->where('migration', '2024_05_07_000000_create_notifications_table')->exists()) {
            // The migration is registered but the table doesn't exist, so we don't need to record this migration
        } else {
            // Record this migration
            DB::table('migrations')->insert([
                'migration' => '2024_05_07_010000_create_notifications_table_fix',
                'batch' => DB::table('migrations')->max('batch') + 1,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
