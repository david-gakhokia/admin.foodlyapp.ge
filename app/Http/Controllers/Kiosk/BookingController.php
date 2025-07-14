<?php

namespace App\Http\Controllers\Kiosk;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Place;
use App\Models\Table;
use App\Services\Reservation\ReservationSlotService;
use App\Services\Reservation\AvailabilityService;
use App\Services\Reservation\ReservationService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    protected $slotService;
    protected $availabilityService;
    protected $reservationService;

    public function __construct(
        ReservationSlotService $slotService,
        AvailabilityService $availabilityService,
        ReservationService $reservationService
    ) {
        $this->slotService = $slotService;
        $this->availabilityService = $availabilityService;
        $this->reservationService = $reservationService;
    }

    /** --------- GET AVAILABLE SLOTS --------- */
    public function availableSlots(Request $request, $type, $id)
    {
        $reservationDate = $request->input('date', now()->toDateString());

        $model = $this->resolveModel($type, $id);
        if (!$model) return response()->json(['error' => 'Invalid type'], 400);

        $slotConfig = $model->reservationSlots()->where('day_of_week', now()->parse($reservationDate)->format('l'))->first();

        if (!$slotConfig) {
            return response()->json([]);
        }

        // Get the restaurant's timezone
        $timezone = $this->getModelTimezone($model);

        $slots = $this->slotService->generateTimeSlots(
            $slotConfig->time_from,
            $slotConfig->time_to,
            $slotConfig->slot_interval_minutes,
            $timezone
        );

        $existingReservations = $model->reservations()->where('reservation_date', $reservationDate)->get(['time_from']);

        $availableSlots = $this->availabilityService->filterAvailableSlots($slots, $existingReservations);

        return response()->json(array_values($availableSlots));
    }

    /** --------- CREATE RESERVATION (optional, test phase) --------- */
    public function createReservation(Request $request, $type, $id)
    {
        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'guests_count' => 'required|integer|min:1',
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $model = $this->resolveModel($type, $id);
        if (!$model) return response()->json(['error' => 'Invalid type'], 400);

        $this->reservationService->createReservation(
            $model,
            $request->reservation_date,
            $request->reservation_time,
            $request->guests_count,
            $request->only(['name', 'phone', 'email', 'promo_code', 'notes'])
        );

        return response()->json(['success' => true]);
    }

    /** --------- COMMON RESOLVER --------- */
    private function resolveModel($type, $id): ?Model
    {
        return match ($type) {
            'restaurant' => Restaurant::find($id),
            'place'      => Place::find($id),
            'table'      => Table::find($id),
            default      => null,
        };
    }

    /**
     * Get timezone from model (Restaurant, Place, or Table)
     */
    private function getModelTimezone($model): string
    {
        // If the model is a Restaurant, get its timezone directly
        if ($model instanceof Restaurant) {
            return $model->time_zone ?? 'Asia/Tbilisi';
        }
        
        // If the model is a Place, get its restaurant's timezone
        if (method_exists($model, 'restaurant') && $model->restaurant) {
            return $model->restaurant->time_zone ?? 'Asia/Tbilisi';
        }
        
        // If the model is a Table, get its restaurant's timezone (through place if needed)
        if (method_exists($model, 'place') && $model->place && $model->place->restaurant) {
            return $model->place->restaurant->time_zone ?? 'Asia/Tbilisi';
        }
        
        // If the model has a restaurant_id and can load restaurant relation
        if (property_exists($model, 'restaurant_id') && $model->restaurant_id) {
            $restaurant = Restaurant::find($model->restaurant_id);
            if ($restaurant) {
                return $restaurant->time_zone ?? 'Asia/Tbilisi';
            }
        }
        
        // Default timezone if none found
        return 'Asia/Tbilisi';
    }
}
