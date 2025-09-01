<x-layouts.app title="Revenue Analytics">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📊 Revenue Analytics</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Comprehensive revenue analysis and trends</p>
        </div>

        <!-- Filters -->
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
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Group By</label>
                    <select id="groupBy" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="day">Daily</option>
                        <option value="week">Weekly</option>
                        <option value="month">Monthly</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="refreshData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        🔄 Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Revenue Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Revenue -->
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
                        <p class="text-xs" id="revenueGrowth">-</p>
                    </div>
                </div>
            </div>

            <!-- Average Daily Revenue -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            📈
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Avg Daily Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="avgDailyRevenue">-</p>
                        <p class="text-xs" id="avgDailyGrowth">-</p>
                    </div>
                </div>
            </div>

            <!-- Highest Day -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            🏆
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Highest Day</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="highestRevenue">-</p>
                        <p class="text-xs text-gray-500" id="highestDate">-</p>
                    </div>
                </div>
            </div>

            <!-- Revenue per Reservation -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            🎯
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Revenue per Reservation</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="revenuePerReservation">-</p>
                        <p class="text-xs" id="rprGrowth">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Trend -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Revenue Trend</h3>
                <div class="h-64">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
            </div>

            <!-- Revenue by Restaurant -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Revenue by Restaurant</h3>
                <div class="h-64">
                    <canvas id="restaurantRevenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Additional Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Monthly Comparison -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Monthly Comparison</h3>
                <div class="h-48">
                    <canvas id="monthlyComparisonChart"></canvas>
                </div>
            </div>

            <!-- Weekday Performance -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Weekday Performance</h3>
                <div class="h-48">
                    <canvas id="weekdayChart"></canvas>
                </div>
            </div>

            <!-- Top Performers -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Performing Restaurants</h3>
                <div id="topPerformers" class="space-y-3">
                    <!-- Dynamic content -->
                </div>
            </div>
        </div>

        <!-- Revenue Breakdown Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Revenue Breakdown</h3>
                <button onclick="exportData()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm">
                    📥 Export Data
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Revenue</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reservations</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Avg per Reservation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Growth</th>
                        </tr>
                    </thead>
                    <tbody id="revenueBreakdownTable" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Dynamic content -->
                    </tbody>
                </table>
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
    const groupBy = document.getElementById('groupBy').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (fromDate) params.append('from_date', fromDate);
    if (toDate) params.append('to_date', toDate);
    if (restaurantId) params.append('restaurant_id', restaurantId);
    if (groupBy) params.append('group_by', groupBy);
    
    // Fetch revenue data
    fetch(`/api/admin/analytics/revenue?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateMetrics(data.data);
                updateCharts(data.data);
                updateRevenueTable(data.data.breakdown || []);
                updateTopPerformers(data.data.top_restaurants || []);
            }
        })
        .catch(error => {
            console.error('Error fetching revenue data:', error);
        });
}

function updateMetrics(data) {
    document.getElementById('totalRevenue').textContent = '₾ ' + data.total.toLocaleString();
    document.getElementById('avgDailyRevenue').textContent = '₾ ' + data.average_daily.toLocaleString();
    document.getElementById('highestRevenue').textContent = '₾ ' + (data.highest_day?.amount || 0).toLocaleString();
    document.getElementById('highestDate').textContent = data.highest_day?.date || '-';
    document.getElementById('revenuePerReservation').textContent = '₾ ' + data.revenue_per_reservation.toLocaleString();
    
    // Growth indicators
    const growthClass = data.growth_percentage > 0 ? 'text-green-600' : 'text-red-600';
    document.getElementById('revenueGrowth').textContent = (data.growth_percentage > 0 ? '+' : '') + data.growth_percentage + '%';
    document.getElementById('revenueGrowth').className = 'text-xs ' + growthClass;
}

let revenueTrendChart, restaurantRevenueChart, monthlyComparisonChart, weekdayChart;

function initializeCharts() {
    // Revenue Trend Chart
    const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    revenueTrendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Revenue',
                data: [],
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4,
                fill: true
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
    
    // Restaurant Revenue Chart
    const restaurantCtx = document.getElementById('restaurantRevenueChart').getContext('2d');
    restaurantRevenueChart = new Chart(restaurantCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Revenue',
                data: [],
                backgroundColor: 'rgba(59, 130, 246, 0.8)'
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
    
    // Monthly Comparison Chart
    const monthlyCtx = document.getElementById('monthlyComparisonChart').getContext('2d');
    monthlyComparisonChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'This Year',
                data: [],
                backgroundColor: 'rgba(34, 197, 94, 0.8)'
            }, {
                label: 'Last Year',
                data: [],
                backgroundColor: 'rgba(156, 163, 175, 0.8)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    // Weekday Chart
    const weekdayCtx = document.getElementById('weekdayChart').getContext('2d');
    weekdayChart = new Chart(weekdayCtx, {
        type: 'radar',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Revenue',
                data: new Array(7).fill(0),
                borderColor: 'rgb(147, 51, 234)',
                backgroundColor: 'rgba(147, 51, 234, 0.2)'
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
}

function updateCharts(data) {
    // Update trend chart
    if (data.time_series) {
        revenueTrendChart.data.labels = data.time_series.map(item => item.date);
        revenueTrendChart.data.datasets[0].data = data.time_series.map(item => item.revenue);
        revenueTrendChart.update();
    }
    
    // Update restaurant chart
    if (data.by_restaurant) {
        restaurantRevenueChart.data.labels = data.by_restaurant.map(item => item.name);
        restaurantRevenueChart.data.datasets[0].data = data.by_restaurant.map(item => item.revenue);
        restaurantRevenueChart.update();
    }
    
    // Update weekday chart
    if (data.by_weekday) {
        weekdayChart.data.datasets[0].data = data.by_weekday;
        weekdayChart.update();
    }
}

function updateRevenueTable(breakdown) {
    const tbody = document.getElementById('revenueBreakdownTable');
    tbody.innerHTML = '';
    
    breakdown.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${item.period}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">₾ ${parseFloat(item.revenue).toLocaleString()}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${item.reservations}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">₾ ${parseFloat(item.avg_per_reservation).toLocaleString()}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <span class="${item.growth_percentage >= 0 ? 'text-green-600' : 'text-red-600'}">
                    ${item.growth_percentage >= 0 ? '+' : ''}${item.growth_percentage}%
                </span>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function updateTopPerformers(restaurants) {
    const container = document.getElementById('topPerformers');
    container.innerHTML = '';
    
    restaurants.slice(0, 5).forEach((restaurant, index) => {
        const item = document.createElement('div');
        item.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg';
        item.innerHTML = `
            <div class="flex items-center">
                <span class="text-sm font-medium text-gray-900 dark:text-white mr-2">${index + 1}.</span>
                <span class="text-sm text-gray-900 dark:text-white">${restaurant.name}</span>
            </div>
            <span class="text-sm font-semibold text-green-600">₾ ${parseFloat(restaurant.revenue).toLocaleString()}</span>
        `;
        container.appendChild(item);
    });
}

function exportData() {
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const restaurantId = document.getElementById('restaurantFilter').value;
    const groupBy = document.getElementById('groupBy').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (fromDate) params.append('from_date', fromDate);
    if (toDate) params.append('to_date', toDate);
    if (restaurantId) params.append('restaurant_id', restaurantId);
    if (groupBy) params.append('group_by', groupBy);
    params.append('type', 'revenue');
    params.append('format', 'excel');
    
    // Trigger export
    window.open(`/api/admin/analytics/export?${params}`, '_blank');
}
</script>
</x-layouts.app>
