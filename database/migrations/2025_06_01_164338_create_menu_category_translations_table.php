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
        Schema::create('menu_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->constrained()->onDelete('cascade');

            $table->string('locale')->index();

            $table->string('name');
            $table->text('description')->nullable();

            $table->unique(['menu_category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_category_translations');
    }
};
