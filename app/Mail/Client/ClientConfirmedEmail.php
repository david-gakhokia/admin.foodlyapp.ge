<?php
namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientConfirmedEmail extends Mailable
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
        return $this->subject('რეზერვაციის დეტალები - დადასტურებულია')
                    ->view('emails.client.confirmed')
                    ->with([
                        'reservation' => $this->reservation,
                        'restaurantName' => $this->restaurantName
                    ]);
    }
}
