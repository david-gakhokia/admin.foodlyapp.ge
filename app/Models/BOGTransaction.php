<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\ReservationStatus;

class BOGTransaction extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     */
    protected $table = 'bog_transactions';
    
    protected $fillable = [
        'reservation_id',
        'bog_order_id',
        'bog_payment_id',
        'amount',
        'currency',
        'status',
        'bog_status',
        'bog_response_data',
        'payment_url',
        'callback_url',
        'error_message',
        'expires_at',
        'paid_at'
    ];

    protected $casts = [
        'bog_response_data' => 'array',
        'amount' => 'decimal:2',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime'
    ];

    /**
     * Reservation relation
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Update from BOG API response and sync reservation status
     */
    public function updateFromBOGResponse(array $bogData): void
    {
        // Update BOG transaction
        $this->update([
            'bog_status' => $bogData['status'] ?? null,
            'bog_response_data' => $bogData,
            'status' => $this->mapBOGStatusToTransactionStatus($bogData['status'] ?? 'pending'),
            'paid_at' => in_array($bogData['status'] ?? '', ['success', 'captured', 'completed']) ? now() : null,
            'error_message' => $bogData['error_message'] ?? null
        ]);

        // Sync reservation status
        $currentReservationStatus = $this->reservation->status instanceof ReservationStatus 
            ? $this->reservation->status 
            : ReservationStatus::from($this->reservation->status);
            
        $newReservationStatus = $this->mapBOGStatusToReservationStatus(
            $bogData['status'] ?? 'pending',
            $currentReservationStatus
        );

        if ($newReservationStatus && $currentReservationStatus !== $newReservationStatus) {
            $this->reservation->update(['status' => $newReservationStatus->value]);
        }
    }

    /**
     * Map BOG status to transaction status
     */
    private function mapBOGStatusToTransactionStatus(string $bogStatus): string
    {
        $mapping = config('bog.status_mappings.bog_to_transaction', [
            'success' => 'completed',
            'captured' => 'completed',
            'completed' => 'completed',
            'failed' => 'failed',
            'error' => 'failed',
            'declined' => 'failed',
            'cancelled' => 'cancelled',
            'voided' => 'cancelled',
            'refunded' => 'refunded',
            'partial_refund' => 'refunded',
            'processing' => 'processing',
            'pending' => 'pending',
        ]);
        
        return $mapping[$bogStatus] ?? 'pending';
    }

    /**
     * Map BOG status to reservation status
     */
    private function mapBOGStatusToReservationStatus(string $bogStatus, ReservationStatus $currentStatus): ?ReservationStatus
    {
        $mappings = config('bog.status_mappings.bog_to_reservation', [
            'success_statuses' => ['success', 'captured', 'completed'],
            'failure_statuses' => ['failed', 'error', 'declined'],
            'cancelled_statuses' => ['cancelled', 'voided'],
            'refunded_statuses' => ['refunded', 'partial_refund']
        ]);

        if (in_array($bogStatus, $mappings['success_statuses'] ?? [])) {
            return match($currentStatus) {
                ReservationStatus::Confirmed => ReservationStatus::Paid,
                default => $currentStatus
            };
        }

        if (in_array($bogStatus, $mappings['failure_statuses'] ?? [])) {
            return match($currentStatus) {
                ReservationStatus::Confirmed => ReservationStatus::Confirmed, // retry possible
                default => $currentStatus
            };
        }

        if (in_array($bogStatus, $mappings['cancelled_statuses'] ?? []) || 
            in_array($bogStatus, $mappings['refunded_statuses'] ?? [])) {
            return ReservationStatus::Cancelled;
        }

        return null; // No status change for processing states
    }

    /**
     * Scopes
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['pending', 'processing']);
    }

    public function scopeRefundable($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Helper methods
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function isPending(): bool
    {
        return in_array($this->status, ['pending', 'processing']);
    }

    public function canBeRefunded(): bool
    {
        return $this->status === 'completed';
    }
}
