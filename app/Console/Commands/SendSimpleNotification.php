<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;

class SendSimpleNotification extends Command
{
    protected $signature = 'test:simple-notification {reservation?}';
    protected $description = 'Send simple notification email for reservation status change';

    public function handle()
    {
        $reservationId = $this->argument('reservation') ?? 1;
        
        $reservation = Reservation::find($reservationId);
        
        if (!$reservation) {
            $this->error('❌ Reservation not found');
            return;
        }
        
        $this->info("📧 Sending notification for reservation #{$reservation->id}");
        $this->info("Client: {$reservation->name}");
        $this->info("Status: {$reservation->status}");
        
        // Simple notification message
        $message = "
🎉 რეზერვაციის სტატუსი განახლდა!

📋 რეზერვაციის დეტალები:
- ID: #{$reservation->id}
- კლიენტი: {$reservation->name}
- ტელეფონი: {$reservation->phone}
- სტატუსი: {$reservation->status}
- თარიღი: {$reservation->reservation_date}
- დრო: {$reservation->time_from} - {$reservation->time_to}
- სტუმარი: {$reservation->guests_count}

📧 Foodly App
";

        try {
            // Send to client
            if ($reservation->email) {
                Mail::raw($message, function ($msg) use ($reservation) {
                    $msg->to($reservation->email)
                        ->subject("🎉 რეზერვაციის სტატუსი განახლდა - #{$reservation->id}");
                });
                $this->info("✅ Email sent to client: {$reservation->email}");
            }
            
            // Send to admin
            Mail::raw($message, function ($msg) use ($reservation) {
                $msg->to('gakhokia.david@gmail.com')
                    ->subject("📋 რეზერვაცია #{$reservation->id} - {$reservation->status}");
            });
            $this->info("✅ Email sent to admin: gakhokia.david@gmail.com");
            
            $this->info("🎉 All notifications sent successfully!");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send: " . $e->getMessage());
        }
    }
}
