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
        // Load additional relationships based on reservation type
        $reservation->load(['reservable']);
        
        // If it's a table reservation, also load the restaurant and place
        if ($reservation->type === 'table' && $reservation->reservable_type === 'App\\Models\\Table') {
            $reservation->load(['reservable.restaurant.translations', 'reservable.place.translations']);
        }
        // If it's a place reservation, also load the restaurant
        elseif ($reservation->type === 'place' && $reservation->reservable_type === 'App\\Models\\Place') {
            $reservation->load(['reservable.restaurant.translations']);
        }
        
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

        if ($request->filled('restaurant_id')) {
            $restaurant_id = $request->restaurant_id;
            $query->where(function ($q) use ($restaurant_id) {
                // Restaurant reservations
                $q->where(function ($q2) use ($restaurant_id) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', 'App\\Models\\Restaurant')
                        ->where('reservable_id', $restaurant_id);
                })
                // Place reservations
                ->orWhere(function ($q2) use ($restaurant_id) {
                    $q2->where('type', 'place')
                        ->whereHasMorph('reservable', [\App\Models\Place::class], function ($q3) use ($restaurant_id) {
                            $q3->where('restaurant_id', $restaurant_id);
                        });
                })
                // Table reservations
                ->orWhere(function ($q2) use ($restaurant_id) {
                    $q2->where('type', 'table')
                        ->whereHasMorph('reservable', [\App\Models\Table::class], function ($q3) use ($restaurant_id) {
                            $q3->whereHas('place', function ($q4) use ($restaurant_id) {
                                $q4->where('restaurant_id', $restaurant_id);
                            });
                        });
                });
            });
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$search}%")
                  ->orWhere('customer_email', 'LIKE', "%{$search}%");
            });
        }

        $reservations = $query->orderBy('reservation_date', 'desc')
                             ->orderBy('time_from', 'desc')
                             ->paginate(30);

        // Calculate stats for dashboard cards
        $today = Carbon::today();
        $todayReservations = Reservation::whereDate('reservation_date', $today)->count();
        $confirmedToday = Reservation::whereDate('reservation_date', $today)
                                   ->where('status', 'Confirmed')
                                   ->count();

        // Prepare calendar events data
        $calendarEvents = $this->getCalendarEvents($request);

        return view('admin.reservations.list', compact(
            'reservations', 
            'todayReservations', 
            'confirmedToday', 
            'calendarEvents'
        ));
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
     * Get calendar events for FullCalendar
     */
    private function getCalendarEvents(Request $request, $limit = 100)
    {
        $query = Reservation::with(['reservable']);

        // Default date range: current month ± 1 month
        $startDate = $request->filled('calendar_start') 
            ? Carbon::parse($request->calendar_start)
            : Carbon::now()->startOfMonth()->subMonth();
            
        $endDate = $request->filled('calendar_end')
            ? Carbon::parse($request->calendar_end)
            : Carbon::now()->endOfMonth()->addMonth();

        $query->whereBetween('reservation_date', [$startDate, $endDate]);

        // Apply same filters as list view
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('restaurant_id')) {
            $restaurant_id = $request->restaurant_id;
            $query->where(function ($q) use ($restaurant_id) {
                $q->where(function ($q2) use ($restaurant_id) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', 'App\\Models\\Restaurant')
                        ->where('reservable_id', $restaurant_id);
                })
                ->orWhere(function ($q2) use ($restaurant_id) {
                    $q2->where('type', 'place')
                        ->whereHasMorph('reservable', [\App\Models\Place::class], function ($q3) use ($restaurant_id) {
                            $q3->where('restaurant_id', $restaurant_id);
                        });
                })
                ->orWhere(function ($q2) use ($restaurant_id) {
                    $q2->where('type', 'table')
                        ->whereHasMorph('reservable', [\App\Models\Table::class], function ($q3) use ($restaurant_id) {
                            $q3->whereHas('place', function ($q4) use ($restaurant_id) {
                                $q4->where('restaurant_id', $restaurant_id);
                            });
                        });
                });
            });
        }

        $reservations = $query->orderBy('reservation_date', 'asc')
                             ->orderBy('time_from', 'asc')
                             ->limit($limit)
                             ->get();

        $events = [];
        foreach ($reservations as $reservation) {
            // Format datetime correctly for FullCalendar
            $startDateTime = $reservation->reservation_date . 'T' . $reservation->time_from;
            $endDateTime = $reservation->reservation_date . 'T' . $reservation->time_to;
            
            $events[] = [
                'id' => $reservation->id,
                'title' => $this->getEventTitle($reservation),
                'start' => $startDateTime,
                'end' => $endDateTime,
                'backgroundColor' => $this->getStatusColor($reservation->status),
                'borderColor' => $this->getStatusColor($reservation->status),
                'textColor' => '#ffffff',
                'url' => '#', // route('admin.reservations.show', $reservation->id),
                'extendedProps' => [
                    'status' => $reservation->status,
                    'customerName' => $reservation->name ?? 'უცნობი',
                    'customerPhone' => $reservation->phone ?? '',
                    'customerEmail' => $reservation->email ?? '',
                    'partySize' => $reservation->guests_count ?? 1,
                    'type' => $reservation->type,
                    'reservableName' => $this->getReservableName($reservation)
                ]
            ];
        }

        return $events;
    }

    /**
     * Get event title for calendar display
     */
    private function getEventTitle($reservation)
    {
        $time = Carbon::parse($reservation->time_from)->format('H:i');
        $name = $reservation->name ?? 'უცნობი';
        $size = $reservation->guests_count ?? 1;
        
        return "{$time} - {$name} ({$size}კ.)";
    }

    /**
     * Get status color for calendar events
     */
    private function getStatusColor($status)
    {
        return match ($status) {
            'Pending' => '#f59e0b',    // amber-500
            'Confirmed' => '#10b981',  // emerald-500
            'Cancelled' => '#ef4444',  // red-500
            'Completed' => '#3b82f6',  // blue-500
            default => '#6b7280'       // gray-500
        };
    }

    /**
     * Get reservable name for display
     */
    private function getReservableName($reservation)
    {
        if (!$reservation->reservable) {
            return 'N/A';
        }

        switch ($reservation->type) {
            case 'restaurant':
                return $reservation->reservable->name ?? 'რესტორანი';
            case 'place':
                return ($reservation->reservable->restaurant->name ?? 'რესტორანი') . ' - ' . ($reservation->reservable->name ?? 'ადგილი');
            case 'table':
                $table = $reservation->reservable;
                $place = $table->place ?? null;
                $restaurant = $place->restaurant ?? null;
                return ($restaurant->name ?? 'რესტორანი') . ' - ' . ($place->name ?? 'ადგილი') . ' - მაგიდა ' . ($table->table_number ?? '?');
            default:
                return 'N/A';
        }
    }

    /**
     * Return events across all restaurants (filtered by date range)
     */
    public function eventsAll(Request $request)
    {
        try {
            // Build query with filters
            $query = \DB::table('reservations')
                ->select('id', 'name', 'phone', 'email', 'guests_count', 'reservation_date', 'time_from', 'time_to', 'status', 'type');

            // Apply status filter
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Apply restaurant filter (if needed in future)
            if ($request->filled('restaurant_id')) {
                // Future implementation for restaurant filtering
                // $query->where('restaurant_id', $request->restaurant_id);
            }

            // Apply date filter for "დღეს" (Today) button
            if ($request->filled('date')) {
                $query->whereDate('reservation_date', $request->date);
            }

            $reservations = $query->get();

            $events = [];
            foreach ($reservations as $reservation) {
                $color = '#3b82f6'; // Default blue color
                if ($reservation->status === 'Confirmed') $color = '#10b981';
                if ($reservation->status === 'Pending') $color = '#f59e0b';
                if ($reservation->status === 'Cancelled') $color = '#ef4444';

                $events[] = [
                    'id' => $reservation->id,
                    'title' => ($reservation->name ?? 'უცნობი') . ' (' . ($reservation->guests_count ?? 1) . 'კ.)',
                    'start' => $reservation->reservation_date . 'T' . $reservation->time_from,
                    'end' => $reservation->reservation_date . 'T' . $reservation->time_to,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'customerName' => $reservation->name ?? 'უცნობი',
                        'customerPhone' => $reservation->phone ?? '',
                        'customerEmail' => $reservation->email ?? '',
                        'partySize' => $reservation->guests_count ?? 1,
                        'status' => $reservation->status,
                        'type' => $reservation->type ?? 'restaurant',
                        'reservableName' => 'ზოგადი ჯავშანი'
                    ]
                ];
            }
            
            return response()->json($events, 200, ['Content-Type' => 'application/json']);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Database error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get reservation statistics by status
     */
    public function getStatistics(Request $request)
    {
        try {
            // Get status counts
            $statistics = \DB::table('reservations')
                ->select('status', \DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get()
                ->keyBy('status');

            // Prepare result with all possible statuses
            $result = [
                'Pending' => $statistics->get('Pending')?->count ?? 0,
                'Confirmed' => $statistics->get('Confirmed')?->count ?? 0,
                'Cancelled' => $statistics->get('Cancelled')?->count ?? 0,
                'Completed' => $statistics->get('Completed')?->count ?? 0,
                'total' => $statistics->sum('count')
            ];
            
            return response()->json($result, 200, ['Content-Type' => 'application/json']);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Database error: ' . $e->getMessage()
            ], 500);
        }
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

    /**
     * Update reservation status.
     */
    public function updateStatus(Request $request, Restaurant $restaurant, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Cancelled,Completed',
            'note' => 'nullable|string|max:500'
        ]);

        $oldStatus = $reservation->status;
        $reservation->status = $request->status;
        
        // Add note to existing notes if provided
        if ($request->note) {
            $timestamp = now()->format('Y-m-d H:i:s');
            $statusNote = "სტატუსის ცვლილება ({$oldStatus} → {$request->status}): {$request->note} [{$timestamp}]";
            
            if ($reservation->notes) {
                $reservation->notes = $reservation->notes . "\n\n" . $statusNote;
            } else {
                $reservation->notes = $statusNote;
            }
        }
        
        $reservation->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'სტატუსი წარმატებით განახლდა!',
                'status' => $reservation->status
            ]);
        }

        return redirect()->back()->with('success', 'სტატუსი წარმატებით განახლდა!');
    }
}
