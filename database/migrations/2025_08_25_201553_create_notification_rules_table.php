<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_rules', function (Blueprint $table) {
            $table->id();
            $table->string('event_key'); // 'reservation.requested'
            $table->string('recipient_type'); // 'client', 'manager', 'admin'
            $table->json('conditions')->nullable(); // Additional conditions for sending
            $table->integer('delay_minutes')->default(0); // Delay before sending
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['event_key', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_rules');
    }
};
