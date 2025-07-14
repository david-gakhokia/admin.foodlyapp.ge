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
        Schema::create('cuisine_restaurant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuisine_id')->constrained()->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');

            // დამატებითი ველები:
            $table->integer('rank')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();

            $table->unique(['cuisine_id', 'restaurant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuisine_restaurant');
    }
};
