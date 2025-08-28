<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Livewire\Attributes\On;
use App\Events\ReservationStatusChanged;

class ReservationStatusUpdater extends Component
{
    public $reservation;
    public $restaurantId;
    public $currentStatus;
    public $isUpdating = false;
    
    // Available status options with enhanced styling
    public $statusOptions = [
        'Pending' => [
            'label' => 'მოლოდინში',
            'icon' => '🟡',
            'class' => 'bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-800 border border-amber-200'
        ],
        'Confirmed' => [
            'label' => 'დადასტურებული',
            'icon' => '🟢',
            'class' => 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200'
        ],
        'Completed' => [
            'label' => 'დასრულებული',
            'icon' => '🔵',
            'class' => 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200'
        ],
        'Cancelled' => [
            'label' => 'გაუქმებული',
            'icon' => '🔴',
            'class' => 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200'
        ]
    ];

    public function mount($reservation, $restaurantId)
    {
        $this->reservation = $reservation;
        $this->restaurantId = $restaurantId;
        $this->currentStatus = $reservation->status;
    }

    public function updateStatus($newStatus)
    {
        try {
            $this->isUpdating = true;
            
            // Validate the new status
            if (!array_key_exists($newStatus, $this->statusOptions)) {
                $this->dispatch('status-error', message: '❌ არასწორი სტატუსი');
                return;
            }

            // Confirm if status is different
            if ($this->currentStatus === $newStatus) {
                $this->dispatch('status-info', message: 'ℹ️ სტატუსი უკვე განახლებულია');
                return;
            }

            // Update reservation status
            $oldStatus = $this->reservation->status;
            
            $this->reservation->update([
                'status' => $newStatus,
                'updated_at' => now()
            ]);

            $this->currentStatus = $newStatus;
            $this->reservation->refresh();

            // Fire the ReservationStatusChanged event to trigger email notifications
            ReservationStatusChanged::dispatch($this->reservation, $oldStatus, $newStatus);

            // Enhanced success message with status info
            $statusEmoji = $this->statusOptions[$newStatus]['icon'];
            $statusLabel = $this->statusOptions[$newStatus]['label'];
            
            $this->dispatch('status-updated', message: "✅ სტატუსი წარმატებით შეიცვალა: {$statusEmoji} {$statusLabel}");

            // Emit to parent component to refresh list if needed
            $this->dispatch('reservation-status-changed', $this->reservation->id, $newStatus);

        } catch (\Exception $e) {
            \Log::error('Status update error', [
                'reservation_id' => $this->reservation->id,
                'new_status' => $newStatus,
                'error' => $e->getMessage()
            ]);
            
            $this->dispatch('status-error', message: '❌ შეცდომა სტატუსის განახლებისას: ' . $e->getMessage());
        } finally {
            $this->isUpdating = false;
        }
    }

    public function getAvailableStatusesProperty()
    {
        // Return all statuses except current one
        return collect($this->statusOptions)->filter(function ($status, $key) {
            return $key !== $this->currentStatus;
        })->toArray();
    }

    public function getCurrentStatusInfoProperty()
    {
        return $this->statusOptions[$this->currentStatus] ?? [
            'label' => $this->currentStatus,
            'icon' => '⚪',
            'class' => 'bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200'
        ];
    }

    public function render()
    {
        return view('livewire.reservation-status-updater');
    }
}
