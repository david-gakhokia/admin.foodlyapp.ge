<?php

namespace Database\Factories;

use App\Models\AnalyticsReport;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnalyticsReport>
 */
class AnalyticsReportFactory extends Factory
{
    protected $model = AnalyticsReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            AnalyticsReport::TYPE_BOG_PAYMENTS,
            AnalyticsReport::TYPE_RESERVATIONS,
            AnalyticsReport::TYPE_REVENUE,
            AnalyticsReport::TYPE_OVERVIEW
        ];

        $type = $this->faker->randomElement($types);
        $generatedAt = $this->faker->dateTimeBetween('-30 days', 'now');

        return [
            'type' => $type,
            'name' => $this->generateName($type),
            'description' => $this->generateDescription($type),
            'filters' => $this->generateFilters(),
            'data' => $this->generateData($type),
            'generated_at' => $generatedAt,
            'generated_by' => User::factory(),
            'file_path' => $this->faker->optional(0.7)->passthrough('analytics_reports/' . $this->faker->uuid() . '.csv'),
            'expires_at' => $this->faker->dateTimeBetween($generatedAt, '+30 days'),
        ];
    }

    /**
     * Generate report name based on type
     */
    private function generateName(string $type): string
    {
        $typeNames = AnalyticsReport::getReportTypes();
        $typeName = $typeNames[$type] ?? $type;
        
        return $typeName . ' - ' . $this->faker->dateTime()->format('Y-m-d H:i:s');
    }

    /**
     * Generate report description
     */
    private function generateDescription(string $type): string
    {
        $descriptions = [
            AnalyticsReport::TYPE_BOG_PAYMENTS => 'BOG payment transactions analysis and statistics',
            AnalyticsReport::TYPE_RESERVATIONS => 'Reservation booking patterns and conversion metrics',
            AnalyticsReport::TYPE_REVENUE => 'Revenue trends and financial performance analysis',
            AnalyticsReport::TYPE_OVERVIEW => 'Comprehensive dashboard overview with key metrics'
        ];

        return $descriptions[$type] ?? 'Analytics report for ' . $type;
    }

    /**
     * Generate filters based on type
     */
    private function generateFilters(): array
    {
        $fromDate = $this->faker->dateTimeBetween('-60 days', '-30 days')->format('Y-m-d');
        $toDate = $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d');

        return [
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'restaurant_id' => $this->faker->optional(0.6)->numberBetween(1, 20),
            'period' => $this->faker->randomElement(['day', 'week', 'month']),
            'status' => $this->faker->optional(0.4)->randomElements(['pending', 'confirmed', 'cancelled'], $this->faker->numberBetween(1, 3)),
            'include_projections' => $this->faker->boolean(30)
        ];
    }

    /**
     * Generate sample data based on type
     */
    private function generateData(string $type): array
    {
        return match($type) {
            AnalyticsReport::TYPE_BOG_PAYMENTS => $this->generateBogPaymentData(),
            AnalyticsReport::TYPE_RESERVATIONS => $this->generateReservationData(),
            AnalyticsReport::TYPE_REVENUE => $this->generateRevenueData(),
            AnalyticsReport::TYPE_OVERVIEW => $this->generateOverviewData(),
            default => []
        };
    }

    /**
     * Generate BOG payment data
     */
    private function generateBogPaymentData(): array
    {
        return [
            'summary' => [
                'total_transactions' => $this->faker->numberBetween(50, 500),
                'success_rate' => $this->faker->randomFloat(2, 85, 99),
                'total_revenue' => $this->faker->randomFloat(2, 5000, 50000),
                'average_transaction_amount' => $this->faker->randomFloat(2, 80, 150)
            ],
            'time_series' => $this->generateTimeSeries(['total_transactions', 'successful_transactions', 'failed_transactions', 'revenue']),
            'status_breakdown' => [
                'success' => [
                    'count' => $this->faker->numberBetween(40, 400),
                    'total_amount' => $this->faker->randomFloat(2, 4000, 40000)
                ],
                'failed' => [
                    'count' => $this->faker->numberBetween(5, 50),
                    'total_amount' => 0
                ]
            ]
        ];
    }

    /**
     * Generate reservation data
     */
    private function generateReservationData(): array
    {
        return [
            'summary' => [
                'total_reservations' => $this->faker->numberBetween(100, 800),
                'conversion_rate' => $this->faker->randomFloat(2, 70, 90),
                'average_guests_per_reservation' => $this->faker->randomFloat(1, 2.0, 4.5),
                'total_guests_served' => $this->faker->numberBetween(200, 2000)
            ],
            'time_series' => $this->generateTimeSeries(['total_reservations', 'confirmed_reservations', 'cancelled_reservations', 'total_guests']),
            'status_distribution' => [
                'confirmed' => ['count' => $this->faker->numberBetween(70, 600)],
                'cancelled' => ['count' => $this->faker->numberBetween(10, 100)],
                'pending' => ['count' => $this->faker->numberBetween(5, 50)]
            ]
        ];
    }

    /**
     * Generate revenue data
     */
    private function generateRevenueData(): array
    {
        return [
            'summary' => [
                'total_revenue' => $this->faker->randomFloat(2, 10000, 100000),
                'growth_percentage' => $this->faker->randomFloat(2, -10, 30),
                'average_daily_revenue' => $this->faker->randomFloat(2, 300, 3000),
                'total_transactions' => $this->faker->numberBetween(100, 1000),
                'average_transaction_value' => $this->faker->randomFloat(2, 80, 150)
            ],
            'time_series' => $this->generateTimeSeries(['revenue', 'transaction_count', 'average_transaction']),
            'projections' => [
                'next_month' => $this->faker->randomFloat(2, 8000, 25000),
                'next_quarter' => $this->faker->randomFloat(2, 25000, 80000),
                'next_year' => $this->faker->randomFloat(2, 100000, 300000)
            ]
        ];
    }

    /**
     * Generate overview data
     */
    private function generateOverviewData(): array
    {
        return [
            'reservations' => [
                'total' => $this->faker->numberBetween(150, 1000),
                'confirmed' => $this->faker->numberBetween(120, 800),
                'cancelled' => $this->faker->numberBetween(20, 150),
                'pending' => $this->faker->numberBetween(10, 50),
                'conversion_rate' => $this->faker->randomFloat(2, 75, 95),
                'growth_percentage' => $this->faker->randomFloat(2, -5, 25)
            ],
            'payments' => [
                'total_transactions' => $this->faker->numberBetween(100, 800),
                'successful_transactions' => $this->faker->numberBetween(90, 750),
                'failed_transactions' => $this->faker->numberBetween(5, 50),
                'success_rate' => $this->faker->randomFloat(2, 90, 99),
                'total_revenue' => $this->faker->randomFloat(2, 10000, 80000)
            ],
            'revenue' => [
                'total' => $this->faker->randomFloat(2, 10000, 80000),
                'average_per_reservation' => $this->faker->randomFloat(2, 80, 150),
                'growth_percentage' => $this->faker->randomFloat(2, -5, 30)
            ]
        ];
    }

    /**
     * Generate time series data
     */
    private function generateTimeSeries(array $metrics): array
    {
        $series = [];
        $days = $this->faker->numberBetween(7, 30);
        
        for ($i = 0; $i < $days; $i++) {
            $period = now()->subDays($days - $i)->format('Y-m-d');
            $point = ['period' => $period];
            
            foreach ($metrics as $metric) {
                $point[$metric] = match($metric) {
                    'revenue', 'average_transaction' => $this->faker->randomFloat(2, 100, 2000),
                    'conversion_rate', 'success_rate' => $this->faker->randomFloat(2, 80, 99),
                    default => $this->faker->numberBetween(1, 50)
                };
            }
            
            $series[] = $point;
        }
        
        return $series;
    }

    /**
     * State for expired reports
     */
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'expires_at' => $this->faker->dateTimeBetween('-10 days', '-1 day'),
        ]);
    }

    /**
     * State for recent reports
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'generated_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'expires_at' => $this->faker->dateTimeBetween('+1 day', '+7 days'),
        ]);
    }
}
