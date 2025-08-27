<?php

use App\Jobs\SendAdminReservationEmail;
use Illuminate\Mail\Mailable;

it('executes job->handle without throwing when given a mailable', function () {
    // create a minimal anonymous mailable
    $mailable = new class extends Mailable {
        public function build()
        {
            return $this->view('emails.admin.pending');
        }
    };

    $job = new SendAdminReservationEmail('test@ex.com', $mailable);
    $job->handle();

    // If no exception was thrown, test is considered passed
    expect(true)->toBeTrue();
});
