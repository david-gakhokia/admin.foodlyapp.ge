<x-layouts.app title="Conversion Funnel Analytics">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">🎯 Conversion Funnel Analytics</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Track user journey from visit to successful reservation</p>
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
                <div class="flex items-end">
                    <button onclick="refreshData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        🔄 Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Conversion Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Overall Conversion Rate -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            🎯
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Overall Conversion</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="overallConversion">-</p>
                        <p class="text-xs" id="conversionChange">-</p>
                    </div>
                </div>
            </div>

            <!-- Payment Conversion -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            💳
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Payment Conversion</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="paymentConversion">-</p>
                        <p class="text-xs" id="paymentChange">-</p>
                    </div>
                </div>
            </div>

            <!-- Drop-off Rate -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            📉
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Drop-off Rate</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="dropoffRate">-</p>
                        <p class="text-xs" id="dropoffChange">-</p>
                    </div>
                </div>
            </div>

            <!-- Avg Time to Convert -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            ⏱️
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Avg Time to Convert</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="avgTimeToConvert">-</p>
                        <p class="text-xs text-gray-500">minutes</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Funnel Visualization -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Conversion Funnel</h3>
            <div class="space-y-4">
                <!-- Restaurant Visits -->
                <div class="flex items-center">
                    <div class="w-full">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">1. Restaurant Visits</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400" id="visits">-</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-blue-600 h-4 rounded-full" style="width: 100%" id="visitsBar"></div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Attempts -->
                <div class="flex items-center">
                    <div class="w-full">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">2. Reservation Attempts</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400" id="attempts">-</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-indigo-600 h-4 rounded-full" id="attemptsBar"></div>
                        </div>
                    </div>
                </div>

                <!-- Payment Initiated -->
                <div class="flex items-center">
                    <div class="w-full">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">3. Payment Initiated</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400" id="paymentInitiated">-</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-purple-600 h-4 rounded-full" id="paymentInitiatedBar"></div>
                        </div>
                    </div>
                </div>

                <!-- Successful Reservations -->
                <div class="flex items-center">
                    <div class="w-full">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">4. Successful Reservations</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400" id="successful">-</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-green-600 h-4 rounded-full" id="successfulBar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conversion Rates Between Steps -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Visit → Attempt</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="visitToAttempt">-</p>
                </div>
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Attempt → Payment</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="attemptToPayment">-</p>
                </div>
                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Payment → Success</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="paymentToSuccess">-</p>
                </div>
            </div>
        </div>

        <!-- Detailed Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Conversion by Time -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Conversion Rate Over Time</h3>
                <div class="h-64">
                    <canvas id="conversionTrendChart"></canvas>
                </div>
            </div>

            <!-- Drop-off Analysis -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Drop-off Points</h3>
                <div class="h-64">
                    <canvas id="dropoffChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Restaurant Performance -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Best Performing Restaurants -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Best Converting Restaurants</h3>
                <div id="bestRestaurants" class="space-y-3">
                    <!-- Dynamic content -->
                </div>
            </div>

            <!-- Improvement Opportunities -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Improvement Opportunities</h3>
                <div id="improvements" class="space-y-3">
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
    
    // Fetch conversion funnel data
    fetch(`/api/admin/analytics/conversion-funnel?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateMetrics(data.data);
                updateFunnel(data.data);
                updateCharts(data.data);
                updateRestaurantLists(data.data);
            }
        })
        .catch(error => {
            console.error('Error fetching conversion funnel data:', error);
        });
}

function updateMetrics(data) {
    document.getElementById('overallConversion').textContent = data.overall_conversion_rate + '%';
    document.getElementById('paymentConversion').textContent = data.payment_conversion_rate + '%';
    document.getElementById('dropoffRate').textContent = data.dropoff_rate + '%';
    document.getElementById('avgTimeToConvert').textContent = data.avg_time_to_convert || '-';
}

function updateFunnel(data) {
    const steps = data.funnel_steps;
    
    // Update step values
    document.getElementById('visits').textContent = steps.visits.toLocaleString();
    document.getElementById('attempts').textContent = steps.reservation_attempts.toLocaleString();
    document.getElementById('paymentInitiated').textContent = steps.payment_initiated.toLocaleString();
    document.getElementById('successful').textContent = steps.successful_reservations.toLocaleString();
    
    // Update progress bars
    const maxValue = steps.visits;
    document.getElementById('attemptsBar').style.width = (steps.reservation_attempts / maxValue * 100) + '%';
    document.getElementById('paymentInitiatedBar').style.width = (steps.payment_initiated / maxValue * 100) + '%';
    document.getElementById('successfulBar').style.width = (steps.successful_reservations / maxValue * 100) + '%';
    
    // Update conversion rates between steps
    const visitToAttempt = steps.visits > 0 ? ((steps.reservation_attempts / steps.visits) * 100).toFixed(1) : 0;
    const attemptToPayment = steps.reservation_attempts > 0 ? ((steps.payment_initiated / steps.reservation_attempts) * 100).toFixed(1) : 0;
    const paymentToSuccess = steps.payment_initiated > 0 ? ((steps.successful_reservations / steps.payment_initiated) * 100).toFixed(1) : 0;
    
    document.getElementById('visitToAttempt').textContent = visitToAttempt + '%';
    document.getElementById('attemptToPayment').textContent = attemptToPayment + '%';
    document.getElementById('paymentToSuccess').textContent = paymentToSuccess + '%';
}

let conversionTrendChart, dropoffChart;

function initializeCharts() {
    // Conversion Trend Chart
    const trendCtx = document.getElementById('conversionTrendChart').getContext('2d');
    conversionTrendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Conversion Rate (%)',
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
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
    
    // Drop-off Chart
    const dropoffCtx = document.getElementById('dropoffChart').getContext('2d');
    dropoffChart = new Chart(dropoffCtx, {
        type: 'bar',
        data: {
            labels: ['Visit → Attempt', 'Attempt → Payment', 'Payment → Success'],
            datasets: [{
                label: 'Drop-off Rate (%)',
                data: [0, 0, 0],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
}

function updateCharts(data) {
    // Update conversion trend chart if time series data available
    if (data.time_series) {
        conversionTrendChart.data.labels = data.time_series.map(item => item.date);
        conversionTrendChart.data.datasets[0].data = data.time_series.map(item => item.conversion_rate);
        conversionTrendChart.update();
    }
    
    // Update drop-off chart
    if (data.dropoff_analysis) {
        dropoffChart.data.datasets[0].data = [
            data.dropoff_analysis.visit_to_attempt,
            data.dropoff_analysis.attempt_to_payment,
            data.dropoff_analysis.payment_to_success
        ];
        dropoffChart.update();
    }
}

function updateRestaurantLists(data) {
    // Update best performing restaurants
    const bestContainer = document.getElementById('bestRestaurants');
    bestContainer.innerHTML = '';
    
    if (data.best_restaurants) {
        data.best_restaurants.forEach((restaurant, index) => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg';
            item.innerHTML = `
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-900 dark:text-white mr-2">${index + 1}.</span>
                    <span class="text-sm text-gray-900 dark:text-white">${restaurant.name}</span>
                </div>
                <span class="text-sm font-semibold text-green-600">${restaurant.conversion_rate}%</span>
            `;
            bestContainer.appendChild(item);
        });
    }
    
    // Update improvement opportunities
    const improvementContainer = document.getElementById('improvements');
    improvementContainer.innerHTML = '';
    
    if (data.improvement_opportunities) {
        data.improvement_opportunities.forEach(opportunity => {
            const item = document.createElement('div');
            item.className = 'p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800';
            item.innerHTML = `
                <div class="flex items-start">
                    <span class="text-yellow-600 mr-2">⚠️</span>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">${opportunity.title}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">${opportunity.description}</p>
                        <p class="text-xs text-yellow-600 mt-1">Potential improvement: +${opportunity.potential_improvement}%</p>
                    </div>
                </div>
            `;
            improvementContainer.appendChild(item);
        });
    }
}
</script>
</x-layouts.app>
