<x-layouts.app title="Notification Logs">
    <div class="container">
        <h1>Notification Logs</h1>

        @if($logs->count() === 0)
            <div class="py-12 text-center">
                <h3 class="text-xl font-semibold">No notification logs yet</h3>
                <p class="text-sm text-gray-500 mt-2">You can generate a sample failed notification to test the UI.</p>

                <form method="POST" action="{{ route('admin.notification-logs.sample') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg">Create sample log</button>
                </form>
            </div>
        @else
    <table class="table table-striped">
                <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                        <div class="mb-8">
                            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="p-3 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl text-white shadow-lg">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 4v9"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="text-4xl font-bold text-gray-900">Notification Logs</h1>
                                        <p class="text-gray-600 text-lg">Failed notification events and job failures</p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3">
                                    <form method="POST" action="{{ route('admin.notification-logs.sample') }}">
                                        @csrf
                                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-5 py-2 rounded-xl shadow">Create sample</button>
                                    </form>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Total Logs</p>
                                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $logs->total() }}</p>
                                        </div>
                                        <div class="p-3 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-lg">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 4v9"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Failed</p>
                                            <p class="text-3xl font-bold text-red-600 mt-1">{{ $logs->where('status','failed')->count() }}</p>
                                        </div>
                                        <div class="p-3 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Recent</p>
                                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $logs->take(5)->count() }}</p>
                                        </div>
                                        <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
                            <div class="overflow-x-auto">
                                @if($logs->count() === 0)
                                    <div class="px-6 py-12 text-center">
                                        <h3 class="text-lg font-medium text-gray-900">No notification logs</h3>
                                        <p class="text-gray-500 mt-2">Create a sample to test the interface.</p>
                                        <form method="POST" action="{{ route('admin.notification-logs.sample') }}" class="mt-4">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg">Create sample</button>
                                        </form>
                                    </div>
                                @else
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">To</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mailable</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Message</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">When</th>
                                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($logs as $log)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $log->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $log->to }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $log->mailable }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $log->status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">{{ ucfirst($log->status) }}</span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($log->message, 80) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->diffForHumans() }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.notification-logs.show', $log) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>

                            @if($logs->hasPages())
                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                                    {{ $logs->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            
        @endif

    </div>
</x-layouts.app>
