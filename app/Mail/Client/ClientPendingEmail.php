<?php

namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientPendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $restaurantName;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
        
        // Pre-compute restaurant name safely
        if (method_exists($reservation, 'getRestaurantName')) {
            $this->restaurantName = $reservation->getRestaurantName();
        } else {
            $this->restaurantName = 'N/A';
        }
    }

    public function build()
    {
        return $this->subject('რესტორანმა რეზერვაციის დეტალები შეცვალა')
                    ->view('emails.client.pending')
                    ->with([
                    'reservation' => $this->reservation,
                    'restaurantName' => $this->restaurantName,
                ]);
    }
}
