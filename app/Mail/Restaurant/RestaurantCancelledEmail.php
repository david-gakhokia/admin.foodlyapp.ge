<?php

namespace App\Mail\Restaurant;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantCancelledEmail extends Mailable
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
        return $this->subject('ჯავშანი გაუქმებულია')
                    ->view('emails.restaurant.cancelled')
                    ->with([
                    'reservation' => $this->reservation,
                    'restaurantName' => $this->restaurantName,
                ]);
    }
}

