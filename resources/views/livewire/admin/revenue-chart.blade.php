<div class="revenue-chart">
    <!-- Header Controls -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <h2 class="text-2xl font-bold text-gray-900">📈 შემოსავლის ანალიტიკა</h2>
            
            <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                <!-- Chart Type -->
                <select wire:model.live="chartType" class="border rounded-lg px-3 py-2">
                    <option value="daily">ყოველდღიური</option>
                    <option value="weekly">კვირეული</option>
                    <option value="monthly">ყოველთვიური</option>
                    <option value="restaurant">რესტორნების მიხედვით</option>
                </select>
                
                <!-- Date Range -->
                @if($chartType !== 'restaurant')
                    <select wire:model.live="dateRange" class="border rounded-lg px-3 py-2">
                        <option value="7">უკანასკნელი 7 დღე</option>
                        <option value="30">უკანასკნელი 30 დღე</option>
                        <option value="90">უკანასკნელი 90 დღე</option>
                        <option value="365">უკანასკნელი წელი</option>
                    </select>
                @endif
                
                <!-- Restaurant Filter -->
                <select wire:model.live="selectedRestaurant" class="border rounded-lg px-3 py-2">
                    <option value="all">ყველა რესტორანი</option>
                    <!-- TODO: Populate with actual restaurants -->
                </select>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">მთლიანი შემოსავალი</p>
                    <p class="text-2xl font-bold">₾{{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="text-blue-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Average Revenue -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">
                        @if($chartType === 'daily') საშუალო დღიური
                        @elseif($chartType === 'weekly') საშუალო კვირეული
                        @elseif($chartType === 'monthly') საშუალო ყოველთვიური
                        @else საშუალო
                        @endif
                        შემოსავალი
                    </p>
                    <p class="text-2xl font-bold">₾{{ number_format($averageDailyRevenue, 2) }}</p>
                </div>
                <div class="text-green-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Data Points -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">მონაცემთა წერტილები</p>
                    <p class="text-2xl font-bold">{{ count($chartData) }}</p>
                </div>
                <div class="text-purple-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-900">
                @if($chartType === 'daily') 📅 ყოველდღიური შემოსავალი
                @elseif($chartType === 'weekly') 📅 კვირეული შემოსავალი
                @elseif($chartType === 'monthly') 📅 ყოველთვიური შემოსავალი
                @else 🏪 რესტორნების შემოსავალი
                @endif
            </h3>
            <div class="text-sm text-gray-500">
                განახლებულია: {{ now()->format('Y-m-d H:i') }}
            </div>
        </div>
        
        <div class="h-96">
            <canvas id="mainChart" wire:ignore></canvas>
        </div>
    </div>

    <!-- Top Restaurants -->
    @if($chartType !== 'restaurant' && count($topRestaurants) > 0)
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">🏆 საუკეთესო რესტორნები</h3>
            
            <div class="space-y-4">
                @foreach($topRestaurants as $index => $restaurant)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ $index + 1 }}
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">{{ $restaurant['restaurant_name'] }}</h4>
                                <p class="text-sm text-gray-500">{{ $restaurant['transactions'] }} ტრანზაქცია</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-gray-900">₾{{ number_format($restaurant['revenue'], 2) }}</div>
                            <div class="text-sm text-gray-500">
                                {{ round(($restaurant['revenue'] / max($totalRevenue, 1)) * 100, 1) }}%
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Export Options -->
    <div class="mt-6 flex justify-end">
        <div class="flex space-x-2">
            <button 
                onclick="exportChart('png')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm"
            >
                📊 PNG Export
            </button>
            <button 
                onclick="exportChart('pdf')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm"
            >
                📄 PDF Export
            </button>
            <button 
                onclick="exportData()"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm"
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
