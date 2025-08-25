<x-layouts.app title="Cities Management">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8">
               
                <!-- Header with Title and Action Buttons -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl text-white shadow-lg">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Cities</h1>
                            <p class="text-gray-600 text-lg">Manage cities and locations</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.cities.create') }}" 
                           class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl font-medium transition-all duration-200 flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New City
                        </a>
                        
                        <button onclick="window.location.reload()" 
                                class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-4 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center gap-2 shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Refresh
                        </button>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Cities</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $cities->total() }}</p>
                            </div>
                            <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Active</p>
                                <p class="text-3xl font-bold text-green-600 mt-1">{{ $cities->where('status', 'active')->count() }}</p>
                            </div>
                            <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Inactive</p>
                                <p class="text-3xl font-bold text-red-600 mt-1">{{ $cities->where('status', 'inactive')->count() }}</p>
                            </div>
                            <div class="p-3 bg-gradient-to-r from-red-500 to-red-600 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Average Rank</p>
                                <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($cities->avg('rank'), 1) }}</p>
                            </div>
                            <div class="p-3 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white backdrop-blur-sm shadow-xl rounded-2xl p-6 mb-8 border border-gray-200">
                <form method="GET" class="space-y-6">
                    
                    <!-- Filter Header -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search & Filter
                        </h3>
                        
                        @if(request('search') || request('status'))
                            <a href="{{ route('admin.cities.index') }}" 
                               class="text-sm text-red-600 hover:text-red-800 font-medium flex items-center gap-1 px-3 py-1 rounded-lg hover:bg-red-50 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear Filters
                            </a>
                        @endif
                    </div>
                    
                    <!-- Search and Filter Fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
                        <div class="lg:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Search by Name or Slug</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Type city name or slug..."
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm bg-gray-50 focus:bg-white"
                                />
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                
                                @if(request('search'))
                                    <button type="button" 
                                            onclick="this.previousElementSibling.previousElementSibling.value=''; this.closest('form').submit();"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Filter</label>
                            <select name="status" 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3">
                                <option value="">All Statuses</option>
                                @foreach (\App\Models\City::getStatuses() as $value => $label)
                                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex gap-3">
                            <button
                                type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Cities Table -->
            <div class="bg-white backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">City</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Rank</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($cities as $city)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $city->slug }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $city->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($city->image)
                                            <img src="{{ $city->image }}" alt="City Image" class="h-12 w-12 rounded-lg object-cover shadow-sm">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $city->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">{{ $city->rank }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                              style="background: {{ $city->status_color }}; color: white;">
                                            {{ $city->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.cities.show', $city) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs rounded-lg transition-colors duration-200">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View
                                            </a>
                                            
                                            <a href="{{ route('admin.cities.edit', $city) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-lg transition-colors duration-200">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this city? This action cannot be undone.')"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs rounded-lg transition-colors duration-200">
                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">No cities found</h3>
                                            <p class="text-gray-500 mb-6">
                                                @if(request('search') || request('status'))
                                                    No cities match your search criteria. Try adjusting your filters.
                                                @else
                                                    Get started by creating your first city.
                                                @endif
                                            </p>
                                            @if(!request('search') && !request('status'))
                                                <a href="{{ route('admin.cities.create') }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors duration-200">
                                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Create First City
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($cities->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $cities->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
