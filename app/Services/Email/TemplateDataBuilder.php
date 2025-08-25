<?php

namespace App\Services\Email;

use App\Models\NotificationEvent;
use App\Models\Reservation;
use Carbon\Carbon;

class TemplateDataBuilder
{
    /**
     * Build template data for email sending
     */
    public function build(NotificationEvent $event, array $recipient): array
    {
        $baseData = $this->getBaseData();
        $reservationData = $this->getReservationData($event->reservation_id);
        $recipientData = $this->getRecipientSpecificData($recipient);
        $eventData = $this->getEventSpecificData($event);

        return array_merge($baseData, $reservationData, $recipientData, $eventData);
    }

    /**
     * Get base data available to all templates
     */
    private function getBaseData(): array
    {
        return [
            'app_name' => config('app.name', 'FOODLY'),
            'app_url' => config('app.url'),
            'support_email' => config('mail.from.address'),
            'current_year' => date('Y'),
            'current_date' => Carbon::now()->format('Y-m-d'),
            'current_time' => Carbon::now()->format('H:i'),
        ];
    }

    /**
     * Get reservation-specific data
     */
    private function getReservationData(?int $reservationId): array
    {
        if (!$reservationId) {
            return [];
        }

        $reservation = Reservation::with(['restaurant', 'user'])->find($reservationId);

        if (!$reservation) {
            return [];
        }

        $reservationDateTime = Carbon::parse($reservation->datetime_local);

        return [
            // Reservation details
            'reservation_id' => $reservation->id,
            'reservation_number' => str_pad($reservation->id, 6, '0', STR_PAD_LEFT),
            'guest_count' => $reservation->guest_count,
            'special_requests' => $reservation->special_requests,
            'reservation_notes' => $reservation->notes,

            // Client details
            'client_name' => $reservation->client_name,
            'client_email' => $reservation->client_email,
            'client_phone' => $reservation->client_phone,

            // Restaurant details
            'restaurant_name' => $reservation->restaurant->name ?? '',
            'restaurant_address' => $reservation->restaurant->address ?? '',
            'restaurant_phone' => $reservation->restaurant->phone ?? '',
            'restaurant_email' => $reservation->restaurant->email ?? '',

            // Date and time formatting
            'reservation_date' => $reservationDateTime->format('Y-m-d'),
            'reservation_time' => $reservationDateTime->format('H:i'),
            'reservation_datetime' => $reservationDateTime->format('Y-m-d H:i'),
            'reservation_day_name' => $reservationDateTime->translatedFormat('l'),
            'reservation_month_name' => $reservationDateTime->translatedFormat('F'),

            // Localized Georgian formats
            'reservation_date_georgian' => $this->formatDateGeorgian($reservationDateTime),
            'reservation_time_georgian' => $reservationDateTime->format('H:i'),

            // Status
            'reservation_status' => $reservation->status,
            'reservation_status_georgian' => $this->getStatusInGeorgian($reservation->status),

            // URLs
            'reservation_view_url' => config('app.frontend_url') . '/reservations/' . $reservation->id,
            'restaurant_profile_url' => config('app.frontend_url') . '/restaurants/' . $reservation->restaurant->id,
        ];
    }

    /**
     * Get recipient-specific data
     */
    private function getRecipientSpecificData(array $recipient): array
    {
        $data = [
            'recipient_name' => $recipient['name'] ?? $recipient['email'],
            'recipient_email' => $recipient['email'],
            'recipient_type' => $recipient['type'],
        ];

        // Add recipient type specific data
        switch ($recipient['type']) {
            case 'client':
                $data['is_client'] = true;
                $data['dashboard_url'] = config('app.frontend_url') . '/dashboard';
                break;

            case 'manager':
                $data['is_manager'] = true;
                $data['admin_panel_url'] = config('app.frontend_url') . '/admin';
                $data['reservations_url'] = config('app.frontend_url') . '/admin/reservations';
                break;

            case 'admin':
                $data['is_admin'] = true;
                $data['admin_panel_url'] = config('app.frontend_url') . '/admin';
                break;
        }

        return $data;
    }

    /**
     * Get event-specific data
     */
    private function getEventSpecificData(NotificationEvent $event): array
    {
        $data = [
            'event_key' => $event->event_key,
            'event_type' => $event->event_type,
            'event_time' => $event->created_at->format('Y-m-d H:i:s'),
        ];

        // Add event-specific messaging
        switch ($event->event_key) {
            case 'reservation.requested':
                $data['action_required'] = true;
                $data['message_type'] = 'new_request';
                break;

            case 'reservation.confirmed':
                $data['action_required'] = false;
                $data['message_type'] = 'confirmation';
                break;

            case 'reservation.declined':
                $data['action_required'] = false;
                $data['message_type'] = 'decline';
                break;

            case 'reservation.prearrival':
                $data['action_required'] = false;
                $data['message_type'] = 'reminder';
                $data['is_reminder'] = true;
                break;
        }

        return $data;
    }

    /**
     * Format date in Georgian locale
     */
    private function formatDateGeorgian(Carbon $date): string
    {
        $georgianMonths = [
            1 => 'იანვარი', 2 => 'თებერვალი', 3 => 'მარტი', 4 => 'აპრილი',
            5 => 'მაისი', 6 => 'ივნისი', 7 => 'ივლისი', 8 => 'აგვისტო',
            9 => 'სექტემბერი', 10 => 'ოქტომბერი', 11 => 'ნოემბერი', 12 => 'დეკემბერი'
        ];

        $georgianDays = [
            1 => 'ორშაბათი', 2 => 'სამშაბათი', 3 => 'ოთხშაბათი', 
            4 => 'ხუთშაბათი', 5 => 'პარასკევი', 6 => 'შაბათი', 0 => 'კვირა'
        ];

        $day = $date->day;
        $month = $georgianMonths[$date->month];
        $year = $date->year;
        $dayName = $georgianDays[$date->dayOfWeek];

        return "{$dayName}, {$day} {$month}, {$year}";
    }

    /**
     * Get reservation status in Georgian
     */
    private function getStatusInGeorgian(string $status): string
    {
        $statuses = [
            'pending' => 'მოლოდინში',
            'confirmed' => 'დადასტურებული',
            'declined' => 'უარყოფილი',
            'cancelled' => 'გაუქმებული',
            'completed' => 'დასრულებული',
        ];

        return $statuses[$status] ?? $status;
    }

    /**
     * Build data for specific template
     */
    public function buildForTemplate(string $templateKey, NotificationEvent $event, array $recipient): array
    {
        $baseData = $this->build($event, $recipient);

        // Add template-specific data
        switch ($templateKey) {
            case 'reservation.requested.manager':
                $baseData['action_url'] = config('app.frontend_url') . '/admin/reservations/' . $event->reservation_id;
                $baseData['approve_url'] = config('app.frontend_url') . '/admin/reservations/' . $event->reservation_id . '/approve';
                $baseData['decline_url'] = config('app.frontend_url') . '/admin/reservations/' . $event->reservation_id . '/decline';
                break;

            case 'reservation.confirmed.client':
                $baseData['view_reservation_url'] = config('app.frontend_url') . '/reservations/' . $event->reservation_id;
                $baseData['add_to_calendar_url'] = $this->generateCalendarUrl($event->reservation_id);
                break;

            case 'reservation.prearrival.client':
                $baseData['directions_url'] = $this->generateDirectionsUrl($event->reservation_id);
                $baseData['contact_restaurant_url'] = config('app.frontend_url') . '/restaurants/' . $baseData['restaurant_id'] . '/contact';
                break;
        }

        return $baseData;
    }

    /**
     * Generate calendar URL for reservation
     */
    private function generateCalendarUrl(int $reservationId): string
    {
        $reservation = Reservation::with('restaurant')->find($reservationId);
        
        if (!$reservation) {
            return '';
        }

        $startTime = Carbon::parse($reservation->datetime_local);
        $endTime = $startTime->copy()->addHours(2); // Assume 2-hour duration

        $params = [
            'action' => 'TEMPLATE',
            'text' => "Reservation at {$reservation->restaurant->name}",
            'dates' => $startTime->format('Ymd\THis') . '/' . $endTime->format('Ymd\THis'),
            'location' => $reservation->restaurant->address,
            'details' => "Reservation for {$reservation->guest_count} guests",
        ];

        return 'https://calendar.google.com/calendar/render?' . http_build_query($params);
    }

    /**
     * Generate directions URL to restaurant
     */
    private function generateDirectionsUrl(int $reservationId): string
    {
        $reservation = Reservation::with('restaurant')->find($reservationId);
        
        if (!$reservation || !$reservation->restaurant->address) {
            return '';
        }

        return 'https://maps.google.com/maps?daddr=' . urlencode($reservation->restaurant->address);
    }
}
