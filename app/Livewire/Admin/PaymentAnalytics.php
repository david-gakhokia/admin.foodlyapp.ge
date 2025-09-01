<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentAnalytics extends Component
{
    public $dateRange = '7';
    public $selectedStatus = 'all';
    
    public $totalRevenue = 0;
    public $totalTransactions = 0;
    public $successRate = 0;
    public $averageAmount = 0;
    
    public $chartData = [];
    public $statusBreakdown = [];
    
    public function mount()
    {
        $this->calculateMetrics();
    }
    
    public function updatedDateRange()
    {
        $this->calculateMetrics();
        $this->dispatch('chartUpdated');
    }
    
    public function updatedSelectedStatus()
    {
        $this->calculateMetrics();
        $this->dispatch('chartUpdated');
    }
    
    public function refreshData()
    {
        $this->calculateMetrics();
        $this->dispatch('chartUpdated');
        $this->dispatch('dataUpdated', 'Payment analytics data updated');
    }
    
    protected $listeners = ['refreshData'];
    
    public function calculateMetrics()
    {
        $startDate = Carbon::now()->subDays($this->dateRange);
        
        $query = BOGTransaction::where('created_at', '>=', $startDate);
        
        if ($this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }
        
        $transactions = $query->get();
        
        // Total metrics
        $this->totalTransactions = $transactions->count();
        $this->totalRevenue = $transactions->where('status', 'completed')->sum('amount');
        
        $successfulTransactions = $transactions->where('status', 'completed')->count();
        $this->successRate = $this->totalTransactions > 0 
            ? round(($successfulTransactions / $this->totalTransactions) * 100, 2)
            : 0;
            
        $this->averageAmount = $successfulTransactions > 0
            ? round($this->totalRevenue / $successfulTransactions, 2)
            : 0;
        
        // Chart data - daily revenue
        $this->chartData = $this->generateChartData($startDate);
        
        // Status breakdown
        $this->statusBreakdown = $transactions->groupBy('status')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'amount' => $group->sum('amount')
                ];
            })->toArray();
    }
    
    private function generateChartData($startDate)
    {
        $chartData = [];
        $endDate = Carbon::now();
        
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dayRevenue = BOGTransaction::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('amount');
                
            $chartData[] = [
                'date' => $date->format('Y-m-d'),
                'revenue' => $dayRevenue
            ];
        }
        
        return $chartData;
    }
    
    public function render()
    {
        return view('livewire.admin.payment-analytics');
    }
}
