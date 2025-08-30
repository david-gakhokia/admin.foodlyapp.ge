<x-layouts.app>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">🔥 Real-time Monitoring</h1>
                        <p class="text-gray-600 mt-1">Live system performance and activity monitoring</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-sm text-gray-600">Live</span>
                        </div>
                        <div class="text-sm text-gray-500" id="last-update">
                            Last updated: <span id="timestamp">--</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- System Health Alert Banner -->
            <div id="health-alert" class="hidden mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">System Alert</h3>
                        <div class="mt-2 text-sm text-red-700" id="alert-message"></div>
                    </div>
                </div>
            </div>

            <!-- Main Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Reservations Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Reservations Today</p>
                            <p class="text-2xl font-bold text-gray-900" id="reservations-today">--</p>
                            <p class="text-sm text-gray-500">
                                <span id="reservations-last-hour" class="text-green-600">+--</span> last hour
                            </p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="text-xs text-gray-500">Conversion Rate</div>
                        <div class="text-lg font-semibold text-green-600" id="conversion-rate">--%</div>
                    </div>
                </div>

                <!-- Email System Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Emails Sent</p>
                            <p class="text-2xl font-bold text-gray-900" id="emails-sent">--</p>
                            <p class="text-sm">
                                <span id="emails-pending" class="text-yellow-600">-- pending</span> • 
                                <span id="emails-failed" class="text-red-600">-- failed</span>
                            </p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="text-xs text-gray-500">Delivery Rate</div>
                        <div class="text-lg font-semibold text-green-600" id="delivery-rate">--%</div>
                    </div>
                </div>

                <!-- Queue System Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Queue Jobs</p>
                            <p class="text-2xl font-bold text-gray-900" id="pending-jobs">--</p>
                            <p class="text-sm">
                                <span id="failed-jobs" class="text-red-600">-- failed</span>
                            </p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="text-xs text-gray-500">Avg Wait Time</div>
                        <div class="text-lg font-semibold text-blue-600" id="avg-wait-time">--s</div>
                    </div>
                </div>

                <!-- System Performance Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">System Health</p>
                            <p class="text-2xl font-bold" id="system-status">--</p>
                            <p class="text-sm">
                                <span id="error-rate" class="text-red-600">--%</span> error rate
                            </p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="text-xs text-gray-500">Response Time</div>
                        <div class="text-lg font-semibold text-purple-600" id="response-time">--ms</div>
                    </div>
                </div>
            </div>

            <!-- Charts and Activity Feed Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Hourly Activity Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">📊 Hourly Activity</h3>
                    <canvas id="hourlyChart" width="400" height="200"></canvas>
                </div>

                <!-- Live Activity Feed -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">⚡ Live Activity Feed</h3>
                    <div id="activity-feed" class="space-y-3 max-h-80 overflow-y-auto">
                        <!-- Activities will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- System Health Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Reservations -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">🍽️ Recent Reservations</h3>
                    <div id="recent-reservations" class="space-y-3 max-h-64 overflow-y-auto">
                        <!-- Reservations will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Email Activities -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">📧 Email Activities</h3>
                    <div id="email-activities" class="space-y-3 max-h-64 overflow-y-auto">
                        <!-- Email activities will be populated by JavaScript -->
                    </div>
                </div>

                <!-- System Health -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">🏥 System Health</h3>
                    <div id="system-health" class="space-y-3">
                        <!-- Health metrics will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Real-time monitoring JavaScript
        let updateInterval;
        let hourlyChart;

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
            updateDashboard();
            startAutoUpdate();
        });

        function initializeCharts() {
            const ctx = document.getElementById('hourlyChart').getContext('2d');
            hourlyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array.from({length: 24}, (_, i) => `${i}:00`),
                    datasets: [{
                        label: 'Reservations',
                        data: new Array(24).fill(0),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateDashboard() {
            // Update main stats
            fetch('/admin/monitoring/api')
                .then(response => response.json())
                .then(data => {
                    updateStats(data);
                    updateTimestamp();
                })
                .catch(error => {
                    console.error('Error updating dashboard:', error);
                    showAlert('Failed to update dashboard data');
                });

            // Update feeds
            updateActivityFeeds();
        }

        function updateStats(data) {
            // Reservations
            document.getElementById('reservations-today').textContent = data.reservations.total_today;
            document.getElementById('reservations-last-hour').textContent = `+${data.reservations.last_hour}`;
            document.getElementById('conversion-rate').textContent = `${data.reservations.conversion_rate}%`;

            // Emails
            document.getElementById('emails-sent').textContent = data.emails.sent_today;
            document.getElementById('emails-pending').textContent = `${data.emails.pending} pending`;
            document.getElementById('emails-failed').textContent = `${data.emails.failed} failed`;
            document.getElementById('delivery-rate').textContent = `${data.emails.delivery_rate}%`;

            // Queue
            document.getElementById('pending-jobs').textContent = data.queue.pending_jobs;
            document.getElementById('failed-jobs').textContent = `${data.queue.failed_jobs} failed`;
            document.getElementById('avg-wait-time').textContent = `${data.queue.avg_wait_time}s`;

            // Performance
            const errorRate = data.performance.error_rate;
            document.getElementById('system-status').textContent = errorRate < 1 ? '✅ Healthy' : '⚠️ Issues';
            document.getElementById('system-status').className = errorRate < 1 ? 'text-2xl font-bold text-green-600' : 'text-2xl font-bold text-yellow-600';
            document.getElementById('error-rate').textContent = `${errorRate}%`;
            document.getElementById('response-time').textContent = `${data.performance.response_time}ms`;
        }

        function updateActivityFeeds() {
            // Update reservations feed
            fetch('/admin/monitoring/reservations-feed')
                .then(response => response.json())
                .then(reservations => {
                    const container = document.getElementById('recent-reservations');
                    container.innerHTML = reservations.map(reservation => `
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <div>
                                <div class="text-sm font-medium">${reservation.customer_name}</div>
                                <div class="text-xs text-gray-500">${reservation.restaurant_name}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">${reservation.created_at}</div>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(reservation.status)}">
                                    ${reservation.status}
                                </span>
                            </div>
                        </div>
                    `).join('');
                });

            // Update email activities
            fetch('/admin/monitoring/email-activities')
                .then(response => response.json())
                .then(activities => {
                    const container = document.getElementById('email-activities');
                    container.innerHTML = activities.map(activity => `
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <div>
                                <div class="text-sm font-medium">${activity.recipient_type}</div>
                                <div class="text-xs text-gray-500">${activity.event_type}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">${activity.created_at}</div>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getEmailStatusColor(activity.status)}">
                                    ${activity.status}
                                </span>
                            </div>
                        </div>
                    `).join('');
                });

            // Update system health
            fetch('/admin/monitoring/system-health')
                .then(response => response.json())
                .then(health => {
                    const container = document.getElementById('system-health');
                    container.innerHTML = Object.entries(health).map(([key, value]) => `
                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                            <span class="text-sm font-medium capitalize">${key.replace('_', ' ')}</span>
                            <span class="text-xs ${value.status === 'healthy' ? 'text-green-600' : 'text-red-600'}">
                                ${value.status}
                            </span>
                        </div>
                    `).join('');
                });
        }

        function getStatusColor(status) {
            const colors = {
                'Pending': 'bg-yellow-100 text-yellow-800',
                'Confirmed': 'bg-green-100 text-green-800',
                'Completed': 'bg-blue-100 text-blue-800',
                'Cancelled': 'bg-red-100 text-red-800'
            };
            return colors[status] || 'bg-gray-100 text-gray-800';
        }

        function getEmailStatusColor(status) {
            const colors = {
                'delivered': 'bg-green-100 text-green-800',
                'pending': 'bg-yellow-100 text-yellow-800',
                'failed': 'bg-red-100 text-red-800',
                'bounced': 'bg-red-100 text-red-800'
            };
            return colors[status] || 'bg-gray-100 text-gray-800';
        }

        function updateTimestamp() {
            document.getElementById('timestamp').textContent = new Date().toLocaleTimeString();
        }

        function startAutoUpdate() {
            updateInterval = setInterval(() => {
                updateDashboard();
            }, 5000); // Update every 5 seconds
        }

        function stopAutoUpdate() {
            if (updateInterval) {
                clearInterval(updateInterval);
            }
        }

        function showAlert(message) {
            const alertElement = document.getElementById('health-alert');
            const messageElement = document.getElementById('alert-message');
            
            messageElement.textContent = message;
            alertElement.classList.remove('hidden');
            
            setTimeout(() => {
                alertElement.classList.add('hidden');
            }, 5000);
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', stopAutoUpdate);
    </script>
</x-layouts.app>
