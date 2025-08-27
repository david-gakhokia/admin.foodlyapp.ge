<?php
namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminConfirmedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
    return $this->subject('რეზერვაცია დადასტურებულია')
            ->view('emails.admin.confirmed')
            ->with(['reservation' => $this->reservation]);
    }
}
