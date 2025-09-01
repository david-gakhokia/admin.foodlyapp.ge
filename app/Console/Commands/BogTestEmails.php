<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BogTestEmails extends Command
{
    protected $signature = 'bog:test-emails {--email=} {--type=all}';
    protected $description = 'Test BOG-related email templates';

    public function handle()
    {
        $email = $this->option('email') ?? config('mail.from.address');
        $type = $this->option('type');

        if (!$email) {
            $this->error('No recipient email configured');
            return 1;
        }

        $this->info('Sending test emails to: ' . $email);

        // For safety, we'll just log the actions and optionally send a simple email
        $payload = [
            'subject' => 'BOG Test Email - ' . strtoupper($type),
            'body' => 'This is a test email for type: ' . $type
        ];

        Log::info('bog:test-emails executing', ['email' => $email, 'type' => $type]);

        try {
            Mail::raw($payload['body'], function ($message) use ($email, $payload) {
                $message->to($email)
                    ->subject($payload['subject']);
            });

            $this->info('Test email sent (or queued) to ' . $email);
        } catch (\Exception $e) {
            Log::error('bog:test-emails failed', ['exception' => $e]);
            $this->error('Failed to send test email: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
