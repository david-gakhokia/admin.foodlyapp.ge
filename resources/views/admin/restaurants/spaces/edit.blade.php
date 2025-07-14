<x-layouts.app :title="'Space რედაქტირება - ' . $restaurant->name">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl text-white shadow-lg">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Space რედაქტირება</h1>
                            <p class="text-gray-600 text-lg">{{ $space->name }} - {{ $restaurant->name }}</p>
                        </div>
                    </div>
                    
                    <!-- Breadcrumb -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin.restaurants.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Restaurants
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('admin.restaurants.spaces.index', $restaurant) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ $restaurant->name }} Spaces</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">რედაქტირება</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6">
                    <div class="flex items-center mb-2">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Errors:
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Restaurant Info -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-purple-600 uppercase tracking-wide">
                                Restaurant
                            </div>
                            <div class="text-xl font-bold text-gray-900 mt-1">{{ $restaurant->name }}</div>
                            <div class="text-gray-600 mt-1">{{ $restaurant->email ?? 'Email არ არის მითითებული' }}</div>
                        </div>
                        <div>
                            @if($restaurant->logo)
                                <img src="{{ $restaurant->logo }}" alt="{{ $restaurant->name }}" class="w-12 h-12 rounded-lg object-cover shadow-md">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Space Info -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                                Space
                            </div>
                            <div class="text-xl font-bold text-gray-900 mt-1">{{ $space->name }}</div>
                            <div class="text-gray-600 mt-1">{{ $space->description ?? 'Description არ არის მითითებული' }}</div>
                        </div>
                        <div>
                            @if($space->image)
                                <img src="{{ $space->image }}" alt="{{ $space->name }}" class="w-12 h-12 rounded-lg object-cover shadow-md">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">კავშირის პარამეტრების რედაქტირება</h3>
                    <p class="text-sm text-gray-600 mt-1">შეცვალეთ restaurant-space კავშირის status და rank</p>
                </div>
                
                <form action="{{ route('admin.restaurants.spaces.update', [$restaurant, $space]) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Current Relationship Info -->
                        <div class="bg-purple-50 border border-purple-200 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-purple-800 mb-2">მიმდინარე კავშირის ინფორმაცია</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-purple-600 font-medium">Status:</span>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($space->pivot->status === 'active') bg-green-100 text-green-800
                                        @elseif($space->pivot->status === 'inactive') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($space->pivot->status ?? 'pending') }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-purple-600 font-medium">Rank:</span>
                                    <span class="ml-2 text-purple-800">{{ $space->pivot->rank ?? 0 }}</span>
                                </div>
                                <div>
                                    <span class="text-purple-600 font-medium">Added:</span>
                                    <span class="ml-2 text-purple-800">{{ $space->pivot->created_at?->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status *
                            </label>
                            <select name="status" id="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('status') border-red-300 @enderror">
                                <option value="active" {{ old('status', $space->pivot->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $space->pivot->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="pending" {{ old('status', $space->pivot->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rank -->
                        <div>
                            <label for="rank" class="block text-sm font-medium text-gray-700 mb-2">
                                Rank
                            </label>
                            <input type="number" name="rank" id="rank" min="0" step="1" 
                                   value="{{ old('rank', $space->pivot->rank ?? 0) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('rank') border-red-300 @enderror"
                                   placeholder="0">
                            <p class="mt-1 text-sm text-gray-500">რაოდენობა რომლითაც განისაზღვრება თანმიმდევრობა (0 = lowest priority)</p>
                            @error('rank')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 mt-8">
                        <a href="{{ route('admin.restaurants.spaces.index', $restaurant) }}" 
                           class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-200">
                            განახლება
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
