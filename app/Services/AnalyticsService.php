<?php

namespace App\Services;

use App\Models\BOGTransaction;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Enums\ReservationStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AnalyticsService
{
    /**
     * Get dashboard overview analytics
     */
    public function getDashboardOverview(string $fromDate, string $toDate, ?int $restaurantId = null): array
    {
        $cacheKey = "dashboard_overview_{$fromDate}_{$toDate}_{$restaurantId}";
        
        return Cache::remember($cacheKey, 300, function () use ($fromDate, $toDate, $restaurantId) {
            $baseQuery = Reservation::whereBetween('created_at', [$fromDate, $toDate]);
            
            if ($restaurantId) {
                $baseQuery->where('reservable_type', 'App\\Models\\Restaurant')
                         ->where('reservable_id', $restaurantId);
            }

            $totalReservations = $baseQuery->count();
            $confirmedReservations = (clone $baseQuery)->where('status', ReservationStatus::Confirmed)->count();
            $cancelledReservations = (clone $baseQuery)->where('status', ReservationStatus::Cancelled)->count();
            $pendingReservations = (clone $baseQuery)->where('status', ReservationStatus::Pending)->count();

            // BOG Payment Statistics
            $bogQuery = BOGTransaction::whereBetween('created_at', [$fromDate, $toDate]);
            if ($restaurantId) {
                $bogQuery->whereHas('reservation', function ($q) use ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                });
            }

            $totalTransactions = $bogQuery->count();
            $successfulTransactions = (clone $bogQuery)->where('status', 'success')->count();
            $failedTransactions = (clone $bogQuery)->where('status', 'failed')->count();
            $totalRevenue = (clone $bogQuery)->where('status', 'success')->sum('amount');

            // Conversion rates
            $conversionRate = $totalReservations > 0 ? ($confirmedReservations / $totalReservations) * 100 : 0;
            $paymentSuccessRate = $totalTransactions > 0 ? ($successfulTransactions / $totalTransactions) * 100 : 0;

            // Previous period comparison
            $previousFromDate = Carbon::parse($fromDate)->subDays(Carbon::parse($toDate)->diffInDays(Carbon::parse($fromDate)))->toDateString();
            $previousToDate = Carbon::parse($fromDate)->subDay()->toDateString();

            $previousReservations = Reservation::whereBetween('created_at', [$previousFromDate, $previousToDate]);
            if ($restaurantId) {
                $previousReservations->where('reservable_type', 'App\\Models\\Restaurant')
                                   ->where('reservable_id', $restaurantId);
            }
            $previousTotalReservations = $previousReservations->count();

            $previousRevenue = BOGTransaction::whereBetween('created_at', [$previousFromDate, $previousToDate])
                ->where('status', 'success');
            if ($restaurantId) {
                $previousRevenue->whereHas('reservation', function ($q) use ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                });
            }
            $previousTotalRevenue = $previousRevenue->sum('amount');

            // Growth calculations
            $reservationGrowth = $previousTotalReservations > 0 
                ? (($totalReservations - $previousTotalReservations) / $previousTotalReservations) * 100 
                : 0;

            $revenueGrowth = $previousTotalRevenue > 0 
                ? (($totalRevenue - $previousTotalRevenue) / $previousTotalRevenue) * 100 
                : 0;

            return [
                'reservations' => [
                    'total' => $totalReservations,
                    'confirmed' => $confirmedReservations,
                    'cancelled' => $cancelledReservations,
                    'pending' => $pendingReservations,
                    'conversion_rate' => round($conversionRate, 2),
                    'growth_percentage' => round($reservationGrowth, 2)
                ],
                'payments' => [
                    'total_transactions' => $totalTransactions,
                    'successful_transactions' => $successfulTransactions,
                    'failed_transactions' => $failedTransactions,
                    'success_rate' => round($paymentSuccessRate, 2),
                    'total_revenue' => $totalRevenue
                ],
                'revenue' => [
                    'total' => $totalRevenue,
                    'average_per_reservation' => $confirmedReservations > 0 ? $totalRevenue / $confirmedReservations : 0,
                    'growth_percentage' => round($revenueGrowth, 2)
                ]
            ];
        });
    }

    /**
     * Get BOG payment analytics
     */
    public function getBOGPaymentAnalytics(string $fromDate, string $toDate, ?int $restaurantId = null, string $period = 'day'): array
    {
        $cacheKey = "bog_analytics_{$fromDate}_{$toDate}_{$restaurantId}_{$period}";
        
        return Cache::remember($cacheKey, 300, function () use ($fromDate, $toDate, $restaurantId, $period) {
            $query = BOGTransaction::whereBetween('created_at', [$fromDate, $toDate]);

            if ($restaurantId) {
                $query->whereHas('reservation', function ($q) use ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                });
            }

            // Time series data
            $timeSeries = $this->getTimeSeriesData($query, $fromDate, $toDate, $period, [
                'total_transactions' => 'count',
                'successful_transactions' => function ($q) { return $q->where('status', 'success')->count(); },
                'failed_transactions' => function ($q) { return $q->where('status', 'failed')->count(); },
                'revenue' => function ($q) { return $q->where('status', 'success')->sum('amount'); }
            ]);

            // Status breakdown
            $statusBreakdown = $query->groupBy('status')
                ->selectRaw('status, count(*) as count, sum(amount) as total_amount')
                ->get()
                ->keyBy('status');

            // Payment method analytics
            $paymentMethods = $query->where('status', 'success')
                ->selectRaw('
                    COUNT(*) as transaction_count,
                    SUM(amount) as total_amount,
                    AVG(amount) as average_amount
                ')
                ->first();

            // Error analysis
            $errorAnalysis = $query->where('status', 'failed')
                ->whereNotNull('error_message')
                ->selectRaw('error_message, count(*) as count')
                ->groupBy('error_message')
                ->orderByDesc('count')
                ->limit(10)
                ->get();

            return [
                'time_series' => $timeSeries,
                'status_breakdown' => $statusBreakdown,
                'payment_methods' => $paymentMethods,
                'error_analysis' => $errorAnalysis,
                'summary' => [
                    'total_transactions' => $query->count(),
                    'success_rate' => $this->calculateSuccessRate($query),
                    'total_revenue' => $query->where('status', 'success')->sum('amount'),
                    'average_transaction_amount' => $query->where('status', 'success')->avg('amount')
                ]
            ];
        });
    }

    /**
     * Get reservation analytics
     */
    public function getReservationAnalytics(string $fromDate, string $toDate, ?int $restaurantId = null, string $period = 'day', array $statuses = []): array
    {
        $cacheKey = "reservation_analytics_{$fromDate}_{$toDate}_{$restaurantId}_{$period}_" . md5(serialize($statuses));
        
        return Cache::remember($cacheKey, 300, function () use ($fromDate, $toDate, $restaurantId, $period, $statuses) {
            $query = Reservation::whereBetween('reservation_date', [$fromDate, $toDate]);

            if ($restaurantId) {
                $query->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
            }

            if (!empty($statuses)) {
                $query->whereIn('status', $statuses);
            }

            // Time series data
            $timeSeries = $this->getTimeSeriesData($query, $fromDate, $toDate, $period, [
                'total_reservations' => 'count',
                'confirmed_reservations' => function ($q) { return $q->where('status', ReservationStatus::Confirmed)->count(); },
                'cancelled_reservations' => function ($q) { return $q->where('status', ReservationStatus::Cancelled)->count(); },
                'total_guests' => function ($q) { return $q->sum('guests_count'); }
            ]);

            // Status distribution
            $statusDistribution = $query->groupBy('status')
                ->selectRaw('status, count(*) as count')
                ->get()
                ->keyBy('status');

            // Guest count analysis
            $guestAnalysis = $query->selectRaw('
                AVG(guests_count) as average_guests,
                MIN(guests_count) as min_guests,
                MAX(guests_count) as max_guests,
                SUM(guests_count) as total_guests
            ')->first();

            // Peak hours analysis
            $peakHours = $query->selectRaw('
                HOUR(time_from) as hour,
                COUNT(*) as reservation_count,
                AVG(guests_count) as avg_guests
            ')
            ->groupBy('hour')
            ->orderByDesc('reservation_count')
            ->get();

            // Day of week analysis
            $dayOfWeekAnalysis = $query->selectRaw('
                DAYOFWEEK(reservation_date) as day_of_week,
                COUNT(*) as reservation_count,
                AVG(guests_count) as avg_guests
            ')
            ->groupBy('day_of_week')
            ->get();

            return [
                'time_series' => $timeSeries,
                'status_distribution' => $statusDistribution,
                'guest_analysis' => $guestAnalysis,
                'peak_hours' => $peakHours,
                'day_of_week_analysis' => $dayOfWeekAnalysis,
                'summary' => [
                    'total_reservations' => $query->count(),
                    'conversion_rate' => $this->calculateConversionRate($query),
                    'average_guests_per_reservation' => $guestAnalysis->average_guests ?? 0,
                    'total_guests_served' => $guestAnalysis->total_guests ?? 0
                ]
            ];
        });
    }

    /**
     * Get revenue analytics
     */
    public function getRevenueAnalytics(string $fromDate, string $toDate, ?int $restaurantId = null, string $period = 'day', bool $includeProjections = false): array
    {
        $cacheKey = "revenue_analytics_{$fromDate}_{$toDate}_{$restaurantId}_{$period}_{$includeProjections}";
        
        return Cache::remember($cacheKey, 300, function () use ($fromDate, $toDate, $restaurantId, $period, $includeProjections) {
            $query = BOGTransaction::whereBetween('paid_at', [$fromDate, $toDate])
                ->where('status', 'success');

            if ($restaurantId) {
                $query->whereHas('reservation', function ($q) use ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                });
            }

            // Time series data
            $timeSeries = $this->getTimeSeriesData($query, $fromDate, $toDate, $period, [
                'revenue' => function ($q) { return $q->sum('amount'); },
                'transaction_count' => 'count',
                'average_transaction' => function ($q) { return $q->avg('amount'); }
            ]);

            // Revenue breakdown by restaurant
            $revenueByRestaurant = BOGTransaction::whereBetween('paid_at', [$fromDate, $toDate])
                ->where('status', 'success')
                ->with(['reservation.reservable'])
                ->get()
                ->groupBy(function ($transaction) {
                    return $transaction->reservation->reservable->name ?? 'Unknown';
                })
                ->map(function ($transactions) {
                    return [
                        'revenue' => $transactions->sum('amount'),
                        'transaction_count' => $transactions->count(),
                        'average_transaction' => $transactions->avg('amount')
                    ];
                });

            // Revenue trends
            $previousPeriodQuery = BOGTransaction::whereBetween('paid_at', [
                Carbon::parse($fromDate)->subDays(Carbon::parse($toDate)->diffInDays(Carbon::parse($fromDate))),
                Carbon::parse($fromDate)->subDay()
            ])->where('status', 'success');

            if ($restaurantId) {
                $previousPeriodQuery->whereHas('reservation', function ($q) use ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                });
            }

            $currentRevenue = $query->sum('amount');
            $previousRevenue = $previousPeriodQuery->sum('amount');
            $revenueGrowth = $previousRevenue > 0 ? (($currentRevenue - $previousRevenue) / $previousRevenue) * 100 : 0;

            $result = [
                'time_series' => $timeSeries,
                'revenue_by_restaurant' => $revenueByRestaurant,
                'summary' => [
                    'total_revenue' => $currentRevenue,
                    'previous_period_revenue' => $previousRevenue,
                    'growth_percentage' => round($revenueGrowth, 2),
                    'average_daily_revenue' => $currentRevenue / Carbon::parse($toDate)->diffInDays(Carbon::parse($fromDate)),
                    'total_transactions' => $query->count(),
                    'average_transaction_value' => $query->avg('amount')
                ]
            ];

            // Add projections if requested
            if ($includeProjections) {
                $result['projections'] = $this->calculateRevenueProjections($currentRevenue, $revenueGrowth, $fromDate, $toDate);
            }

            return $result;
        });
    }

    /**
     * Get top performing restaurants
     */
    public function getTopRestaurants(string $fromDate, string $toDate, string $metric = 'revenue', int $limit = 10): array
    {
        $cacheKey = "top_restaurants_{$fromDate}_{$toDate}_{$metric}_{$limit}";
        
        return Cache::remember($cacheKey, 300, function () use ($fromDate, $toDate, $metric, $limit) {
            $query = Restaurant::with(['reservations' => function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('created_at', [$fromDate, $toDate]);
            }]);

            switch ($metric) {
                case 'revenue':
                    $query->withSum(['reservations as total_revenue' => function ($q) use ($fromDate, $toDate) {
                        $q->whereBetween('created_at', [$fromDate, $toDate])
                          ->whereHas('bogTransactions', function ($tq) {
                              $tq->where('status', 'success');
                          });
                    }], 'bogTransactions.amount')
                    ->orderByDesc('total_revenue');
                    break;

                case 'reservations':
                    $query->withCount(['reservations' => function ($q) use ($fromDate, $toDate) {
                        $q->whereBetween('created_at', [$fromDate, $toDate]);
                    }])
                    ->orderByDesc('reservations_count');
                    break;

                case 'conversion_rate':
                    $query->withCount([
                        'reservations' => function ($q) use ($fromDate, $toDate) {
                            $q->whereBetween('created_at', [$fromDate, $toDate]);
                        },
                        'reservations as confirmed_reservations_count' => function ($q) use ($fromDate, $toDate) {
                            $q->whereBetween('created_at', [$fromDate, $toDate])
                              ->where('status', ReservationStatus::Confirmed);
                        }
                    ]);
                    break;
            }

            $restaurants = $query->limit($limit)->get();

            if ($metric === 'conversion_rate') {
                $restaurants = $restaurants->map(function ($restaurant) {
                    $restaurant->conversion_rate = $restaurant->reservations_count > 0 
                        ? ($restaurant->confirmed_reservations_count / $restaurant->reservations_count) * 100 
                        : 0;
                    return $restaurant;
                })->sortByDesc('conversion_rate');
            }

            return $restaurants->values();
        });
    }

    /**
     * Get conversion funnel analytics
     */
    public function getConversionFunnel(string $fromDate, string $toDate, ?int $restaurantId = null): array
    {
        $cacheKey = "conversion_funnel_{$fromDate}_{$toDate}_{$restaurantId}";
        
        return Cache::remember($cacheKey, 300, function () use ($fromDate, $toDate, $restaurantId) {
            $reservationQuery = Reservation::whereBetween('created_at', [$fromDate, $toDate]);
            
            if ($restaurantId) {
                $reservationQuery->where('reservable_type', 'App\\Models\\Restaurant')
                               ->where('reservable_id', $restaurantId);
            }

            $totalReservations = $reservationQuery->count();
            $pendingReservations = (clone $reservationQuery)->where('status', ReservationStatus::Pending)->count();
            $confirmedReservations = (clone $reservationQuery)->where('status', ReservationStatus::Confirmed)->count();
            
            $paymentInitiated = BOGTransaction::whereHas('reservation', function ($q) use ($fromDate, $toDate, $restaurantId) {
                $q->whereBetween('created_at', [$fromDate, $toDate]);
                if ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                }
            })->count();

            $paymentCompleted = BOGTransaction::whereHas('reservation', function ($q) use ($fromDate, $toDate, $restaurantId) {
                $q->whereBetween('created_at', [$fromDate, $toDate]);
                if ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                }
            })->where('status', 'success')->count();

            return [
                'steps' => [
                    [
                        'name' => 'Reservation Created',
                        'count' => $totalReservations,
                        'percentage' => 100,
                        'drop_off' => 0
                    ],
                    [
                        'name' => 'Payment Initiated',
                        'count' => $paymentInitiated,
                        'percentage' => $totalReservations > 0 ? ($paymentInitiated / $totalReservations) * 100 : 0,
                        'drop_off' => $totalReservations - $paymentInitiated
                    ],
                    [
                        'name' => 'Payment Completed',
                        'count' => $paymentCompleted,
                        'percentage' => $totalReservations > 0 ? ($paymentCompleted / $totalReservations) * 100 : 0,
                        'drop_off' => $paymentInitiated - $paymentCompleted
                    ],
                    [
                        'name' => 'Reservation Confirmed',
                        'count' => $confirmedReservations,
                        'percentage' => $totalReservations > 0 ? ($confirmedReservations / $totalReservations) * 100 : 0,
                        'drop_off' => $paymentCompleted - $confirmedReservations
                    ]
                ],
                'overall_conversion_rate' => $totalReservations > 0 ? ($confirmedReservations / $totalReservations) * 100 : 0,
                'payment_conversion_rate' => $paymentInitiated > 0 ? ($paymentCompleted / $paymentInitiated) * 100 : 0
            ];
        });
    }

    /**
     * Get real-time analytics
     */
    public function getRealTimeAnalytics(?int $restaurantId = null, int $hours = 24): array
    {
        $fromTime = now()->subHours($hours);
        
        $reservationQuery = Reservation::where('created_at', '>=', $fromTime);
        $transactionQuery = BOGTransaction::where('created_at', '>=', $fromTime);

        if ($restaurantId) {
            $reservationQuery->where('reservable_type', 'App\\Models\\Restaurant')
                           ->where('reservable_id', $restaurantId);
            
            $transactionQuery->whereHas('reservation', function ($q) use ($restaurantId) {
                $q->where('reservable_type', 'App\\Models\\Restaurant')
                  ->where('reservable_id', $restaurantId);
            });
        }

        return [
            'current_hour' => [
                'reservations' => $reservationQuery->where('created_at', '>=', now()->startOfHour())->count(),
                'revenue' => $transactionQuery->where('created_at', '>=', now()->startOfHour())->where('status', 'success')->sum('amount'),
                'successful_payments' => $transactionQuery->where('created_at', '>=', now()->startOfHour())->where('status', 'success')->count()
            ],
            'last_24_hours' => [
                'reservations' => $reservationQuery->count(),
                'revenue' => $transactionQuery->where('status', 'success')->sum('amount'),
                'successful_payments' => $transactionQuery->where('status', 'success')->count(),
                'failed_payments' => $transactionQuery->where('status', 'failed')->count()
            ],
            'hourly_breakdown' => $this->getHourlyBreakdown($fromTime, $restaurantId)
        ];
    }

    /**
     * Export analytics data
     */
    public function exportAnalytics(string $type, string $fromDate, string $toDate, ?int $restaurantId = null, string $format = 'csv'): string
    {
        // This would integrate with Laravel Excel or similar export library
        // For now, returning a placeholder URL
        $filename = "{$type}_analytics_{$fromDate}_to_{$toDate}.{$format}";
        
        // Generate and store the export file
        // Return the download URL
        return route('analytics.download', ['filename' => $filename]);
    }

    /**
     * Helper method to get time series data
     */
    private function getTimeSeriesData($query, string $fromDate, string $toDate, string $period, array $metrics): array
    {
        $carbonFromDate = Carbon::parse($fromDate);
        $carbonToDate = Carbon::parse($toDate);
        
        $periodFormat = match($period) {
            'hour' => '%Y-%m-%d %H:00:00',
            'day' => '%Y-%m-%d',
            'week' => '%Y-%u',
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m-%d'
        };

        $result = [];
        $carbonPeriod = CarbonPeriod::create($carbonFromDate, "1 {$period}", $carbonToDate);

        foreach ($carbonPeriod as $date) {
            $periodStart = $date->copy();
            $periodEnd = match($period) {
                'hour' => $periodStart->copy()->endOfHour(),
                'day' => $periodStart->copy()->endOfDay(),
                'week' => $periodStart->copy()->endOfWeek(),
                'month' => $periodStart->copy()->endOfMonth(),
                'year' => $periodStart->copy()->endOfYear(),
                default => $periodStart->copy()->endOfDay()
            };

            $periodData = ['period' => $periodStart->format($period === 'week' ? 'Y-W' : 'Y-m-d')];
            
            foreach ($metrics as $metricName => $metricCallback) {
                $periodQuery = clone $query;
                $periodQuery->whereBetween('created_at', [$periodStart, $periodEnd]);
                
                if (is_callable($metricCallback)) {
                    $periodData[$metricName] = $metricCallback($periodQuery);
                } else {
                    $periodData[$metricName] = $periodQuery->count();
                }
            }
            
            $result[] = $periodData;
        }

        return $result;
    }

    /**
     * Calculate success rate for BOG transactions
     */
    private function calculateSuccessRate($query): float
    {
        $total = $query->count();
        if ($total === 0) return 0;
        
        $successful = $query->where('status', 'success')->count();
        return round(($successful / $total) * 100, 2);
    }

    /**
     * Calculate conversion rate for reservations
     */
    private function calculateConversionRate($query): float
    {
        $total = $query->count();
        if ($total === 0) return 0;
        
        $confirmed = $query->where('status', ReservationStatus::Confirmed)->count();
        return round(($confirmed / $total) * 100, 2);
    }

    /**
     * Calculate revenue projections
     */
    private function calculateRevenueProjections(float $currentRevenue, float $growthRate, string $fromDate, string $toDate): array
    {
        $periodDays = Carbon::parse($toDate)->diffInDays(Carbon::parse($fromDate));
        $dailyAverage = $currentRevenue / $periodDays;
        
        return [
            'next_month' => $dailyAverage * 30 * (1 + $growthRate / 100),
            'next_quarter' => $dailyAverage * 90 * (1 + $growthRate / 100),
            'next_year' => $dailyAverage * 365 * (1 + $growthRate / 100)
        ];
    }

    /**
     * Get hourly breakdown for real-time analytics
     */
    private function getHourlyBreakdown(Carbon $fromTime, ?int $restaurantId = null): array
    {
        $hours = [];
        
        for ($i = 23; $i >= 0; $i--) {
            $hourStart = now()->subHours($i)->startOfHour();
            $hourEnd = $hourStart->copy()->endOfHour();
            
            $reservationQuery = Reservation::whereBetween('created_at', [$hourStart, $hourEnd]);
            $transactionQuery = BOGTransaction::whereBetween('created_at', [$hourStart, $hourEnd]);
            
            if ($restaurantId) {
                $reservationQuery->where('reservable_type', 'App\\Models\\Restaurant')
                               ->where('reservable_id', $restaurantId);
                
                $transactionQuery->whereHas('reservation', function ($q) use ($restaurantId) {
                    $q->where('reservable_type', 'App\\Models\\Restaurant')
                      ->where('reservable_id', $restaurantId);
                });
            }
            
            $hours[] = [
                'hour' => $hourStart->format('H:00'),
                'reservations' => $reservationQuery->count(),
                'revenue' => $transactionQuery->where('status', 'success')->sum('amount'),
                'successful_payments' => $transactionQuery->where('status', 'success')->count()
            ];
        }
        
        return $hours;
    }
}
