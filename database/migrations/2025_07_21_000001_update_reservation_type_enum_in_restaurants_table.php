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
        // If column already exists, alter it to enum; otherwise add it.
        if (Schema::hasColumn('restaurants', 'reservation_type')) {
            DB::statement("ALTER TABLE `restaurants` MODIFY `reservation_type` ENUM('Restaurant','Place','Table') NOT NULL DEFAULT 'Restaurant';");
        } else {
            Schema::table('restaurants', function (Blueprint $table) {
                $table->enum('reservation_type', ['Restaurant', 'Place', 'Table'])->default('Restaurant');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to string. Use raw statement if column exists.
        if (Schema::hasColumn('restaurants', 'reservation_type')) {
            DB::statement("ALTER TABLE `restaurants` MODIFY `reservation_type` VARCHAR(255) NULL;");
        }
    }
};
