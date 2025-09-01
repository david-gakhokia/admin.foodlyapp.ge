<x-layouts.app title="Reservation Analytics">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📅 Reservation Analytics</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Comprehensive analysis of reservation patterns and trends</p>
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select id="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="">All Statuses</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="refreshData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        🔄 Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Metrics -->
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
                        <p class="text-xs" id="reservationGrowth">-</p>
                    </div>
                </div>
            </div>

            <!-- Confirmed Rate -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            ✅
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Confirmation Rate</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="confirmationRate">-</p>
                        <p class="text-xs" id="confirmationChange">-</p>
                    </div>
                </div>
            </div>

            <!-- Average Party Size -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            👥
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Avg Party Size</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="avgPartySize">-</p>
                        <p class="text-xs text-gray-500">people</p>
                    </div>
                </div>
            </div>

            <!-- Peak Hours -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            🕐
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Peak Hour</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="peakHour">-</p>
                        <p class="text-xs text-gray-500" id="peakHourReservations">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Reservations Trend -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Reservations Trend</h3>
                <div class="h-64">
                    <canvas id="reservationsTrendChart"></canvas>
                </div>
            </div>

            <!-- Status Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Distribution</h3>
                <div class="h-64">
                    <canvas id="statusDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Additional Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Hourly Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Hourly Distribution</h3>
                <div class="h-48">
                    <canvas id="hourlyDistributionChart"></canvas>
                </div>
            </div>

            <!-- Weekly Pattern -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Weekly Pattern</h3>
                <div class="h-48">
                    <canvas id="weeklyPatternChart"></canvas>
                </div>
            </div>

            <!-- Party Size Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Party Size Distribution</h3>
                <div class="h-48">
                    <canvas id="partySizeChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Performing Restaurants -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Restaurants by Volume -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Restaurants by Volume</h3>
                <div id="topRestaurantsByVolume" class="space-y-3">
                    <!-- Dynamic content -->
                </div>
            </div>

            <!-- Best Conversion Rates -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Best Conversion Rates</h3>
                <div id="bestConversionRates" class="space-y-3">
                    <!-- Dynamic content -->
                </div>
            </div>
        </div>

        <!-- Recent Reservations Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Reservations</h3>
                <button onclick="exportReservations()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm">
                    📥 Export Data
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reservation ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Restaurant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date & Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Party Size</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                        </tr>
                    </thead>
                    <tbody id="reservationsTable" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
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
    const status = document.getElementById('statusFilter').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (fromDate) params.append('from_date', fromDate);
    if (toDate) params.append('to_date', toDate);
    if (restaurantId) params.append('restaurant_id', restaurantId);
    if (status) params.append('status', status);
    
    // Fetch reservation analytics data
    fetch(`/api/admin/analytics/reservations?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateMetrics(data.data);
                updateCharts(data.data);
                updateReservationsTable(data.data.recent_reservations || []);
                updateTopLists(data.data);
            }
        })
        .catch(error => {
            console.error('Error fetching reservation analytics:', error);
        });
}

function updateMetrics(data) {
    document.getElementById('totalReservations').textContent = data.total_reservations.toLocaleString();
    document.getElementById('confirmationRate').textContent = data.confirmation_rate + '%';
    document.getElementById('avgPartySize').textContent = data.average_party_size;
    document.getElementById('peakHour').textContent = data.peak_hour || '-';
    document.getElementById('peakHourReservations').textContent = (data.peak_hour_count || 0) + ' reservations';
    
    // Growth indicators
    const growthClass = data.growth_percentage > 0 ? 'text-green-600' : 'text-red-600';
    document.getElementById('reservationGrowth').textContent = (data.growth_percentage > 0 ? '+' : '') + data.growth_percentage + '%';
    document.getElementById('reservationGrowth').className = 'text-xs ' + growthClass;
    
    const confirmationClass = data.confirmation_rate_change > 0 ? 'text-green-600' : 'text-red-600';
    document.getElementById('confirmationChange').textContent = (data.confirmation_rate_change > 0 ? '+' : '') + data.confirmation_rate_change + '%';
    document.getElementById('confirmationChange').className = 'text-xs ' + confirmationClass;
}

let reservationsTrendChart, statusDistributionChart, hourlyDistributionChart, weeklyPatternChart, partySizeChart;

function initializeCharts() {
    // Reservations Trend Chart
    const trendCtx = document.getElementById('reservationsTrendChart').getContext('2d');
    reservationsTrendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Reservations',
                data: [],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
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
    
    // Status Distribution Chart
    const statusCtx = document.getElementById('statusDistributionChart').getContext('2d');
    statusDistributionChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Confirmed', 'Pending', 'Cancelled', 'Completed'],
            datasets: [{
                data: [0, 0, 0, 0],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#6b7280']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    // Hourly Distribution Chart
    const hourlyCtx = document.getElementById('hourlyDistributionChart').getContext('2d');
    hourlyDistributionChart = new Chart(hourlyCtx, {
        type: 'bar',
        data: {
            labels: Array.from({length: 24}, (_, i) => i + ':00'),
            datasets: [{
                label: 'Reservations',
                data: new Array(24).fill(0),
                backgroundColor: 'rgba(147, 51, 234, 0.8)'
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
    
    // Weekly Pattern Chart
    const weeklyCtx = document.getElementById('weeklyPatternChart').getContext('2d');
    weeklyPatternChart = new Chart(weeklyCtx, {
        type: 'radar',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Reservations',
                data: new Array(7).fill(0),
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.2)'
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
    
    // Party Size Chart
    const partySizeCtx = document.getElementById('partySizeChart').getContext('2d');
    partySizeChart = new Chart(partySizeCtx, {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5', '6+'],
            datasets: [{
                label: 'Count',
                data: new Array(6).fill(0),
                backgroundColor: 'rgba(249, 115, 22, 0.8)'
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
        reservationsTrendChart.data.labels = data.time_series.map(item => item.date);
        reservationsTrendChart.data.datasets[0].data = data.time_series.map(item => item.reservations);
        reservationsTrendChart.update();
    }
    
    // Update status distribution
    if (data.status_distribution) {
        statusDistributionChart.data.datasets[0].data = [
            data.status_distribution.confirmed || 0,
            data.status_distribution.pending || 0,
            data.status_distribution.cancelled || 0,
            data.status_distribution.completed || 0
        ];
        statusDistributionChart.update();
    }
    
    // Update hourly distribution
    if (data.hourly_distribution) {
        hourlyDistributionChart.data.datasets[0].data = data.hourly_distribution;
        hourlyDistributionChart.update();
    }
    
    // Update weekly pattern
    if (data.weekly_pattern) {
        weeklyPatternChart.data.datasets[0].data = data.weekly_pattern;
        weeklyPatternChart.update();
    }
    
    // Update party size distribution
    if (data.party_size_distribution) {
        partySizeChart.data.datasets[0].data = data.party_size_distribution;
        partySizeChart.update();
    }
}

function updateReservationsTable(reservations) {
    const tbody = document.getElementById('reservationsTable');
    tbody.innerHTML = '';
    
    if (reservations.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                No reservations found for the selected criteria.
            </td>
        `;
        tbody.appendChild(row);
        return;
    }
    
    reservations.forEach(reservation => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${reservation.id}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${reservation.restaurant_name || '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                ${new Date(reservation.reservation_date).toLocaleDateString()} ${reservation.reservation_time || ''}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${reservation.party_size || '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusClass(reservation.status)}">
                    ${reservation.status}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${reservation.customer_name || reservation.customer_email || '-'}</td>
        `;
        tbody.appendChild(row);
    });
}

function updateTopLists(data) {
    // Update top restaurants by volume
    const volumeContainer = document.getElementById('topRestaurantsByVolume');
    volumeContainer.innerHTML = '';
    
    if (data.top_restaurants_by_volume) {
        data.top_restaurants_by_volume.forEach((restaurant, index) => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg';
            item.innerHTML = `
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-900 dark:text-white mr-2">${index + 1}.</span>
                    <span class="text-sm text-gray-900 dark:text-white">${restaurant.name}</span>
                </div>
                <span class="text-sm font-semibold text-blue-600">${restaurant.reservation_count} reservations</span>
            `;
            volumeContainer.appendChild(item);
        });
    }
    
    // Update best conversion rates
    const conversionContainer = document.getElementById('bestConversionRates');
    conversionContainer.innerHTML = '';
    
    if (data.best_conversion_rates) {
        data.best_conversion_rates.forEach((restaurant, index) => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg';
            item.innerHTML = `
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-900 dark:text-white mr-2">${index + 1}.</span>
                    <span class="text-sm text-gray-900 dark:text-white">${restaurant.name}</span>
                </div>
                <span class="text-sm font-semibold text-green-600">${restaurant.conversion_rate}%</span>
            `;
            conversionContainer.appendChild(item);
        });
    }
}

function getStatusClass(status) {
    switch(status) {
        case 'confirmed': return 'bg-green-100 text-green-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'cancelled': return 'bg-red-100 text-red-800';
        case 'completed': return 'bg-gray-100 text-gray-800';
        default: return 'bg-blue-100 text-blue-800';
    }
}

function exportReservations() {
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const restaurantId = document.getElementById('restaurantFilter').value;
    const status = document.getElementById('statusFilter').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (fromDate) params.append('from_date', fromDate);
    if (toDate) params.append('to_date', toDate);
    if (restaurantId) params.append('restaurant_id', restaurantId);
    if (status) params.append('status', status);
    params.append('type', 'reservations');
    params.append('format', 'excel');
    
    // Trigger export
    window.open(`/api/admin/analytics/export?${params}`, '_blank');
}
</script>
</x-layouts.app>
