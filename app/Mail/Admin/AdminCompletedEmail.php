<?php
namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminCompletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('გადახდილია - მაგიდა დაიჯავშნა')
                    ->view('emails.admin.completed')
                    ->with(['reservation' => $this->reservation]);
    }
}
