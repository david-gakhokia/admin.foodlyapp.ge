<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Services\Reservation\AvailabilityService;

class KioskReservationController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    public function restaurantForm(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $reservationDate = $request->input('reservation_date') ?? now()->format('Y-m-d');

        $availableSlots = $this->availabilityService->generateAvailableSlots($restaurant, $reservationDate, now()->parse($reservationDate)->format('l'));

        return view('kiosk.reservations.restaurant_form', [
            'restaurant' => $restaurant,
            'reservationDate' => $reservationDate,
            'availableSlots' => $availableSlots,
            'oldReservationTime' => $request->old('reservation_time'),
        ]);
    }

    public function restaurantReserve(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();

        $validated = $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'guests_count' => 'required|integer|min:1',
            'name' => 'required|string',
            'phone' => ['required', 'regex:/^\+?[0-9\s\-()]{7,15}$/'],
            'email' => 'nullable|email',
            'promo_code' => 'nullable|string',
        ]);

        // ხელმეორედ შემოწმება სლოტზე
        $dayOfWeek = now()->parse($validated['reservation_date'])->format('l');
        $availableSlots = $this->availabilityService->generateAvailableSlots($restaurant, $validated['reservation_date'], $dayOfWeek);
        if (!in_array($validated['reservation_time'], $availableSlots)) {
            return redirect()->back()
                ->withErrors(['reservation_time' => 'This time slot is already reserved.'])
                ->withInput();
        }

        Reservation::create([
            'type' => 'restaurant',
            'restaurant_id' => $restaurant->id,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'guests_count' => $validated['guests_count'],
            'promo_code' => $validated['promo_code'],
        ]);

        return redirect()->back()->with('success', 'Reservation successfully created!');
    }
}
