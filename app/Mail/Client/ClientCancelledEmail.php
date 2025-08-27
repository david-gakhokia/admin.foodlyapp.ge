<?php

namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientCancelledEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('რეზერვაცია უარყოფილია - დეტალები...')
                    ->view('emails.client.cancelled')
                    ->with(['reservation' => $this->reservation]);
    }
}

