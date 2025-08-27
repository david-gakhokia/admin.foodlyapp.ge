<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminCancelledEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('რეზერვაცია გაუქმებულია - დეტალები')
                    ->view('emails.admin.cancelled')
                    ->with(['reservation' => $this->reservation]);
    }
}

