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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            
            // QR Code fields  
            $table->string('qr_code')->nullable();
            $table->string('qr_code_image')->nullable();
            $table->string('qr_code_link')->nullable();
            
            // Foreign keys
            $table->foreignId('restaurant_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('place_id')->nullable()->constrained('places')->onDelete('set null');
            
            // Table details
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->longText('icon')->nullable();
            $table->longText('image')->nullable();
            $table->longText('image_link')->nullable(); 
            $table->integer('seats')->nullable();
            $table->integer('capacity')->nullable(); // Added capacity field
            
            // Location
            $table->string('latitude', 255)->nullable();
            $table->string('longitude', 255)->nullable();
            $table->integer('rank')->nullable();
            
            // Timestamps and user tracking
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            // Foreign key constraints for user tracking
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
