<?php

use App\Jobs\SendAdminReservationEmail;
use Illuminate\Support\Facades\Mail;

it('queues the provided mailable to the recipient', function () {
    Mail::fake();

    $mailable = new \Illuminate\Mail\Mailable();
    $job = new SendAdminReservationEmail('test@ex.com', $mailable);

    $job->handle();

    Mail::assertQueued(get_class($mailable));
});
