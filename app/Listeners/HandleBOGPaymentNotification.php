<?php

namespace App\Listeners;

use App\Events\BOGPaymentStatusChanged;
use App\Services\BOG\BOGStatusMapper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;
use App\Mail\PaymentFailed;
use App\Mail\PaymentRefunded;

class HandleBOGPaymentNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(BOGPaymentStatusChanged $event): void
    {
        $transaction = $event->transaction;
        $reservation = $transaction->reservation;
        
        Log::info('Handling BOG payment status change', [
            'transaction_id' => $transaction->id,
            'reservation_id' => $reservation->id,
            'old_status' => $event->previousTransactionStatus,
            'new_status' => $transaction->status,
            'bog_status' => $transaction->bog_status
        ]);

        // Send email notifications based on status
        $this->sendEmailNotification($transaction, $event);
        
        // Send SMS notifications if needed
        $this->sendSMSNotification($transaction, $event);
        
        // Update restaurant notification
        $this->notifyRestaurant($transaction, $event);
        
        // Log activity for admin dashboard
        $this->logActivity($transaction, $event);
    }

    /**
     * Send email notification to customer
     */
    private function sendEmailNotification($transaction, $event): void
    {
        try {
            $customerEmail = $transaction->reservation->guest_email;
            
            if (!$customerEmail) {
                Log::warning('No customer email for payment notification', [
                    'transaction_id' => $transaction->id,
                    'reservation_id' => $transaction->reservation->id
                ]);
                return;
            }

            $emailClass = match($transaction->status) {
                'completed' => PaymentConfirmation::class,
                'failed' => PaymentFailed::class,
                'refunded' => PaymentRefunded::class,
                default => null
            };

            if ($emailClass) {
                Mail::to($customerEmail)->queue(new $emailClass($transaction));
                
                Log::info('Payment email queued', [
                    'email' => $customerEmail,
                    'type' => class_basename($emailClass),
                    'transaction_id' => $transaction->id
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Failed to send payment email', [
                'error' => $e->getMessage(),
                'transaction_id' => $transaction->id
            ]);
        }
    }

    /**
     * Send SMS notification to customer
     */
    private function sendSMSNotification($transaction, $event): void
    {
        try {
            $customerPhone = $transaction->reservation->guest_phone;
            
            if (!$customerPhone) {
                return;
            }

            $message = match($transaction->status) {
                'completed' => sprintf(
                    'FOODLY: თქვენი გადახდა %s %s წარმატებით დასრულდა. რეზერვაცია #%s დადასტურებულია.',
                    $transaction->amount,
                    $transaction->currency,
                    $transaction->reservation->id
                ),
                'failed' => sprintf(
                    'FOODLY: გადახდა %s %s ვერ მოხერხდა. რეზერვაცია #%s მოლოდინშია.',
                    $transaction->amount,
                    $transaction->currency,
                    $transaction->reservation->id
                ),
                'refunded' => sprintf(
                    'FOODLY: თქვენი გადახდა %s %s დაბრუნდა. რეზერვაცია #%s გაუქმდა.',
                    $transaction->amount,
                    $transaction->currency,
                    $transaction->reservation->id
                ),
                default => null
            };

            if ($message) {
                // TODO: Integrate with your SMS service
                // Example: app(SMSService::class)->send($customerPhone, $message);
                
                Log::info('SMS notification would be sent', [
                    'phone' => $customerPhone,
                    'message' => $message,
                    'transaction_id' => $transaction->id
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Failed to send payment SMS', [
                'error' => $e->getMessage(),
                'transaction_id' => $transaction->id
            ]);
        }
    }

    /**
     * Notify restaurant about payment status change
     */
    private function notifyRestaurant($transaction, $event): void
    {
        try {
            $restaurant = $transaction->reservation->getRestaurant();
            
            if (!$restaurant || !$restaurant->email) {
                return;
            }

            // Only notify restaurant for successful payments and refunds
            if (!in_array($transaction->status, ['completed', 'refunded'])) {
                return;
            }

            $subject = match($transaction->status) {
                'completed' => 'ახალი გადახდილი რეზერვაცია',
                'refunded' => 'რეზერვაციის გაუქმება - თანხა დაბრუნდა',
                default => 'რეზერვაციის განახლება'
            };

            $message = sprintf(
                'რეზერვაცია #%s - %s\nმომხმარებელი: %s\nთანხა: %s %s\nსტატუსი: %s',
                $transaction->reservation->id,
                $transaction->reservation->reservation_datetime?->format('Y-m-d H:i'),
                $transaction->reservation->guest_name,
                $transaction->amount,
                $transaction->currency,
                BOGStatusMapper::getBOGStatusMessage($transaction->bog_status ?? $transaction->status)
            );

            // TODO: Send restaurant notification email
            // Mail::to($restaurant->email)->queue(new RestaurantPaymentNotification($transaction, $subject, $message));

            Log::info('Restaurant notification would be sent', [
                'restaurant_email' => $restaurant->email,
                'subject' => $subject,
                'transaction_id' => $transaction->id
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to notify restaurant', [
                'error' => $e->getMessage(),
                'transaction_id' => $transaction->id
            ]);
        }
    }

    /**
     * Log activity for admin dashboard
     */
    private function logActivity($transaction, $event): void
    {
        try {
            // TODO: Integrate with your activity log system
            // This could be stored in a dedicated activity_logs table
            
            $activity = [
                'type' => 'payment_status_changed',
                'transaction_id' => $transaction->id,
                'reservation_id' => $transaction->reservation->id,
                'old_status' => $event->previousTransactionStatus,
                'new_status' => $transaction->status,
                'bog_status' => $transaction->bog_status,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
                'timestamp' => now(),
                'metadata' => [
                    'bog_order_id' => $transaction->bog_order_id,
                    'customer_email' => $transaction->reservation->guest_email,
                    'customer_phone' => $transaction->reservation->guest_phone,
                    'restaurant_id' => $transaction->reservation->getRestaurant()?->id
                ]
            ];

            Log::info('Payment activity logged', $activity);

        } catch (\Exception $e) {
            Log::error('Failed to log payment activity', [
                'error' => $e->getMessage(),
                'transaction_id' => $transaction->id
            ]);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(BOGPaymentStatusChanged $event, \Throwable $exception): void
    {
        Log::error('BOG payment notification handler failed', [
            'transaction_id' => $event->transaction->id,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
