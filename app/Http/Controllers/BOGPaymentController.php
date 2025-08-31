<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\BOGTransaction;
use App\Services\BOG\BOGPaymentService;
use App\Enums\ReservationStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Support\Facades\Log;

class BOGPaymentController extends Controller
{
    private BOGPaymentService $paymentService;

    public function __construct(BOGPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Initiate payment for reservation
     */
    public function initiatePayment(Request $request, Reservation $reservation): JsonResponse
    {
        try {
            // Validation
            if (!$reservation->canInitiatePayment()) {
                return response()->json([
                    'success' => false,
                    'message' => 'ამ რეზერვაციისთვის გადახდა ვერ ინიცირდება',
                    'current_status' => is_object($reservation->status) ? $reservation->status->getLabel() : (string)$reservation->status
                ], 400);
            }

            // Check for existing pending payment
            if ($reservation->hasPendingPayment()) {
                $pendingTransaction = $reservation->bogTransactions()
                    ->whereIn('status', ['pending', 'processing'])
                    ->where('expires_at', '>', now())
                    ->latest()
                    ->first();

                return response()->json([
                    'success' => true,
                    'message' => 'გადახდა უკვე ინიცირებულია',
                    'payment_url' => $pendingTransaction->payment_url,
                    'bog_order_id' => $pendingTransaction->bog_order_id,
                    'expires_at' => $pendingTransaction->expires_at
                ]);
            }

            // Create new payment
            $transaction = $this->paymentService->createPayment($reservation);

            Log::info('Payment initiated', [
                'reservation_id' => $reservation->id,
                'bog_order_id' => $transaction->bog_order_id,
                'amount' => $transaction->amount
            ]);

            return response()->json([
                'success' => true,
                'message' => 'გადახდა წარმატებით ინიცირდა',
                'payment_url' => $transaction->payment_url,
                'bog_order_id' => $transaction->bog_order_id,
                'amount' => $transaction->amount,
                'expires_at' => $transaction->expires_at
            ]);

        } catch (Exception $e) {
            Log::error('Payment initiation failed', [
                'reservation_id' => $reservation->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'გადახდის ინიცირებისას მოხდა შეცდომა: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle successful payment callback
     */
    public function handleSuccess(Request $request): View
    {
        $bogOrderId = $request->query('order_id');
        
        if (!$bogOrderId) {
            return view('bog.payment-result', [
                'success' => false,
                'message' => 'გადახდის ინფორმაცია ვერ მოიძებნა'
            ]);
        }

        try {
            $transaction = BOGTransaction::where('bog_order_id', $bogOrderId)->first();
            
            if (!$transaction) {
                return view('bog.payment-result', [
                    'success' => false,
                    'message' => 'ტრანსაქცია ვერ მოიძებნა'
                ]);
            }

            // Check latest status
            $this->paymentService->checkPaymentStatus($transaction);

            return view('bog.payment-result', [
                'success' => $transaction->isCompleted(),
                'message' => $transaction->isCompleted() 
                    ? 'გადახდა წარმატებით დასრულდა!' 
                    : 'გადახდის მუშავება მიმდინარეობს',
                'transaction' => $transaction,
                'reservation' => $transaction->reservation
            ]);

        } catch (Exception $e) {
            Log::error('Payment success callback error', [
                'bog_order_id' => $bogOrderId,
                'error' => $e->getMessage()
            ]);

            return view('bog.payment-result', [
                'success' => false,
                'message' => 'გადახდის მუშავებისას მოხდა შეცდომა'
            ]);
        }
    }

    /**
     * Handle failed payment callback
     */
    public function handleFailure(Request $request): View
    {
        $bogOrderId = $request->query('order_id');
        
        if (!$bogOrderId) {
            return view('bog.payment-result', [
                'success' => false,
                'message' => 'გადახდის ინფორმაცია ვერ მოიძებნა'
            ]);
        }

        try {
            $transaction = BOGTransaction::where('bog_order_id', $bogOrderId)->first();
            
            if ($transaction) {
                // Update status
                $this->paymentService->checkPaymentStatus($transaction);
                
                return view('bog.payment-result', [
                    'success' => false,
                    'message' => 'გადახდა ვერ მოხერხდა. გთხოვთ სცადოთ თავიდან.',
                    'transaction' => $transaction,
                    'reservation' => $transaction->reservation,
                    'can_retry' => true
                ]);
            }

            return view('bog.payment-result', [
                'success' => false,
                'message' => 'გადახდა ვერ მოხერხდა'
            ]);

        } catch (Exception $e) {
            Log::error('Payment failure callback error', [
                'bog_order_id' => $bogOrderId,
                'error' => $e->getMessage()
            ]);

            return view('bog.payment-result', [
                'success' => false,
                'message' => 'გადახდის მუშავებისას მოხდა შეცდომა'
            ]);
        }
    }

    /**
     * Check payment status via AJAX
     */
    public function checkStatus(Request $request, BOGTransaction $transaction): JsonResponse
    {
        try {
            $statusData = $this->paymentService->checkPaymentStatus($transaction);
            
            return response()->json([
                'success' => true,
                'status' => $transaction->status,
                'bog_status' => $transaction->bog_status,
                'reservation_status' => is_object($transaction->reservation->status) ? $transaction->reservation->status->value : (string)$transaction->reservation->status,
                'is_completed' => $transaction->isCompleted(),
                'is_failed' => $transaction->isFailed(),
                'updated_at' => $transaction->updated_at
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'სტატუსის შემოწმება ვერ მოხერხდა: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process refund
     */
    public function processRefund(Request $request, BOGTransaction $transaction): JsonResponse
    {
        try {
            if (!$transaction->canBeRefunded()) {
                return response()->json([
                    'success' => false,
                    'message' => 'ამ ტრანსაქციისთვის თანხის დაბრუნება შეუძლებელია'
                ], 400);
            }

            $refundAmount = $request->input('amount', $transaction->amount);
            $refundData = $this->paymentService->processRefund($transaction, $refundAmount);

            return response()->json([
                'success' => true,
                'message' => 'თანხის დაბრუნება წარმატებით გაიგზავნა',
                'refund_data' => $refundData
            ]);

        } catch (Exception $e) {
            Log::error('Refund processing error', [
                'transaction_id' => $transaction->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'თანხის დაბრუნებისას მოხდა შეცდომა: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payment history for reservation
     */
    public function getPaymentHistory(Reservation $reservation): JsonResponse
    {
        $transactions = $reservation->bogTransactions()
            ->with('reservation')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'transactions' => $transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'bog_order_id' => $transaction->bog_order_id,
                    'amount' => $transaction->amount,
                    'currency' => $transaction->currency,
                    'status' => $transaction->status,
                    'bog_status' => $transaction->bog_status,
                    'created_at' => $transaction->created_at,
                    'paid_at' => $transaction->paid_at,
                    'is_completed' => $transaction->isCompleted(),
                    'can_be_refunded' => $transaction->canBeRefunded()
                ];
            })
        ]);
    }
}
