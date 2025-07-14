<x-layouts.app title="Spots Management">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
        
        {{-- Header Section --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                        Spots Management
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">
                        Manage restaurant types and categories
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.spots.create') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Spot
                    </a>
                </div>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Spots</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $statistics['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-xl">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $statistics['active'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-xl">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Inactive</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $statistics['inactive'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Connected Restaurants</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $statistics['total_restaurants'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <form method="GET" action="{{ route('admin.spots.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Search Input --}}
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Search Spots
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               id="search"
                               value="{{ request('search') }}"
                               placeholder="Search by name..."
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-2xl bg-white/50 backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Status Filter --}}
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>
                    <select name="status" 
                            id="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl bg-white/50 backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search
                    </button>
                    
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.spots.index') }}"
                           class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Active Filters Display --}}
            @if(request()->hasAny(['search', 'status']))
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-2xl p-4 border border-purple-200 dark:border-purple-800 mt-6">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                        </svg>
                        <span class="font-semibold text-purple-800 dark:text-purple-200">Active Filters:</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-200">
                                Search: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('status'))
                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-200">
                                Status: {{ ucfirst(request('status')) }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Spots Grid --}}
        @if($spots->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-8">
                @foreach($spots as $spot)
                    <div class="group relative bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 hover:scale-105">
                        {{-- Image Section --}}
                        <div class="relative h-48 bg-gradient-to-br from-purple-100 via-blue-50 to-indigo-100 overflow-hidden">
                            @if($spot->image_link)
                                <img src="{{ $spot->image_link }}" 
                                     alt="{{ $spot->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Status Badge --}}
                            <div class="absolute top-4 right-4">
                                @if($spot->status === 'active')
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-green-500 text-white shadow-lg backdrop-blur-sm">
                                        <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gray-500 text-white shadow-lg backdrop-blur-sm">
                                        <div class="w-2 h-2 bg-white/70 rounded-full mr-2"></div>
                                        Inactive
                                    </span>
                                @endif
                            </div>

                            {{-- Rank Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-white/90 text-gray-700 shadow-lg backdrop-blur-sm">
                                    <span class="text-purple-600">#</span>{{ $spot->rank ?? 0 }}
                                </span>
                            </div>
                        </div>

                        {{-- Content Section --}}
                        <div class="p-6">
                            {{-- Spot Name --}}
                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-gray-100">
                                {{ $spot->name ?? 'Unnamed Spot' }}
                            </h3>

                            {{-- Slug --}}
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                {{ $spot->slug }}
                            </div>

                            {{-- Restaurant Count --}}
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-6">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $spot->restaurants_count ?? 0 }} Restaurants
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('admin.spots.show', $spot) }}"
                                   class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-purple-600 bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 dark:from-purple-900/30 dark:to-purple-800/30 dark:text-purple-400 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View
                                </a>

                                <a href="{{ route('admin.spots.edit', $spot) }}"
                                   class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-blue-600 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 dark:text-blue-400 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                            </div>

                            {{-- Delete Button (Full Width) --}}
                            <form action="{{ route('admin.spots.destroy', $spot) }}" 
                                  method="POST" 
                                  class="mt-3"
                                  onsubmit="return confirm('Are you sure you want to delete this spot?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-red-600 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 dark:from-red-900/30 dark:to-red-800/30 dark:text-red-400 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 p-4">
                    {{ $spots->withQueryString()->links() }}
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-12 text-center">
                <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                    <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-700 to-gray-900 dark:from-gray-300 dark:to-gray-100 bg-clip-text text-transparent mb-4">
                    No Spots Found
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-lg mb-8 max-w-md mx-auto">
                    No spots match your current filters. Try adjusting your search criteria or create a new spot.
                </p>
                <a href="{{ route('admin.spots.create') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Your First Spot
                </a>
            </div>
        @endif
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" 
             class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
</x-layouts.app>
