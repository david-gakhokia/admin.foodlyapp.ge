<?php

namespace App\Mail\Restaurant;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantConfirmedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $restaurantName;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;

        // Pre-compute restaurant name to avoid serialization issues
        if (method_exists($reservation, 'getRestaurantName')) {
            $this->restaurantName = $reservation->getRestaurantName();
        } else {
            $this->restaurantName = 'N/A';
        }
    }

    public function build()
    {
        return $this->subject('📋 რეზერვაციის შეტყობინება - FOODLY')
            ->view('emails.layouts.restaurant')
            ->with([
                'reservation' => $this->reservation,
                'restaurantName' => $this->restaurantName
            ]);
    }
}
