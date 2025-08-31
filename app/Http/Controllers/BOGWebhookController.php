<?php

namespace App\Http\Controllers;

use App\Models\BOGTransaction;
use App\Services\BOG\BOGPaymentService;
use App\Events\BOGPaymentStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class BOGWebhookController extends Controller
{
    private BOGPaymentService $paymentService;

    public function __construct(BOGPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Handle BOG webhook notifications
     */
    public function handle(Request $request): JsonResponse
    {
        try {
            // Log incoming webhook
            Log::info('BOG Webhook received', [
                'payload' => $request->all(),
                'headers' => $request->headers->all(),
                'ip' => $request->ip()
            ]);

            // Validate webhook signature
            if (!$this->validateWebhookSignature($request)) {
                Log::warning('BOG Webhook signature validation failed', [
                    'payload' => $request->all(),
                    'ip' => $request->ip()
                ]);
                
                return response()->json([
                    'error' => 'Invalid signature'
                ], 403);
            }

            // Get webhook data
            $webhookData = $request->all();
            
            // Validate required fields
            if (!isset($webhookData['order_id'])) {
                Log::error('BOG Webhook missing order_id', [
                    'payload' => $webhookData
                ]);
                
                return response()->json([
                    'error' => 'Missing order_id'
                ], 400);
            }

            // Find transaction
            $transaction = BOGTransaction::where('bog_order_id', $webhookData['order_id'])->first();
            
            if (!$transaction) {
                Log::error('BOG Webhook - transaction not found', [
                    'order_id' => $webhookData['order_id'],
                    'payload' => $webhookData
                ]);
                
                return response()->json([
                    'error' => 'Transaction not found'
                ], 404);
            }

            // Store previous status for comparison
            $previousStatus = $transaction->status;
            $previousReservationStatus = $transaction->reservation->status;

            // Process webhook
            $this->paymentService->handleWebhook($webhookData);

            // Reload transaction to get updated data
            $transaction->refresh();

            // Fire event if status changed
            if ($previousStatus !== $transaction->status || 
                $previousReservationStatus !== $transaction->reservation->status) {
                
                event(new BOGPaymentStatusChanged($transaction, $previousStatus, $previousReservationStatus));
            }

            Log::info('BOG Webhook processed successfully', [
                'order_id' => $webhookData['order_id'],
                'transaction_id' => $transaction->id,
                'old_status' => $previousStatus,
                'new_status' => $transaction->status,
                'reservation_status' => $transaction->reservation->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Webhook processed successfully'
            ]);

        } catch (Exception $e) {
            Log::error('BOG Webhook processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);

            return response()->json([
                'error' => 'Webhook processing failed'
            ], 500);
        }
    }

    /**
     * Validate webhook signature
     */
    private function validateWebhookSignature(Request $request): bool
    {
        $webhookSecret = config('bog.webhook_secret');
        
        if (!$webhookSecret) {
            Log::warning('BOG webhook secret not configured');
            return true; // Allow if not configured (for development)
        }

        $receivedSignature = $request->header('X-BOG-Signature') ?? 
                           $request->header('X-Signature') ?? 
                           $request->header('Signature');

        if (!$receivedSignature) {
            Log::warning('BOG webhook signature header missing');
            return false;
        }

        $payload = $request->getContent();
        $calculatedSignature = hash_hmac('sha256', $payload, $webhookSecret);

        // Support different signature formats
        $expectedSignatures = [
            $calculatedSignature,
            'sha256=' . $calculatedSignature,
            base64_encode(hash_hmac('sha256', $payload, $webhookSecret, true))
        ];

        foreach ($expectedSignatures as $expectedSignature) {
            if (hash_equals($expectedSignature, $receivedSignature)) {
                return true;
            }
        }

        Log::warning('BOG webhook signature mismatch', [
            'received' => $receivedSignature,
            'calculated' => $calculatedSignature,
            'payload_length' => strlen($payload)
        ]);

        return false;
    }

    /**
     * Test webhook endpoint
     */
    public function test(Request $request): JsonResponse
    {
        if (!app()->environment(['local', 'staging'])) {
            return response()->json([
                'error' => 'Test endpoint only available in development'
            ], 403);
        }

        $testData = [
            'order_id' => $request->input('order_id', 'TEST-' . time()),
            'payment_id' => $request->input('payment_id', 'PAY-' . time()),
            'status' => $request->input('status', 'success'),
            'amount' => $request->input('amount', 50.00),
            'currency' => $request->input('currency', 'GEL'),
            'timestamp' => now()->toISOString(),
            'test' => true
        ];

        Log::info('BOG Webhook test', ['test_data' => $testData]);

        try {
            return $this->handle(Request::create('/bog/webhook', 'POST', $testData));
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Test failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Webhook health check
     */
    public function health(): JsonResponse
    {
        return response()->json([
            'status' => 'healthy',
            'timestamp' => now()->toISOString(),
            'service' => 'BOG Webhook Handler'
        ]);
    }
}
