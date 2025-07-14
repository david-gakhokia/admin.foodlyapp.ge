<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{-- ✅ Success Message --}}
        @if (session('success'))
            <div class="mb-6 px-6 py-4 rounded-xl bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border-2 border-green-300 shadow-lg flex items-center space-x-3">
                <div class="p-2 bg-green-500 rounded-full">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <div class="font-semibold">Success!</div>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        {{-- ❌ Error Message --}}
        @if (session('error'))
            <div class="mb-6 px-6 py-4 rounded-xl bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border-2 border-red-300 shadow-lg flex items-center space-x-3">
                <div class="p-2 bg-red-500 rounded-full">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div>
                    <div class="font-semibold">Error!</div>
                    <div>{{ session('error') }}</div>
                </div>
            </div>
        @endif

        {{-- ⚠️ Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 px-6 py-4 rounded-xl bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 border-2 border-yellow-300 shadow-lg">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="p-2 bg-yellow-500 rounded-full">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="font-semibold">Please fix the following errors:</div>
                </div>
                <ul class="list-disc list-inside space-y-1 ml-10">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
