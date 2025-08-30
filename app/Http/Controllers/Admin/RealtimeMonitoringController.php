<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\NotificationEvent;
use App\Models\NotificationDelivery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RealtimeMonitoringController extends Controller
{
    /**
     * Real-time monitoring dashboard
     */
    public function dashboard()
    {
        $stats = $this->getRealtimeStats();
        
        return view('admin.monitoring.dashboard', compact('stats'));
    }

    /**
     * Get real-time statistics API
     */
    public function api(): JsonResponse
    {
        return response()->json($this->getRealtimeStats());
    }

    /**
     * Get live reservation feed
     */
    public function reservationsFeed(): JsonResponse
    {
        $reservations = Reservation::with(['restaurant'])
            ->where('created_at', '>=', now()->subHours(24))
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get()
            ->map(function ($reservation) {
                return [
                    'id' => $reservation->id,
                    'customer_name' => $reservation->name,
                    'restaurant_name' => $reservation->restaurant->name ?? 'Unknown',
                    'status' => $reservation->status,
                    'created_at' => $reservation->created_at->diffForHumans(),
                    'reservation_date' => $reservation->reservation_date,
                    'time_from' => $reservation->time_from,
                    'guests_count' => $reservation->guests_count,
                ];
            });

        return response()->json($reservations);
    }

    /**
     * Get live email activities
     */
    public function emailActivities(): JsonResponse
    {
        $activities = NotificationDelivery::with(['event'])
            ->where('created_at', '>=', now()->subHours(24))
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get()
            ->map(function ($delivery) {
                return [
                    'id' => $delivery->id,
                    'recipient_email' => $delivery->recipient_email,
                    'recipient_type' => $delivery->recipient_type,
                    'status' => $delivery->status,
                    'event_type' => $delivery->event->event_key ?? 'unknown',
                    'created_at' => $delivery->created_at->diffForHumans(),
                    'sent_at' => $delivery->sent_at?->diffForHumans(),
                ];
            });

        return response()->json($activities);
    }

    /**
     * Get queue performance metrics
     */
    public function queueMetrics(): JsonResponse
    {
        $metrics = [
            'pending_jobs' => DB::table('jobs')->count(),
            'failed_jobs' => DB::table('failed_jobs')->count(),
            'processing_rate' => $this->getProcessingRate(),
            'average_wait_time' => $this->getAverageWaitTime(),
            'hourly_throughput' => $this->getHourlyThroughput(),
        ];

        return response()->json($metrics);
    }

    /**
     * Get system health status
     */
    public function systemHealth(): JsonResponse
    {
        $health = [
            'database' => $this->checkDatabaseHealth(),
            'email_service' => $this->checkEmailServiceHealth(),
            'queue_system' => $this->checkQueueHealth(),
            'disk_space' => $this->checkDiskSpace(),
            'memory_usage' => $this->getMemoryUsage(),
        ];

        return response()->json($health);
    }

    /**
     * Get live error monitoring
     */
    public function errorMonitoring(): JsonResponse
    {
        $errors = [
            'recent_errors' => $this->getRecentErrors(),
            'error_rate' => $this->getErrorRate(),
            'top_errors' => $this->getTopErrors(),
        ];

        return response()->json($errors);
    }

    /**
     * Private helper methods
     */
    private function getRealtimeStats(): array
    {
        $today = Carbon::today();
        $now = Carbon::now();

        return [
            // Reservations
            'reservations' => [
                'total_today' => Reservation::whereDate('created_at', $today)->count(),
                'pending' => Reservation::where('status', 'Pending')->count(),
                'confirmed' => Reservation::where('status', 'Confirmed')->count(),
                'last_hour' => Reservation::where('created_at', '>=', $now->copy()->subHour())->count(),
                'conversion_rate' => $this->getConversionRate(),
            ],

            // Email System
            'emails' => [
                'sent_today' => NotificationDelivery::whereDate('created_at', $today)
                    ->where('status', 'delivered')->count(),
                'pending' => NotificationDelivery::where('status', 'pending')->count(),
                'failed' => NotificationDelivery::where('status', 'failed')->count(),
                'delivery_rate' => $this->getDeliveryRate(),
            ],

            // Queue System
            'queue' => [
                'pending_jobs' => DB::table('jobs')->count(),
                'failed_jobs' => DB::table('failed_jobs')->count(),
                'processing_rate' => $this->getProcessingRate(),
                'avg_wait_time' => $this->getAverageWaitTime(),
            ],

            // System Performance
            'performance' => [
                'response_time' => $this->getAverageResponseTime(),
                'cpu_usage' => $this->getCpuUsage(),
                'memory_usage' => $this->getMemoryUsage(),
                'error_rate' => $this->getErrorRate(),
            ],

            'timestamp' => $now->toISOString(),
        ];
    }

    private function getConversionRate(): float
    {
        $total = Reservation::whereDate('created_at', Carbon::today())->count();
        $confirmed = Reservation::whereDate('created_at', Carbon::today())
            ->where('status', 'Confirmed')->count();
            
        return $total > 0 ? round(($confirmed / $total) * 100, 2) : 0;
    }

    private function getDeliveryRate(): float
    {
        $total = NotificationDelivery::whereDate('created_at', Carbon::today())->count();
        $delivered = NotificationDelivery::whereDate('created_at', Carbon::today())
            ->where('status', 'delivered')->count();
            
        return $total > 0 ? round(($delivered / $total) * 100, 2) : 0;
    }

    private function getProcessingRate(): float
    {
        // Jobs processed in last hour
        $processed = DB::table('failed_jobs')
            ->where('failed_at', '>=', now()->subHour())
            ->count();
            
        return $processed; // Jobs per hour
    }

    private function getAverageWaitTime(): float
    {
        // Simplified calculation - would need more sophisticated tracking
        return rand(30, 120); // seconds (mock data)
    }

    private function getHourlyThroughput(): array
    {
        $hours = [];
        for ($i = 23; $i >= 0; $i--) {
            $hour = now()->subHours($i);
            $count = Reservation::whereBetween('created_at', [
                $hour->copy()->startOfHour(),
                $hour->copy()->endOfHour()
            ])->count();
            
            $hours[$hour->format('H:00')] = $count;
        }
        
        return $hours;
    }

    private function checkDatabaseHealth(): array
    {
        try {
            $start = microtime(true);
            DB::select('SELECT 1');
            $responseTime = (microtime(true) - $start) * 1000;
            
            return [
                'status' => 'healthy',
                'response_time_ms' => round($responseTime, 2),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'unhealthy',
                'error' => $e->getMessage(),
            ];
        }
    }

    private function checkEmailServiceHealth(): array
    {
        $recentFailures = NotificationDelivery::where('created_at', '>=', now()->subHour())
            ->where('status', 'failed')
            ->count();
            
        $recentTotal = NotificationDelivery::where('created_at', '>=', now()->subHour())
            ->count();
            
        $failureRate = $recentTotal > 0 ? ($recentFailures / $recentTotal) * 100 : 0;
        
        return [
            'status' => $failureRate < 10 ? 'healthy' : 'degraded',
            'failure_rate' => round($failureRate, 2),
            'recent_failures' => $recentFailures,
        ];
    }

    private function checkQueueHealth(): array
    {
        $pendingJobs = DB::table('jobs')->count();
        $failedJobs = DB::table('failed_jobs')->count();
        
        return [
            'status' => $pendingJobs < 100 ? 'healthy' : 'congested',
            'pending_jobs' => $pendingJobs,
            'failed_jobs' => $failedJobs,
        ];
    }

    private function checkDiskSpace(): array
    {
        $bytes = disk_free_space('/');
        $totalBytes = disk_total_space('/');
        $usedPercent = (($totalBytes - $bytes) / $totalBytes) * 100;
        
        return [
            'status' => $usedPercent < 90 ? 'healthy' : 'critical',
            'used_percent' => round($usedPercent, 2),
            'free_space_gb' => round($bytes / 1024 / 1024 / 1024, 2),
        ];
    }

    private function getMemoryUsage(): array
    {
        $memoryUsage = memory_get_usage(true);
        $peakMemory = memory_get_peak_usage(true);
        
        return [
            'current_mb' => round($memoryUsage / 1024 / 1024, 2),
            'peak_mb' => round($peakMemory / 1024 / 1024, 2),
        ];
    }

    private function getAverageResponseTime(): float
    {
        // Would need request logging for real implementation
        return round(rand(50, 300), 2); // Mock data in milliseconds
    }

    private function getCpuUsage(): float
    {
        // Would need system monitoring for real implementation
        return round(rand(10, 80), 2); // Mock percentage
    }

    private function getErrorRate(): float
    {
        // Would calculate from logs
        return round(rand(0, 5), 2); // Mock percentage
    }

    private function getRecentErrors(): array
    {
        // Would fetch from logs
        return [
            ['message' => 'Database connection timeout', 'count' => 3, 'last_seen' => '2 minutes ago'],
            ['message' => 'Email delivery failed', 'count' => 1, 'last_seen' => '5 minutes ago'],
        ];
    }

    private function getTopErrors(): array
    {
        return [
            'Database timeout' => 15,
            'Email sending failed' => 8,
            'Queue job timeout' => 5,
        ];
    }
}
