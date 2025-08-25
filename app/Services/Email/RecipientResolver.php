<?php

namespace App\Services\Email;

use App\Models\NotificationEvent;
use App\Models\Reservation;
use App\Models\NotificationRule;
use Illuminate\Support\Collection;

class RecipientResolver
{
    /**
     * Resolve recipients for a notification event
     */
    public function resolve(NotificationEvent $event): Collection
    {
        $recipients = collect();

        // Get active rules for this event
        $rules = NotificationRule::getRulesForEvent($event->event_key);

        foreach ($rules as $rule) {
            if ($rule->shouldSend($event->payload ?? [])) {
                $recipient = $this->resolveRecipient($event, $rule->recipient_type);
                
                if ($recipient) {
                    $recipients->push([
                        'email' => $recipient['email'],
                        'type' => $rule->recipient_type,
                        'name' => $recipient['name'] ?? null,
                        'data' => $recipient['data'] ?? [],
                        'delay_minutes' => $rule->delay_minutes,
                    ]);
                }
            }
        }

        return $recipients->unique('email');
    }

    /**
     * Resolve specific recipient based on type and event
     */
    private function resolveRecipient(NotificationEvent $event, string $recipientType): ?array
    {
        switch ($recipientType) {
            case 'client':
                return $this->resolveClientRecipient($event);
            
            case 'manager':
                return $this->resolveManagerRecipient($event);
            
            case 'admin':
                return $this->resolveAdminRecipient($event);
            
            default:
                return null;
        }
    }

    /**
     * Resolve client recipient from reservation
     */
    private function resolveClientRecipient(NotificationEvent $event): ?array
    {
        if (!$event->reservation_id) {
            return null;
        }

        $reservation = Reservation::find($event->reservation_id);
        
        if (!$reservation || !$reservation->email) {
            return null;
        }

        return [
            'email' => $reservation->email,
            'name' => $reservation->name,
            'data' => [
                'customer_name' => $reservation->name,
                'customer_phone' => $reservation->phone,
            ]
        ];
    }

    /**
     * Resolve manager recipient from restaurant via reservable relationship
     */
    private function resolveManagerRecipient(NotificationEvent $event): ?array
    {
        if (!$event->reservation_id) {
            return null;
        }

        $reservation = Reservation::with('reservable')->find($event->reservation_id);
        
        if (!$reservation || !$reservation->reservable) {
            return null;
        }

        // Get restaurant through Place/Table relationship
        $restaurant = null;
        
        if ($reservation->reservable_type === 'App\\Models\\Place') {
            $place = $reservation->reservable;
            $restaurant = \App\Models\Restaurant::find($place->restaurant_id);
        } elseif ($reservation->reservable_type === 'App\\Models\\Table') {
            $table = $reservation->reservable;
            $restaurant = \App\Models\Restaurant::find($table->restaurant_id);
        } elseif ($reservation->reservable_type === 'App\\Models\\Restaurant') {
            $restaurant = $reservation->reservable;
        }

        if (!$restaurant || !$restaurant->email) {
            return null;
        }

        return [
            'email' => $restaurant->email,
            'name' => $restaurant->name,
            'data' => [
                'restaurant_name' => $restaurant->name,
                'manager_name' => $restaurant->name, // Use restaurant name as manager name
                'restaurant_phone' => $restaurant->phone,
            ]
        ];
    }

    /**
     * Resolve admin recipient
     */
    private function resolveAdminRecipient(NotificationEvent $event): ?array
    {
        $adminEmail = config('mail.admin_email') ?? config('mail.from.address');
        
        if (!$adminEmail) {
            return null;
        }

        return [
            'email' => $adminEmail,
            'name' => 'FOODLY Admin',
            'data' => [
                'admin_panel_url' => config('app.url') . '/admin',
            ]
        ];
    }

    /**
     * Get recipients for specific event types
     */
    public function getRecipientsForEventType(string $eventKey, int $reservationId): Collection
    {
        $recipients = collect();

        switch ($eventKey) {
            case 'reservation.requested':
                $recipients = $this->getReservationRequestedRecipients($reservationId);
                break;

            case 'reservation.confirmed':
                $recipients = $this->getReservationConfirmedRecipients($reservationId);
                break;

            case 'reservation.declined':
                $recipients = $this->getReservationDeclinedRecipients($reservationId);
                break;

            case 'reservation.prearrival':
                $recipients = $this->getPreArrivalRecipients($reservationId);
                break;
        }

        return $recipients;
    }

    private function getReservationRequestedRecipients(int $reservationId): Collection
    {
        $reservation = Reservation::with('reservable')->find($reservationId);
        $recipients = collect();

        if (!$reservation) {
            return $recipients;
        }

        // Get restaurant through polymorphic relationship
        $restaurant = null;
        if ($reservation->reservable_type === 'App\\Models\\Place') {
            $restaurant = \App\Models\Restaurant::find($reservation->reservable->restaurant_id);
        } elseif ($reservation->reservable_type === 'App\\Models\\Table') {
            $restaurant = \App\Models\Restaurant::find($reservation->reservable->restaurant_id);
        } elseif ($reservation->reservable_type === 'App\\Models\\Restaurant') {
            $restaurant = $reservation->reservable;
        }

        // Manager notification
        if ($restaurant && $restaurant->email) {
            $recipients->push([
                'email' => $restaurant->email,
                'type' => 'manager',
                'name' => $restaurant->name,
            ]);
        }

        // Client confirmation
        if ($reservation->email) {
            $recipients->push([
                'email' => $reservation->email,
                'type' => 'client',
                'name' => $reservation->name,
            ]);
        }

        return $recipients;
    }

    private function getReservationConfirmedRecipients(int $reservationId): Collection
    {
        $reservation = Reservation::find($reservationId);
        $recipients = collect();

        // Client notification
        if ($reservation && $reservation->email) {
            $recipients->push([
                'email' => $reservation->email,
                'type' => 'client',
                'name' => $reservation->name,
            ]);
        }

        return $recipients;
    }

    private function getReservationDeclinedRecipients(int $reservationId): Collection
    {
        return $this->getReservationConfirmedRecipients($reservationId);
    }

    private function getPreArrivalRecipients(int $reservationId): Collection
    {
        return $this->getReservationConfirmedRecipients($reservationId);
    }
}
