<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    // protected $connection = 'mysql2';


    public function up(): void
    {
        Schema::create('restaurant_space', function (Blueprint $table) {
            $table->foreignId('restaurant_id')->constrained('restaurants')->cascadeOnDelete();
            $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();
            $table->primary(['restaurant_id', 'space_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_space');
    }

};
