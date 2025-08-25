<?php

namespace App\Console\Commands;

use App\Models\NotificationTemplate;
use Illuminate\Console\Command;

class ListTemplates extends Command
{
    protected $signature = 'email:templates';
    protected $description = 'List all notification templates';

    public function handle()
    {
        $this->info('📧 Available Notification Templates:');
        $this->newLine();

        $templates = NotificationTemplate::all();

        foreach ($templates as $template) {
            $this->line("ID: {$template->id}");
            $this->line("Event Key: {$template->event_key}");
            $this->line("Recipient Type: {$template->recipient_type}");
            $this->line("Provider: {$template->provider}");
            $this->line("Template ID: {$template->provider_template_id}");
            $this->line("Subject: {$template->subject_template}");
            $this->line("Active: " . ($template->is_active ? 'Yes' : 'No'));
            $this->newLine();
        }

        $this->info("Total templates: " . $templates->count());
    }
}
