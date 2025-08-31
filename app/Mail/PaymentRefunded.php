<?php

namespace App\Mail;

use App\Models\BOGTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentRefunded extends Mailable
{
    use Queueable, SerializesModels;

    public BOGTransaction $transaction;

    /**
     * Create a new message instance.
     */
    public function __construct(BOGTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: config('mail.from.address'),
            subject: 'თანხა დაბრუნდა - FOODLY რეზერვაცია #' . $this->transaction->reservation->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.payment.refunded',
            with: [
                'transaction' => $this->transaction,
                'reservation' => $this->transaction->reservation,
                'customerName' => $this->transaction->reservation->guest_name,
                'amount' => $this->transaction->amount,
                'currency' => $this->transaction->currency,
                'reservationDate' => $this->transaction->reservation->reservation_datetime?->format('Y-m-d H:i'),
                'reservationId' => $this->transaction->reservation->id,
                'refundDate' => $this->transaction->updated_at->format('Y-m-d H:i'),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
