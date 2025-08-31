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
        // First, update existing data to use lowercase values
        DB::table('reservations')->whereIn('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed', 'Paid', 'NoShow'])
            ->update([
                'status' => DB::raw("CASE 
                    WHEN status = 'Pending' THEN 'pending'
                    WHEN status = 'Confirmed' THEN 'confirmed'
                    WHEN status = 'Cancelled' THEN 'cancelled'
                    WHEN status = 'Completed' THEN 'completed'
                    WHEN status = 'Paid' THEN 'paid'
                    WHEN status = 'NoShow' THEN 'no_show'
                    ELSE status
                END")
            ]);

        // Now update the enum definition to use lowercase values and include new BOG statuses
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'paid', 'completed', 'no_show'])
                  ->default('pending')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, update data back to capitalized values
        DB::table('reservations')->whereIn('status', ['pending', 'confirmed', 'cancelled', 'paid', 'completed', 'no_show'])
            ->update([
                'status' => DB::raw("CASE 
                    WHEN status = 'pending' THEN 'Pending'
                    WHEN status = 'confirmed' THEN 'Confirmed'
                    WHEN status = 'cancelled' THEN 'Cancelled'
                    WHEN status = 'paid' THEN 'Paid'
                    WHEN status = 'completed' THEN 'Completed'
                    WHEN status = 'no_show' THEN 'NoShow'
                    ELSE status
                END")
            ]);

        // Revert enum definition
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed'])
                  ->default('Pending')
                  ->change();
        });
    }
};
