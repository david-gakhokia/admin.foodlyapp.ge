<x-layouts.app title="Spot Details">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
        
        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-3 text-sm mb-8">
            <a href="{{ route('admin.spots.index') }}" 
               class="text-gray-500 hover:text-purple-600 transition-colors duration-200">
                Spots
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-purple-600 font-medium">{{ $spot->name ?? 'Spot #' . $spot->id }}</span>
        </nav>

        {{-- Header Section --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Image Section --}}
                <div class="lg:w-1/3">
                    <div class="relative h-64 lg:h-80 bg-gradient-to-br from-purple-100 via-blue-50 to-indigo-100 rounded-2xl overflow-hidden">
                        @if($spot->image_link)
                            <img src="{{ $spot->image_link }}" 
                                 alt="{{ $spot->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-4 right-4">
                            @if($spot->status === 'active')
                                <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-full bg-green-500 text-white shadow-lg backdrop-blur-sm">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-full bg-gray-500 text-white shadow-lg backdrop-blur-sm">
                                    <div class="w-2 h-2 bg-white/70 rounded-full mr-2"></div>
                                    Inactive
                                </span>
                            @endif
                        </div>

                        {{-- Rank Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-full bg-white/90 text-gray-700 shadow-lg backdrop-blur-sm">
                                <span class="text-purple-600">#</span>{{ $spot->rank ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Info Section --}}
                <div class="lg:w-2/3">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                                {{ $spot->name ?? 'Unnamed Spot' }}
                            </h1>
                            <div class="flex items-center text-gray-500 mb-4">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                <code class="bg-gray-100 px-2 py-1 rounded text-sm">{{ $spot->slug }}</code>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-3">
                            <a href="{{ route('admin.spots.edit', $spot) }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Spot
                            </a>
                        </div>
                    </div>

                    {{-- Statistics Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-4 border border-green-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-700">Total Restaurants</p>
                                    <p class="text-2xl font-bold text-green-900">{{ $statistics['total_restaurants'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-4 border border-blue-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-700">Active</p>
                                    <p class="text-2xl font-bold text-blue-900">{{ $statistics['active_restaurants'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-slate-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-gray-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700">Inactive</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $statistics['inactive_restaurants'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Translations Display --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                            </svg>
                            Translations
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- English Translation --}}
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <span class="w-6 h-4 bg-blue-600 rounded-sm mr-2 flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">EN</span>
                                    </span>
                                    <span class="font-semibold text-blue-800">English</span>
                                </div>
                                <p class="text-gray-800 font-medium">
                                    {{ $spot->translate('en')?->name ?? 'No English translation' }}
                                </p>
                            </div>

                            {{-- Georgian Translation --}}
                            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-4 border border-orange-200">
                                <div class="flex items-center mb-3">
                                    <span class="w-6 h-4 bg-orange-600 rounded-sm mr-2 flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">KA</span>
                                    </span>
                                    <span class="font-semibold text-orange-800">ქართული</span>
                                </div>
                                <p class="text-gray-800 font-medium">
                                    {{ $spot->translate('ka')?->name ?? 'ქართული თარგმანი არ არის' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Attached Restaurants Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Attached Restaurants ({{ $spot->restaurants->count() }})
                </h2>
            </div>

            @if($spot->restaurants->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Restaurant
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rank
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Attached Since
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($spot->restaurants as $restaurant)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($restaurant->image)
                                                    <img class="h-10 w-10 rounded-full object-cover" 
                                                         src="{{ $restaurant->image }}" 
                                                         alt="{{ $restaurant->name }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-blue-500 flex items-center justify-center">
                                                        <span class="text-white font-bold text-sm">
                                                            {{ substr($restaurant->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $restaurant->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $restaurant->slug }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            #{{ $restaurant->pivot->rank }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($restaurant->pivot->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $restaurant->pivot->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.restaurants.show', $restaurant) }}" 
                                           class="text-purple-600 hover:text-purple-900 mr-3">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No restaurants attached</h3>
                    <p class="text-gray-500">This spot doesn't have any restaurants connected to it yet.</p>
                </div>
            @endif
        </div>

        {{-- Additional Info Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Additional Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h4 class="font-medium text-gray-700 mb-2">Created</h4>
                        <p class="text-gray-600">{{ $spot->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h4 class="font-medium text-gray-700 mb-2">Last Updated</h4>
                        <p class="text-gray-600">{{ $spot->updated_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    @if($spot->image)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h4 class="font-medium text-gray-700 mb-2">Image File</h4>
                            <p class="text-gray-600 text-sm break-all">{{ $spot->image }}</p>
                        </div>
                    @endif

                    @if($spot->image_link)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <h4 class="font-medium text-gray-700 mb-2">Image URL</h4>
                            <a href="{{ $spot->image_link }}" 
                               target="_blank" 
                               class="text-purple-600 hover:text-purple-800 text-sm break-all">
                                {{ $spot->image_link }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
