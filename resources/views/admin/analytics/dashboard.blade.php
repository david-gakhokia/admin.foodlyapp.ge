<x-layouts.app title="Analytics Dashboard">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📊 Analytics Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Overview of all key metrics and performance indicators</p>
        </div>

        <!-- Date Range Filter -->
        <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex flex-wrap items-center gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Date</label>
                    <input type="date" id="fromDate" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To Date</label>
                    <input type="date" id="toDate" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Restaurant</label>
                    <select id="restaurantFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="">All Restaurants</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="refreshData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        🔄 Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Reservations -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            📅
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Reservations</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="totalReservations">-</p>
                        <p class="text-xs text-green-600" id="reservationGrowth">-</p>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            💰
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="totalRevenue">-</p>
                        <p class="text-xs text-green-600" id="revenueGrowth">-</p>
                    </div>
                </div>
            </div>

            <!-- Success Rate -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            ✅
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Payment Success Rate</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="successRate">-</p>
                        <p class="text-xs text-blue-600" id="successRateChange">-</p>
                    </div>
                </div>
            </div>

            <!-- Conversion Rate -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            🎯
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Conversion Rate</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="conversionRate">-</p>
                        <p class="text-xs text-purple-600" id="conversionChange">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Revenue Trend</h3>
                <div class="h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Reservations Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Reservations Trend</h3>
                <div class="h-64">
                    <canvas id="reservationsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Reservation Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Reservation Status</h3>
                <div class="h-48">
                    <canvas id="reservationStatusChart"></canvas>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Status</h3>
                <div class="h-48">
                    <canvas id="paymentStatusChart"></canvas>
                </div>
            </div>

            <!-- Top Restaurants -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Restaurants</h3>
                <div id="topRestaurants" class="space-y-3">
                    <!-- Dynamic content -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set default dates
    const today = new Date();
    const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
    
    document.getElementById('fromDate').value = lastMonth.toISOString().split('T')[0];
    document.getElementById('toDate').value = today.toISOString().split('T')[0];
    
    // Initialize charts
    initializeCharts();
    
    // Load initial data
    refreshData();
});

function refreshData() {
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const restaurantId = document.getElementById('restaurantFilter').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (fromDate) params.append('from_date', fromDate);
    if (toDate) params.append('to_date', toDate);
    if (restaurantId) params.append('restaurant_id', restaurantId);
    
    // Fetch dashboard data
    fetch(`/api/admin/analytics/dashboard?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateKPIs(data.data);
                updateCharts(data.data);
            }
        })
        .catch(error => {
            console.error('Error fetching dashboard data:', error);
        });
}

function updateKPIs(data) {
    document.getElementById('totalReservations').textContent = data.reservations.total.toLocaleString();
    document.getElementById('totalRevenue').textContent = '₾ ' + data.revenue.total.toLocaleString();
    document.getElementById('successRate').textContent = data.payments.success_rate + '%';
    document.getElementById('conversionRate').textContent = data.reservations.conversion_rate + '%';
    
    // Growth indicators
    document.getElementById('reservationGrowth').textContent = 
        (data.reservations.growth_percentage > 0 ? '+' : '') + data.reservations.growth_percentage + '%';
    document.getElementById('revenueGrowth').textContent = 
        (data.revenue.growth_percentage > 0 ? '+' : '') + data.revenue.growth_percentage + '%';
}

let revenueChart, reservationsChart, reservationStatusChart, paymentStatusChart;

function initializeCharts() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Revenue',
                data: [],
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    
    // Reservations Chart
    const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
    reservationsChart = new Chart(reservationsCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Reservations',
                data: [],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    
    // Reservation Status Chart
    const reservationStatusCtx = document.getElementById('reservationStatusChart').getContext('2d');
    reservationStatusChart = new Chart(reservationStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Confirmed', 'Pending', 'Cancelled'],
            datasets: [{
                data: [0, 0, 0],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    // Payment Status Chart
    const paymentStatusCtx = document.getElementById('paymentStatusChart').getContext('2d');
    paymentStatusChart = new Chart(paymentStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Successful', 'Failed'],
            datasets: [{
                data: [0, 0],
                backgroundColor: ['#10b981', '#ef4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function updateCharts(data) {
    // Update status charts
    reservationStatusChart.data.datasets[0].data = [
        data.reservations.confirmed,
        data.reservations.pending,
        data.reservations.cancelled
    ];
    reservationStatusChart.update();
    
    paymentStatusChart.data.datasets[0].data = [
        data.payments.successful_transactions,
        data.payments.failed_transactions
    ];
    paymentStatusChart.update();
}
</script>
</x-layouts.app>
