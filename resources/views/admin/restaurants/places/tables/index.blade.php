<x-layouts.app :title="'მაგიდები - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? 'უცნობი ადგილი')">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="{{ route('admin.restaurants.index') }}" class="hover:text-blue-600 transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4" />
                </svg>
                რესტორნები
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="hover:text-blue-600 transition-colors duration-200">
                {{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->translations->where('locale', 'en')->first()?->name ?? 'უცნობი რესტორანი' }}
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('admin.restaurants.places.show', [$restaurant, $place]) }}" class="hover:text-blue-600 transition-colors duration-200">
                {{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium">მაგიდები</span>
        </nav>
    </div>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                მაგიდები
            </h1>
            <p class="text-gray-600 mt-1">
                ადგილი: <span class="font-semibold">{{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}</span> | 
                რესტორანი: <span class="font-semibold">{{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->translations->where('locale', 'en')->first()?->name ?? 'უცნობი რესტორანი' }}</span>
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.restaurants.places.tables.create', [$restaurant, $place]) }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                ახალი მაგიდა
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <form method="GET" action="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <label class="block text-sm font-medium text-gray-700 mb-2">ძიება</label>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="მაგიდის სახელი, აღწერა, ზომა..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
            </div>
            
            <div class="min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">სტატუსი</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    <option value="">ყველა სტატუსი</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>აქტიური</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>არააქტიური</option>
                </select>
            </div>
            
            <div class="flex items-end gap-2">
                <button type="submit" 
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    ძიება
                </button>
                
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" 
                       class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors duration-200">
                        გასუფთავება
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tables Grid -->
    @if($tables->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($tables as $table)
                <div class="group relative bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-green-300 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <!-- Status indicator -->
                    <div class="absolute top-4 right-4 z-10">
                        @if($table->status === 'active')
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse shadow-lg"></div>
                        @else
                            <div class="w-3 h-3 bg-red-400 rounded-full shadow-lg"></div>
                        @endif
                    </div>

                    <!-- Table Image -->
                    @if($table->image_link)
                        <div class="relative overflow-hidden">
                            <img src="{{ $table->image_link }}" 
                                 alt="{{ $table->translations->where('locale', 'ka')->first()?->name ?? 'მაგიდა' }}" 
                                 class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Table Name -->
                        <h3 class="font-semibold text-gray-900 text-lg mb-3">
                            <a href="{{ route('admin.restaurants.places.tables.show', [$restaurant, $place, $table]) }}" class="hover:text-green-600 transition-colors duration-200">
                                @php
                                    $tableName = $table->translations->where('locale', 'ka')->first();
                                @endphp
                                {{ $tableName?->name ?? $table->translations->where('locale', 'en')->first()?->name ?? 'მაგიდა #' . $table->id }}
                            </a>
                        </h3>

                        <!-- Table Info -->
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    ადგილები
                                </span>
                                <span class="font-medium text-gray-900">{{ $table->seats ?? 'მითითებული არ არის' }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    რანგი
                                </span>
                                <span class="font-medium text-gray-900"># {{ $table->rank ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($tableName?->description)
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $tableName->description }}</p>
                        @endif

                        <!-- Status and Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            @if($table->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    აქტიური
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    არააქტიური
                                </span>
                            @endif

                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.restaurants.places.tables.edit', [$restaurant, $place, $table]) }}" 
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-200 hover:border-blue-300 transition-colors duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    
                                </a>

                                <form action="{{ route('admin.restaurants.places.tables.destroy', [$restaurant, $place, $table]) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ {{ $table->translations->where('locale', 'ka')->first()?->name ?? $table->translations->where('locale', 'en')->first()?->name ?? 'ამ მაგიდის' }} წაშლა?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 hover:border-red-300 transition-colors duration-200">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        
                                    </button>
                                </form>
                            </div>

                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            {{ $tables->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="w-24 h-24 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
            
            @if(request()->hasAny(['search', 'status']))
                <h3 class="text-xl font-semibold text-gray-900 mb-2">ძიების შედეგები ვერ მოიძებნა</h3>
                <p class="text-gray-600 mb-6">თქვენი ძიების პარამეტრებით მაგიდები ვერ მოიძებნა. სცადეთ სხვა ძიების პარამეტრები.</p>
                <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors duration-200">
                    ყველა მაგიდის ნახვა
                </a>
            @else
                <h3 class="text-xl font-semibold text-gray-900 mb-2">მაგიდები ჯერ არ არის დამატებული</h3>
                <p class="text-gray-600 mb-6">ამ ადგილისთვის მაგიდები ჯერ არ არის შექმნილი. პირველი მაგიდის დასამატებლად დააჭირეთ ქვემოთ ღილაკს.</p>
                <a href="{{ route('admin.restaurants.places.tables.create', [$restaurant, $place]) }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    პირველი მაგიდის შექმნა
                </a>
            @endif
        </div>
    @endif
</x-layouts.app>
