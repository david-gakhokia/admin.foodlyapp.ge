<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestauranPendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('რეზერვაციის დეტალების ცვლილება')
                    ->view('emails.restaurant.pending')
                    ->with(['reservation' => $this->reservation]);
    }
}
