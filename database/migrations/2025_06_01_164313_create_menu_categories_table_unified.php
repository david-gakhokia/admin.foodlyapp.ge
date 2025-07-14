<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('menu_categories')->onDelete('cascade');
            $table->foreignId('dish_id')->nullable()->constrained('dishes')->onDelete('set null');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('image_link')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_link')->nullable();
            $table->unsignedTinyInteger('rank')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index('dish_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_categories');
    }
};
