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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->integer('rank')->nullable();
            $table->string('image')->nullable();
            $table->string('image_link')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Default set to 'inactive'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
