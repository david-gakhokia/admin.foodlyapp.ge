<x-layouts.app title="City Details">
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-violet-50 to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl text-white shadow-lg">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">City Details</h1>
                        <p class="text-gray-600 text-lg">View city information and settings</p>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.cities.edit', $city) }}"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl font-medium transition-all duration-200 flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit City
                    </a>
                    <a href="{{ route('admin.cities.index') }}"
                        class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center gap-2 shadow-sm">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Cities
                    </a>
                </div>
            </div>

            <!-- City Info -->
            <div class="bg-white rounded-xl shadow p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">General Info</h2>
                        <p><strong>ID:</strong> {{ $city->id }}</p>
                        <p><strong>Slug:</strong> {{ $city->slug }}</p>
                        <p><strong>Status:</strong>
                            <span class="px-2 py-1 rounded-xl text-xs font-semibold"
                                style="background: {{ $city->status_color }}; color: white;">
                                {{ $city->status_label }}
                            </span>
                        </p>
                        <p><strong>Rank:</strong> {{ $city->rank }}</p>
                        @if ($city->image)
                            <div class="mt-4">
                                <img src="{{ $city->image }}" alt="City Image"
                                    class="rounded-xl w-48 h-32 object-cover">
                            </div>
                        @endif
                        @if ($city->image_link)
                            <div class="mt-4">
                                <a href="{{ $city->image_link }}" target="_blank"
                                    class="text-indigo-600 underline">External Image Link</a>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Translations</h2>
                        @foreach (config('translatable.locales') as $locale)
                            @php $translation = $city->translate($locale); @endphp
                            <div class="mb-4">
                                <span class="font-bold text-purple-600">{{ strtoupper($locale) }}</span>
                                <p><strong>Name:</strong> {{ $translation?->name ?? '-' }}</p>
                                <p><strong>Description:</strong> {{ $translation?->description ?? '-' }}</p>
                                <p><strong>Meta Title:</strong> {{ $translation?->meta_title ?? '-' }}</p>
                                <p><strong>Meta Description:</strong> {{ $translation?->meta_description ?? '-' }}</p>
                                <p><strong>Meta Keywords:</strong> {{ $translation?->meta_keywords ?? '-' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
