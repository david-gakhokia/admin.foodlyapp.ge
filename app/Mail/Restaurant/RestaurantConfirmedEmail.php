<?php
namespace App\Mail\Restaurant;

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
        return $this->subject('ახალი რეზერვაცია დადასტურდა!')
                    ->view('emails.restaurant.confirmed')
                    ->with(['reservation' => $this->reservation]);
    }
}
