<x-layouts.app title="Space Details">
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-violet-50 to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl text-white shadow-lg">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">Space Details</h1>
                        <p class="text-gray-600 text-lg">View space information and settings</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.spaces.edit', $space) }}"
                       class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl font-medium transition-all duration-200 flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Space
                    </a>
                    
                    <a href="{{ route('admin.spaces.index') }}"
                       class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center gap-2 shadow-sm">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Spaces
                    </a>
                </div>
            </div>

            <!-- Space Information Card -->
            <div class="bg-white backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200 overflow-hidden mb-8">
                
                <!-- Space Image -->
                @if ($space->image || $space->image_link)
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                        <img src="{{ $space->image ?: $space->image_link }}" 
                             alt="Space Image" 
                             class="w-full h-64 object-cover">
                    </div>
                @endif

                <div class="p-8">
                    <!-- Basic Information -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Basic Information</h2>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($space->status === 'active') bg-green-100 text-green-800
                                @elseif($space->status === 'inactive') bg-red-100 text-red-800
                                @elseif($space->status === 'maintenance') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $space->status_label }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                                <div class="text-lg font-semibold text-gray-900">{{ $space->slug }}</div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Display Order</label>
                                <div class="text-lg font-semibold text-gray-900">{{ $space->rank ?? 'Not set' }}</div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                                <div class="text-lg font-semibold text-gray-900">{{ $space->created_at->format('M d, Y H:i') }}</div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <div class="text-lg font-semibold text-gray-900">{{ $space->updated_at->format('M d, Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Translations -->
                    <div class="border-t border-gray-200 pt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Translations</h3>
                        
                        <div class="space-y-6">
                            @foreach (config('translatable.locales') as $locale)
                                @php
                                    $translation = $space->translate($locale);
                                @endphp
                                
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center">
                                            <span class="text-sm font-bold text-white">{{ strtoupper($locale) }}</span>
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-900">{{ strtoupper($locale) }} Translation</h4>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                                            <div class="text-base text-gray-900">
                                                {{ $translation?->name ?? 'Not provided' }}
                                            </div>
                                        </div>
                                        
                                        @if($translation?->description)
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                                                <div class="text-base text-gray-900">
                                                    {{ $translation->description }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Related Information -->
                    @if($space->restaurants->count() > 0)
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Associated Restaurants</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($space->restaurants as $restaurant)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-purple-500 to-violet-600 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $restaurant->name ?? $restaurant->slug }}</div>
                                                <div class="text-sm text-gray-500">Restaurant</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
