<x-layouts.app :title="'Space დამატება - ' . $restaurant->name">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl text-white shadow-lg">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Space დამატება</h1>
                            <p class="text-gray-600 text-lg">{{ $restaurant->name }}-ში ახალი space-ის დამატება</p>
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
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">დამატება</span>
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
                                Selected Restaurant
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

                <!-- Available Count -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                                Available Spaces
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mt-1">{{ $spaces->count() }}</div>
                            <div class="text-gray-600 mt-1">რომლებსაც შეგიძლიათ დაამატოთ</div>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($spaces->count() > 0)
                <!-- Main Form -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Space-ის დამატება</h3>
                        <p class="text-sm text-gray-600 mt-1">აირჩიეთ space და მიუთითეთ კავშირის პარამეტრები</p>
                    </div>
                    
                    <form action="{{ route('admin.restaurants.spaces.store', $restaurant) }}" method="POST" class="p-6">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Space Selection -->
                            <div>
                                <label for="space_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Space არჩევა *
                                </label>
                                <select name="space_id" id="space_id" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('space_id') border-red-300 @enderror">
                                    <option value="">აირჩიეთ space...</option>
                                    @foreach($spaces as $space)
                                        <option value="{{ $space->id }}" {{ old('space_id') == $space->id ? 'selected' : '' }}>
                                            {{ $space->name }}
                                            @if($space->description)
                                                ({{ Str::limit($space->description, 30) }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('space_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status *
                                </label>
                                <select name="status" id="status" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('status') border-red-300 @enderror">
                                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
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
                                       value="{{ old('rank', 0) }}"
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
                                Space დამატება
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- No Available Spaces -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">არ არის ხელმისაწვდომი spaces</h3>
                        <p class="mt-1 text-sm text-gray-500">ყველა active space უკვე დამატებულია ამ restaurant-ში ან არ არსებობს active spaces.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.restaurants.spaces.index', $restaurant) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors duration-200">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                უკან დაბრუნება
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
