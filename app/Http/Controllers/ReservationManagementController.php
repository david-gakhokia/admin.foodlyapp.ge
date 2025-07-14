<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Place;
use App\Models\Table;

class ReservationManagementController extends Controller
{
    // 1. სრული FOODLY Admin რეზერვაციები
    public function index(Request $request)
    {
        $query = Reservation::with('reservable');
        $reservations = $query->orderByDesc('id')->get();

        // Reservation Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Restaurant filter
        if ($request->filled('restaurant_id')) {
            $restaurantId = $request->restaurant_id;
            $query->where(function ($q) use ($restaurantId) {
                // Restaurant ტიპის რეზერვაცია
                $q->where(function ($q2) use ($restaurantId) {
                    $q2->where('type', 'restaurant')
                        ->where('reservable_type', \App\Models\Restaurant::class)
                        ->where('reservable_id', $restaurantId);
                });
                // Place ტიპის რეზერვაცია
                $q->orWhere(function ($q2) use ($restaurantId) {
                    $q2->where('type', 'place')
                        ->whereHasMorph('reservable', [\App\Models\Place::class], function ($q3) use ($restaurantId) {
                            $q3->where('restaurant_id', $restaurantId);
                        });
                });
                // Table ტიპის რეზერვაცია
                $q->orWhere(function ($q2) use ($restaurantId) {
                    $q2->where('type', 'table')
                        ->whereHasMorph('reservable', [\App\Models\Table::class], function ($q3) use ($restaurantId) {
                            $q3->whereHas('place', function ($q4) use ($restaurantId) {
                                $q4->where('restaurant_id', $restaurantId);
                            });
                        });
                });
            });
        }

        // Place filter
        if ($request->filled('place')) {
            $placeId = $request->place;
            $query->where('type', 'place')
                ->where('reservable_type', \App\Models\Place::class)
                ->where('reservable_id', $placeId);
        }

        // Table filter
        if ($request->filled('table')) {
            $tableId = $request->table;
            $query->where('type', 'table')
                ->where('reservable_type', \App\Models\Table::class)
                ->where('reservable_id', $tableId);
        }

        $reservations = $query->orderByDesc('reservation_date')->paginate(200);


        $restaurants = Restaurant::all();
        $places = Place::all();
        $tables = Table::all();


        return view('booking.reservations.index', compact('reservations', 'restaurants', 'places', 'tables'));
    }

    // 2. Restaurant Manager - მხოლოდ თავისი რესტორნის რეზერვაციები
    public function manager(Request $request, $restaurantId)
    {
        $query = Reservation::where('restaurant_id', $restaurantId)->orderBy('reservation_date', 'desc');

        if ($request->filled('date_from')) {
            $query->where('reservation_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('reservation_date', '<=', $request->date_to);
        }

        $reservations = $query->paginate(20);
        return view('manager.reservations.index', compact('reservations', 'restaurantId'));
    }

    // 3. Manager - Place ფილტრი
    public function byPlace(Request $request, $placeId)
    {
        $query = Reservation::where('place_id', $placeId)->orderBy('reservation_date', 'desc');

        if ($request->filled('date_from')) {
            $query->where('reservation_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('reservation_date', '<=', $request->date_to);
        }

        $reservations = $query->paginate(20);
        return view('manager.reservations.by_place', compact('reservations', 'placeId'));
    }

    // 4. Manager - Table ფილტრი
    public function byTable(Request $request, $tableId)
    {
        $query = Reservation::where('table_id', $tableId)->orderBy('reservation_date', 'desc');

        if ($request->filled('date_from')) {
            $query->where('reservation_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('reservation_date', '<=', $request->date_to);
        }

        $reservations = $query->paginate(20);
        return view('manager.reservations.by_table', compact('reservations', 'tableId'));
    }


    public function exportCsv(Request $request)
    {
        $query = Reservation::with('restaurant', 'place', 'table');

        if ($request->filled('restaurant_id')) $query->where('restaurant_id', $request->restaurant_id);
        if ($request->filled('place')) $query->where('place_id', $request->place);
        if ($request->filled('table')) $query->where('table_id', $request->table);
        if ($request->filled('date_from')) $query->whereDate('reservation_date', '>=', $request->date_from);
        if ($request->filled('date_to')) $query->whereDate('reservation_date', '<=', $request->date_to);

        $reservations = $query->get();

        $filename = 'reservations_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($reservations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Type', 'Restaurant', 'Place', 'Table', 'Date', 'Time', 'Name', 'Phone']);
            foreach ($reservations as $res) {
                fputcsv($file, [
                    ucfirst($res->type),
                    optional($res->restaurant)->name,
                    optional($res->place)->name,
                    optional($res->table)->name,
                    $res->reservation_date,
                    $res->reservation_time,
                    $res->name,
                    $res->phone,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $query = Reservation::with('restaurant', 'place', 'table');

        if ($request->filled('restaurant_id')) $query->where('restaurant_id', $request->restaurant_id);
        if ($request->filled('place')) $query->where('place_id', $request->place);
        if ($request->filled('table')) $query->where('table_id', $request->table);
        if ($request->filled('date_from')) $query->whereDate('reservation_date', '>=', $request->date_from);
        if ($request->filled('date_to')) $query->whereDate('reservation_date', '<=', $request->date_to);

        $reservations = $query->get();

        $html = view('booking.reservations.export_pdf', compact('reservations'))->render();

        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($html);
        return response($pdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="reservations.pdf"');
    }
}
