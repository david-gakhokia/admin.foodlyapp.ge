<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            
            // QR Code fields
            $table->string('qr_code')->nullable();
            $table->string('qr_code_image')->nullable();
            $table->string('qr_code_link')->nullable();
            
            $table->string('time_zone')->nullable();
            
            // Basic restaurant info
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('rank')->default(0);
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            
            // Contact info
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            
            // Business details
            $table->integer('discount_rate')->default(0);
            $table->string('price_per_person')->nullable();
            $table->enum('price_currency', ['GEL', 'USD', 'EUR', 'AED', 'HUF', 'CZK'])->nullable()->default(null);
            $table->string('working_hours')->nullable();
            $table->integer('delivery_time')->nullable();
            $table->string('reservation_type')->nullable();
            
            // Location details
            $table->string('map_link')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->text('map_embed_link')->nullable();
            
            // Timestamps and user tracking
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedInteger('version')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
