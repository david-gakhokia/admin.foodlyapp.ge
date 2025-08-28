<?php

namespace App\Mail\Restaurant;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestauranPendingEmail extends Mailable
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
        return $this->subject('რეზერვაციის დეტალების ცვლილება')
                    ->view('emails.layouts.modern')
                    ->with([
                    'reservation' => $this->reservation,
                    'restaurantName' => $this->restaurantName,
                ]);
    }
}
