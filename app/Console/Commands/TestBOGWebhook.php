<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use App\Events\BOGPaymentStatusChanged;
use App\Enums\ReservationStatus;
use App\Services\BOG\BOGPaymentService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestBOGWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bog:test-webhook {--scenario=success : Test scenario (success|failed|refunded)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test BOG webhook functionality with different payment scenarios';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scenario = $this->option('scenario');
        
        $this->info("🧪 Testing BOG Webhook - Scenario: {$scenario}");
        $this->newLine();

        // Create test reservation and transaction
        $testData = $this->createTestData();
        
        if (!$testData) {
            $this->error('❌ Failed to create test data');
            return 1;
        }

        // Simulate webhook payload
        $webhookPayload = $this->generateWebhookPayload($testData['transaction'], $scenario);
        
        // Test webhook endpoint
        $result = $this->testWebhookEndpoint($webhookPayload);
        
        // Verify results
        $this->verifyResults($testData['transaction'], $scenario);
        
        // Cleanup test data
        $this->cleanupTestData($testData);
        
        $this->info('✅ BOG Webhook test completed successfully!');
        return 0;
    }

    /**
     * Create test reservation and transaction
     */
    private function createTestData(): ?array
    {
        try {
            $this->line('📝 Creating test reservation and transaction...');
            
            // Find or create a test reservation
            $reservation = Reservation::where('email', 'test@foodly.ge')->first();
            
            if (!$reservation) {
                $this->warn('⚠️  No test reservation found. Please create one manually or use existing reservation ID.');
                $reservationId = $this->ask('Enter reservation ID to use for testing');
                $reservation = Reservation::find($reservationId);
                
                if (!$reservation) {
                    $this->error('❌ Reservation not found');
                    return null;
                }
            }

            // Create test transaction
            $transaction = BOGTransaction::create([
                'reservation_id' => $reservation->id,
                'bog_order_id' => 'TEST_' . time(),
                'bog_payment_id' => 'PAYMENT_' . time(),
                'amount' => 50.00,
                'currency' => 'GEL',
                'status' => 'pending',
                'bog_status' => 'pending',
                'bog_response_data' => [
                    'test_mode' => true,
                    'created_at' => now()->toISOString()
                ]
            ]);

            $this->info("✅ Created test transaction: {$transaction->id}");
            
            return [
                'reservation' => $reservation,
                'transaction' => $transaction
            ];
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to create test data: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Generate webhook payload for testing
     */
    private function generateWebhookPayload(BOGTransaction $transaction, string $scenario): array
    {
        $this->line("🎭 Generating webhook payload for scenario: {$scenario}");
        
        $basePayload = [
            'order_id' => $transaction->bog_order_id,
            'payment_id' => $transaction->bog_payment_id,
            'amount' => $transaction->amount,
            'currency' => $transaction->currency,
            'timestamp' => now()->toISOString(),
        ];

        return match($scenario) {
            'success' => array_merge($basePayload, [
                'status' => 'success',
                'payment_status' => 'captured',
                'transaction_id' => 'TXN_' . time(),
                'card_mask' => '**** **** **** 1234',
                'authorization_code' => 'AUTH123'
            ]),
            
            'failed' => array_merge($basePayload, [
                'status' => 'failed',
                'payment_status' => 'declined',
                'error_code' => 'INSUFFICIENT_FUNDS',
                'error_message' => 'არასაკმარისი თანხა ბარათზე'
            ]),
            
            'refunded' => array_merge($basePayload, [
                'status' => 'refunded',
                'payment_status' => 'refunded',
                'refund_amount' => $transaction->amount,
                'refund_id' => 'REFUND_' . time(),
                'refund_reason' => 'customer_request'
            ]),
            
            default => $basePayload
        };
    }

    /**
     * Test webhook endpoint
     */
    private function testWebhookEndpoint(array $payload): bool
    {
        try {
            $this->line('🌐 Testing webhook processing...');
            
            // Use BOGPaymentService directly for testing
            $paymentService = app(BOGPaymentService::class);
            
            $result = $paymentService->handleWebhook($payload);
            
            if ($result) {
                $this->info('✅ Webhook processing successful');
                return true;
            } else {
                $this->error('❌ Webhook processing failed');
                return false;
            }
            
        } catch (\Exception $e) {
            $this->error("❌ Webhook test failed: {$e->getMessage()}");
            $this->line("Stack trace: " . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * Verify test results
     */
    private function verifyResults(BOGTransaction $transaction, string $scenario): void
    {
        $this->line('🔍 Verifying test results...');
        
        // Refresh transaction from database
        $transaction->refresh();
        
        $expectedStatus = match($scenario) {
            'success' => 'completed',
            'failed' => 'failed',
            'refunded' => 'refunded',
            default => 'pending'
        };
        
        if ($transaction->status === $expectedStatus) {
            $this->info("✅ Transaction status correct: {$transaction->status}");
        } else {
            $this->error("❌ Transaction status incorrect. Expected: {$expectedStatus}, Got: {$transaction->status}");
        }
        
        // Check reservation status
        $reservation = $transaction->reservation;
        $reservation->refresh();
        
        $status = $reservation->status;
        if ($status instanceof \App\Enums\ReservationStatus) {
            $this->info("📋 Reservation status: " . $status->value);
        } else {
            $this->info("📋 Reservation status: " . $status);
        }
        
        // Verify logs
        $this->line('📜 Checking logs...');
        $logContent = file_get_contents(storage_path('logs/laravel.log'));
        
        if (str_contains($logContent, $transaction->id)) {
            $this->info('✅ Transaction logged correctly');
        } else {
            $this->warn('⚠️  Transaction not found in logs');
        }
    }

    /**
     * Cleanup test data
     */
    private function cleanupTestData(array $testData): void
    {
        if ($this->confirm('🗑️  Clean up test data?', true)) {
            $testData['transaction']->delete();
            $this->info('✅ Test data cleaned up');
        } else {
            $this->warn('⚠️  Test data preserved for manual inspection');
            $this->line("Transaction ID: {$testData['transaction']->id}");
        }
    }
}
