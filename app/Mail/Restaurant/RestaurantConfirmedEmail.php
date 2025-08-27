<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantConfirmedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('მომხარებელმა მაგიდა დაჯავშნილია!')
                    ->view('emails.restaurant.completed')
                    ->with(['reservation' => $this->reservation]);
    }
}
