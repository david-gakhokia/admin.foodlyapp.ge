<div class="revenue-chart">
    <!-- Header Controls -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <h2 class="h4 text-gray-800 mb-3 mb-lg-0">📈 შემოსავლის ანალიტიკა</h2>

                <div class="d-flex flex-column flex-sm-row" style="gap: 12px;">
                    <!-- Chart Type -->
                    <select wire:model.live="chartType" class="form-select form-select-sm">
                        <option value="daily">ყოველდღიური</option>
                        <option value="weekly">კვირეული</option>
                        <option value="monthly">ყოველთვიური</option>
                        <option value="restaurant">რესტორნების მიხედვით</option>
                    </select>
                    
                    <!-- Date Range -->
                    @if($chartType !== 'restaurant')
                        <select wire:model.live="dateRange" class="form-select form-select-sm">
                            <option value="7">უკანასკნელი 7 დღე</option>
                            <option value="30">უკანასკნელი 30 დღე</option>
                            <option value="90">უკანასკნელი 90 დღე</option>
                            <option value="365">უკანასკნელი წელი</option>
                        </select>
                    @endif
                    
                    <!-- Restaurant Filter -->
                    <select wire:model.live="selectedRestaurant" class="form-select form-select-sm">
                        <option value="all">ყველა რესტორანი</option>
                        <!-- TODO: Populate with actual restaurants -->
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Total Revenue -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-primary text-uppercase mb-1">
                                მთლიანი შემოსავალი
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ₾{{ number_format($totalRevenue, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Revenue -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-success text-uppercase mb-1">
                                @if($chartType === 'daily') საშუალო დღიური
                                @elseif($chartType === 'weekly') საშუალო კვირეული
                                @elseif($chartType === 'monthly') საშუალო ყოველთვიური
                                @else საშუალო
                                @endif
                                შემოსავალი
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ₾{{ number_format($averageDailyRevenue, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Points -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-info text-uppercase mb-1">
                                მონაცემთა წერტილები
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($chartData) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                @if($chartType === 'daily') 📅 ყოველდღიური შემოსავალი
                @elseif($chartType === 'weekly') 📅 კვირეული შემოსავალი
                @elseif($chartType === 'monthly') 📅 ყოველთვიური შემოსავალი
                @else 🏪 რესტორნების შემოსავალი
                @endif
            </h6>
            <div class="small text-muted">
                განახლებულია: {{ now()->format('Y-m-d H:i') }}
            </div>
        </div>
        <div class="card-body">
            <div style="height: 400px;">
                <canvas id="mainChart" wire:ignore></canvas>
            </div>
        </div>
    </div>

    <!-- Top Restaurants -->
    @if($chartType !== 'restaurant' && count($topRestaurants) > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">🏆 საუკეთესო რესტორნები</h6>
            </div>
            <div class="card-body">
                @foreach($topRestaurants as $index => $restaurant)
                    <div class="d-flex align-items-center justify-content-between p-3 mb-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center font-weight-bold" 
                                 style="width: 32px; height: 32px; font-size: 14px;">
                                {{ $index + 1 }}
                            </div>
                            <div class="ml-3">
                                <h6 class="mb-0 font-weight-bold">{{ $restaurant['restaurant_name'] }}</h6>
                                <small class="text-muted">{{ $restaurant['transactions'] }} ტრანზაქცია</small>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₾{{ number_format($restaurant['revenue'], 2) }}</div>
                            <small class="text-muted">
                                {{ round(($restaurant['revenue'] / max($totalRevenue, 1)) * 100, 1) }}%
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Export Options -->
    <div class="d-flex justify-content-end mb-4">
        <div class="btn-group">
            <button 
                onclick="exportChart('png')"
                class="btn btn-primary btn-sm"
            >
                📊 PNG Export
            </button>
            <button 
                onclick="exportChart('pdf')"
                class="btn btn-danger btn-sm"
            >
                📄 PDF Export
            </button>
            <button 
                onclick="exportData()"
                class="btn btn-success btn-sm"
            >
                📈 CSV Export
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
<script>
document.addEventListener('livewire:initialized', () => {
    let mainChart = null;
    
    function updateChart() {
        const ctx = document.getElementById('mainChart').getContext('2d');
        const chartData = @json($chartData);
        const chartType = @json($chartType);
        
        if (mainChart) {
            mainChart.destroy();
        }
        
        let chartConfig = {
            type: chartType === 'restaurant' ? 'bar' : 'line',
            data: {
                labels: chartData.map(item => item.label),
                datasets: [{
                    label: 'შემოსავალი (₾)',
                    data: chartData.map(item => item.revenue),
                    borderColor: chartType === 'restaurant' ? undefined : 'rgb(59, 130, 246)',
                    backgroundColor: chartType === 'restaurant' 
                        ? 'rgba(59, 130, 246, 0.8)' 
                        : 'rgba(59, 130, 246, 0.1)',
                    tension: chartType === 'restaurant' ? undefined : 0.4,
                    fill: chartType !== 'restaurant'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₾' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: chartType === 'restaurant' ? 45 : 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'შემოსავალი: ₾' + context.parsed.y.toLocaleString();
                            },
                            afterLabel: function(context) {
                                const dataPoint = chartData[context.dataIndex];
                                if (dataPoint.transactions) {
                                    return 'ტრანზაქციები: ' + dataPoint.transactions;
                                }
                                return '';
                            }
                        }
                    }
                }
            }
        };
        
        mainChart = new Chart(ctx, chartConfig);
    }
    
    updateChart();
    
    Livewire.on('chartUpdated', () => {
        setTimeout(updateChart, 100);
    });
    
    // Export functions
    window.exportChart = function(format) {
        if (!mainChart) return;
        
        if (format === 'png') {
            const url = mainChart.toBase64Image();
            const link = document.createElement('a');
            link.download = 'revenue-chart.png';
            link.href = url;
            link.click();
        } else if (format === 'pdf') {
            // TODO: Implement PDF export
            alert('PDF export ფუნქცია მალე დაემატება');
        }
    };
    
    window.exportData = function() {
        const chartData = @json($chartData);
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Label,Revenue,Transactions\n";
        
        chartData.forEach(item => {
            csvContent += `"${item.label}",${item.revenue},${item.transactions || 0}\n`;
        });
        
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'revenue-data.csv');
        link.click();
    };
});
</script>
@endpush
