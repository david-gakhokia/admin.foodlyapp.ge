<?php

namespace App\Jobs;

use App\Models\AnalyticsReport;
use App\Services\AnalyticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class GenerateAnalyticsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $type;
    protected array $filters;
    protected ?int $userId;
    protected string $format;

    /**
     * Create a new job instance.
     */
    public function __construct(string $type, array $filters, ?int $userId = null, string $format = 'csv')
    {
        $this->type = $type;
        $this->filters = $filters;
        $this->userId = $userId;
        $this->format = $format;
    }

    /**
     * Execute the job.
     */
    public function handle(AnalyticsService $analyticsService): void
    {
        $fromDate = $this->filters['from_date'] ?? now()->startOfMonth()->toDateString();
        $toDate = $this->filters['to_date'] ?? now()->endOfMonth()->toDateString();
        $restaurantId = $this->filters['restaurant_id'] ?? null;

        // Generate report data based on type
        $data = match($this->type) {
            AnalyticsReport::TYPE_BOG_PAYMENTS => $analyticsService->getBOGPaymentAnalytics(
                $fromDate, 
                $toDate, 
                $restaurantId, 
                $this->filters['period'] ?? 'day'
            ),
            AnalyticsReport::TYPE_RESERVATIONS => $analyticsService->getReservationAnalytics(
                $fromDate, 
                $toDate, 
                $restaurantId, 
                $this->filters['period'] ?? 'day',
                $this->filters['status'] ?? []
            ),
            AnalyticsReport::TYPE_REVENUE => $analyticsService->getRevenueAnalytics(
                $fromDate, 
                $toDate, 
                $restaurantId, 
                $this->filters['period'] ?? 'day',
                $this->filters['include_projections'] ?? false
            ),
            AnalyticsReport::TYPE_OVERVIEW => $analyticsService->getDashboardOverview(
                $fromDate, 
                $toDate, 
                $restaurantId
            ),
            default => throw new \InvalidArgumentException("Unsupported report type: {$this->type}")
        };

        // Generate file if format is specified
        $filePath = null;
        if ($this->format !== 'json') {
            $filePath = $this->generateFile($data);
        }

        // Create analytics report record
        AnalyticsReport::create([
            'type' => $this->type,
            'name' => $this->generateReportName(),
            'description' => $this->generateReportDescription(),
            'filters' => $this->filters,
            'data' => $data,
            'generated_at' => now(),
            'generated_by' => $this->userId,
            'file_path' => $filePath,
            'expires_at' => now()->addDays(7) // Reports expire after 7 days
        ]);
    }

    /**
     * Generate file for the report
     */
    private function generateFile(array $data): string
    {
        $fileName = $this->type . '_' . date('Y_m_d_H_i_s') . '.' . $this->format;
        $filePath = 'analytics_reports/' . $fileName;

        switch ($this->format) {
            case 'csv':
                $this->generateCsvFile($data, $filePath);
                break;
            case 'xlsx':
                $this->generateExcelFile($data, $filePath);
                break;
            case 'pdf':
                $this->generatePdfFile($data, $filePath);
                break;
            default:
                throw new \InvalidArgumentException("Unsupported format: {$this->format}");
        }

        return $filePath;
    }

    /**
     * Generate CSV file
     */
    private function generateCsvFile(array $data, string $filePath): void
    {
        $csvData = $this->convertDataToCsv($data);
        Storage::put($filePath, $csvData);
    }

    /**
     * Generate Excel file (placeholder - requires Laravel Excel)
     */
    private function generateExcelFile(array $data, string $filePath): void
    {
        // This would use Laravel Excel package
        // For now, falling back to CSV
        $this->generateCsvFile($data, $filePath);
    }

    /**
     * Generate PDF file (placeholder - requires PDF library)
     */
    private function generatePdfFile(array $data, string $filePath): void
    {
        // This would use a PDF library like DomPDF or TCPDF
        // For now, falling back to CSV
        $this->generateCsvFile($data, $filePath);
    }

    /**
     * Convert data to CSV format
     */
    private function convertDataToCsv(array $data): string
    {
        $csv = '';
        
        switch ($this->type) {
            case AnalyticsReport::TYPE_BOG_PAYMENTS:
                $csv = $this->bogPaymentsToCsv($data);
                break;
            case AnalyticsReport::TYPE_RESERVATIONS:
                $csv = $this->reservationsToCsv($data);
                break;
            case AnalyticsReport::TYPE_REVENUE:
                $csv = $this->revenueToCsv($data);
                break;
            case AnalyticsReport::TYPE_OVERVIEW:
                $csv = $this->overviewToCsv($data);
                break;
        }

        return $csv;
    }

    /**
     * Convert BOG payments data to CSV
     */
    private function bogPaymentsToCsv(array $data): string
    {
        $output = fopen('php://temp', 'r+');
        
        // Headers
        fputcsv($output, ['Period', 'Total Transactions', 'Successful Transactions', 'Failed Transactions', 'Revenue']);
        
        // Time series data
        if (isset($data['time_series'])) {
            foreach ($data['time_series'] as $period) {
                fputcsv($output, [
                    $period['period'],
                    $period['total_transactions'] ?? 0,
                    $period['successful_transactions'] ?? 0,
                    $period['failed_transactions'] ?? 0,
                    $period['revenue'] ?? 0
                ]);
            }
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }

    /**
     * Convert reservations data to CSV
     */
    private function reservationsToCsv(array $data): string
    {
        $output = fopen('php://temp', 'r+');
        
        // Headers
        fputcsv($output, ['Period', 'Total Reservations', 'Confirmed Reservations', 'Cancelled Reservations', 'Total Guests']);
        
        // Time series data
        if (isset($data['time_series'])) {
            foreach ($data['time_series'] as $period) {
                fputcsv($output, [
                    $period['period'],
                    $period['total_reservations'] ?? 0,
                    $period['confirmed_reservations'] ?? 0,
                    $period['cancelled_reservations'] ?? 0,
                    $period['total_guests'] ?? 0
                ]);
            }
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }

    /**
     * Convert revenue data to CSV
     */
    private function revenueToCsv(array $data): string
    {
        $output = fopen('php://temp', 'r+');
        
        // Headers
        fputcsv($output, ['Period', 'Revenue', 'Transaction Count', 'Average Transaction']);
        
        // Time series data
        if (isset($data['time_series'])) {
            foreach ($data['time_series'] as $period) {
                fputcsv($output, [
                    $period['period'],
                    $period['revenue'] ?? 0,
                    $period['transaction_count'] ?? 0,
                    $period['average_transaction'] ?? 0
                ]);
            }
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }

    /**
     * Convert overview data to CSV
     */
    private function overviewToCsv(array $data): string
    {
        $output = fopen('php://temp', 'r+');
        
        // Reservations summary
        fputcsv($output, ['Metric', 'Value']);
        fputcsv($output, ['Total Reservations', $data['reservations']['total'] ?? 0]);
        fputcsv($output, ['Confirmed Reservations', $data['reservations']['confirmed'] ?? 0]);
        fputcsv($output, ['Cancelled Reservations', $data['reservations']['cancelled'] ?? 0]);
        fputcsv($output, ['Pending Reservations', $data['reservations']['pending'] ?? 0]);
        fputcsv($output, ['Conversion Rate (%)', $data['reservations']['conversion_rate'] ?? 0]);
        fputcsv($output, ['']);
        
        // Payments summary
        fputcsv($output, ['Total Transactions', $data['payments']['total_transactions'] ?? 0]);
        fputcsv($output, ['Successful Transactions', $data['payments']['successful_transactions'] ?? 0]);
        fputcsv($output, ['Failed Transactions', $data['payments']['failed_transactions'] ?? 0]);
        fputcsv($output, ['Success Rate (%)', $data['payments']['success_rate'] ?? 0]);
        fputcsv($output, ['']);
        
        // Revenue summary
        fputcsv($output, ['Total Revenue', $data['revenue']['total'] ?? 0]);
        fputcsv($output, ['Average per Reservation', $data['revenue']['average_per_reservation'] ?? 0]);
        fputcsv($output, ['Revenue Growth (%)', $data['revenue']['growth_percentage'] ?? 0]);

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }

    /**
     * Generate report name
     */
    private function generateReportName(): string
    {
        $typeNames = AnalyticsReport::getReportTypes();
        $typeName = $typeNames[$this->type] ?? $this->type;
        
        return "{$typeName} - " . date('Y-m-d H:i:s');
    }

    /**
     * Generate report description
     */
    private function generateReportDescription(): string
    {
        $fromDate = $this->filters['from_date'] ?? 'N/A';
        $toDate = $this->filters['to_date'] ?? 'N/A';
        
        return "Analytics report for period {$fromDate} to {$toDate}";
    }
}
