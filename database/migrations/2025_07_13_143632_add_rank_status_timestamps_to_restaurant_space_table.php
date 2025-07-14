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
        Schema::table('restaurant_space', function (Blueprint $table) {
            $table->integer('rank')->default(0)->after('space_id');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active')->after('rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurant_space', function (Blueprint $table) {
            $table->dropColumn(['rank', 'status', 'created_at', 'updated_at']);
        });
    }
};
