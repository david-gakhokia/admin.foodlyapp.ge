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
        Schema::create('notification_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_event_id')
                  ->constrained('notification_events')
                  ->onDelete('cascade');
            $table->string('recipient_email');
            $table->string('recipient_type'); // 'client', 'manager', 'admin'
            $table->string('template_id'); // SendGrid template ID
            $table->json('template_data')->nullable(); // Data sent to template
            $table->string('provider'); // 'sendgrid', 'ses', etc.
            $table->string('provider_message_id')->nullable(); // External provider's message ID
            $table->enum('status', [
                'pending', 'sent', 'delivered', 'opened', 'clicked', 
                'bounced', 'dropped', 'deferred', 'spam_report', 'unsubscribed'
            ])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->text('error_message')->nullable();
            $table->json('webhook_data')->nullable(); // Raw webhook payload
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'sent_at']);
            $table->index(['recipient_email', 'created_at']);
            $table->index('provider_message_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_deliveries');
    }
};
