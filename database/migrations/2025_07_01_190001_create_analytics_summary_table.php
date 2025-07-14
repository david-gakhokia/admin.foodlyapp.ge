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
        Schema::create('analytics_summary', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relationship
            $table->string('entity_type'); // Restaurant, Place, Table
            $table->unsignedBigInteger('entity_id');
            
            // Date for daily/monthly aggregation
            $table->date('date');
            $table->enum('period_type', ['daily', 'monthly'])->default('daily');
            
            // Aggregated metrics
            $table->unsignedInteger('total_views')->default(0);
            $table->unsignedInteger('unique_visitors')->default(0); // by IP
            $table->unsignedInteger('booking_form_views')->default(0);
            $table->unsignedInteger('menu_views')->default(0);
            
            // Popular times
            $table->json('hourly_distribution')->nullable(); // [0=>5, 1=>3, 2=>0, ...]
            $table->json('top_referrers')->nullable();
            $table->json('top_countries')->nullable();
            
            $table->timestamps();
            
            // Unique constraint - one record per entity per date
            $table->unique(['entity_type', 'entity_id', 'date', 'period_type'], 'analytics_unique');
            
            // Indexes
            $table->index(['entity_type', 'entity_id']);
            $table->index(['date']);
            $table->index(['period_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_summary');
    }
};
