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
        Schema::create('bog_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            
            // BOG API identifiers
            $table->string('bog_order_id')->unique();
            $table->string('bog_payment_id')->nullable();
            
            // Payment details
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('GEL');
            
            // BOG Transaction status
            $table->enum('status', [
                'pending',      // BOG: created, pending
                'processing',   // BOG: in_progress
                'completed',    // BOG: success → Reservation: paid
                'failed',       // BOG: failed → Reservation: confirmed
                'cancelled',    // BOG: cancelled → Reservation: cancelled
                'refunded'      // BOG: refunded → Reservation: cancelled
            ])->default('pending');
            
            // BOG API response data
            $table->string('bog_status', 50)->nullable();
            $table->json('bog_response_data')->nullable();
            
            // URLs
            $table->text('payment_url')->nullable();
            $table->text('callback_url')->nullable();
            
            // Error handling
            $table->text('error_message')->nullable();
            
            // Timestamps
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            // Foreign keys and indexes
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->index(['reservation_id', 'status']);
            $table->index('bog_order_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bog_transactions');
    }
};
