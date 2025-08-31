<?php

namespace App\Services\BOG;

use App\Models\Reservation;
use App\Models\BOGTransaction;
use App\Services\BOG\BOGAuthService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;

class BOGPaymentService
{
    private BOGAuthService $authService;
    private string $paymentUrl;
    private string $apiUrl;
    private string $currency;

    public function __construct(BOGAuthService $authService)
    {
        $this->authService = $authService;
        $this->paymentUrl = config('bog.urls.payment');
        $this->apiUrl = config('bog.urls.api');
        $this->currency = config('bog.currency');
    }

    /**
     * Create payment for reservation
     */
    public function createPayment(Reservation $reservation, float $amount = null): BOGTransaction
    {
        try {
            $amount = $amount ?? $this->calculateReservationAmount($reservation);
            $bogOrderId = $this->generateBOGOrderId($reservation);

            Log::info('BOG: Creating payment', [
                'reservation_id' => $reservation->id,
                'amount' => $amount,
                'bog_order_id' => $bogOrderId
            ]);

            // Create BOG transaction record
            $transaction = BOGTransaction::create([
                'reservation_id' => $reservation->id,
                'bog_order_id' => $bogOrderId,
                'amount' => $amount,
                'currency' => $this->currency,
                'status' => 'pending',
                'expires_at' => now()->addHours(config('bog.payment_expiry'))
            ]);

            // Prepare payment request
            $paymentData = [
                'order_id' => $bogOrderId,
                'amount' => $amount,
                'currency' => $this->currency,
                'description' => $this->getPaymentDescription($reservation),
                'success_url' => config('bog.callbacks.success') . '?order_id=' . $bogOrderId,
                'fail_url' => config('bog.callbacks.fail') . '?order_id=' . $bogOrderId,
                'webhook_url' => config('bog.callbacks.webhook'),
                'customer' => [
                    'email' => $reservation->guest_email,
                    'phone' => $reservation->guest_phone,
                ],
                'extra_info' => [
                    'reservation_id' => $reservation->id,
                    'restaurant_id' => $reservation->restaurant_id,
                ]
            ];

            // Send request to BOG
            $response = Http::timeout(config('bog.timeout'))
                ->withHeaders([
                    'Authorization' => $this->authService->getAuthorizationHeader(),
                    'Content-Type' => 'application/json',
                ])
                ->post($this->paymentUrl, $paymentData);

            if (!$response->successful()) {
                throw new Exception('BOG Payment API Error: ' . $response->body());
            }

            $responseData = $response->json();

            // Update transaction with BOG response
            $transaction->update([
                'bog_payment_id' => $responseData['payment_id'] ?? null,
                'payment_url' => $responseData['redirect_url'] ?? null,
                'bog_response_data' => $responseData,
                'bog_status' => $responseData['status'] ?? 'pending'
            ]);

            Log::info('BOG: Payment created successfully', [
                'reservation_id' => $reservation->id,
                'bog_order_id' => $bogOrderId,
                'bog_payment_id' => $responseData['payment_id'] ?? null,
                'payment_url' => $responseData['redirect_url'] ?? null
            ]);

            return $transaction;

        } catch (Exception $e) {
            Log::error('BOG Payment Creation Error', [
                'reservation_id' => $reservation->id,
                'amount' => $amount ?? 0,
                'error' => $e->getMessage()
            ]);

            throw new Exception('Failed to create BOG payment: ' . $e->getMessage());
        }
    }

    /**
     * Check payment status
     */
    public function checkPaymentStatus(BOGTransaction $transaction): array
    {
        try {
            $response = Http::timeout(config('bog.timeout'))
                ->withHeaders([
                    'Authorization' => $this->authService->getAuthorizationHeader(),
                ])
                ->get($this->apiUrl . '/payments/' . $transaction->bog_payment_id);

            if (!$response->successful()) {
                throw new Exception('BOG Status Check API Error: ' . $response->body());
            }

            $statusData = $response->json();
            
            // Update transaction with latest status
            $transaction->updateFromBOGResponse($statusData);

            return $statusData;

        } catch (Exception $e) {
            Log::error('BOG Status Check Error', [
                'transaction_id' => $transaction->id,
                'bog_payment_id' => $transaction->bog_payment_id,
                'error' => $e->getMessage()
            ]);

            throw new Exception('Failed to check BOG payment status: ' . $e->getMessage());
        }
    }

    /**
     * Process refund
     */
    public function processRefund(BOGTransaction $transaction, float $amount = null): array
    {
        try {
            if (!$transaction->canBeRefunded()) {
                throw new Exception('Transaction cannot be refunded');
            }

            $refundAmount = $amount ?? $transaction->amount;

            $refundData = [
                'payment_id' => $transaction->bog_payment_id,
                'amount' => $refundAmount,
                'reason' => 'Customer request'
            ];

            $response = Http::timeout(config('bog.timeout'))
                ->withHeaders([
                    'Authorization' => $this->authService->getAuthorizationHeader(),
                    'Content-Type' => 'application/json',
                ])
                ->post($this->apiUrl . '/payments/refund', $refundData);

            if (!$response->successful()) {
                throw new Exception('BOG Refund API Error: ' . $response->body());
            }

            $refundResponse = $response->json();

            // Update transaction
            $transaction->update([
                'status' => 'refunded',
                'bog_response_data' => array_merge($transaction->bog_response_data ?? [], [
                    'refund' => $refundResponse
                ]),
                'refunded_at' => now()
            ]);

            Log::info('BOG: Refund processed successfully', [
                'transaction_id' => $transaction->id,
                'refund_amount' => $refundAmount,
                'refund_id' => $refundResponse['refund_id'] ?? null
            ]);

            return $refundResponse;

        } catch (Exception $e) {
            Log::error('BOG Refund Error', [
                'transaction_id' => $transaction->id,
                'amount' => $amount ?? $transaction->amount,
                'error' => $e->getMessage()
            ]);

            throw new Exception('Failed to process BOG refund: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique BOG order ID
     */
    private function generateBOGOrderId(Reservation $reservation): string
    {
        return 'RES-' . $reservation->id . '-' . time() . '-' . Str::random(8);
    }

    /**
     * Calculate reservation amount (implement your business logic)
     */
    private function calculateReservationAmount(Reservation $reservation): float
    {
        // TODO: Implement your pricing logic
        // This could be based on:
        // - Restaurant pricing
        // - Number of guests
        // - Time slot
        // - Special offers
        
        // For now, return a default amount
        return 50.00; // 50 GEL default
    }

    /**
     * Get payment description
     */
    private function getPaymentDescription(Reservation $reservation): string
    {
        return sprintf(
            'Reservation payment for %s on %s',
            $reservation->restaurant->name ?? 'Restaurant',
            $reservation->reservation_datetime->format('Y-m-d H:i')
        );
    }

    /**
     * Handle webhook notification
     */
    public function handleWebhook(array $webhookData): void
    {
        try {
            $bogOrderId = $webhookData['order_id'] ?? null;
            
            if (!$bogOrderId) {
                throw new Exception('Missing order_id in webhook data');
            }

            $transaction = BOGTransaction::where('bog_order_id', $bogOrderId)->first();
            
            if (!$transaction) {
                throw new Exception('Transaction not found for order_id: ' . $bogOrderId);
            }

            // Update transaction with webhook data
            $transaction->update([
                'bog_webhook_data' => $webhookData,
                'bog_status' => $webhookData['status'] ?? $transaction->bog_status
            ]);

            $transaction->updateFromBOGResponse($webhookData);

            Log::info('BOG: Webhook processed successfully', [
                'bog_order_id' => $bogOrderId,
                'status' => $webhookData['status'] ?? 'unknown',
                'transaction_id' => $transaction->id
            ]);

        } catch (Exception $e) {
            Log::error('BOG Webhook Processing Error', [
                'webhook_data' => $webhookData,
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}
