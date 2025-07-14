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
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relationship - ნებისმიერი entity (restaurant, place, table)
            $table->string('viewable_type'); // App\Models\Restaurant, App\Models\Place, etc.
            $table->unsignedBigInteger('viewable_id');
            
            // View details
            $table->string('page_type')->nullable(); // 'booking_form', 'menu', 'info', etc.
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referer')->nullable();
            $table->string('session_id')->nullable();
            
            // User info (if logged in)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // Geographic data (optional)
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            
            // Additional metadata
            $table->json('metadata')->nullable(); // ნებისმიერი დამატებითი ინფო
            
            $table->timestamp('viewed_at');
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['viewable_type', 'viewable_id']);
            $table->index(['page_type']);
            $table->index(['viewed_at']);
            $table->index(['ip_address']);
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
