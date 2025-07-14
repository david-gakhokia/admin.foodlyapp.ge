<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // Polymorphic
            $table->string('type'); // (restaurant / place / table - სიმარტივისთვის)
            $table->string('reservable_type');
            $table->unsignedBigInteger('reservable_id');

            // Reservation details
            $table->date('reservation_date');
            $table->time('time_from');
            $table->time('time_to');
            $table->integer('guests_count');
            $table->string('occasion')->nullable();

            // Customer information
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();

            // Additional
            $table->string('promo_code')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed'])->default('Pending');

            $table->timestamps();

            // Indexes (optional but recommended)
            $table->index(['reservable_type', 'reservable_id']);
            $table->index(['reservation_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
