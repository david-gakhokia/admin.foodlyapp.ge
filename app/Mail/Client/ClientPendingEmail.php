<?php

namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientPendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('რესტორანმა რეზერვაციის დეტალები შეცვალა')
                    ->view('emails.client.pending')
                    ->with(['reservation' => $this->reservation]);
    }
}
