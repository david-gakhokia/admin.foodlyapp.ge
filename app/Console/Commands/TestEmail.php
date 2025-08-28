<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'test:email {email=gakhokia.david@gmail.com}';
    protected $description = 'Send a test email';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info('📧 Sending test email...');
        
        try {
            Mail::raw('ეს არის ტესტ იმეილი Foodly აპიდან! 🎉 თარიღი: ' . now(), function ($message) use ($email) {
                $message->to($email)
                        ->subject('🧪 ტესტ იმეილი - Foodly App - ' . now()->format('H:i:s'));
            });
            
            $this->info("✅ Test email sent successfully to: {$email}");
            $this->info("💡 Please check your inbox and spam folder");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            
            // Check mail config
            $this->warn("📋 Mail Configuration:");
            $this->line("Driver: " . config('mail.default'));
            $this->line("Host: " . config('mail.mailers.smtp.host'));
            $this->line("Port: " . config('mail.mailers.smtp.port'));
            $this->line("From: " . config('mail.from.address'));
        }
    }
}
