<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use App\Mail\PaymentConfirmation;
use App\Mail\PaymentFailed;
use App\Mail\PaymentRefunded;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailNotifications extends Command
{
    protected $signature = 'bog:test-emails {--email= : Send to specific email address} {--type=all : Email type (all|confirmation|failed|refunded)}';
    protected $description = 'Test BOG payment email notifications';

    public function handle()
    {
        $this->info('📧 Testing BOG Email Notifications');
        $this->newLine();

        $emailAddress = $this->option('email') ?: 'test@foodly.ge';
        $emailType = $this->option('type');

        $this->line("📬 Testing emails to: {$emailAddress}");
        $this->line("📋 Email type: {$emailType}");
        $this->newLine();

        // Create test data
        $testData = $this->createTestData($emailAddress);
        
        if (!$testData) {
            $this->error('❌ Failed to create test data');
            return 1;
        }

        // Test emails based on type
        $results = [];
        
        if ($emailType === 'all' || $emailType === 'confirmation') {
            $results['confirmation'] = $this->testPaymentConfirmation($testData, $emailAddress);
        }
        
        if ($emailType === 'all' || $emailType === 'failed') {
            $results['failed'] = $this->testPaymentFailed($testData, $emailAddress);
        }
        
        if ($emailType === 'all' || $emailType === 'refunded') {
            $results['refunded'] = $this->testPaymentRefunded($testData, $emailAddress);
        }

        // Display results
        $this->displayResults($results);

        // Cleanup
        $this->cleanupTestData($testData);

        return 0;
    }

    private function createTestData(string $email): ?array
    {
        try {
            $this->line('🏗️  Creating test data...');

            // Create test reservation
            $reservation = Reservation::create([
                'name' => 'Test User',
                'email' => $email,
                'phone' => '+995555123456',
                'guests_count' => 2,
                'reservation_date' => now()->addDay()->toDateString(),
                'time_from' => '19:00',
                'time_to' => '21:00',
                'status' => 'confirmed',
                'reservable_type' => 'App\\Models\\Restaurant',
                'reservable_id' => 1,
                'type' => 'table'
            ]);

            // Create test transactions for different scenarios
            $transactions = [];

            // Successful payment transaction
            $transactions['success'] = BOGTransaction::create([
                'reservation_id' => $reservation->id,
                'bog_order_id' => 'TEST_SUCCESS_' . time(),
                'bog_payment_id' => 'PAY_SUCCESS_' . time(),
                'amount' => 75.50,
                'currency' => 'GEL',
                'status' => 'completed',
                'bog_status' => 'success',
                'bog_response_data' => [
                    'test_mode' => true,
                    'payment_method' => 'card',
                    'card_mask' => '**** **** **** 1234'
                ]
            ]);

            // Failed payment transaction
            $transactions['failed'] = BOGTransaction::create([
                'reservation_id' => $reservation->id,
                'bog_order_id' => 'TEST_FAILED_' . time(),
                'bog_payment_id' => 'PAY_FAILED_' . time(),
                'amount' => 60.00,
                'currency' => 'GEL',
                'status' => 'failed',
                'bog_status' => 'failed',
                'bog_response_data' => [
                    'test_mode' => true,
                    'error_code' => 'INSUFFICIENT_FUNDS',
                    'error_message' => 'არასაკმარისი თანხა ბარათზე'
                ]
            ]);

            // Refunded payment transaction
            $transactions['refunded'] = BOGTransaction::create([
                'reservation_id' => $reservation->id,
                'bog_order_id' => 'TEST_REFUND_' . time(),
                'bog_payment_id' => 'PAY_REFUND_' . time(),
                'amount' => 80.00,
                'currency' => 'GEL',
                'status' => 'refunded',
                'bog_status' => 'refunded',
                'bog_response_data' => [
                    'test_mode' => true,
                    'refund_id' => 'REFUND_' . time(),
                    'refund_reason' => 'customer_request'
                ]
            ]);

            $this->info('✅ Test data created successfully');
            
            return [
                'reservation' => $reservation,
                'transactions' => $transactions
            ];

        } catch (\Exception $e) {
            $this->error("❌ Failed to create test data: {$e->getMessage()}");
            return null;
        }
    }

    private function testPaymentConfirmation(array $testData, string $email): bool
    {
        try {
            $this->line('✅ Testing Payment Confirmation Email...');
            
            $transaction = $testData['transactions']['success'];
            $mailable = new PaymentConfirmation($transaction);

            // Test email content
            $this->info('📧 Email Preview:');
            $this->line("To: {$email}");
            $this->line("Subject: {$mailable->envelope()->subject}");
            $this->line("Transaction: {$transaction->id}");
            $this->line("Amount: {$transaction->amount} {$transaction->currency}");

            // Send email
            if ($this->confirm('Send confirmation email?', true)) {
                Mail::to($email)->send($mailable);
                $this->info('✅ Payment confirmation email sent');
                return true;
            } else {
                $this->warn('⚠️  Email sending skipped');
                return true;
            }

        } catch (\Exception $e) {
            $this->error("❌ Payment confirmation test failed: {$e->getMessage()}");
            return false;
        }
    }

    private function testPaymentFailed(array $testData, string $email): bool
    {
        try {
            $this->line('❌ Testing Payment Failed Email...');
            
            $transaction = $testData['transactions']['failed'];
            $mailable = new PaymentFailed($transaction);

            // Test email content
            $this->info('📧 Email Preview:');
            $this->line("To: {$email}");
            $this->line("Subject: {$mailable->envelope()->subject}");
            $this->line("Transaction: {$transaction->id}");
            $this->line("Error: {$transaction->bog_response_data['error_message']}");

            // Send email
            if ($this->confirm('Send failed payment email?', true)) {
                Mail::to($email)->send($mailable);
                $this->info('✅ Payment failed email sent');
                return true;
            } else {
                $this->warn('⚠️  Email sending skipped');
                return true;
            }

        } catch (\Exception $e) {
            $this->error("❌ Payment failed test failed: {$e->getMessage()}");
            return false;
        }
    }

    private function testPaymentRefunded(array $testData, string $email): bool
    {
        try {
            $this->line('💸 Testing Payment Refunded Email...');
            
            $transaction = $testData['transactions']['refunded'];
            $mailable = new PaymentRefunded($transaction);

            // Test email content
            $this->info('📧 Email Preview:');
            $this->line("To: {$email}");
            $this->line("Subject: {$mailable->envelope()->subject}");
            $this->line("Transaction: {$transaction->id}");
            $this->line("Refund Amount: {$transaction->amount} {$transaction->currency}");

            // Send email
            if ($this->confirm('Send refunded payment email?', true)) {
                Mail::to($email)->send($mailable);
                $this->info('✅ Payment refunded email sent');
                return true;
            } else {
                $this->warn('⚠️  Email sending skipped');
                return true;
            }

        } catch (\Exception $e) {
            $this->error("❌ Payment refunded test failed: {$e->getMessage()}");
            return false;
        }
    }

    private function displayResults(array $results): void
    {
        $this->newLine();
        $this->info('📊 Test Results Summary:');
        
        foreach ($results as $type => $success) {
            $status = $success ? '✅' : '❌';
            $this->line("{$status} {$type}: " . ($success ? 'SUCCESS' : 'FAILED'));
        }

        $successCount = count(array_filter($results));
        $totalCount = count($results);
        
        $this->newLine();
        $this->info("📈 Overall Result: {$successCount}/{$totalCount} tests passed");

        if ($successCount === $totalCount) {
            $this->info('🎉 All email tests passed successfully!');
        } else {
            $this->warn('⚠️  Some email tests failed. Check the logs for details.');
        }
    }

    private function cleanupTestData(array $testData): void
    {
        if ($this->confirm('🗑️  Clean up test data?', true)) {
            try {
                // Delete transactions
                foreach ($testData['transactions'] as $transaction) {
                    $transaction->delete();
                }
                
                // Delete reservation
                $testData['reservation']->delete();
                
                $this->info('✅ Test data cleaned up');
            } catch (\Exception $e) {
                $this->error("❌ Cleanup failed: {$e->getMessage()}");
            }
        } else {
            $this->warn('⚠️  Test data preserved for manual inspection');
            $this->line("Reservation ID: {$testData['reservation']->id}");
            foreach ($testData['transactions'] as $type => $transaction) {
                $this->line("Transaction ({$type}): {$transaction->id}");
            }
        }
    }
}
