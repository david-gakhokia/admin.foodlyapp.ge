<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations for a specific restaurant.
     */
    public function index(Request $request, Restaurant $restaurant)
    {
        $query = Reservation::with(['reservable'])
            ->where(function ($q) use ($restaurant) {
                // Restaurant reservations
                $q->where(function ($q2) use ($restaurant) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', 'App\\Models\\Restaurant')
                        ->where('reservable_id', $restaurant->id);
                })
                // Place reservations
                ->orWhere(function ($q2) use ($restaurant) {
                    $q2->where('type', 'place')
                        ->whereHasMorph('reservable', [\App\Models\Place::class], function ($q3) use ($restaurant) {
                            $q3->where('restaurant_id', $restaurant->id);
                        });
                })
                // Table reservations
                ->orWhere(function ($q2) use ($restaurant) {
                    $q2->where('type', 'table')
                        ->whereHasMorph('reservable', [\App\Models\Table::class], function ($q3) use ($restaurant) {
                            $q3->whereHas('place', function ($q4) use ($restaurant) {
                                $q4->where('restaurant_id', $restaurant->id);
                            });
                        });
                });
            });

        // Date filters
        if ($request->filled('date_from')) {
            $query->where('reservation_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('reservation_date', '<=', $request->date_to);
        }

        // Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->orderBy('reservation_date', 'desc')
            ->orderBy('time_from', 'desc')
            ->paginate(20);

        return view('admin.restaurants.reservations.index', compact('restaurant', 'reservations'));
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(Restaurant $restaurant, Reservation $reservation)
    {
        return view('admin.restaurants.reservations.edit', compact('restaurant', 'reservation'));
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, Restaurant $restaurant, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Cancelled,Completed',
            'notes' => 'nullable|string',
        ]);

        $reservation->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.restaurants.reservations.index', $restaurant)
            ->with('success', 'ჯავშანი წარმატებით განახლდა!');
    }

    /**
     * Display the specified reservation.
     */
    public function show(Restaurant $restaurant, Reservation $reservation)
    {
        return view('admin.restaurants.reservations.show', compact('restaurant', 'reservation'));
    }

    /**
     * Display calendar view of reservations.
     */
    public function calendar(Request $request, Restaurant $restaurant)
    {
        $startDate = $request->input('start', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Get all reservations for this restaurant
        $reservations = Reservation::with(['reservable'])
            ->where(function ($q) use ($restaurant) {
                // Restaurant reservations
                $q->where(function ($q2) use ($restaurant) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', 'App\\Models\\Restaurant')
                        ->where('reservable_id', $restaurant->id);
                })
                // Place reservations
                ->orWhere(function ($q2) use ($restaurant) {
                    $q2->where('type', 'place')
                        ->whereHasMorph('reservable', [\App\Models\Place::class], function ($q3) use ($restaurant) {
                            $q3->where('restaurant_id', $restaurant->id);
                        });
                })
                // Table reservations
                ->orWhere(function ($q2) use ($restaurant) {
                    $q2->where('type', 'table')
                        ->whereHasMorph('reservable', [\App\Models\Table::class], function ($q3) use ($restaurant) {
                            $q3->whereHas('place', function ($q4) use ($restaurant) {
                                $q4->where('restaurant_id', $restaurant->id);
                            });
                        });
                });
            })
            ->whereBetween('reservation_date', [$startDate, $endDate])
            ->orderBy('reservation_date')
            ->orderBy('time_from')
            ->get();

        // Transform for calendar
        $calendarEvents = $reservations->map(function ($reservation) {
            $color = match ($reservation->status) {
                'Confirmed' => '#10B981',
                'Pending' => '#F59E0B',
                'Cancelled' => '#EF4444',
                'Completed' => '#6B7280',
                default => '#3B82F6',
            };

            // determine restaurant id for this reservation
            $restaurantId = null;
            if ($reservation->type === 'restaurant' && $reservation->reservable_type === 'App\\Models\\Restaurant') {
                $restaurantId = $reservation->reservable_id;
            } elseif ($reservation->type === 'place') {
                $restaurantId = $reservation->reservable?->restaurant_id ?? null;
            } elseif ($reservation->type === 'table') {
                $restaurantId = $reservation->reservable?->place?->restaurant_id ?? null;
            }

            return [
                'id' => $reservation->id,
                'title' => $reservation->name . ' (' . $reservation->guests_count . ' სტუმარი)',
                'start' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->time_from,
                'end' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->time_to,
                'color' => $color,
                'extendedProps' => [
                    'type' => $reservation->type,
                    'status' => $reservation->status,
                    'phone' => $reservation->phone,
                    'email' => $reservation->email,
                    'guests_count' => $reservation->guests_count,
                    'reservable_name' => $reservation->reservable?->name ?? 'N/A',
                    'restaurant_id' => $restaurantId,
                    'reservable_id' => $reservation->reservable_id,
                ],
            ];
        });

        return view('admin.restaurants.reservations.calendar', compact('restaurant', 'calendarEvents'));
    }

    /**
     * Return JSON events for a specific restaurant (used by FullCalendar AJAX)
     */
    public function events(Request $request, Restaurant $restaurant)
    {
        $startDate = $request->input('start', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $reservations = Reservation::with(['reservable'])
            ->where(function ($q) use ($restaurant) {
                $q->where(function ($q2) use ($restaurant) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', 'App\\Models\\Restaurant')
                        ->where('reservable_id', $restaurant->id);
                })
                ->orWhere(function ($q2) use ($restaurant) {
                    $q2->where('type', 'place')
                        ->whereHasMorph('reservable', [\App\Models\Place::class], function ($q3) use ($restaurant) {
                            $q3->where('restaurant_id', $restaurant->id);
                        });
                })
                ->orWhere(function ($q2) use ($restaurant) {
                    $q2->where('type', 'table')
                        ->whereHasMorph('reservable', [\App\Models\Table::class], function ($q3) use ($restaurant) {
                            $q3->whereHas('place', function ($q4) use ($restaurant) {
                                $q4->where('restaurant_id', $restaurant->id);
                            });
                        });
                });
            })
            ->whereBetween('reservation_date', [$startDate, $endDate])
            ->orderBy('reservation_date')
            ->orderBy('time_from')
            ->get();

        $events = $reservations->map(function ($reservation) {
            $color = match ($reservation->status) {
                'Confirmed' => '#10B981',
                'Pending' => '#F59E0B',
                'Cancelled' => '#EF4444',
                'Completed' => '#6B7280',
                default => '#3B82F6',
            };

            return [
                'id' => $reservation->id,
                'title' => $reservation->name . ' (' . $reservation->guests_count . ' სტუმარი)',
                'start' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->time_from,
                'end' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->time_to,
                'color' => $color,
                'extendedProps' => [
                    'type' => $reservation->type,
                    'status' => $reservation->status,
                    'phone' => $reservation->phone,
                    'email' => $reservation->email,
                    'guests_count' => $reservation->guests_count,
                    'reservable_name' => $reservation->reservable?->name ?? 'N/A',
                ],
            ];
        });

        return response()->json($events);
    }

    /**
     * Top-level admin: show reservations list across all restaurants with filters.
     */
    public function list(Request $request)
    {
        $query = Reservation::with(['reservable']);

        if ($request->filled('date_from')) {
            $query->where('reservation_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('reservation_date', '<=', $request->date_to);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->orderBy('reservation_date', 'desc')->paginate(30);

        return view('admin.reservations.list', compact('reservations'));
    }

    /**
     * Top-level admin: calendar across all restaurants
     */
    public function calendarAll(Request $request)
    {
        // For the view we can either pass empty events and use AJAX to fetch eventsAll
        return view('admin.reservations.calendar');
    }

    /**
     * Return events across all restaurants (filtered by date range)
     */
    public function eventsAll(Request $request)
    {
        $startDate = $request->input('start', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $reservations = Reservation::with(['reservable'])
            ->whereBetween('reservation_date', [$startDate, $endDate])
            ->orderBy('reservation_date')
            ->orderBy('time_from')
            ->get();

        $events = $reservations->map(function ($reservation) {
            $color = match ($reservation->status) {
                'Confirmed' => '#10B981',
                'Pending' => '#F59E0B',
                'Cancelled' => '#EF4444',
                'Completed' => '#6B7280',
                default => '#3B82F6',
            };

            return [
                'id' => $reservation->id,
                'title' => $reservation->name . ' (' . $reservation->guests_count . ' სტუმარი)',
                'start' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->time_from,
                'end' => $reservation->reservation_date->format('Y-m-d') . 'T' . $reservation->time_to,
                'color' => $color,
                'extendedProps' => [
                    'type' => $reservation->type,
                    'status' => $reservation->status,
                    'phone' => $reservation->phone,
                    'email' => $reservation->email,
                    'guests_count' => $reservation->guests_count,
                    'reservable_name' => $reservation->reservable?->name ?? 'N/A',
                ],
            ];
        });

        return response()->json($events);
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(Restaurant $restaurant, Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.restaurants.reservations.index', $restaurant)
            ->with('success', 'ჯავშანი წარმატებით წაიშალა!');
    }
}
