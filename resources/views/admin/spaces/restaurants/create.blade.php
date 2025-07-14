<x-layouts.app :title="'Add Restaurant to ' . ($space->translate('ka')->name ?? $space->translate('en')->name ?? 'Space')">
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
                            <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Add Restaurant</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                            Add Restaurant to Space
                        </h1>
                        <p class="mt-2 text-gray-600">
                            Add a restaurant to: <span class="font-semibold text-purple-600">{{ $space->translate('ka')->name ?? $space->translate('en')->name ?? 'Unknown Space' }}</span>
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

            <!-- Form -->
            <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/80">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Restaurant Details
                    </h3>
                </div>

                <form action="{{ route('admin.spaces.restaurants.store', $space) }}" method="POST" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Restaurant Selection -->
                        <div class="md:col-span-2">
                            <label for="restaurant_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Select Restaurant <span class="text-red-500">*</span>
                            </label>
                            <select name="restaurant_id" id="restaurant_id" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                <option value="">Choose a restaurant...</option>
                                @foreach($availableRestaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                        {{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'Unknown Restaurant' }}
                                        @if($restaurant->translate('ka')->address ?? $restaurant->translate('en')->address)
                                            - {{ Str::limit($restaurant->translate('ka')->address ?? $restaurant->translate('en')->address, 50) }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-gray-600">Select which restaurant to add to this space.</p>
                        </div>

                        <!-- Rank -->
                        <div>
                            <label for="rank" class="block text-sm font-medium text-gray-700 mb-2">
                                Rank (Priority Order)
                            </label>
                            <input type="number" 
                                   name="rank" 
                                   id="rank" 
                                   value="{{ old('rank', '') }}"
                                   min="0"
                                   placeholder="Auto-assigned if empty"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                            <p class="mt-2 text-sm text-gray-600">Lower numbers appear first. Leave empty for auto-assignment.</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
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
                            Add Restaurant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
