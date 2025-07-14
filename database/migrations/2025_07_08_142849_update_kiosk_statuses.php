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
        // First, modify the status column to include the new values
        Schema::table('kiosks', function (Blueprint $table) {
            // Change the enum to include our three status values
            $table->enum('status', ['active', 'offline', 'maintenance'])->default('active')->change();
        });
        
        // Now normalize any existing status values
        // Update 'inactive' to 'offline' (this is the main change we need)
        DB::table('kiosks')
            ->where('status', 'inactive')
            ->update(['status' => 'offline']);
            
        // Update any other variations to the standard statuses
        DB::table('kiosks')
            ->where('status', 'ofline')
            ->orWhere('status', 'OFFLINE')
            ->orWhere('status', 'Offline')
            ->update(['status' => 'offline']);
            
        // Update any variations of 'active'
        DB::table('kiosks')
            ->where('status', 'ACTIVE')
            ->orWhere('status', 'Active')
            ->orWhere('status', 'online')
            ->orWhere('status', 'ONLINE')
            ->orWhere('status', 'Online')
            ->update(['status' => 'active']);
            
        // Update any variations of 'maintenance'
        DB::table('kiosks')
            ->where('status', 'MAINTENANCE')
            ->orWhere('status', 'Maintenance')
            ->orWhere('status', 'under_maintenance')
            ->orWhere('status', 'maintainance') // common typo
            ->update(['status' => 'maintenance']);
            
        // Set any unknown statuses to 'offline' as default
        DB::table('kiosks')
            ->whereNotIn('status', ['active', 'offline', 'maintenance'])
            ->update(['status' => 'offline']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, convert any 'offline' and 'maintenance' back to 'inactive'
        DB::table('kiosks')
            ->whereIn('status', ['offline', 'maintenance'])
            ->update(['status' => 'inactive']);
            
        // Then revert the column back to the original enum
        Schema::table('kiosks', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }
};
