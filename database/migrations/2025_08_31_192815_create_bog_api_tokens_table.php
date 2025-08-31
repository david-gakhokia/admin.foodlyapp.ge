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
        Schema::create('bog_api_tokens', function (Blueprint $table) {
            $table->id();
            $table->enum('environment', ['sandbox', 'production']);
            $table->text('access_token');
            $table->string('token_type', 50)->default('Bearer');
            $table->timestamp('expires_at');
            $table->timestamps();
            
            // Unique constraint for environment
            $table->unique('environment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bog_api_tokens');
    }
};
