<?php

namespace App\Http\Controllers\Manager\Booking;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class SlotManagerController extends Controller
{
    public function restaurantSlots($restaurantId)
    {
        $restaurant = Restaurant::with('reservationSlots')->findOrFail($restaurantId);
        
        // Use restaurant's timezone for current date calculation
        $timezone = $restaurant->time_zone ?? 'Asia/Tbilisi';
        $today = Carbon::now($timezone)->toDateString();

        $slots = $restaurant->reservationSlots()->orderBy('day_of_week')->orderBy('time_from')->get();

        $reservations = Reservation::where('reservable_type', Restaurant::class)
            ->where('reservable_id', $restaurantId)
            ->where('reservation_date', $today)
            ->get()
            ->groupBy(function ($res) {
                return $res->time_from;
            });

        return view('manager.booking.restaurant-slots', compact('restaurant', 'slots', 'reservations'));
    }
}
