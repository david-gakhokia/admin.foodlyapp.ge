<x-layouts.app title="Analytics Reports">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📋 Analytics Reports</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Generate and manage custom analytics reports</p>
            </div>
            <button onclick="showCreateReportModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                ➕ Generate New Report
            </button>
        </div>

        <!-- Report Filters -->
        <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex flex-wrap items-center gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Report Type</label>
                    <select id="typeFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="">All Types</option>
                        <option value="dashboard">Dashboard</option>
                        <option value="bog_payments">BOG Payments</option>
                        <option value="revenue">Revenue</option>
                        <option value="conversion_funnel">Conversion Funnel</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select id="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Range</label>
                    <select id="dateFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="quarter">This Quarter</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="refreshReports()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                        🔄 Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            📊
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Reports</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="totalReports">-</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            ✅
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="completedReports">-</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            ⏳
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">In Progress</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="progressReports">-</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            ❌
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Failed</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white" id="failedReports">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Reports List</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Report Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Expires</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="reportsTable" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Dynamic content -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Report Modal -->
<div id="createReportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Generate New Report</h3>
            <div class="mt-4 space-y-4">
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Report Name</label>
                    <input type="text" id="reportName" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white" placeholder="Enter report name">
                </div>
                
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Report Type</label>
                    <select id="reportType" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="dashboard">Dashboard Overview</option>
                        <option value="bog_payments">BOG Payments Analysis</option>
                        <option value="revenue">Revenue Analysis</option>
                        <option value="conversion_funnel">Conversion Funnel</option>
                        <option value="custom">Custom Report</option>
                    </select>
                </div>
                
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Date</label>
                    <input type="date" id="reportFromDate" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To Date</label>
                    <input type="date" id="reportToDate" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Restaurant (Optional)</label>
                    <select id="reportRestaurant" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="">All Restaurants</option>
                    </select>
                </div>
                
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Format</label>
                    <select id="reportFormat" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option value="excel">Excel (.xlsx)</option>
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-center space-x-4 mt-6">
                <button onclick="hideCreateReportModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600">
                    Cancel
                </button>
                <button onclick="generateReport()" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-600">
                    Generate Report
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set default dates for report generation
    const today = new Date();
    const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
    
    document.getElementById('reportFromDate').value = lastMonth.toISOString().split('T')[0];
    document.getElementById('reportToDate').value = today.toISOString().split('T')[0];
    
    // Load initial reports
    refreshReports();
});

function refreshReports() {
    const typeFilter = document.getElementById('typeFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (typeFilter) params.append('type', typeFilter);
    if (statusFilter) params.append('status', statusFilter);
    if (dateFilter) params.append('date_range', dateFilter);
    
    // Fetch reports data
    fetch(`/api/admin/analytics/reports?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateStats(data.data.stats);
                updateReportsTable(data.data.reports);
            }
        })
        .catch(error => {
            console.error('Error fetching reports:', error);
        });
}

function updateStats(stats) {
    document.getElementById('totalReports').textContent = stats.total;
    document.getElementById('completedReports').textContent = stats.completed;
    document.getElementById('progressReports').textContent = stats.processing + stats.pending;
    document.getElementById('failedReports').textContent = stats.failed;
}

function updateReportsTable(reports) {
    const tbody = document.getElementById('reportsTable');
    tbody.innerHTML = '';
    
    reports.forEach(report => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${report.name}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                <span class="capitalize">${report.type.replace('_', ' ')}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusClass(report.status)}">
                    ${report.status}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${new Date(report.created_at).toLocaleDateString()}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${report.expires_at ? new Date(report.expires_at).toLocaleDateString() : 'Never'}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex space-x-2">
                    ${report.status === 'completed' ? `
                        <button onclick="downloadReport('${report.id}')" class="text-blue-600 hover:text-blue-900">Download</button>
                        <button onclick="viewReport('${report.id}')" class="text-green-600 hover:text-green-900">View</button>
                    ` : ''}
                    ${report.status === 'failed' ? `
                        <button onclick="regenerateReport('${report.id}')" class="text-yellow-600 hover:text-yellow-900">Retry</button>
                    ` : ''}
                    <button onclick="deleteReport('${report.id}')" class="text-red-600 hover:text-red-900">Delete</button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function getStatusClass(status) {
    switch(status) {
        case 'completed': return 'bg-green-100 text-green-800';
        case 'processing': return 'bg-blue-100 text-blue-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'failed': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function showCreateReportModal() {
    document.getElementById('createReportModal').classList.remove('hidden');
}

function hideCreateReportModal() {
    document.getElementById('createReportModal').classList.add('hidden');
    // Reset form
    document.getElementById('reportName').value = '';
    document.getElementById('reportType').value = 'dashboard';
    document.getElementById('reportRestaurant').value = '';
    document.getElementById('reportFormat').value = 'excel';
}

function generateReport() {
    const name = document.getElementById('reportName').value;
    const type = document.getElementById('reportType').value;
    const fromDate = document.getElementById('reportFromDate').value;
    const toDate = document.getElementById('reportToDate').value;
    const restaurantId = document.getElementById('reportRestaurant').value;
    const format = document.getElementById('reportFormat').value;
    
    if (!name) {
        alert('Please enter a report name');
        return;
    }
    
    const data = {
        name: name,
        type: type,
        from_date: fromDate,
        to_date: toDate,
        format: format,
        parameters: {
            restaurant_id: restaurantId || null
        }
    };
    
    fetch('/api/admin/analytics/reports', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            hideCreateReportModal();
            refreshReports();
            alert('Report generation started successfully!');
        } else {
            alert('Error generating report: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error generating report:', error);
        alert('Error generating report');
    });
}

function downloadReport(reportId) {
    // Trigger download
    window.open(`/api/admin/analytics/reports/${reportId}/download`, '_blank');
}

function viewReport(reportId) {
    // Open report in new tab
    window.open(`/api/admin/analytics/reports/${reportId}`, '_blank');
}

function regenerateReport(reportId) {
    if (confirm('Are you sure you want to regenerate this report?')) {
        fetch(`/api/admin/analytics/reports/${reportId}/regenerate`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                refreshReports();
                alert('Report regeneration started successfully!');
            } else {
                alert('Error regenerating report: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error regenerating report:', error);
            alert('Error regenerating report');
        });
    }
}

function deleteReport(reportId) {
    if (confirm('Are you sure you want to delete this report?')) {
        fetch(`/api/admin/analytics/reports/${reportId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                refreshReports();
                alert('Report deleted successfully!');
            } else {
                alert('Error deleting report: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error deleting report:', error);
            alert('Error deleting report');
        });
    }
}
</script>
</x-layouts.app>
