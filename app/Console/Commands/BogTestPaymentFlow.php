<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use App\Models\BOGTransaction;

class BogTestPaymentFlow extends Command
{
    protected $signature = 'bog:test-payment-flow {--reservation-id=}';
    protected $description = 'Run a simulated payment flow for a reservation';

    public function handle()
    {
        $reservationId = $this->option('reservation-id');

        $reservation = $reservationId ? Reservation::find($reservationId) : Reservation::inRandomOrder()->first();

        if (!$reservation) {
            $this->error('Reservation not found');
            return 1;
        }

        $this->info('Simulating payment for reservation: ' . $reservation->id);

        // Create local test transaction record
        $tx = BOGTransaction::create([
            'reservation_id' => $reservation->id,
            'bog_order_id' => 'SIM-' . now()->timestamp,
            'amount' => 1.00,
            'currency' => 'GEL',
            'status' => 'pending',
            'bog_response_data' => ['simulated' => true],
        ]);

        $this->info('Created test transaction: ' . $tx->id);

        // Simulate webhook callback to mark completed
        $tx->status = 'completed';
        $tx->save();

        $this->info('Transaction marked as completed');
        Log::info('bog:test-payment-flow completed', ['reservation' => $reservation->id, 'transaction' => $tx->id]);

        return 0;
    }
}
