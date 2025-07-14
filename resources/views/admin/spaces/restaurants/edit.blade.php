<x-layouts.app :title="'Edit Restaurant in ' . ($space->translate('ka')->name ?? $space->translate('en')->name ?? 'Space')">
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.spaces.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Spaces
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.spaces.restaurants.index', $space) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-purple-600 md:ml-2">
                                {{ $space->translate('ka')->name ?? $space->translate('en')->name ?? 'Unknown Space' }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Edit Restaurant</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                            Edit Restaurant Relationship
                        </h1>
                        <p class="mt-2 text-gray-600">
                            Editing: <span class="font-semibold text-purple-600">{{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant' }}</span>
                            in <span class="font-semibold text-indigo-600">{{ $space->translate('ka')->name ?? $space->translate('en')->name ?? 'Unknown Space' }}</span>
                        </p>
                    </div>
                    
                    <a href="{{ route('admin.spaces.restaurants.index', $space) }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-all duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Restaurants
                    </a>
                </div>
            </div>

            <!-- Error Messages -->
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-center gap-3">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h4 class="text-sm font-medium text-red-800">Please fix the following errors:</h4>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Restaurant Info Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-lg sticky top-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Restaurant Info
                        </h3>
                        
                        <div class="space-y-4">
                            @if($restaurant->logo)
                                <div class="flex justify-center">
                                    <img src="{{ $restaurant->logo }}" alt="Restaurant Logo" class="w-20 h-20 rounded-xl object-cover shadow-lg">
                                </div>
                            @endif
                            
                            <div class="text-center">
                                <h4 class="font-semibold text-gray-900">{{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant' }}</h4>
                                <p class="text-sm text-gray-500">{{ $restaurant->slug }}</p>
                            </div>
                            
                            @if($restaurant->translate('ka')->address ?? $restaurant->translate('en')->address)
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <div class="text-sm font-medium text-gray-700 mb-1">Address</div>
                                    <div class="text-sm text-gray-600">{{ $restaurant->translate('ka')->address ?? $restaurant->translate('en')->address }}</div>
                                </div>
                            @endif
                            
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <div class="text-sm font-medium text-purple-700 mb-2">Current Relationship</div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Rank:</span>
                                        <span class="font-medium text-purple-600">#{{ $pivotData->rank }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="font-medium capitalize 
                                            @if($pivotData->status === 'active') text-green-600
                                            @elseif($pivotData->status === 'inactive') text-red-600
                                            @else text-yellow-600 @endif">
                                            {{ $pivotData->status }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Added:</span>
                                        <span class="text-gray-600">{{ $pivotData->created_at ? $pivotData->created_at->format('M j, Y') : '—' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/80">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update Relationship
                            </h3>
                        </div>

                        <form action="{{ route('admin.spaces.restaurants.update', [$space, $restaurant]) }}" method="POST" class="p-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Rank -->
                                <div>
                                    <label for="rank" class="block text-sm font-medium text-gray-700 mb-2">
                                        Rank (Priority Order) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" 
                                           name="rank" 
                                           id="rank" 
                                           value="{{ old('rank', $pivotData->rank) }}"
                                           min="0"
                                           required
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                    <p class="mt-2 text-sm text-gray-600">Lower numbers appear first in listings.</p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status" id="status" required
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                        <option value="active" {{ old('status', $pivotData->status) === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $pivotData->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="pending" {{ old('status', $pivotData->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    <p class="mt-2 text-sm text-gray-600">Set the restaurant's status in this space.</p>
                                </div>
                            </div>

                            <div class="mt-8 flex items-center justify-end gap-4">
                                <a href="{{ route('admin.spaces.restaurants.index', $space) }}" 
                                   class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-colors duration-200">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                                    Update Relationship
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
