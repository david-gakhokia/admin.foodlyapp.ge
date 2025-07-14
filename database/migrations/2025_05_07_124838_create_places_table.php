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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            
            // QR Code fields
            $table->string('qr_code')->nullable();
            $table->string('qr_code_image')->nullable();
            $table->string('qr_code_link')->nullable();
            
            // Basic details
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedInteger('rank')->default(0);
            $table->string('image')->nullable();       // Local image path
            $table->string('image_link')->nullable();  // External image link
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
