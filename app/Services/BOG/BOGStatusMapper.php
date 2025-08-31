<?php

namespace App\Services\BOG;

use App\Enums\ReservationStatus;

class BOGStatusMapper
{
    /**
     * Map BOG API status to our transaction status
     */
    public static function mapBOGStatusToTransactionStatus(string $bogStatus): string
    {
        $mapping = config('bog.status_mappings.bog_to_transaction');
        return $mapping[$bogStatus] ?? 'pending';
    }

    /**
     * Map BOG API status to reservation status
     */
    public static function mapBOGStatusToReservationStatus(
        string $bogStatus, 
        ReservationStatus $currentStatus
    ): ?ReservationStatus {
        $mappings = config('bog.status_mappings.bog_to_reservation');

        // Payment Success
        if (in_array($bogStatus, $mappings['success_statuses'])) {
            return match($currentStatus) {
                ReservationStatus::Confirmed => ReservationStatus::Paid,
                default => $currentStatus // Already paid or other status
            };
        }

        // Payment Failed
        if (in_array($bogStatus, $mappings['failure_statuses'])) {
            return match($currentStatus) {
                ReservationStatus::Confirmed => ReservationStatus::Confirmed, // Retry possible
                default => $currentStatus
            };
        }

        // Payment Cancelled
        if (in_array($bogStatus, $mappings['cancelled_statuses'])) {
            return ReservationStatus::Cancelled;
        }

        // Payment Refunded
        if (in_array($bogStatus, $mappings['refunded_statuses'])) {
            return ReservationStatus::Cancelled;
        }

        // Processing states - no status change
        return null;
    }

    /**
     * Check if BOG status indicates successful payment
     */
    public static function isSuccessStatus(string $bogStatus): bool
    {
        $mappings = config('bog.status_mappings.bog_to_reservation');
        return in_array($bogStatus, $mappings['success_statuses']);
    }

    /**
     * Check if BOG status indicates failed payment
     */
    public static function isFailureStatus(string $bogStatus): bool
    {
        $mappings = config('bog.status_mappings.bog_to_reservation');
        return in_array($bogStatus, $mappings['failure_statuses']);
    }

    /**
     * Check if BOG status indicates cancelled payment
     */
    public static function isCancelledStatus(string $bogStatus): bool
    {
        $mappings = config('bog.status_mappings.bog_to_reservation');
        return in_array($bogStatus, $mappings['cancelled_statuses']);
    }

    /**
     * Check if BOG status indicates refunded payment
     */
    public static function isRefundedStatus(string $bogStatus): bool
    {
        $mappings = config('bog.status_mappings.bog_to_reservation');
        return in_array($bogStatus, $mappings['refunded_statuses']);
    }

    /**
     * Get user-friendly status message
     */
    public static function getBOGStatusMessage(string $bogStatus): string
    {
        return match($bogStatus) {
            'success', 'captured', 'completed' => 'გადახდა წარმატებით დასრულდა',
            'failed' => 'გადახდა ვერ მოხერხდა',
            'declined' => 'გადახდა უარყოფილია',
            'insufficient_funds' => 'ანგარიშზე არასაკმარისი თანხა',
            'invalid_card' => 'არასწორი ბარათის მონაცემები',
            'cancelled' => 'გადახდა გაუქმდა',
            'user_cancelled' => 'მომხმარებელმა გააუქმა გადახდა',
            'voided' => 'გადახდა ბათილია',
            'refunded' => 'თანხა დაბრუნდა',
            'partially_refunded' => 'თანხა ნაწილობრივ დაბრუნდა',
            'pending' => 'გადახდა მოლოდინშია',
            'created' => 'გადახდა შეიქმნა',
            'in_progress' => 'გადახდა მუშავდება',
            'processing' => 'გადახდა მუშავდება',
            default => 'უცნობი სტატუსი: ' . $bogStatus
        };
    }

    /**
     * Get status color class for UI
     */
    public static function getBOGStatusColorClass(string $bogStatus): string
    {
        if (self::isSuccessStatus($bogStatus)) {
            return 'text-green-600 bg-green-100';
        }

        if (self::isFailureStatus($bogStatus)) {
            return 'text-red-600 bg-red-100';
        }

        if (self::isCancelledStatus($bogStatus)) {
            return 'text-gray-600 bg-gray-100';
        }

        if (self::isRefundedStatus($bogStatus)) {
            return 'text-yellow-600 bg-yellow-100';
        }

        // Processing states
        return 'text-blue-600 bg-blue-100';
    }

    /**
     * Get all possible BOG statuses with descriptions
     */
    public static function getAllBOGStatuses(): array
    {
        return [
            'success' => ['label' => 'წარმატებული', 'type' => 'success'],
            'captured' => ['label' => 'დაჭერილი', 'type' => 'success'],
            'completed' => ['label' => 'დასრულებული', 'type' => 'success'],
            'failed' => ['label' => 'ვერ მოხერხდა', 'type' => 'failure'],
            'declined' => ['label' => 'უარყოფილი', 'type' => 'failure'],
            'insufficient_funds' => ['label' => 'არასაკმარისი თანხა', 'type' => 'failure'],
            'invalid_card' => ['label' => 'არასწორი ბარათი', 'type' => 'failure'],
            'cancelled' => ['label' => 'გაუქმებული', 'type' => 'cancelled'],
            'user_cancelled' => ['label' => 'მომხმარებლის გაუქმება', 'type' => 'cancelled'],
            'voided' => ['label' => 'ბათილი', 'type' => 'cancelled'],
            'refunded' => ['label' => 'დაბრუნებული', 'type' => 'refunded'],
            'partially_refunded' => ['label' => 'ნაწილობრივ დაბრუნებული', 'type' => 'refunded'],
            'pending' => ['label' => 'მოლოდინში', 'type' => 'processing'],
            'created' => ['label' => 'შექმნილი', 'type' => 'processing'],
            'in_progress' => ['label' => 'მუშავდება', 'type' => 'processing'],
            'processing' => ['label' => 'დამუშავება', 'type' => 'processing'],
        ];
    }
}
