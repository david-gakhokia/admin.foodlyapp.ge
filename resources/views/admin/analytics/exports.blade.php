<x-layouts.app title="Analytics Exports">
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📥 Analytics Exports</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Export and download analytics data in various formats</p>
        </div>

        <!-- Export Options -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Quick Exports -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Exports</h3>
                <div class="space-y-3">
                    <button onclick="quickExport('dashboard')" class="w-full text-left p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                📊
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Dashboard Overview</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Export complete dashboard metrics</p>
                            </div>
                        </div>
                    </button>
                    
                    <button onclick="quickExport('bog_payments')" class="w-full text-left p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                💳
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">BOG Payment Data</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Export all payment transactions</p>
                            </div>
                        </div>
                    </button>
                    
                    <button onclick="quickExport('revenue')" class="w-full text-left p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                💰
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Revenue Report</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Export revenue analysis</p>
                            </div>
                        </div>
                    </button>
                    
                    <button onclick="quickExport('reservations')" class="w-full text-left p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                📅
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">Reservations Data</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Export reservation statistics</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Custom Export -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Custom Export</h3>
                <form id="customExportForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Export Type</label>
                        <select id="exportType" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                            <option value="dashboard">Dashboard Overview</option>
                            <option value="bog_payments">BOG Payments</option>
                            <option value="revenue">Revenue Analysis</option>
                            <option value="conversion_funnel">Conversion Funnel</option>
                            <option value="custom">Custom Query</option>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Date</label>
                            <input type="date" id="fromDate" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To Date</label>
                            <input type="date" id="toDate" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Restaurant</label>
                        <select id="restaurantId" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                            <option value="">All Restaurants</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Format</label>
                        <select id="format" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                            <option value="excel">Excel (.xlsx)</option>
                            <option value="csv">CSV</option>
                            <option value="pdf">PDF</option>
                            <option value="json">JSON</option>
                        </select>
                    </div>
                    
                    <div id="customQuerySection" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Custom Query</label>
                        <textarea id="customQuery" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white" placeholder="Enter custom SQL query..."></textarea>
                    </div>
                    
                    <button type="button" onclick="customExport()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        📥 Generate Export
                    </button>
                </form>
            </div>
        </div>

        <!-- Export History -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Export History</h3>
                <button onclick="refreshHistory()" class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                    🔄 Refresh
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Export Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Format</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date Range</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="exportHistoryTable" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Dynamic content -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set default dates
    const today = new Date();
    const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
    
    document.getElementById('fromDate').value = lastMonth.toISOString().split('T')[0];
    document.getElementById('toDate').value = today.toISOString().split('T')[0];
    
    // Show/hide custom query section
    document.getElementById('exportType').addEventListener('change', function() {
        const customSection = document.getElementById('customQuerySection');
        if (this.value === 'custom') {
            customSection.classList.remove('hidden');
        } else {
            customSection.classList.add('hidden');
        }
    });
    
    // Load export history
    refreshHistory();
});

function quickExport(type) {
    const today = new Date();
    const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
    
    const params = new URLSearchParams({
        type: type,
        format: 'excel',
        from_date: lastMonth.toISOString().split('T')[0],
        to_date: today.toISOString().split('T')[0]
    });
    
    // Show loading state
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    button.innerHTML = '<div class="flex items-center justify-center"><div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"></div><span class="ml-2">Generating...</span></div>';
    button.disabled = true;
    
    // Trigger export
    fetch(`/api/admin/analytics/export?${params}`)
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            throw new Error('Export failed');
        })
        .then(blob => {
            // Create download link
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = `${type}_export_${new Date().toISOString().split('T')[0]}.xlsx`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            
            // Refresh history
            refreshHistory();
        })
        .catch(error => {
            console.error('Export error:', error);
            alert('Export failed. Please try again.');
        })
        .finally(() => {
            // Restore button
            button.innerHTML = originalText;
            button.disabled = false;
        });
}

function customExport() {
    const type = document.getElementById('exportType').value;
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const restaurantId = document.getElementById('restaurantId').value;
    const format = document.getElementById('format').value;
    const customQuery = document.getElementById('customQuery').value;
    
    const params = new URLSearchParams({
        type: type,
        format: format
    });
    
    if (fromDate) params.append('from_date', fromDate);
    if (toDate) params.append('to_date', toDate);
    if (restaurantId) params.append('restaurant_id', restaurantId);
    if (type === 'custom' && customQuery) params.append('query', customQuery);
    
    // Show loading state
    const button = event.target;
    const originalText = button.textContent;
    button.textContent = 'Generating...';
    button.disabled = true;
    
    // Trigger export
    fetch(`/api/admin/analytics/export?${params}`)
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            throw new Error('Export failed');
        })
        .then(blob => {
            // Create download link
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            
            // Generate filename based on format
            const extension = format === 'excel' ? 'xlsx' : format;
            a.download = `${type}_custom_export_${new Date().toISOString().split('T')[0]}.${extension}`;
            
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            
            // Refresh history
            refreshHistory();
        })
        .catch(error => {
            console.error('Export error:', error);
            alert('Export failed. Please try again.');
        })
        .finally(() => {
            // Restore button
            button.textContent = originalText;
            button.disabled = false;
        });
}

function refreshHistory() {
    fetch('/api/admin/analytics/exports')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateHistoryTable(data.data);
            }
        })
        .catch(error => {
            console.error('Error fetching export history:', error);
        });
}

function updateHistoryTable(exports) {
    const tbody = document.getElementById('exportHistoryTable');
    tbody.innerHTML = '';
    
    if (exports.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                No exports found. Create your first export above.
            </td>
        `;
        tbody.appendChild(row);
        return;
    }
    
    exports.forEach(exportItem => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                <span class="capitalize">${exportItem.type.replace('_', ' ')}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white uppercase">${exportItem.format}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                ${exportItem.from_date ? new Date(exportItem.from_date).toLocaleDateString() : 'N/A'} - 
                ${exportItem.to_date ? new Date(exportItem.to_date).toLocaleDateString() : 'N/A'}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getExportStatusClass(exportItem.status)}">
                    ${exportItem.status}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">${new Date(exportItem.created_at).toLocaleDateString()}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex space-x-2">
                    ${exportItem.status === 'completed' ? `
                        <button onclick="downloadExport('${exportItem.id}')" class="text-blue-600 hover:text-blue-900">Download</button>
                    ` : ''}
                    ${exportItem.status === 'failed' ? `
                        <button onclick="retryExport('${exportItem.id}')" class="text-yellow-600 hover:text-yellow-900">Retry</button>
                    ` : ''}
                    <button onclick="deleteExport('${exportItem.id}')" class="text-red-600 hover:text-red-900">Delete</button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function getExportStatusClass(status) {
    switch(status) {
        case 'completed': return 'bg-green-100 text-green-800';
        case 'processing': return 'bg-blue-100 text-blue-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'failed': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function downloadExport(exportId) {
    window.open(`/api/admin/analytics/exports/${exportId}/download`, '_blank');
}

function retryExport(exportId) {
    if (confirm('Are you sure you want to retry this export?')) {
        fetch(`/api/admin/analytics/exports/${exportId}/retry`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                refreshHistory();
                alert('Export retry initiated successfully!');
            } else {
                alert('Error retrying export: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error retrying export:', error);
            alert('Error retrying export');
        });
    }
}

function deleteExport(exportId) {
    if (confirm('Are you sure you want to delete this export?')) {
        fetch(`/api/admin/analytics/exports/${exportId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                refreshHistory();
                alert('Export deleted successfully!');
            } else {
                alert('Error deleting export: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error deleting export:', error);
            alert('Error deleting export');
        });
    }
}
</script>
</x-layouts.app>
