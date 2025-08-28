<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Models\Reservation;
use App\Mail\Client\ClientConfirmedEmail;

class TestRealReservation extends Command
{
    protected $signature = 'test:real-reservation';
    protected $description = 'Test email with real reservation data';

    public function handle()
    {
        $this->info('📧 Testing with real reservation data...');
        
        // Get a real reservation from database
        $reservation = Reservation::first();
        
        if (!$reservation) {
            $this->error('❌ No reservations found in database');
            return;
        }
        
        $this->info("Found reservation ID: {$reservation->id}");
        $this->info("Client: {$reservation->name}");
        $this->info("Status: {$reservation->status}");
        
        // Temporarily switch to log driver
        Config::set('mail.default', 'log');
        
        try {
            $mailable = new ClientConfirmedEmail($reservation);
            
            Mail::to('gakhokia.david@gmail.com')->send($mailable);
            
            $this->info("✅ Email with real reservation data sent!");
            $this->info("💡 Check storage/logs/laravel.log for email content");
            
            // Now try with SMTP
            $this->info("\n📧 Trying with real SMTP...");
            Config::set('mail.default', 'smtp');
            
            Mail::to('gakhokia.david@gmail.com')->send($mailable);
            
            $this->info("✅ Real email sent to your inbox!");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            $this->line("Stack trace: " . $e->getTraceAsString());
        }
    }
}
