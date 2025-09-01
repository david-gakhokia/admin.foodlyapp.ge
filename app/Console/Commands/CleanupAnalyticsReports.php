<?php

namespace App\Console\Commands;

use App\Models\AnalyticsReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupAnalyticsReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:cleanup {--days=7 : Number of days to keep reports}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired analytics reports and files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = now()->subDays($days);

        $this->info("Cleaning up analytics reports older than {$days} days...");

        // Find expired reports
        $expiredReports = AnalyticsReport::where('created_at', '<', $cutoffDate)
            ->orWhere('expires_at', '<', now())
            ->get();

        $deletedFiles = 0;
        $deletedReports = 0;

        foreach ($expiredReports as $report) {
            // Delete associated file if exists
            if ($report->file_path && Storage::exists($report->file_path)) {
                Storage::delete($report->file_path);
                $deletedFiles++;
            }

            // Delete the report record
            $report->delete();
            $deletedReports++;
        }

        $this->info("Cleanup completed:");
        $this->info("- Deleted {$deletedReports} report records");
        $this->info("- Deleted {$deletedFiles} files");

        // Clean up empty directories
        $this->cleanupEmptyDirectories();

        return 0;
    }

    /**
     * Clean up empty directories in analytics reports folder
     */
    private function cleanupEmptyDirectories(): void
    {
        $directories = Storage::directories('analytics_reports');
        
        foreach ($directories as $directory) {
            $files = Storage::files($directory);
            if (empty($files)) {
                Storage::deleteDirectory($directory);
                $this->info("- Deleted empty directory: {$directory}");
            }
        }
    }
}
