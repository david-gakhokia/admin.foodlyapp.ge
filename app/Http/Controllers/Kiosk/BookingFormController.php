<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Place;
use App\Services\Reservation\AvailabilityService;
use App\Services\Reservation\ReservationService;

class BookingFormController extends Controller
{
    private $availabilityService;
    private $reservationService;

    public function __construct(AvailabilityService $availabilityService, ReservationService $reservationService)
    {
        $this->availabilityService = $availabilityService;
        $this->reservationService = $reservationService;
    }

    // ----------- RESTAURANT FORM -----------
    public function restaurantForm(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $reservationDate = $request->input('reservation_date', now()->toDateString());
        $dayOfWeek = now()->parse($reservationDate)->format('l'); // Returns day name like 'Monday'

        $slots = $this->availabilityService->generateAvailableSlots($restaurant, $reservationDate, $dayOfWeek);

        return view('kiosk.booking.restaurant', [
            'restaurant' => $restaurant,
            'reservationDate' => $reservationDate,
            'availableSlots' => $slots,
        ]);
    }

    public function restaurantReserve(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $validated = $this->validateReservation($request);

        $this->reservationService->createReservation(
            $restaurant,
            $validated['reservation_date'],
            $validated['reservation_time'],
            $validated['guests_count'],
            $request->only(['name', 'phone', 'email', 'promo_code', 'notes'])
        );

        return redirect()->back()->with('success', 'Reservation created!');
    }

    // ----------- PLACE FORM -----------
    public function placeForm(Request $request, $restaurant_slug, $slug)
    {
        $restaurant = Restaurant::where('slug', $restaurant_slug)->where('status', 'active')->firstOrFail();
        $place = Place::where('slug', $slug)->where('restaurant_id', $restaurant->id)->firstOrFail();
        $reservationDate = $request->input('reservation_date', now()->toDateString());
        $dayOfWeek = now()->parse($reservationDate)->format('l');

        $slots = $this->availabilityService->generateAvailableSlots($place, $reservationDate, $dayOfWeek);

        return view('kiosk.booking.place', [
            'restaurant' => $restaurant,
            'place' => $place,
            'reservationDate' => $reservationDate,
            'availableSlots' => $slots,
        ]);
    }

    public function placeReserve(Request $request, $restaurant_slug, $slug)
    {
        $restaurant = Restaurant::where('slug', $restaurant_slug)->where('status', 'active')->firstOrFail();
        $place = Place::where('slug', $slug)->where('restaurant_id', $restaurant->id)->firstOrFail();
        $validated = $this->validateReservation($request);

        $this->reservationService->createReservation(
            $place,
            $validated['reservation_date'],
            $validated['reservation_time'],
            $validated['guests_count'],
            $request->only(['name', 'phone', 'email', 'promo_code', 'notes'])
        );

        return redirect()->back()->with('success', 'Reservation created!');
    }

    // ----------- TABLE FORM -----------
    public function tableForm(Request $request, $restaurant_slug, $place_slug, $slug)
    {
        $restaurant = Restaurant::where('slug', $restaurant_slug)->where('status', 'active')->firstOrFail();
        $place = Place::where('slug', $place_slug)->where('restaurant_id', $restaurant->id)->firstOrFail();
        $table = Table::where('slug', $slug)->where('place_id', $place->id)->firstOrFail();
        $reservationDate = $request->input('reservation_date', now()->toDateString());
        $dayOfWeek = now()->parse($reservationDate)->format('l');

        $slots = $this->availabilityService->generateAvailableSlots($table, $reservationDate, $dayOfWeek);

        return view('kiosk.booking.table', [
            'restaurant' => $restaurant,
            'place' => $place,
            'table' => $table,
            'reservationDate' => $reservationDate,
            'availableSlots' => $slots,
        ]);
    }

    public function tableReserve(Request $request, $restaurant_slug, $place_slug, $slug)
    {
        $restaurant = Restaurant::where('slug', $restaurant_slug)->where('status', 'active')->firstOrFail();
        $place = Place::where('slug', $place_slug)->where('restaurant_id', $restaurant->id)->firstOrFail();
        $table = Table::where('slug', $slug)->where('place_id', $place->id)->firstOrFail();
        $validated = $this->validateReservation($request);

        $this->reservationService->createReservation(
            $table,
            $validated['reservation_date'],
            $validated['reservation_time'],
            $validated['guests_count'],
            $request->only(['name', 'phone', 'email', 'promo_code', 'notes'])
        );

        return redirect()->back()->with('success', 'Reservation created!');
    }

    // ----------- TABLE FORM (Direct Restaurant) -----------
    public function tableFormDirect(Request $request, $restaurant_slug, $slug)
    {
        $restaurant = Restaurant::where('slug', $restaurant_slug)->where('status', 'active')->firstOrFail();
        $table = Table::where('slug', $slug)->where('restaurant_id', $restaurant->id)->whereNull('place_id')->firstOrFail();
        $reservationDate = $request->input('reservation_date', now()->toDateString());
        $dayOfWeek = now()->parse($reservationDate)->format('l');

        $slots = $this->availabilityService->generateAvailableSlots($table, $reservationDate, $dayOfWeek);

        return view('kiosk.booking.table', [
            'restaurant' => $restaurant,
            'place' => null,
            'table' => $table,
            'reservationDate' => $reservationDate,
            'availableSlots' => $slots,
        ]);
    }

    public function tableReserveDirect(Request $request, $restaurant_slug, $slug)
    {
        $restaurant = Restaurant::where('slug', $restaurant_slug)->where('status', 'active')->firstOrFail();
        $table = Table::where('slug', $slug)->where('restaurant_id', $restaurant->id)->whereNull('place_id')->firstOrFail();
        $validated = $this->validateReservation($request);

        $this->reservationService->createReservation(
            $table,
            $validated['reservation_date'],
            $validated['reservation_time'],
            $validated['guests_count'],
            $request->only(['name', 'phone', 'email', 'promo_code', 'notes'])
        );

        return redirect()->back()->with('success', 'Reservation created!');
    }

    // ----------- RESTAURANT OTP & SMS FORMS -----------
    public function restaurantOTPForm(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        
        return view('kiosk.booking.otp-form', [
            'restaurant' => $restaurant,
        ]);
    }

    public function restaurantSMSForm(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        
        return view('kiosk.booking.sms-form', [
            'restaurant' => $restaurant,
        ]);
    }

    // ----------- OTP & SMS VERIFICATION METHODS -----------
    public function verifyOTP(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        
        $validated = $request->validate([
            'phone' => 'required|string',
            'otp_code' => 'required|string|size:6',
        ]);

        // OTP verification logic here
        // This would typically verify against SMS service or cache
        
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully',
            'restaurant' => $restaurant->slug
        ]);
    }

    public function sendSMS(Request $request, $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        
        $validated = $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        // SMS sending logic here
        // This would typically use SMS service like Twilio, etc.
        
        return response()->json([
            'success' => true,
            'message' => 'SMS sent successfully',
            'phone' => $validated['phone']
        ]);
    }

    private function validateReservation(Request $request): array
    {
        return $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|string',
            'guests_count' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email',
            'promo_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
    }
}
