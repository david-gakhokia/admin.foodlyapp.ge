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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();              // SEO-friendly ბმული
            $table->string('image')->nullable();           // Cloudinary image path ან filename
            $table->string('image_link')->nullable();      // Full URL (optional, cache ან direct access)
            $table->string('unit')->nullable();                // ერთეულის ტიპი (მაგ: kg, piece)
            $table->decimal('quantity', 8, 2)->default(1);     // რაოდენობა
            $table->decimal('price', 10, 2);                   // ფასი
            $table->decimal('discounted_price', 10, 2)->nullable(); // ფასდაკლებული ფასი
            $table->boolean('is_vegan')->default(false);     // ვეგანურია თუ არა
            $table->boolean('is_gluten_free')->default(false); // გლუტენის გარეშეა თუ არა
            $table->integer('calories')->nullable();         // კალორიები (optional)
            $table->unsignedTinyInteger('rank')->default(0);
            $table->integer('preparation_time')->nullable(); // მომზადების დრო (წუთებში)
            $table->boolean('available')->default(true);  // ხელმისაწვდომობა
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
