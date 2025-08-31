<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BOG\BOGAuthService;
use App\Services\BOG\BOGPaymentService;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use App\Enums\ReservationStatus;
use Illuminate\Support\Facades\Log;

class TestBOGPaymentFlow extends Command
{
    protected $signature = 'bog:test-payment-flow {--reservation-id= : Use specific reservation ID}';
    protected $description = 'Test complete BOG payment flow from authentication to completion';

    private BOGAuthService $authService;
    private BOGPaymentService $paymentService;

    public function __construct(BOGAuthService $authService, BOGPaymentService $paymentService)
    {
        parent::__construct();
        $this->authService = $authService;
        $this->paymentService = $paymentService;
    }

    public function handle()
    {
        $this->info('🚀 Testing Complete BOG Payment Flow');
        $this->newLine();

        $steps = [
            '1️⃣ Authentication Test',
            '2️⃣ Payment Creation',
            '3️⃣ Status Checking',
            '4️⃣ Webhook Simulation',
            '5️⃣ Database Verification'
        ];

        foreach ($steps as $step) {
            $this->line($step);
        }
        $this->newLine();

        // Step 1: Test Authentication
        if (!$this->testAuthentication()) {
            return 1;
        }

        // Step 2: Test Payment Creation
        $reservation = $this->getTestReservation();
        if (!$reservation) {
            return 1;
        }

        $transaction = $this->testPaymentCreation($reservation);
        if (!$transaction) {
            return 1;
        }

        // Step 3: Test Status Checking
        $this->testStatusChecking($transaction);

        // Step 4: Test Webhook Simulation
        $this->testWebhookSimulation($transaction);

        // Step 5: Database Verification
        $this->testDatabaseVerification($transaction);

        $this->newLine();
        $this->info('✅ Complete BOG Payment Flow Test Successful!');
        
        return 0;
    }

    private function testAuthentication(): bool
    {
        $this->line('🔐 Testing BOG Authentication...');

        try {
            $token = $this->authService->getAccessToken();
            
            if ($token) {
                $this->info('✅ Authentication successful');
                $this->line("Token preview: " . substr($token, 0, 20) . "...");
                return true;
            } else {
                $this->error('❌ Authentication failed - No token received');
                return false;
            }
        } catch (\Exception $e) {
            $this->error("❌ Authentication failed: {$e->getMessage()}");
            return false;
        }
    }

    private function getTestReservation(): ?Reservation
    {
        $this->line('📋 Getting test reservation...');

        $reservationId = $this->option('reservation-id');
        
        if ($reservationId) {
            $reservation = Reservation::find($reservationId);
            if (!$reservation) {
                $this->error("❌ Reservation {$reservationId} not found");
                return null;
            }
        } else {
            // Find a suitable test reservation
            $reservation = Reservation::where('status', ReservationStatus::Confirmed)
                ->whereDoesntHave('bogTransactions', function($query) {
                    $query->where('status', 'completed');
                })
                ->first();

            if (!$reservation) {
                $this->warn('⚠️  No suitable reservation found. Creating test scenario...');
                $reservation = $this->createTestReservation();
            }
        }

        if ($reservation) {
            $this->info("✅ Using reservation: {$reservation->id}");
            $this->line("Guest: {$reservation->name}");
            $this->line("Email: {$reservation->email}");
            $status = $reservation->status;
            if ($status instanceof \App\Enums\ReservationStatus) {
                $this->line("Status: " . $status->value);
            } else {
                $this->line("Status: " . $status);
            }
        }

        return $reservation;
    }

    private function createTestReservation(): ?Reservation
    {
        try {
            $this->line('🏗️  Creating test reservation...');
            
            $reservation = Reservation::create([
                'name' => 'Test User',
                'email' => 'test@foodly.ge',
                'phone' => '+995555123456',
                'guests_count' => 2,
                'reservation_date' => now()->addDay()->toDateString(),
                'time_from' => '19:00',
                'time_to' => '21:00',
                'status' => ReservationStatus::Confirmed->value,
                'reservable_type' => 'App\\Models\\Restaurant',
                'reservable_id' => 1, // Assuming restaurant ID 1 exists
                'type' => 'table'
            ]);

            $this->info("✅ Test reservation created: {$reservation->id}");
            return $reservation;
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to create test reservation: {$e->getMessage()}");
            return null;
        }
    }

    private function testPaymentCreation(Reservation $reservation): ?BOGTransaction
    {
        $this->line('💳 Testing payment creation...');

        try {
            $amount = 50.00; // Test amount

            $transaction = $this->paymentService->createPayment($reservation, $amount);

            if ($transaction) {
                $this->info('✅ Payment created successfully');
                $this->line("Transaction ID: {$transaction->id}");
                $this->line("BOG Order ID: {$transaction->bog_order_id}");
                $this->line("Amount: {$transaction->amount} {$transaction->currency}");
                return $transaction;
            } else {
                $this->error('❌ Payment creation failed');
                return null;
            }

        } catch (\Exception $e) {
            $this->error("❌ Payment creation failed: {$e->getMessage()}");
            return null;
        }
    }

    private function testStatusChecking(BOGTransaction $transaction): void
    {
        $this->line('📊 Testing status checking...');

        try {
            $status = $this->paymentService->checkPaymentStatus($transaction);
            
            $this->info("✅ Status check successful");
            $this->line("Current status: {$status}");
            $this->line("BOG status: {$transaction->bog_status}");
            
        } catch (\Exception $e) {
            $this->error("❌ Status checking failed: {$e->getMessage()}");
        }
    }

    private function testWebhookSimulation(BOGTransaction $transaction): void
    {
        $this->line('🎣 Testing webhook simulation...');

        try {
            // Simulate successful payment webhook
            $webhookData = [
                'order_id' => $transaction->bog_order_id,
                'payment_id' => $transaction->bog_payment_id,
                'status' => 'success',
                'payment_status' => 'captured',
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
                'timestamp' => now()->toISOString(),
            ];

            $result = $this->paymentService->handleWebhook($webhookData);

            if ($result) {
                $this->info('✅ Webhook simulation successful');
                
                // Refresh transaction to see changes
                $transaction->refresh();
                $this->line("Updated status: {$transaction->status}");
            } else {
                $this->error('❌ Webhook simulation failed');
            }

        } catch (\Exception $e) {
            $this->error("❌ Webhook simulation failed: {$e->getMessage()}");
        }
    }

    private function testDatabaseVerification(BOGTransaction $transaction): void
    {
        $this->line('🗄️  Testing database verification...');

        try {
            // Refresh from database
            $transaction->refresh();
            $reservation = $transaction->reservation;
            $reservation->refresh();

            // Verify transaction data
            $this->info('✅ Database verification:');
            $this->line("Transaction Status: {$transaction->status}");
            $this->line("BOG Status: {$transaction->bog_status}");
            $status = $reservation->status;
            if ($status instanceof \App\Enums\ReservationStatus) {
                $this->line("Reservation Status: " . $status->value);
            } else {
                $this->line("Reservation Status: " . $status);
            }
            $this->line("Amount: {$transaction->amount} {$transaction->currency}");
            
            // Check if audit trail exists
            if ($transaction->bog_response_data) {
                $this->line("Response data: " . json_encode($transaction->bog_response_data, JSON_PRETTY_PRINT));
            }

            // Verify relationships
            if ($transaction->reservation_id === $reservation->id) {
                $this->info('✅ Relationships verified');
            } else {
                $this->error('❌ Relationship verification failed');
            }

        } catch (\Exception $e) {
            $this->error("❌ Database verification failed: {$e->getMessage()}");
        }
    }
}
