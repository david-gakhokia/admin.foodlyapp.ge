<x-layouts.app title="Notification Log #{{ $log->id }}">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Notification Log #{{ $log->id }}</h1>
                        <p class="text-sm text-gray-500">{{ $log->created_at->toDateTimeString() }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.notification-logs.index') }}" class="px-4 py-2 bg-white border rounded-lg">Back</a>
                        <form method="POST" action="#">
                            @csrf
                            <button type="button" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Retry</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <div class="text-sm text-gray-500">To</div>
                        <div class="text-lg font-medium text-gray-900">{{ $log->to }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Mailable</div>
                        <div class="text-lg font-medium text-gray-900">{{ $log->mailable }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Status</div>
                        <div class="text-lg font-medium text-{{ $log->status === 'failed' ? 'red' : 'green' }}-600">{{ ucfirst($log->status) }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Message</div>
                        <div class="text-sm text-gray-700">{{ $log->message }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Meta</div>
                        <pre class="text-xs bg-gray-50 p-3 rounded">{{ json_encode($log->meta, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

