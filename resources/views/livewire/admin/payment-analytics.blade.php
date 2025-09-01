<div class="payment-analytics">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-900">📊 გადახდების ანალიტიკა</h2>
            <div class="flex space-x-4">
                <select wire:model.live="dateRange" class="border rounded-lg px-3 py-2">
                    <option value="7">უკანასკნელი 7 დღე</option>
                    <option value="30">უკანასკნელი 30 დღე</option>
                    <option value="90">უკანასკნელი 90 დღე</option>
                    <option value="365">უკანასკნელი წელი</option>
                </select>
                
                <select wire:model.live="selectedStatus" class="border rounded-lg px-3 py-2">
                    <option value="all">ყველა სტატუსი</option>
                    <option value="pending">მიმდინარე</option>
                    <option value="completed">დასრულებული</option>
                    <option value="failed">ვერ შესრულდა</option>
                    <option value="cancelled">გაუქმებული</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-gradient-to-r from-green-400 to-green-600 rounded-lg p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-green-100 text-sm">მთლიანი შემოსავალი</p>
                    <p class="text-2xl font-bold">₾{{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="text-green-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-blue-100 text-sm">ტრანზაქციების რაოდენობა</p>
                    <p class="text-2xl font-bold">{{ number_format($totalTransactions) }}</p>
                </div>
                <div class="text-blue-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Success Rate -->
        <div class="bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-purple-100 text-sm">წარმატების მაჩვენებელი</p>
                    <p class="text-2xl font-bold">{{ $successRate }}%</p>
                </div>
                <div class="text-purple-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Average Amount -->
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-yellow-100 text-sm">საშუალო თანხა</p>
                    <p class="text-2xl font-bold">₾{{ number_format($averageAmount, 2) }}</p>
                </div>
                <div class="text-yellow-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📈 შემოსავლის ტენდენცია</h3>
            <div class="h-64">
                <canvas id="revenueChart" wire:ignore></canvas>
            </div>
        </div>

        <!-- Status Breakdown -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 სტატუსების განაწილება</h3>
            <div class="space-y-4">
                @foreach($statusBreakdown as $status => $data)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full mr-3 
                                @if($status === 'completed') bg-green-500
                                @elseif($status === 'pending') bg-yellow-500
                                @elseif($status === 'failed') bg-red-500
                                @else bg-gray-500
                                @endif
                            "></div>
                            <span class="text-sm text-gray-600 capitalize">{{ $status }}</span>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-semibold">{{ $data['count'] }}</div>
                            <div class="text-xs text-gray-500">₾{{ number_format($data['amount'], 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">🕒 ბოლო აქტივობა</h3>
        @livewire('admin.transaction-monitor')
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('livewire:initialized', () => {
    let revenueChart = null;
    
    function updateChart() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const chartData = @json($chartData);
        
        if (revenueChart) {
            revenueChart.destroy();
        }
        
        revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(item => item.date),
                datasets: [{
                    label: 'შემოსავალი (₾)',
                    data: chartData.map(item => item.revenue),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
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
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'შემოსავალი: ₾' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }
    
    updateChart();
    
    Livewire.on('chartUpdated', () => {
        setTimeout(updateChart, 100);
    });
});
</script>
@endpush
