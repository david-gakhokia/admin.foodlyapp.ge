<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // protected $connection = 'mysql2';

    public function up(): void
    {
        Schema::create('space_translations', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('space_id')->unsigned();
            $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();

            $table->string('locale')->index(); // Ensure locale is NOT NULL
            $table->string('name');
            $table->text('description')->nullable();

            $table->unique(['space_id', 'locale']);
            // $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_translations');
    }
};
