<?php

namespace App\Http\Controllers\Manager\Booking;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Services\Reservation\OccupancyService;
use Illuminate\Http\Request;

class OccupancyController extends Controller
{
    protected $occupancyService;

    public function __construct(OccupancyService $occupancyService)
    {
        $this->occupancyService = $occupancyService;
    }

    // public function show(Restaurant $restaurant, Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     $occupancyData = $this->occupancyService->getOccupancyByRestaurant($restaurant->id, $startDate, $endDate);


    //     return view('manager.occupancy.show', [
    //         'restaurant' => $restaurant,
    //         'occupancyData' => $occupancyData,
    //         'startDate' => $startDate,
    //         'endDate' => $endDate,
    //     ]);
    // }

    public function show(Restaurant $restaurant, Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $period = $request->input('period', 'day'); // default: day

        $occupancyData = $this->occupancyService->getOccupancyByRestaurant($restaurant->id, $startDate, $endDate);
        $grouped = $this->occupancyService->groupByPeriod($occupancyData, $period);

        return view('manager.occupancy.show', [
            'restaurant' => $restaurant,
            'occupancyData' => $occupancyData,
            'grouped' => $grouped,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'period' => $period,
        ]);
    }
}
