<x-layouts.app :title="'Menu Categories for ' . $restaurant->name">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        {{-- Header Section: Title and Add New Button --}}                                    @if($category->children->count() > 0)
                                        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}?parent={{ $category->id }}" 
                                           class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200 hover:underline">
                                            {{ $category->children->count() }} ქვეკატეგორია
                                        </a>
                                    @else
                                        <span class="text-sm">{{ $category->children->count() }} ქვეკატეგორია</span>
                                    @endif <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                        მთავარი კატეგორიები
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">{{ $restaurant->name }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.restaurants.show', $restaurant) }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 border border-gray-300 rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        რესტორანზე დაბრუნება
                    </a>
                    <a href="{{ route('admin.restaurants.menu.categories.create', $restaurant) }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        ახალი კატეგორია
                    </a>
                </div>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">ძიება და ფილტრაცია</h2>
                    <p class="text-gray-600 dark:text-gray-400">მოძებნეთ მთავარი კატეგორია სახელით და გაფილტრეთ სტატუსით</p>
                </div>
            </div>
            
            <form method="GET" action="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" class="space-y-6">
                {{-- Single Row Layout --}}
                <div class="flex flex-wrap items-end gap-4">
                    {{-- Search Input --}}
                    <div class="flex-1 min-w-80">
                        <label for="search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            ძიების ტექსტი
                        </label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" 
                                   placeholder="მოძებნეთ კატეგორია სახელით..." 
                                   class="w-full px-6 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-base font-medium transition-all duration-300 shadow-lg">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Status Filter --}}
                    <div class="w-48">
                        <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            სტატუსი
                        </label>
                        <select id="status" name="status" 
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-base font-medium transition-all duration-300 shadow-lg">
                            <option value="">ყველა სტატუსი</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                                🟢 აქტიური
                            </option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                                🔴 არააქტიური
                            </option>
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-3">
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            ძიება
                        </button>
                        
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" 
                               class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                გასუფთავება
                            </a>
                        @endif

                        <button type="button" onclick="document.getElementById('search').value=''; document.getElementById('status').value=''; this.form.submit();"
                                class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            გადატვირთვა
                        </button>
                    </div>
                </div>

                {{-- Active Filters Display --}}
                @if(request()->hasAny(['search', 'status']))
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-4 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-blue-800 dark:text-blue-200">აქტიური ფილტრები:</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-200">
                                    ძიება: "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('status'))
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200">
                                    სტატუსი: {{ request('status') === 'active' ? 'აქტიური' : 'არააქტიური' }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </form>
        </div>

        {{-- Main Categories Grid Container - 4 cards per row with compact size --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($menuCategories as $index => $category)
                <div class="group bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 overflow-hidden hover:shadow-xl transition-all duration-300 hover:scale-102 transform">
                    {{-- Category Image --}}
                    <div class="relative h-48 bg-gradient-to-br from-blue-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:to-gray-600 overflow-hidden">
                        @if ($category->image)
                            <img src="{{ $category->image }}" 
                                 alt="{{ $category->translate('en')->name ?? 'Category Image' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-200/50 to-purple-200/50"></div>
                                <div class="relative w-14 h-14 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-3 right-3">
                            @if ($category->status === 'active')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-500 text-white shadow-md backdrop-blur-sm">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></div>
                                    აქტიური
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-gray-500 text-white shadow-md backdrop-blur-sm">
                                    <div class="w-1.5 h-1.5 bg-white/70 rounded-full mr-1.5"></div>
                                    არააქტიური
                                </span>
                            @endif
                        </div>

                        {{-- Rank Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-white/90 text-gray-700 shadow-md backdrop-blur-sm">
                                <span class="text-blue-600">#</span>{{ $category->rank ?? 0 }}
                            </span>
                        </div>

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    {{-- Card Content --}}
                    <div class="p-5">
                        {{-- Category Name --}}
                        <h3 class="text-lg font-semibold mb-3 line-clamp-2 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}?parent={{ $category->id }}" 
                                class="hover:underline hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                {{ $category->name ?? 'უსახელო კატეგორია' }}
                            </a>
                        </h3>

                        {{-- Statistics Section --}}
                        <div class="space-y-3 mb-5">
                            {{-- Subcategories Count --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-400">
                                    <div class="w-7 h-7 bg-gradient-to-r from-blue-100 to-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    @if($category->children->count() > 0)
                                        <a href="{{ route('admin.restaurants.menu.parent-categories', $restaurant) }}" 
                                           class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200 hover:underline">
                                            {{ $category->children->count() }} ქვეკატეგორია
                                        </a>
                                    @else
                                        <span class="text-sm">{{ $category->children->count() }} ქვეკატეგორია</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Total Items Count --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-400">
                                    <div class="w-7 h-7 bg-gradient-to-r from-green-100 to-emerald-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    @php
                                        $totalItems = $category->menuItems()->count();
                                        // Add items from subcategories
                                        foreach($category->children as $child) {
                                            $totalItems += $child->menuItems()->count();
                                        }
                                    @endphp
                                    @if($totalItems > 0)
                                        <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}" 
                                           class="text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 transition-colors duration-200 hover:underline">
                                            {{ $totalItems }} კერძი / სასმელი
                                        </a>
                                    @else
                                        <span class="text-sm">{{ $totalItems }} კერძი / სასმელი</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Last Updated --}}
                            <div class="flex items-center justify-end">
                                <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full font-medium">
                                    {{ $category->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('admin.restaurants.menu.categories.edit', [$restaurant, $category]) }}"
                               class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-orange-600 bg-gradient-to-r from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 dark:from-orange-900/30 dark:to-orange-800/30 dark:text-orange-400 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                
                            </a>

                            <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}"
                               class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-green-600 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 dark:from-green-900/30 dark:to-green-800/30 dark:text-green-400 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                 ნახვა
                            </a>
                            
                            <form action="{{ route('admin.restaurants.menu.categories.destroy', [$restaurant, $category]) }}" 
                                  method="POST" 
                                  class="col-span-2"
                                  onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ კატეგორიის წაშლა?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-red-600 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 dark:from-red-900/30 dark:to-red-800/30 dark:text-red-400 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    წაშლა
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
        @empty
            {{-- Empty State with Glassmorphism --}}
            <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center">
                <div class="backdrop-blur-lg bg-white/20 dark:bg-gray-800/20 border border-white/30 dark:border-gray-700/30 rounded-2xl p-8 max-w-sm mx-auto shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold bg-gradient-to-r from-gray-700 to-gray-900 dark:from-gray-300 dark:to-gray-100 bg-clip-text text-transparent mb-3">
                        მთავარი კატეგორია არ მოიძებნა
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm leading-relaxed">
                        ამ რესტორნისთვის ჯერ არ შექმნილა მენიუს მთავარი კატეგორია. დაამატეთ პირველი კატეგორია დასაწყებად.
                    </p>
                    <a href="{{ route('admin.restaurants.menu.categories.create', $restaurant) }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        კატეგორიის დამატება
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    
    <script>        
        // Auto-submit on Enter key in search input
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });
    </script>
    
</x-layouts.app>
