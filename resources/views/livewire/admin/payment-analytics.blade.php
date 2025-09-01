<div class="payment-analytics">
    <!-- Header -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 text-gray-800 mb-0">📊 გადახდების ანალიტიკა</h2>
                <div class="d-flex" style="gap: 12px;">
                    <select wire:model.live="dateRange" class="form-select form-select-sm">
                        <option value="7">უკანასკნელი 7 დღე</option>
                        <option value="30">უკანასკნელი 30 დღე</option>
                        <option value="90">უკანასკნელი 90 დღე</option>
                        <option value="365">უკანასკნელი წელი</option>
                    </select>
                    
                    <select wire:model.live="selectedStatus" class="form-select form-select-sm">
                        <option value="all">ყველა სტატუსი</option>
                        <option value="pending">მიმდინარე</option>
                        <option value="completed">დასრულებული</option>
                        <option value="failed">ვერ შესრულდა</option>
                        <option value="cancelled">გაუქმებული</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="row mb-4">
        <!-- Total Revenue -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-success text-uppercase mb-1">
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

        <!-- Total Transactions -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-primary text-uppercase mb-1">
                                ტრანზაქციები
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($totalTransactions) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Success Rate -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-info text-uppercase mb-1">
                                წარმატების მაჩვენებელი
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $successRate }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Amount -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="small font-weight-bold text-warning text-uppercase mb-1">
                                საშუალო თანხა
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ₾{{ number_format($averageAmount, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Charts Section -->
    <div class="row">
        <!-- Revenue Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">📈 შემოსავლის ტენდენცია</h6>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="revenueChart" wire:ignore></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Breakdown -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">📊 სტატუსების განაწილება</h6>
                </div>
                <div class="card-body">
                    @if(count($statusBreakdown) > 0)
                        @foreach($statusBreakdown as $status => $data)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle mr-3" style="width: 16px; height: 16px; 
                                        @if($status === 'completed') background-color: #28a745;
                                        @elseif($status === 'pending') background-color: #ffc107;
                                        @elseif($status === 'failed') background-color: #dc3545;
                                        @else background-color: #6c757d;
                                        @endif
                                    "></div>
                                    <span class="small text-capitalize">
                                        @if($status === 'completed') დასრულებული
                                        @elseif($status === 'pending') მიმდინარე
                                        @elseif($status === 'failed') ვერ შესრულდა
                                        @elseif($status === 'cancelled') გაუქმებული
                                        @else {{ $status }}
                                        @endif
                                    </span>
                                </div>
                                <div class="text-right">
                                    <div class="font-weight-bold">{{ $data['count'] }}</div>
                                    <div class="text-muted small">₾{{ number_format($data['amount'], 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-chart-pie fa-3x mb-3"></i>
                            <p>მონაცემები არ მოიძებნა</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">🕒 ბოლო აქტივობა</h6>
        </div>
        <div class="card-body">
            @livewire('admin.transaction-monitor')
        </div>
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
                labels: chartData.map(item => new Date(item.date).toLocaleDateString('ka-GE')),
                datasets: [{
                    label: 'შემოსავალი (₾)',
                    data: chartData.map(item => item.revenue),
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 3,
                    pointBackgroundColor: '#4e73df',
                    pointBorderColor: '#4e73df',
                    pointHoverRadius: 5
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
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
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
