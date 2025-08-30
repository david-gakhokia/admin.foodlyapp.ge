<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QueueController extends Controller
{
    public function dashboard()
    {
        // Queue Jobs Statistics
        $stats = [
            'pending' => DB::table('jobs')->count(),
            'failed' => DB::table('failed_jobs')->count(),
            'processed_today' => $this->getProcessedToday(),
            'total_processed' => $this->getTotalProcessed(),
        ];

        // Recent Jobs
        $recentJobs = DB::table('jobs')
            ->select('id', 'queue', 'payload', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Failed Jobs
        $failedJobs = DB::table('failed_jobs')
            ->select('id', 'queue', 'payload', 'exception', 'failed_at')
            ->orderBy('failed_at', 'desc')
            ->limit(10)
            ->get();

        // Queue Performance (last 24 hours)
        $performance = $this->getQueuePerformance();

        return view('admin.queue.dashboard', compact(
            'stats', 
            'recentJobs', 
            'failedJobs', 
            'performance'
        ));
    }

    public function jobs(Request $request)
    {
        $query = DB::table('jobs')
            ->select('id', 'queue', 'payload', 'attempts', 'created_at', 'available_at');

        if ($request->filled('queue')) {
            $query->where('queue', $request->queue);
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(50);

        // Decode payload for better display
        $jobs->getCollection()->transform(function ($job) {
            $payload = json_decode($job->payload, true);
            $job->display_name = $payload['displayName'] ?? 'Unknown Job';
            $job->job_class = $payload['job'] ?? 'Unknown';
            return $job;
        });

        return view('admin.queue.jobs', compact('jobs'));
    }

    public function failed(Request $request)
    {
        $query = DB::table('failed_jobs')
            ->select('id', 'uuid', 'connection', 'queue', 'payload', 'exception', 'failed_at');

        if ($request->filled('queue')) {
            $query->where('queue', $request->queue);
        }

        $failedJobs = $query->orderBy('failed_at', 'desc')->paginate(50);

        // Decode payload for better display
        $failedJobs->getCollection()->transform(function ($job) {
            $payload = json_decode($job->payload, true);
            $job->display_name = $payload['displayName'] ?? 'Unknown Job';
            $job->job_class = $payload['job'] ?? 'Unknown';
            $job->short_exception = $this->truncateException($job->exception);
            return $job;
        });

        return view('admin.queue.failed', compact('failedJobs'));
    }

    public function retryFailed($id)
    {
        try {
            \Artisan::call('queue:retry', ['id' => [$id]]);
            return redirect()->back()->with('success', 'Failed job queued for retry successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to retry job: ' . $e->getMessage());
        }
    }

    public function deleteFailed($id)
    {
        try {
            \Artisan::call('queue:forget', ['id' => $id]);
            return redirect()->back()->with('success', 'Failed job deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete job: ' . $e->getMessage());
        }
    }

    public function clearFailed()
    {
        try {
            \Artisan::call('queue:flush');
            return redirect()->back()->with('success', 'All failed jobs cleared successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear jobs: ' . $e->getMessage());
        }
    }

    public function restart()
    {
        try {
            \Artisan::call('queue:restart');
            return redirect()->back()->with('success', 'Queue workers restarted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to restart workers: ' . $e->getMessage());
        }
    }

    private function getProcessedToday()
    {
        // Estimate from failed jobs and logs
        $today = Carbon::today();
        return DB::table('failed_jobs')
            ->whereDate('failed_at', $today)
            ->count();
    }

    private function getTotalProcessed()
    {
        // Estimate from failed jobs
        return DB::table('failed_jobs')->count();
    }

    private function getQueuePerformance()
    {
        $last24Hours = Carbon::now()->subHours(24);
        
        // Jobs by hour (last 24 hours)
        $hourlyJobs = DB::table('jobs')
            ->where('created_at', '>=', $last24Hours)
            ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour')
            ->toArray();

        // Failed jobs by hour
        $hourlyFailed = DB::table('failed_jobs')
            ->where('failed_at', '>=', $last24Hours)
            ->selectRaw('HOUR(failed_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour')
            ->toArray();

        return [
            'hourly_jobs' => $hourlyJobs,
            'hourly_failed' => $hourlyFailed,
        ];
    }

    private function truncateException($exception, $length = 200)
    {
        if (strlen($exception) <= $length) {
            return $exception;
        }

        return substr($exception, 0, $length) . '...';
    }

    public function api()
    {
        $stats = [
            'pending_jobs' => DB::table('jobs')->count(),
            'failed_jobs' => DB::table('failed_jobs')->count(),
            'queues' => DB::table('jobs')
                ->select('queue')
                ->groupBy('queue')
                ->pluck('queue')
                ->toArray(),
            'timestamp' => now()->toISOString(),
        ];

        return response()->json($stats);
    }
}
