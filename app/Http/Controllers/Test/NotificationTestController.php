<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Events\ReservationStatusChanged;
use Illuminate\Http\Request;

class NotificationTestController extends Controller
{
    public function testNotification(Request $request)
    {
        try {
            // Find a reservation to test with
            $reservation = Reservation::first();
            
            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'No reservations found for testing'
                ]);
            }

            $oldStatus = $reservation->status;
            $newStatus = $oldStatus === 'Pending' ? 'Confirmed' : 'Pending';

            // Fire the event
            ReservationStatusChanged::dispatch($reservation, $oldStatus, $newStatus);

            return response()->json([
                'success' => true,
                'message' => 'Test notification event dispatched successfully',
                'data' => [
                    'reservation_id' => $reservation->id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error dispatching test notification: ' . $e->getMessage()
            ]);
        }
    }
}
