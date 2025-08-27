<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantCancelledEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('ჯავშანი გაუქმებულია')
                    ->view('emails.restaurant.cancelled')
                    ->with(['reservation' => $this->reservation]);
    }
}

