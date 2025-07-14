<x-layouts.app :title="'Restaurant რედაქტირება - ' . $cuisine->name">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl text-white shadow-lg">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Restaurant რედაქტირება</h1>
                            <p class="text-gray-600 text-lg">{{ $restaurant->name }} - {{ $cuisine->name }}</p>
                        </div>
                    </div>
                    
                    <!-- Breadcrumb -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin.cuisines.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Cuisines
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('admin.cuisines.restaurants.index', $cuisine) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ $cuisine->name }} Restaurants</a>
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

            <!-- Restaurant Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Cuisine Info -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">
                                Cuisine
                            </div>
                            <div class="text-xl font-bold text-gray-900 mt-1">{{ $cuisine->name }}</div>
                            <div class="text-gray-600 mt-1">{{ $cuisine->description ?? 'აღწერა არ არის მითითებული' }}</div>
                        </div>
                        <div>
                            @if($cuisine->image)
                                <img src="{{ $cuisine->image }}" alt="{{ $cuisine->name }}" class="w-12 h-12 rounded-lg object-cover shadow-md">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="h-6 w-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Restaurant Info -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-green-600 uppercase tracking-wide">
                                Restaurant
                            </div>
                            <div class="text-xl font-bold text-gray-900 mt-1">{{ $restaurant->name }}</div>
                            <div class="text-gray-600 mt-1">{{ $restaurant->city?->name ?? 'City არ არის მითითებული' }}</div>
                        </div>
                        <div>
                            @if($restaurant->image)
                                <img src="{{ $restaurant->image }}" alt="{{ $restaurant->name }}" class="w-12 h-12 rounded-lg object-cover shadow-md">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-blue-100 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
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
                    <p class="text-sm text-gray-600 mt-1">შეცვალეთ cuisine-restaurant კავშირის status და rank</p>
                </div>
                
                <form action="{{ route('admin.cuisines.restaurants.update', [$cuisine, $restaurant]) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Current Relationship Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-blue-800 mb-2">მიმდინარე კავშირის ინფორმაცია</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-blue-600 font-medium">Status:</span>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($restaurant->pivot->status === 'active') bg-green-100 text-green-800
                                        @elseif($restaurant->pivot->status === 'inactive') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($restaurant->pivot->status ?? 'pending') }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-blue-600 font-medium">Rank:</span>
                                    <span class="ml-2 text-blue-800">{{ $restaurant->pivot->rank ?? 0 }}</span>
                                </div>
                                <div>
                                    <span class="text-blue-600 font-medium">Added:</span>
                                    <span class="ml-2 text-blue-800">{{ $restaurant->pivot->created_at?->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status *
                            </label>
                            <select name="status" id="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('status') border-red-300 @enderror">
                                <option value="active" {{ old('status', $restaurant->pivot->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $restaurant->pivot->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="pending" {{ old('status', $restaurant->pivot->status) === 'pending' ? 'selected' : '' }}>Pending</option>
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
                                   value="{{ old('rank', $restaurant->pivot->rank ?? 0) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('rank') border-red-300 @enderror"
                                   placeholder="0">
                            <p class="mt-1 text-sm text-gray-500">რაოდენობა რომლითაც განისაზღვრება თანმიმდევრობა (0 = lowest priority)</p>
                            @error('rank')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 mt-8">
                        <a href="{{ route('admin.cuisines.restaurants.index', $cuisine) }}" 
                           class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-200">
                            განახლება
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
