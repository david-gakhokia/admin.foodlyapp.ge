<x-layouts.app>
    <div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📊 Queue Dashboard</h1>
            <p class="text-gray-600 mt-2">Monitor and manage your queue jobs in real-time</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Pending Jobs -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pending Jobs</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['pending'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Failed Jobs -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Failed Jobs</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['failed'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Processed Today -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Processed Today</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['processed_today'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Processed -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Processed</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_processed'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mb-8 flex space-x-4">
            <form method="POST" action="{{ route('admin.queue.restart') }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    🔄 Restart Workers
                </button>
            </form>

            <form method="POST" action="{{ route('admin.queue.clear-failed') }}" class="inline" onsubmit="return confirm('Are you sure you want to clear all failed jobs?')">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    🗑️ Clear Failed Jobs
                </button>
            </form>

            <a href="{{ route('admin.queue.jobs') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                📋 View All Jobs
            </a>

            <a href="{{ route('admin.queue.failed') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ❌ View Failed Jobs
            </a>
        </div>

        <!-- Recent Jobs -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Pending Jobs -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">🕐 Recent Pending Jobs</h3>
                    
                    @if($recentJobs->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentJobs as $job)
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $job->display_name ?? 'Unknown Job' }}</p>
                                            <p class="text-xs text-gray-500">Queue: {{ $job->queue }}</p>
                                            <p class="text-xs text-gray-500">Attempts: {{ $job->attempts ?? 0 }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No pending jobs</p>
                    @endif
                </div>
            </div>

            <!-- Failed Jobs -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">❌ Recent Failed Jobs</h3>
                    
                    @if($failedJobs->count() > 0)
                        <div class="space-y-3">
                            @foreach($failedJobs as $job)
                                <div class="bg-red-50 rounded-lg p-3 border-l-4 border-red-400">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-red-900">{{ $job->display_name ?? 'Unknown Job' }}</p>
                                            <p class="text-xs text-red-700">Queue: {{ $job->queue }}</p>
                                            <p class="text-xs text-red-600 mt-1 truncate">{{ $job->short_exception }}</p>
                                        </div>
                                        <div class="text-right ml-4">
                                            <p class="text-xs text-red-600">{{ \Carbon\Carbon::parse($job->failed_at)->diffForHumans() }}</p>
                                            <div class="mt-1 space-x-1">
                                                <form method="POST" action="{{ route('admin.queue.retry-failed', $job->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-xs text-blue-600 hover:text-blue-900">Retry</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.queue.delete-failed', $job->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-red-600 hover:text-red-900" onclick="return confirm('Delete this job?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No failed jobs</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Auto Refresh -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                🔄 Auto-refreshing every 30 seconds
            </p>
        </div>
    </div>
</div>

<script>
// Auto refresh every 30 seconds
setTimeout(function() {
    window.location.reload();
}, 30000);
</script>
</x-layouts.app>
