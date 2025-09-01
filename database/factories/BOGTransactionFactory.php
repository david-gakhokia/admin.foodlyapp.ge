<?php

namespace Database\Factories;

use App\Models\BOGTransaction;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class BOGTransactionFactory extends Factory
{
    protected $model = BOGTransaction::class;

    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 10, 500);
        $status = $this->faker->randomElement(['pending', 'processing', 'completed', 'failed', 'cancelled', 'refunded']);
        $bogStatus = $this->getBogStatusForTransactionStatus($status);

        return [
            'reservation_id' => Reservation::factory(),
            'bog_order_id' => 'BOG_' . $this->faker->unique()->randomNumber(8),
            'bog_payment_id' => 'PAY_' . $this->faker->unique()->randomNumber(8),
            'amount' => $amount,
            'currency' => 'GEL',
            'status' => $status,
            'bog_status' => $bogStatus,
            'bog_response_data' => $this->generateBogResponseData($status, $bogStatus, $amount),
            'payment_url' => $status === 'pending' ? $this->faker->url() : null,
            'callback_url' => $this->faker->url(),
            'error_message' => $status === 'failed' ? $this->faker->sentence() : null,
            'expires_at' => $status === 'pending' ? now()->addHours(24) : null,
            'paid_at' => in_array($status, ['completed']) ? $this->faker->dateTimeBetween('-30 days', 'now') : null,
            'created_at' => $this->faker->dateTimeBetween('-60 days', 'now'),
        ];
    }

    /**
     * Map transaction status to appropriate BOG status
     */
    private function getBogStatusForTransactionStatus(string $status): string
    {
        return match($status) {
            'pending' => $this->faker->randomElement(['pending', 'created']),
            'processing' => $this->faker->randomElement(['processing', 'in_progress']),
            'completed' => $this->faker->randomElement(['success', 'captured', 'completed']),
            'failed' => $this->faker->randomElement(['failed', 'declined', 'insufficient_funds', 'invalid_card']),
            'cancelled' => $this->faker->randomElement(['cancelled', 'voided', 'user_cancelled']),
            'refunded' => $this->faker->randomElement(['refunded', 'partially_refunded']),
        };
    }

    /**
     * Generate realistic BOG response data
     */
    private function generateBogResponseData(string $status, string $bogStatus, float $amount): array
    {
        $baseData = [
            'order_id' => 'BOG_' . $this->faker->randomNumber(8),
            'payment_id' => 'PAY_' . $this->faker->randomNumber(8),
            'status' => $bogStatus,
            'amount' => $amount,
            'currency' => 'GEL',
            'timestamp' => now()->toISOString(),
        ];

        if ($status === 'completed') {
            $baseData['transaction_id'] = 'TXN_' . $this->faker->randomNumber(10);
            $baseData['authorization_code'] = $this->faker->randomNumber(6);
            $baseData['card_mask'] = '**** **** **** ' . $this->faker->randomNumber(4);
        }

        if ($status === 'failed') {
            $baseData['error_code'] = $this->faker->randomElement(['001', '002', '003', '004']);
            $baseData['error_message'] = $this->faker->randomElement([
                'Insufficient funds',
                'Invalid card',
                'Transaction declined',
                'Card expired'
            ]);
        }

        return $baseData;
    }

    /**
     * State for completed transactions
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'bog_status' => $this->faker->randomElement(['success', 'captured', 'completed']),
            'paid_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'expires_at' => null,
            'error_message' => null,
        ]);
    }

    /**
     * State for failed transactions
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
            'bog_status' => $this->faker->randomElement(['failed', 'declined', 'insufficient_funds']),
            'paid_at' => null,
            'error_message' => $this->faker->sentence(),
        ]);
    }

    /**
     * State for pending transactions
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'bog_status' => $this->faker->randomElement(['pending', 'created']),
            'payment_url' => $this->faker->url(),
            'expires_at' => now()->addHours(24),
            'paid_at' => null,
            'error_message' => null,
        ]);
    }

    /**
     * State for transactions from the last 7 days
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'paid_at' => in_array($attributes['status'], ['completed']) 
                ? $this->faker->dateTimeBetween('-7 days', 'now') 
                : null,
        ]);
    }

    /**
     * State for high-value transactions
     */
    public function highValue(): static
    {
        return $this->state(fn (array $attributes) => [
            'amount' => $this->faker->randomFloat(2, 200, 1000),
        ]);
    }
}
