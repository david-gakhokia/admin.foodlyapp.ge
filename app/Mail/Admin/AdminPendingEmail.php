<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('რეზერვაციის სტატუსი შეიცვალა')
                    ->view('emails.admin.pending')
                    ->with(['reservation' => $this->reservation]);
    }
}
