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
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('event_key'); // 'reservation.requested', 'reservation.confirmed'
            $table->string('recipient_type'); // 'client', 'manager', 'admin'
            $table->string('provider'); // 'sendgrid', 'ses'
            $table->string('provider_template_id'); // d-xxxxx for SendGrid
            $table->string('subject_template')->nullable(); // For providers that need subject
            $table->json('default_data')->nullable(); // Default template variables
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Unique constraint to prevent duplicate templates
            $table->unique(['event_key', 'recipient_type', 'provider']);
            $table->index(['event_key', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
