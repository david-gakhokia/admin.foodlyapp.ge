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
        // For MySQL, we need to use raw SQL to properly modify ENUM
        DB::statement("ALTER TABLE kiosks MODIFY COLUMN status ENUM('active', 'offline', 'maintenance') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original ENUM values
        DB::statement("ALTER TABLE kiosks MODIFY COLUMN status ENUM('active', 'inactive') NOT NULL DEFAULT 'active'");
    }
};
