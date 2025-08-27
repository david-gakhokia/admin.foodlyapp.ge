<?php
namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientCompletedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('მაგიდა დაიჯავშნა - გადახდილია')
                    ->view('emails.client.completed')
                    ->with(['reservation' => $this->reservation]);
    }
}
