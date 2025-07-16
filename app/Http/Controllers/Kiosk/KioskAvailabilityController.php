<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Place;
use App\Models\Table;
use App\Services\Reservation\AvailabilityService;
use App\Http\Resources\Availability\RestaurantAvailabilityResource;
use App\Http\Resources\Availability\PlaceAvailabilityResource;
use App\Http\Resources\Availability\TableAvailabilityResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class KioskAvailabilityController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    /**
     * Get restaurant availability hours and time slots
     * 
     * @param Request $request
     * @param string $slug Restaurant slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function restaurantAvailability(Request $request, string $slug)
    {
        try {
            $restaurant = Restaurant::where('slug', $slug)
                ->where('status', 'active')
                ->with('reservationSlots')
                ->firstOrFail();

            $date = $request->input('date', now()->toDateString());
            $dayOfWeek = Carbon::parse($date)->format('l');

            // Get available slots for the specified date
            $availableSlots = $this->availabilityService->generateAvailableSlots($restaurant, $date, $dayOfWeek);

            // Get all reservation slots for the week
            $weeklySlots = $restaurant->reservationSlots()
                ->where('available', true)
                ->orderBy('day_of_week')
                ->orderBy('time_from')
                ->get()
                ->groupBy('day_of_week')
                ->map(function ($slots) {
                    return $slots->map(function ($slot) {
                        return [
                            'day' => $slot->day_of_week,
                            'time_from' => $slot->time_from,
                            'time_to' => $slot->time_to,
                            'available' => $slot->available,
                            'max_guests' => $slot->max_guests,
                            'slot_interval_minutes' => $slot->slot_interval_minutes
                        ];
                    });
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'restaurant' => [
                        'id' => $restaurant->id,
                        'name' => $restaurant->name,
                        'slug' => $restaurant->slug,
                        'timezone' => $restaurant->time_zone ?? 'Asia/Tbilisi',
                        'working_hours' => $restaurant->working_hours
                    ],
                    'date' => $date,
                    'day_of_week' => $dayOfWeek,
                    'available_slots' => $availableSlots,
                    'weekly_hours' => $weeklySlots
                ]
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch restaurant availability',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get place availability hours and time slots
     * 
     * @param Request $request
     * @param string $restaurantSlug
     * @param string $placeSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function placeAvailability(Request $request, string $restaurantSlug, string $placeSlug)
    {
        try {
            $restaurant = Restaurant::where('slug', $restaurantSlug)
                ->where('status', 'active')
                ->firstOrFail();

            $place = $restaurant->places()
                ->where('slug', $placeSlug)
                ->with('reservationSlots')
                ->firstOrFail();

            $date = $request->input('date', now()->toDateString());
            $dayOfWeek = Carbon::parse($date)->format('l');

            // Get available slots for the specified date
            $availableSlots = $this->availabilityService->generateAvailableSlots($place, $date, $dayOfWeek);

            // Get all reservation slots for the week
            $weeklySlots = $place->reservationSlots()
                ->where('available', true)
                ->orderBy('day_of_week')
                ->orderBy('time_from')
                ->get()
                ->groupBy('day_of_week')
                ->map(function ($slots) {
                    return $slots->map(function ($slot) {
                        return [
                            'day' => $slot->day_of_week,
                            'time_from' => $slot->time_from,
                            'time_to' => $slot->time_to,
                            'available' => $slot->available,
                            'max_guests' => $slot->max_guests,
                            'slot_interval_minutes' => $slot->slot_interval_minutes
                        ];
                    });
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'restaurant' => [
                        'id' => $restaurant->id,
                        'name' => $restaurant->name,
                        'slug' => $restaurant->slug
                    ],
                    'place' => [
                        'id' => $place->id,
                        'name' => $place->name,
                        'slug' => $place->slug
                    ],
                    'date' => $date,
                    'day_of_week' => $dayOfWeek,
                    'available_slots' => $availableSlots,
                    'weekly_hours' => $weeklySlots
                ]
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant or Place not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch place availability',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get table availability hours and time slots
     * 
     * @param Request $request
     * @param string $restaurantSlug
     * @param string $placeSlug
     * @param string $tableSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableAvailability(Request $request, string $restaurantSlug, string $placeSlug, string $tableSlug)
    {
        try {
            $restaurant = Restaurant::where('slug', $restaurantSlug)
                ->where('status', 'active')
                ->firstOrFail();

            $place = $restaurant->places()
                ->where('slug', $placeSlug)
                ->firstOrFail();

            $table = $place->tables()
                ->where('slug', $tableSlug)
                ->with('reservationSlots')
                ->firstOrFail();

            $date = $request->input('date', now()->toDateString());
            $dayOfWeek = Carbon::parse($date)->format('l');

            // Get available slots for the specified date
            $availableSlots = $this->availabilityService->generateAvailableSlots($table, $date, $dayOfWeek);

            // Get all reservation slots for the week
            $weeklySlots = $table->reservationSlots()
                ->where('available', true)
                ->orderBy('day_of_week')
                ->orderBy('time_from')
                ->get()
                ->groupBy('day_of_week')
                ->map(function ($slots) use ($table) {
                    return $slots->map(function ($slot) use ($table) {
                        return [
                            'day' => $slot->day_of_week,
                            'time_from' => $slot->time_from,
                            'time_to' => $slot->time_to,
                            'available' => $slot->available,
                            'max_guests' => $slot->max_guests ?? $table->capacity,
                            'slot_interval_minutes' => $slot->slot_interval_minutes
                        ];
                    });
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'restaurant' => [
                        'id' => $restaurant->id,
                        'name' => $restaurant->name,
                        'slug' => $restaurant->slug
                    ],
                    'place' => [
                        'id' => $place->id,
                        'name' => $place->name,
                        'slug' => $place->slug
                    ],
                    'table' => [
                        'id' => $table->id,
                        'name' => $table->name,
                        'slug' => $table->slug,
                        'capacity' => $table->capacity,
                        'seats' => $table->seats
                    ],
                    'date' => $date,
                    'day_of_week' => $dayOfWeek,
                    'available_slots' => $availableSlots,
                    'weekly_hours' => $weeklySlots
                ]
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant, Place or Table not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch table availability',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get direct table availability (tables without place)
     * 
     * @param Request $request
     * @param string $restaurantSlug
     * @param string $tableSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function directTableAvailability(Request $request, string $restaurantSlug, string $tableSlug)
    {
        try {
            $restaurant = Restaurant::where('slug', $restaurantSlug)
                ->where('status', 'active')
                ->firstOrFail();

            $table = $restaurant->tables()
                ->where('slug', $tableSlug)
                ->whereNull('place_id') // Direct table without place
                ->with('reservationSlots')
                ->firstOrFail();

            $date = $request->input('date', now()->toDateString());
            $dayOfWeek = Carbon::parse($date)->format('l');

            // Get available slots for the specified date
            $availableSlots = $this->availabilityService->generateAvailableSlots($table, $date, $dayOfWeek);

            // Get all reservation slots for the week
            $weeklySlots = $table->reservationSlots()
                ->where('available', true)
                ->orderBy('day_of_week')
                ->orderBy('time_from')
                ->get()
                ->groupBy('day_of_week')
                ->map(function ($slots) use ($table) {
                    return $slots->map(function ($slot) use ($table) {
                        return [
                            'day' => $slot->day_of_week,
                            'time_from' => $slot->time_from,
                            'time_to' => $slot->time_to,
                            'available' => $slot->available,
                            'max_guests' => $slot->max_guests ?? $table->capacity,
                            'slot_interval_minutes' => $slot->slot_interval_minutes
                        ];
                    });
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'restaurant' => [
                        'id' => $restaurant->id,
                        'name' => $restaurant->name,
                        'slug' => $restaurant->slug
                    ],
                    'table' => [
                        'id' => $table->id,
                        'name' => $table->name,
                        'slug' => $table->slug,
                        'capacity' => $table->capacity,
                        'seats' => $table->seats
                    ],
                    'date' => $date,
                    'day_of_week' => $dayOfWeek,
                    'available_slots' => $availableSlots,
                    'weekly_hours' => $weeklySlots
                ]
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Restaurant or Table not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch table availability',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
