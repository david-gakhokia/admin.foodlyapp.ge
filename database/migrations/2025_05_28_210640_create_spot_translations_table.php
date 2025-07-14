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
        Schema::create('spot_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spot_id')->constrained('spots')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['spot_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spot_translations');
    }
};
