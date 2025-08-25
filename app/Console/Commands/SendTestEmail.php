<?php

namespace App\Console\Commands;

use App\Services\Email\EmailDispatcher;
use App\Models\NotificationTemplate;
use App\Models\Reservation;
use Illuminate\Console\Command;

class SendTestEmail extends Command
{
    protected $signature = 'email:send-test {email} {--template=1 : Template ID to use} {--dry-run : Don\'t actually send}';
    protected $description = 'Send a test email using the notification system';

    public function handle()
    {
        $email = $this->argument('email');
        $templateId = $this->option('template');
        $dryRun = $this->option('dry-run');

        $this->info("🧪 Sending test email to: {$email}");
        
        if ($dryRun) {
            $this->warn("🔄 DRY RUN MODE - No email will be sent");
        }

        // Get template
        $template = NotificationTemplate::find($templateId);
        if (!$template) {
            $this->error("❌ Template not found with ID: {$templateId}");
            return 1;
        }

        $this->line("📧 Using template: {$template->event_key} for {$template->recipient_type} ({$template->provider})");

        // Get a sample reservation for data
        $reservation = Reservation::first();
        if (!$reservation) {
            $this->error("❌ No reservations found. Creating sample data...");
            
            // Create minimal sample data
            $sampleData = [
                'customer_name' => 'Test Customer',
                'restaurant_name' => 'Test Restaurant',
                'reservation_date' => now()->format('Y-m-d'),
                'reservation_time' => '19:00',
                'party_size' => 2,
                'confirmation_code' => 'TEST123'
            ];
        } else {
            // Safely handle time_from field
            $timeFrom = $reservation->time_from;
            if (is_object($timeFrom) && method_exists($timeFrom, 'format')) {
                $timeString = $timeFrom->format('H:i');
            } else {
                $timeString = (string) $timeFrom;
            }

            $sampleData = [
                'customer_name' => $reservation->name ?? 'Test Customer',
                'restaurant_name' => $reservation->reservable?->name ?? 'Test Restaurant',
                'reservation_date' => $reservation->reservation_date?->format('Y-m-d') ?? now()->format('Y-m-d'),
                'reservation_time' => $timeString ?? '19:00',
                'party_size' => (int) $reservation->guests_count ?? 2,
                'confirmation_code' => 'RES' . $reservation->id
            ];
        }

        $this->line("📝 Sample data:");
        foreach ($sampleData as $key => $value) {
            // Convert arrays and objects to strings safely
            $displayValue = is_array($value) || is_object($value) ? json_encode($value) : $value;
            $this->line("   {$key}: {$displayValue}");
        }

        if ($dryRun) {
            $this->info("✅ Dry run completed - template and data validation passed");
            return 0;
        }

        // Actually send the email
        try {
            $dispatcher = new EmailDispatcher();

            $messageId = $dispatcher->sendTemplate(
                $email,
                'customer', // recipient type
                $template->provider_template_id, // Use correct column name
                $sampleData,
                'test_' . now()->timestamp // idempotency key
            );

            $this->info("✅ Email sent successfully!");
            $this->line("   Message ID: {$messageId}");

        } catch (\Exception $e) {
            $this->error("❌ Exception occurred: " . $e->getMessage());
            $this->error("File: " . $e->getFile() . " Line: " . $e->getLine());
            $this->error("Stack trace:");
            $this->line($e->getTraceAsString());
            return 1;
        }

        return 0;
    }
}
