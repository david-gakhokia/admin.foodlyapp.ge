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
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('menu_categories')->onDelete('cascade');
            $table->string('slug')->unique();              // SEO-friendly ბმული
            $table->string('image')->nullable();           // Cloudinary image path ან filename
            $table->string('image_link')->nullable();      // Full URL (optional, cache ან direct access)
            $table->string('icon')->nullable();            // ფაილის სახელი ან სიმბოლო
            $table->string('icon_link')->nullable();       // Full icon URL (თუ საჭიროა)
            $table->unsignedTinyInteger('rank')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_categories');
    }
};
