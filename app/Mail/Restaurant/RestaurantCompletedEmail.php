<?php
namespace App\Mail\Restaurant;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantCompletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('მომხმარებელმა მაგიდა დაჯავშნა')
                    ->view('emails.restaurant.completed')
                    ->with(['reservation' => $this->reservation]);
    }
}
