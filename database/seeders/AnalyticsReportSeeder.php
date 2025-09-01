<?php

namespace Database\Seeders;

use App\Models\AnalyticsReport;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnalyticsReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        // Sample BOG Payment Analytics Report
        AnalyticsReport::create([
            'type' => AnalyticsReport::TYPE_BOG_PAYMENTS,
            'name' => 'BOG Payment Analytics - Monthly Report',
            'description' => 'BOG payment analytics for current month',
            'filters' => [
                'from_date' => now()->startOfMonth()->toDateString(),
                'to_date' => now()->endOfMonth()->toDateString(),
                'period' => 'day'
            ],
            'data' => [
                'summary' => [
                    'total_transactions' => 145,
                    'success_rate' => 95.2,
                    'total_revenue' => 15420.50,
                    'average_transaction_amount' => 106.35
                ],
                'time_series' => [
                    [
                        'period' => now()->format('Y-m-d'),
                        'total_transactions' => 12,
                        'successful_transactions' => 11,
                        'failed_transactions' => 1,
                        'revenue' => 1250.00
                    ]
                ]
            ],
            'generated_at' => now(),
            'generated_by' => $user?->id,
            'expires_at' => now()->addDays(7)
        ]);

        // Sample Reservation Analytics Report
        AnalyticsReport::create([
            'type' => AnalyticsReport::TYPE_RESERVATIONS,
            'name' => 'Reservation Analytics - Weekly Report',
            'description' => 'Reservation analytics for current week',
            'filters' => [
                'from_date' => now()->startOfWeek()->toDateString(),
                'to_date' => now()->endOfWeek()->toDateString(),
                'period' => 'day'
            ],
            'data' => [
                'summary' => [
                    'total_reservations' => 89,
                    'conversion_rate' => 78.5,
                    'average_guests_per_reservation' => 2.8,
                    'total_guests_served' => 249
                ],
                'status_distribution' => [
                    'confirmed' => ['count' => 70],
                    'cancelled' => ['count' => 12],
                    'pending' => ['count' => 7]
                ]
            ],
            'generated_at' => now()->subHours(2),
            'generated_by' => $user?->id,
            'expires_at' => now()->addDays(7)
        ]);

        // Sample Revenue Analytics Report
        AnalyticsReport::create([
            'type' => AnalyticsReport::TYPE_REVENUE,
            'name' => 'Revenue Analytics - Quarterly Report',
            'description' => 'Revenue analytics for Q1',
            'filters' => [
                'from_date' => now()->startOfQuarter()->toDateString(),
                'to_date' => now()->endOfQuarter()->toDateString(),
                'period' => 'month',
                'include_projections' => true
            ],
            'data' => [
                'summary' => [
                    'total_revenue' => 45620.80,
                    'growth_percentage' => 15.3,
                    'average_daily_revenue' => 507.01,
                    'total_transactions' => 429,
                    'average_transaction_value' => 106.34
                ],
                'projections' => [
                    'next_month' => 16875.50,
                    'next_quarter' => 52540.25,
                    'next_year' => 210160.88
                ]
            ],
            'generated_at' => now()->subDay(),
            'generated_by' => $user?->id,
            'expires_at' => now()->addDays(7)
        ]);

        // Sample Dashboard Overview Report
        AnalyticsReport::create([
            'type' => AnalyticsReport::TYPE_OVERVIEW,
            'name' => 'Dashboard Overview - Current Month',
            'description' => 'Complete overview of all metrics for current month',
            'filters' => [
                'from_date' => now()->startOfMonth()->toDateString(),
                'to_date' => now()->toDateString()
            ],
            'data' => [
                'reservations' => [
                    'total' => 234,
                    'confirmed' => 198,
                    'cancelled' => 25,
                    'pending' => 11,
                    'conversion_rate' => 84.6,
                    'growth_percentage' => 12.8
                ],
                'payments' => [
                    'total_transactions' => 198,
                    'successful_transactions' => 189,
                    'failed_transactions' => 9,
                    'success_rate' => 95.5,
                    'total_revenue' => 20145.75
                ],
                'revenue' => [
                    'total' => 20145.75,
                    'average_per_reservation' => 106.60,
                    'growth_percentage' => 18.5
                ]
            ],
            'generated_at' => now()->subHours(6),
            'generated_by' => $user?->id,
            'expires_at' => now()->addDays(7)
        ]);
    }
}
