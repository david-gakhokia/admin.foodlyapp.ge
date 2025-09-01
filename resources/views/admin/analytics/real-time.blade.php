<x-layouts.app title="Real-time Analytics">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">⚡ Real-time Analytics</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Live monitoring of system performance and user activity</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Live Updates</span>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400" id="lastUpdate">-</span>
            </div>
        </div>

        <!-- Real-time Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Active Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            👥
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Users</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="activeUsers">-</p>
                        <p class="text-xs text-blue-600" id="activeUsersChange">-</p>
                    </div>
                </div>
            </div>

            <!-- Live Reservations -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            📅
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Live Reservations</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="liveReservations">-</p>
                        <p class="text-xs text-green-600" id="reservationsToday">-</p>
                    </div>
                </div>
            </div>

            <!-- Processing Payments -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            ⏳
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Processing Payments</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="processingPayments">-</p>
                        <p class="text-xs text-yellow-600" id="paymentQueue">-</p>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            ⚡
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">System Health</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="systemHealth">-</p>
                        <p class="text-xs" id="systemStatus">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Real-time Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Live Activity Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Live Activity (Last 24 Hours)</h3>
                <div class="h-64">
                    <canvas id="liveActivityChart"></canvas>
                </div>
            </div>

            <!-- Payment Status Real-time -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Status Real-time</h3>
                <div class="h-64">
                    <canvas id="paymentStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Live Feed and System Status -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Live Activity Feed -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Live Activity Feed</h3>
                    <button onclick="togglePause()" id="pauseBtn" class="text-sm text-blue-600 hover:text-blue-800">⏸️ Pause</button>
                </div>
                <div class="h-96 overflow-y-auto p-4">
                    <div id="activityFeed" class="space-y-3">
                        <!-- Dynamic content -->
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Status</h3>
                </div>
                <div class="p-4 space-y-4">
                    <!-- Database Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Database</span>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2" id="dbStatus"></div>
                            <span class="text-sm text-gray-900 dark:text-white" id="dbStatusText">Online</span>
                        </div>
                    </div>

                    <!-- Redis Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Redis Cache</span>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2" id="redisStatus"></div>
                            <span class="text-sm text-gray-900 dark:text-white" id="redisStatusText">Online</span>
                        </div>
                    </div>

                    <!-- Queue Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Job Queue</span>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2" id="queueStatus"></div>
                            <span class="text-sm text-gray-900 dark:text-white" id="queueStatusText">Running</span>
                        </div>
                    </div>

                    <!-- BOG Gateway -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">BOG Gateway</span>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2" id="bogStatus"></div>
                            <span class="text-sm text-gray-900 dark:text-white" id="bogStatusText">Connected</span>
                        </div>
                    </div>

                    <!-- Response Time -->
                    <div class="mt-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Avg Response Time</span>
                            <span class="text-gray-900 dark:text-white" id="responseTime">-</span>
                        </div>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 85%" id="responseTimeBar"></div>
                        </div>
                    </div>

                    <!-- API Calls -->
                    <div class="mt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">API Calls/min</span>
                            <span class="text-gray-900 dark:text-white" id="apiCalls">-</span>
                        </div>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 65%" id="apiCallsBar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Logs -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Errors & Warnings</h3>
                <button onclick="clearErrorLog()" class="text-sm text-red-600 hover:text-red-800">🗑️ Clear Log</button>
            </div>
            <div class="max-h-64 overflow-y-auto">
                <div id="errorLog" class="p-4 space-y-2">
                    <!-- Dynamic content -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let isPaused = false;
let liveActivityChart, paymentStatusChart;
let websocket = null;

document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
    initializeWebSocket();
    startRealTimeUpdates();
});

function initializeCharts() {
    // Live Activity Chart
    const activityCtx = document.getElementById('liveActivityChart').getContext('2d');
    liveActivityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: generateTimeLabels(),
            datasets: [{
                label: 'Active Users',
                data: new Array(24).fill(0),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Reservations',
                data: new Array(24).fill(0),
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 750
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Payment Status Chart
    const paymentCtx = document.getElementById('paymentStatusChart').getContext('2d');
    paymentStatusChart = new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Successful', 'Failed', 'Processing'],
            datasets: [{
                data: [0, 0, 0],
                backgroundColor: ['#10b981', '#ef4444', '#f59e0b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 500
            }
        }
    });
}

function generateTimeLabels() {
    const labels = [];
    for (let i = 23; i >= 0; i--) {
        const time = new Date(Date.now() - i * 60 * 60 * 1000);
        labels.push(time.getHours() + ':00');
    }
    return labels;
}

function initializeWebSocket() {
    // Initialize WebSocket connection for real-time updates
    // This would connect to your WebSocket server
    console.log('WebSocket connection would be initialized here');
}

function startRealTimeUpdates() {
    // Fetch initial data
    fetchRealTimeData();
    
    // Set up polling for real-time updates
    setInterval(() => {
        if (!isPaused) {
            fetchRealTimeData();
        }
    }, 5000); // Update every 5 seconds
}

function fetchRealTimeData() {
    fetch('/api/admin/analytics/real-time')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateRealTimeStats(data.data);
                updateCharts(data.data);
                updateActivityFeed(data.data.recent_activities || []);
                updateSystemStatus(data.data.system_status || {});
                updateErrorLog(data.data.recent_errors || []);
                
                // Update last update time
                document.getElementById('lastUpdate').textContent = new Date().toLocaleTimeString();
            }
        })
        .catch(error => {
            console.error('Error fetching real-time data:', error);
        });
}

function updateRealTimeStats(data) {
    document.getElementById('activeUsers').textContent = data.active_users || 0;
    document.getElementById('liveReservations').textContent = data.live_reservations || 0;
    document.getElementById('processingPayments').textContent = data.processing_payments || 0;
    document.getElementById('systemHealth').textContent = data.system_health || 'Unknown';
    
    // Update additional stats
    document.getElementById('reservationsToday').textContent = (data.reservations_today || 0) + ' today';
    document.getElementById('paymentQueue').textContent = (data.payment_queue_size || 0) + ' in queue';
    
    // Update system status text
    const healthElement = document.getElementById('systemStatus');
    const healthScore = data.system_health_score || 0;
    if (healthScore >= 90) {
        healthElement.textContent = 'Excellent';
        healthElement.className = 'text-xs text-green-600';
    } else if (healthScore >= 70) {
        healthElement.textContent = 'Good';
        healthElement.className = 'text-xs text-yellow-600';
    } else {
        healthElement.textContent = 'Poor';
        healthElement.className = 'text-xs text-red-600';
    }
}

function updateCharts(data) {
    // Update live activity chart
    if (data.hourly_activity) {
        liveActivityChart.data.datasets[0].data = data.hourly_activity.users || new Array(24).fill(0);
        liveActivityChart.data.datasets[1].data = data.hourly_activity.reservations || new Array(24).fill(0);
        liveActivityChart.update('none'); // No animation for real-time updates
    }
    
    // Update payment status chart
    if (data.payment_status) {
        paymentStatusChart.data.datasets[0].data = [
            data.payment_status.successful || 0,
            data.payment_status.failed || 0,
            data.payment_status.processing || 0
        ];
        paymentStatusChart.update('none');
    }
}

function updateActivityFeed(activities) {
    const feedContainer = document.getElementById('activityFeed');
    
    activities.forEach(activity => {
        const activityElement = document.createElement('div');
        activityElement.className = 'flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg animate-fadeIn';
        
        const iconClass = getActivityIcon(activity.type);
        const timeAgo = getTimeAgo(activity.timestamp);
        
        activityElement.innerHTML = `
            <div class="flex-shrink-0">
                <div class="w-8 h-8 ${iconClass} rounded-full flex items-center justify-center">
                    ${getActivityEmoji(activity.type)}
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-900 dark:text-white">${activity.message}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">${timeAgo}</p>
            </div>
        `;
        
        // Insert at the beginning
        feedContainer.insertBefore(activityElement, feedContainer.firstChild);
        
        // Keep only last 50 activities
        while (feedContainer.children.length > 50) {
            feedContainer.removeChild(feedContainer.lastChild);
        }
    });
}

function updateSystemStatus(status) {
    // Update database status
    updateStatusIndicator('db', status.database || { status: 'online', response_time: 0 });
    
    // Update Redis status
    updateStatusIndicator('redis', status.redis || { status: 'online', response_time: 0 });
    
    // Update queue status
    updateStatusIndicator('queue', status.queue || { status: 'running', jobs_pending: 0 });
    
    // Update BOG gateway status
    updateStatusIndicator('bog', status.bog_gateway || { status: 'connected', response_time: 0 });
    
    // Update performance metrics
    document.getElementById('responseTime').textContent = (status.avg_response_time || 0) + 'ms';
    document.getElementById('apiCalls').textContent = status.api_calls_per_minute || 0;
    
    // Update progress bars
    const responseTimePercentage = Math.min((status.avg_response_time || 0) / 1000 * 100, 100);
    const apiCallsPercentage = Math.min((status.api_calls_per_minute || 0) / 100 * 100, 100);
    
    document.getElementById('responseTimeBar').style.width = responseTimePercentage + '%';
    document.getElementById('apiCallsBar').style.width = apiCallsPercentage + '%';
}

function updateStatusIndicator(service, status) {
    const statusElement = document.getElementById(service + 'Status');
    const textElement = document.getElementById(service + 'StatusText');
    
    if (status.status === 'online' || status.status === 'running' || status.status === 'connected') {
        statusElement.className = 'w-2 h-2 bg-green-500 rounded-full mr-2';
        textElement.textContent = status.status;
    } else {
        statusElement.className = 'w-2 h-2 bg-red-500 rounded-full mr-2';
        textElement.textContent = status.status;
    }
}

function updateErrorLog(errors) {
    const logContainer = document.getElementById('errorLog');
    
    if (errors.length === 0) {
        logContainer.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">No recent errors</p>';
        return;
    }
    
    logContainer.innerHTML = '';
    errors.forEach(error => {
        const errorElement = document.createElement('div');
        errorElement.className = 'flex items-start space-x-3 p-2 border border-red-200 dark:border-red-800 rounded bg-red-50 dark:bg-red-900/20';
        
        errorElement.innerHTML = `
            <div class="flex-shrink-0">
                <span class="text-red-600">${error.level === 'error' ? '❌' : '⚠️'}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-red-800 dark:text-red-200">${error.message}</p>
                <p class="text-xs text-red-600 dark:text-red-400">${getTimeAgo(error.timestamp)}</p>
            </div>
        `;
        
        logContainer.appendChild(errorElement);
    });
}

function getActivityIcon(type) {
    switch(type) {
        case 'reservation': return 'bg-green-100';
        case 'payment': return 'bg-blue-100';
        case 'user_login': return 'bg-purple-100';
        case 'error': return 'bg-red-100';
        default: return 'bg-gray-100';
    }
}

function getActivityEmoji(type) {
    switch(type) {
        case 'reservation': return '📅';
        case 'payment': return '💳';
        case 'user_login': return '👤';
        case 'error': return '❌';
        default: return '📊';
    }
}

function getTimeAgo(timestamp) {
    const now = new Date();
    const time = new Date(timestamp);
    const diff = Math.floor((now - time) / 1000);
    
    if (diff < 60) return 'Just now';
    if (diff < 3600) return Math.floor(diff / 60) + ' minutes ago';
    if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
    return Math.floor(diff / 86400) + ' days ago';
}

function togglePause() {
    isPaused = !isPaused;
    const btn = document.getElementById('pauseBtn');
    btn.textContent = isPaused ? '▶️ Resume' : '⏸️ Pause';
}

function clearErrorLog() {
    if (confirm('Are you sure you want to clear the error log?')) {
        document.getElementById('errorLog').innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Error log cleared</p>';
    }
}

// Add CSS for fade-in animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.5s ease-out;
    }
`;
document.head.appendChild(style);
</script>
</x-layouts.app>
