<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationEvent;
use App\Models\NotificationDelivery;
use App\Models\NotificationTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Get notification dashboard statistics
     */
    public function dashboard(): JsonResponse
    {
        $stats = [
            'events' => $this->getEventStats(),
            'deliveries' => $this->getDeliveryStats(),
            'recent_activity' => $this->getRecentActivity(),
            'performance' => $this->getPerformanceStats(),
        ];

        return response()->json($stats);
    }

    /**
     * Get notification events with pagination
     */
    public function events(Request $request): JsonResponse
    {
        $query = NotificationEvent::with(['deliveries', 'reservation'])
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('event_key')) {
            $query->where('event_key', $request->event_key);
        }

        if ($request->has('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        $events = $query->paginate(
            config('notifications.admin.pagination', 50)
        );

        return response()->json($events);
    }

    /**
     * Get single notification event details
     */
    public function show(NotificationEvent $event): JsonResponse
    {
        $event->load(['deliveries', 'reservation.restaurant']);

        return response()->json([
            'event' => $event,
            'deliveries' => $event->deliveries->map(function ($delivery) {
                return [
                    'id' => $delivery->id,
                    'recipient_email' => $delivery->recipient_email,
                    'recipient_type' => $delivery->recipient_type,
                    'status' => $delivery->status,
                    'template_id' => $delivery->template_id,
                    'provider_message_id' => $delivery->provider_message_id,
                    'sent_at' => $delivery->sent_at,
                    'delivered_at' => $delivery->delivered_at,
                    'opened_at' => $delivery->opened_at,
                    'clicked_at' => $delivery->clicked_at,
                    'error_message' => $delivery->error_message,
                    'created_at' => $delivery->created_at,
                ];
            }),
        ]);
    }

    /**
     * Get notification deliveries with pagination
     */
    public function deliveries(Request $request): JsonResponse
    {
        $query = NotificationDelivery::with(['notificationEvent'])
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('recipient_type')) {
            $query->where('recipient_type', $request->recipient_type);
        }

        if ($request->has('email')) {
            $query->where('recipient_email', 'like', '%' . $request->email . '%');
        }

        $deliveries = $query->paginate(
            config('notifications.admin.pagination', 50)
        );

        return response()->json($deliveries);
    }

    /**
     * Retry failed notification event
     */
    public function retry(NotificationEvent $event): JsonResponse
    {
        if ($event->status !== NotificationEvent::STATUS_FAILED) {
            return response()->json([
                'error' => 'Only failed events can be retried'
            ], 400);
        }

        // Reset event status to pending
        $event->update([
            'status' => NotificationEvent::STATUS_PENDING,
            'error_message' => null,
        ]);

        // Dispatch job to process again
        \App\Jobs\ProcessNotificationEvent::dispatch($event->id)
            ->onQueue(config('notifications.queue.name', 'emails'));

        return response()->json([
            'message' => 'Event queued for retry',
            'event_id' => $event->id,
        ]);
    }

    /**
     * Get notification templates
     */
    public function templates(): JsonResponse
    {
        $templates = NotificationTemplate::orderBy('event_key')
            ->orderBy('recipient_type')
            ->get();

        return response()->json($templates);
    }

    /**
     * Get event statistics
     */
    private function getEventStats(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $last7Days = Carbon::now()->subDays(7);

        return [
            'total' => NotificationEvent::count(),
            'today' => NotificationEvent::whereDate('created_at', $today)->count(),
            'yesterday' => NotificationEvent::whereDate('created_at', $yesterday)->count(),
            'last_7_days' => NotificationEvent::where('created_at', '>=', $last7Days)->count(),
            'by_status' => NotificationEvent::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray(),
            'by_event_key' => NotificationEvent::selectRaw('event_key, COUNT(*) as count')
                ->where('created_at', '>=', $last7Days)
                ->groupBy('event_key')
                ->pluck('count', 'event_key')
                ->toArray(),
        ];
    }

    /**
     * Get delivery statistics
     */
    private function getDeliveryStats(): array
    {
        $today = Carbon::today();
        $last7Days = Carbon::now()->subDays(7);

        return [
            'total' => NotificationDelivery::count(),
            'today' => NotificationDelivery::whereDate('created_at', $today)->count(),
            'last_7_days' => NotificationDelivery::where('created_at', '>=', $last7Days)->count(),
            'by_status' => NotificationDelivery::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray(),
            'by_recipient_type' => NotificationDelivery::selectRaw('recipient_type, COUNT(*) as count')
                ->where('created_at', '>=', $last7Days)
                ->groupBy('recipient_type')
                ->pluck('count', 'recipient_type')
                ->toArray(),
            'success_rate' => $this->calculateSuccessRate(),
        ];
    }

    /**
     * Get recent activity
     */
    private function getRecentActivity(): array
    {
        $recentEvents = NotificationEvent::with(['deliveries'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'event_key' => $event->event_key,
                    'status' => $event->status,
                    'reservation_id' => $event->reservation_id,
                    'deliveries_count' => $event->deliveries->count(),
                    'created_at' => $event->created_at,
                ];
            });

        return $recentEvents->toArray();
    }

    /**
     * Get performance statistics
     */
    private function getPerformanceStats(): array
    {
        $last24Hours = Carbon::now()->subHours(24);

        // Average processing time for completed events
        $avgProcessingTime = NotificationEvent::where('status', NotificationEvent::STATUS_COMPLETED)
            ->where('created_at', '>=', $last24Hours)
            ->whereNotNull('processed_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, processed_at)) as avg_seconds')
            ->value('avg_seconds');

        // Delivery rates by hour (last 24 hours)
        $hourlyDeliveries = NotificationDelivery::where('created_at', '>=', $last24Hours)
            ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour')
            ->toArray();

        return [
            'avg_processing_time_seconds' => round($avgProcessingTime ?? 0, 2),
            'hourly_deliveries' => $hourlyDeliveries,
            'failed_events_last_24h' => NotificationEvent::where('status', NotificationEvent::STATUS_FAILED)
                ->where('created_at', '>=', $last24Hours)
                ->count(),
            'bounce_rate' => $this->calculateBounceRate(),
        ];
    }

    /**
     * Calculate email delivery success rate
     */
    private function calculateSuccessRate(): float
    {
        $total = NotificationDelivery::count();
        
        if ($total === 0) {
            return 100.0;
        }

        $successful = NotificationDelivery::whereIn('status', [
            NotificationDelivery::STATUS_SENT,
            NotificationDelivery::STATUS_DELIVERED,
            NotificationDelivery::STATUS_OPENED,
            NotificationDelivery::STATUS_CLICKED,
        ])->count();

        return round(($successful / $total) * 100, 2);
    }

    /**
     * Calculate email bounce rate
     */
    private function calculateBounceRate(): float
    {
        $total = NotificationDelivery::count();
        
        if ($total === 0) {
            return 0.0;
        }

        $bounced = NotificationDelivery::whereIn('status', [
            NotificationDelivery::STATUS_BOUNCED,
            NotificationDelivery::STATUS_DROPPED,
        ])->count();

        return round(($bounced / $total) * 100, 2);
    }
}
