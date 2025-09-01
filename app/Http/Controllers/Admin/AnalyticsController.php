<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use App\Models\AnalyticsReport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    protected AnalyticsService $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    /**
     * Get dashboard overview analytics
     */
    public function dashboard(Request $request): JsonResponse
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'restaurant_id' => 'nullable|exists:restaurants,id'
        ]);

        $fromDate = $request->get('from_date', now()->startOfMonth());
        $toDate = $request->get('to_date', now()->endOfMonth());
        $restaurantId = $request->get('restaurant_id');

        $overview = $this->analyticsService->getDashboardOverview($fromDate, $toDate, $restaurantId);

        return response()->json([
            'success' => true,
            'data' => $overview
        ]);
    }

    /**
     * Get BOG payment analytics
     */
    public function bogPaymentAnalytics(Request $request): JsonResponse
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'period' => 'nullable|in:day,week,month,year'
        ]);

        $fromDate = $request->get('from_date', now()->startOfMonth());
        $toDate = $request->get('to_date', now()->endOfMonth());
        $restaurantId = $request->get('restaurant_id');
        $period = $request->get('period', 'day');

        $analytics = $this->analyticsService->getBOGPaymentAnalytics($fromDate, $toDate, $restaurantId, $period);

        return response()->json([
            'success' => true,
            'data' => $analytics
        ]);
    }

    /**
     * Get reservation analytics
     */
    public function reservationAnalytics(Request $request): JsonResponse
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'period' => 'nullable|in:day,week,month,year',
            'status' => 'nullable|array',
            'status.*' => 'string'
        ]);

        $fromDate = $request->get('from_date', now()->startOfMonth());
        $toDate = $request->get('to_date', now()->endOfMonth());
        $restaurantId = $request->get('restaurant_id');
        $period = $request->get('period', 'day');
        $statuses = $request->get('status', []);

        $analytics = $this->analyticsService->getReservationAnalytics($fromDate, $toDate, $restaurantId, $period, $statuses);

        return response()->json([
            'success' => true,
            'data' => $analytics
        ]);
    }

    /**
     * Get revenue analytics
     */
    public function revenueAnalytics(Request $request): JsonResponse
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'period' => 'nullable|in:day,week,month,year',
            'include_projections' => 'nullable|boolean'
        ]);

        $fromDate = $request->get('from_date', now()->startOfMonth());
        $toDate = $request->get('to_date', now()->endOfMonth());
        $restaurantId = $request->get('restaurant_id');
        $period = $request->get('period', 'day');
        $includeProjections = $request->get('include_projections', false);

        $analytics = $this->analyticsService->getRevenueAnalytics($fromDate, $toDate, $restaurantId, $period, $includeProjections);

        return response()->json([
            'success' => true,
            'data' => $analytics
        ]);
    }

    /**
     * Get top performing restaurants
     */
    public function topRestaurants(Request $request): JsonResponse
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'metric' => 'nullable|in:revenue,reservations,conversion_rate',
            'limit' => 'nullable|integer|min:1|max:50'
        ]);

        $fromDate = $request->get('from_date', now()->startOfMonth());
        $toDate = $request->get('to_date', now()->endOfMonth());
        $metric = $request->get('metric', 'revenue');
        $limit = $request->get('limit', 10);

        $topRestaurants = $this->analyticsService->getTopRestaurants($fromDate, $toDate, $metric, $limit);

        return response()->json([
            'success' => true,
            'data' => $topRestaurants
        ]);
    }

    /**
     * Export analytics data
     */
    public function export(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:bog_payments,reservations,revenue,overview',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'format' => 'nullable|in:csv,xlsx,pdf'
        ]);

        $type = $request->get('type');
        $filters = [
            'from_date' => $request->get('from_date', now()->startOfMonth()->toDateString()),
            'to_date' => $request->get('to_date', now()->endOfMonth()->toDateString()),
            'restaurant_id' => $request->get('restaurant_id'),
            'period' => $request->get('period', 'day'),
            'status' => $request->get('status', []),
            'include_projections' => $request->get('include_projections', false)
        ];
        $format = $request->get('format', 'csv');
        $userId = Auth::id();

        // Dispatch job to generate report
        \App\Jobs\GenerateAnalyticsReport::dispatch($type, $filters, $userId, $format);

        return response()->json([
            'success' => true,
            'message' => 'Report generation started. You will receive a notification when it\'s ready.',
            'data' => [
                'estimated_completion' => now()->addMinutes(5)->toISOString()
            ]
        ]);
    }

    /**
     * Get conversion funnel analytics
     */
    public function conversionFunnel(Request $request): JsonResponse
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'restaurant_id' => 'nullable|exists:restaurants,id'
        ]);

        $fromDate = $request->get('from_date', now()->startOfMonth());
        $toDate = $request->get('to_date', now()->endOfMonth());
        $restaurantId = $request->get('restaurant_id');

        $funnel = $this->analyticsService->getConversionFunnel($fromDate, $toDate, $restaurantId);

        return response()->json([
            'success' => true,
            'data' => $funnel
        ]);
    }

    /**
     * Get real-time analytics
     */
    public function realTimeAnalytics(Request $request): JsonResponse
    {
        $request->validate([
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'hours' => 'nullable|integer|min:1|max:24'
        ]);

        $restaurantId = $request->get('restaurant_id');
        $hours = $request->get('hours', 24);

        $realTime = $this->analyticsService->getRealTimeAnalytics($restaurantId, $hours);

        return response()->json([
            'success' => true,
            'data' => $realTime
        ]);
    }

    /**
     * Download analytics report
     */
    public function download(AnalyticsReport $report)
    {
        if ($report->isExpired()) {
            return response()->json([
                'success' => false,
                'message' => 'Report has expired'
            ], 410);
        }

        if (!$report->file_path || !Storage::exists($report->file_path)) {
            return response()->json([
                'success' => false,
                'message' => 'Report file not found'
            ], 404);
        }

        return Storage::download($report->file_path, $report->name . '.' . pathinfo($report->file_path, PATHINFO_EXTENSION));
    }
}
