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
        Schema::create('analytics_reports', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->index(); // bog_payments, reservations, revenue, etc.
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('filters')->nullable(); // Report parameters/filters used
            $table->longText('data')->nullable(); // Generated report data
            $table->timestamp('generated_at');
            $table->unsignedBigInteger('generated_by')->nullable();
            $table->string('file_path')->nullable(); // Path to exported file
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->foreign('generated_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['type', 'generated_at']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_reports');
    }
};
