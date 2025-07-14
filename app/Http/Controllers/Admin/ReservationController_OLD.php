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
                        ->where('reservable_type', Restaurant::class)
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

        // Debug: Check if we have any reservations at all
        $totalReservations = Reservation::count();
        \Log::info('Total reservations in DB: ' . $totalReservations);
        
        // Debug: Check Restaurant class name
        \Log::info('Restaurant class: ' . Restaurant::class);
        \Log::info('Restaurant ID: ' . $restaurant->id);

        $reservations = Reservation::with(['reservable'])
            ->where(function ($q) use ($restaurant) {
                // Restaurant reservations
                $q->where(function ($q2) use ($restaurant) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', Restaurant::class)
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

        // Debug: Log reservations found
        \Log::info('Reservations found: ' . $reservations->count());
        \Log::info('Date range: ' . $startDate . ' to ' . $endDate);

        // Debug: Simple test query
        $allReservations = Reservation::all();
        \Log::info('All reservations: ' . $allReservations->toJson());
        
        // Test specific restaurant reservations
        $restaurantReservations = Reservation::where('reservable_type', 'App\\Models\\Restaurant')
            ->where('reservable_id', $restaurant->id)
            ->get();
        \Log::info('Restaurant reservations: ' . $restaurantReservations->toJson());

        // Debug: Add dd() to see what's happening
        dd([
            'restaurant_id' => $restaurant->id,
            'total_reservations' => Reservation::count(),
            'reservations_for_restaurant' => Reservation::where('reservable_type', 'App\\Models\\Restaurant')
                ->where('reservable_id', $restaurant->id)
                ->get()->toArray(),
            'date_range' => [$startDate, $endDate],
            'current_date' => Carbon::now()->format('Y-m-d'),
        ]);

        // Transform for calendar
        $calendarEvents = $reservations->map(function ($reservation) {
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
            };
        });

        return view('admin.restaurants.reservations.calendar', compact('restaurant', 'calendarEvents'));
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
