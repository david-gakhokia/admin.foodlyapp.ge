<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class TestEmailLocal extends Command
{
    protected $signature = 'test:email-local';
    protected $description = 'Test email with log driver';

    public function handle()
    {
        $this->info('📧 Testing email with log driver...');
        
        // Temporarily switch to log driver
        Config::set('mail.default', 'log');
        
        try {
            Mail::raw('ეს არის ტესტ იმეილი Foodly აპიდან! 🎉 თარიღი: ' . now(), function ($message) {
                $message->to('gakhokia.david@gmail.com')
                        ->subject('🧪 ტესტ იმეილი - Foodly App - ' . now()->format('H:i:s'));
            });
            
            $this->info("✅ Test email logged successfully!");
            $this->info("💡 Check storage/logs/laravel.log for email content");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
        }
        
        // Test reservation email template
        $this->info("\n📧 Testing reservation email template...");
        
        try {
            $fakeReservation = (object) [
                'id' => 999,
                'name' => 'ტესტ კლიენტი',
                'phone' => '+995555123456',
                'email' => 'test@example.com',
                'status' => 'Confirmed',
                'reservation_date' => now(),
                'time_from' => '19:00',
                'time_to' => '21:00',
                'guests_count' => 4,
                'notes' => 'ტესტ შენიშვნები',
                'created_at' => now(),
            ];
            
            // Add mock method
            $fakeReservation->getRestaurantName = function() {
                return 'ტესტ რესტორანი';
            };
            
            $mailable = new \App\Mail\Client\ClientConfirmedEmail($fakeReservation);
            
            Mail::to('gakhokia.david@gmail.com')->send($mailable);
            
            $this->info("✅ Template email logged successfully!");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send template email: " . $e->getMessage());
            $this->line("Stack trace: " . $e->getTraceAsString());
        }
    }
}
