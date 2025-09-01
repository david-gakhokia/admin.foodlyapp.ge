<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChart extends Component
{
    public $chartType = 'daily';
    public $dateRange = '30';
    public $selectedRestaurant = 'all';
    
    public $chartData = [];
    public $totalRevenue = 0;
    public $averageDailyRevenue = 0;
    public $topRestaurants = [];
    
    public function mount()
    {
        $this->generateChartData();
    }
    
    public function updatedChartType()
    {
        $this->generateChartData();
        $this->dispatch('chartDataUpdated');
    }
    
    public function updatedDateRange()
    {
        $this->generateChartData();
        $this->dispatch('chartDataUpdated');
    }
    
    public function updatedSelectedRestaurant()
    {
        $this->generateChartData();
        $this->dispatch('chartDataUpdated');
    }
    
    public function refreshCharts()
    {
        $this->generateChartData();
        $this->dispatch('chartDataUpdated');
    }
    
    protected $listeners = ['refreshCharts'];
    
    public function exportChart($format)
    {
        $this->dispatch('exportStarted', $format);
        
        // TODO: Implement actual export logic
        sleep(1); // Simulate processing time
        
        $this->dispatch('exportCompleted', $format);
    }
    
    public function generateChartData()
    {
        $startDate = Carbon::now()->subDays($this->dateRange);
        
        $query = BOGTransaction::where('created_at', '>=', $startDate)
            ->where('status', 'completed');
            
        if ($this->selectedRestaurant !== 'all') {
            $query->whereHas('reservation', function ($q) {
                $q->where('restaurant_id', $this->selectedRestaurant);
            });
        }
        
        $transactions = $query->get();
        $this->totalRevenue = $transactions->sum('amount');
        
        switch ($this->chartType) {
            case 'daily':
                $this->chartData = $this->generateDailyData($startDate, $query);
                $this->averageDailyRevenue = $this->totalRevenue / max(1, $this->dateRange);
                break;
                
            case 'weekly':
                $this->chartData = $this->generateWeeklyData($startDate, $query);
                $weeks = ceil($this->dateRange / 7);
                $this->averageDailyRevenue = $this->totalRevenue / max(1, $weeks);
                break;
                
            case 'monthly':
                $this->chartData = $this->generateMonthlyData($startDate, $query);
                $months = ceil($this->dateRange / 30);
                $this->averageDailyRevenue = $this->totalRevenue / max(1, $months);
                break;
                
            case 'restaurant':
                $this->chartData = $this->generateRestaurantData($query);
                break;
        }
        
        $this->generateTopRestaurants();
    }
    
    private function generateDailyData($startDate, $query)
    {
        $data = [];
        $endDate = Carbon::now();
        
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dayRevenue = (clone $query)->whereDate('created_at', $date)->sum('amount');
            $dayTransactions = (clone $query)->whereDate('created_at', $date)->count();
            
            $data[] = [
                'label' => $date->format('m/d'),
                'revenue' => $dayRevenue,
                'transactions' => $dayTransactions,
                'date' => $date->format('Y-m-d')
            ];
        }
        
        return $data;
    }
    
    private function generateWeeklyData($startDate, $query)
    {
        $data = [];
        $currentDate = $startDate->copy()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        
        while ($currentDate <= $endDate) {
            $weekStart = $currentDate->copy();
            $weekEnd = $currentDate->copy()->endOfWeek();
            
            $weekRevenue = (clone $query)
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('amount');
                
            $weekTransactions = (clone $query)
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->count();
            
            $data[] = [
                'label' => $weekStart->format('m/d') . '-' . $weekEnd->format('m/d'),
                'revenue' => $weekRevenue,
                'transactions' => $weekTransactions,
                'date' => $weekStart->format('Y-m-d')
            ];
            
            $currentDate->addWeek();
        }
        
        return $data;
    }
    
    private function generateMonthlyData($startDate, $query)
    {
        $data = [];
        $currentDate = $startDate->copy()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        
        while ($currentDate <= $endDate) {
            $monthStart = $currentDate->copy()->startOfMonth();
            $monthEnd = $currentDate->copy()->endOfMonth();
            
            $monthRevenue = (clone $query)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('amount');
                
            $monthTransactions = (clone $query)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            
            $data[] = [
                'label' => $currentDate->format('M Y'),
                'revenue' => $monthRevenue,
                'transactions' => $monthTransactions,
                'date' => $currentDate->format('Y-m-d')
            ];
            
            $currentDate->addMonth();
        }
        
        return $data;
    }
    
    private function generateRestaurantData($query)
    {
        return (clone $query)
            ->join('reservations', 'bog_transactions.reservation_id', '=', 'reservations.id')
            ->leftJoin('restaurant_translations', function ($join) {
                $join->on('reservations.reservable_id', '=', 'restaurant_translations.restaurant_id')
                     ->where('restaurant_translations.locale', '=', 'ka');
            })
            ->select('restaurant_translations.name as restaurant_name', 
                     DB::raw('SUM(bog_transactions.amount) as revenue'),
                     DB::raw('COUNT(bog_transactions.id) as transactions'))
            ->whereNotNull('restaurant_translations.name')
            ->where('reservations.reservable_type', 'App\\Models\\Restaurant')
            ->groupBy('reservations.reservable_id', 'restaurant_translations.name')
            ->orderByDesc('revenue')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->restaurant_name ?? 'Unknown Restaurant',
                    'revenue' => $item->revenue,
                    'transactions' => $item->transactions
                ];
            })
            ->toArray();
    }
    
    private function generateTopRestaurants()
    {
        $startDate = Carbon::now()->subDays($this->dateRange);
        
        $this->topRestaurants = BOGTransaction::where('bog_transactions.created_at', '>=', $startDate)
            ->where('bog_transactions.status', 'completed')
            ->join('reservations', 'bog_transactions.reservation_id', '=', 'reservations.id')
            ->leftJoin('restaurant_translations', function ($join) {
                $join->on('reservations.reservable_id', '=', 'restaurant_translations.restaurant_id')
                     ->where('restaurant_translations.locale', '=', 'ka');
            })
            ->select('restaurant_translations.name as restaurant_name', 
                     DB::raw('SUM(bog_transactions.amount) as revenue'),
                     DB::raw('COUNT(bog_transactions.id) as transactions'))
            ->whereNotNull('restaurant_translations.name')
            ->where('reservations.reservable_type', 'App\\Models\\Restaurant')
            ->groupBy('reservations.reservable_id', 'restaurant_translations.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get()
            ->toArray();
    }
    
    public function render()
    {
        return view('livewire.admin.revenue-chart');
    }
}
