<x-layouts.app :title="'Sub Categories for ' . $restaurant->name">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50">
        {{-- Header Section with Breadcrumb --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col gap-6">
                {{-- Breadcrumb --}}
                <nav class="flex items-center space-x-3 text-sm">
                    <a href="{{ route('admin.restaurants.show', $restaurant) }}" 
                       class="text-gray-500 hover:text-blue-600 transition-colors duration-200">
                        {{ $restaurant->name }}
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" 
                       class="text-gray-500 hover:text-blue-600 transition-colors duration-200">
                        მთავარი კატეგორიები
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-blue-600 font-medium">{{ $parentCategory->name ?? 'ქვეკატეგორიები' }}</span>
                </nav>

                {{-- Title and Actions --}}
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="text-center sm:text-left">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-2">
                            ქვეკატეგორიები
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">
                            @if(isset($parentCategory))
                                {{ $parentCategory->name }} - {{ $restaurant->name }}
                            @else
                                {{ $restaurant->name }}
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 border border-gray-300 rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            მთავარ კატეგორიებზე
                        </a>
                        <a href="{{ route('admin.restaurants.menu.categories.create', $restaurant) }}{{ isset($parentCategory) ? '?parent_id=' . $parentCategory->id : '' }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            ახალი ქვეკატეგორია
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">ძიება და ფილტრაცია</h2>
                    <p class="text-gray-600 dark:text-gray-400">მოძებნეთ ქვეკატეგორია სახელით და გაფილტრეთ სტატუსით</p>
                </div>
            </div>
            
            <form method="GET" action="{{ url()->current() }}" class="space-y-6">
                {{-- Preserve parent parameter --}}
                @if(request('parent'))
                    <input type="hidden" name="parent" value="{{ request('parent') }}">
                @endif
                
                {{-- Single Row Layout --}}
                <div class="flex flex-wrap items-end gap-4">
                    {{-- Search Input --}}
                    <div class="flex-1 min-w-80">
                        <label for="search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            ძიების ტექსტი
                        </label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" 
                                   placeholder="მოძებნეთ ქვეკატეგორია სახელით..." 
                                   class="w-full px-6 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 dark:bg-gray-700 dark:text-white text-base font-medium transition-all duration-300 shadow-lg">
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
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 dark:bg-gray-700 dark:text-white text-base font-medium transition-all duration-300 shadow-lg">
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
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            ძიება
                        </button>
                        
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ url()->current() }}{{ request('parent') ? '?parent=' . request('parent') : '' }}" 
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
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl p-4 border border-emerald-200 dark:border-emerald-800">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-emerald-800 dark:text-emerald-200">აქტიური ფილტრები:</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-200">
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

        {{-- Sub Categories Grid Container - 3 cards per row with larger size --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-10">
            @forelse ($menuCategories as $index => $category)
                <div class="group bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 hover:scale-105 transform">
                    {{-- Category Image --}}
                    <div class="relative h-64 bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 dark:from-gray-700 dark:to-gray-600 overflow-hidden">
                        @if ($category->image)
                            <img src="{{ $category->image }}" 
                                 alt="{{ $category->translate('en')->name ?? 'Category Image' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-200/50 to-teal-200/50"></div>
                                <div class="relative w-20 h-20 bg-white/80 backdrop-blur-sm rounded-3xl flex items-center justify-center shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-4 right-4">
                            @if ($category->status === 'active')
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-green-500 text-white shadow-lg backdrop-blur-sm">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    აქტიური
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gray-500 text-white shadow-lg backdrop-blur-sm">
                                    <div class="w-2 h-2 bg-white/70 rounded-full mr-2"></div>
                                    არააქტიური
                                </span>
                            @endif
                        </div>

                        {{-- Rank Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-white/90 text-gray-700 shadow-lg backdrop-blur-sm">
                                <span class="text-emerald-600">#</span>{{ $category->rank ?? 0 }}
                            </span>
                        </div>

                        {{-- Sub-category Badge --}}
                        <div class="absolute bottom-4 left-4">
                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-emerald-500/90 text-white shadow-lg backdrop-blur-sm">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                ქვეკატეგორია
                            </span>
                        </div>

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    {{-- Card Content --}}
                    <div class="p-8">
                        {{-- Category Name --}}
                        <h3 class="text-2xl font-bold mb-4 line-clamp-2 text-gray-900 dark:text-gray-100">
                            {{ $category->name ?? 'უსახელო კატეგორია' }}
                        </h3>

                        {{-- Statistics Section --}}
                        <div class="space-y-4 mb-8">
                            {{-- Items Count --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-base font-medium text-gray-600 dark:text-gray-400">
                                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    @php
                                        $itemsCount = $category->menuItems()->count();
                                    @endphp
                                    @if($itemsCount > 0)
                                        <a href="{{ route('admin.menu.items.index') }}?category_id={{ $category->id }}&restaurant_id={{ $restaurant->id }}" 
                                           class="text-lg text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors duration-200 hover:underline">
                                            {{ $itemsCount }} მენიუს აითემი
                                        </a>
                                    @else
                                        <span class="text-lg">{{ $itemsCount }} მენიუს აითემი</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Parent Category --}}
                            @if($category->parent)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-base font-medium text-gray-600 dark:text-gray-400">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-100 to-purple-100 rounded-xl flex items-center justify-center mr-4">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" 
                                           class="text-lg text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200 hover:underline">
                                            {{ $category->parent->name }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            {{-- Last Updated --}}
                            <div class="flex items-center justify-end">
                                <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-full font-medium">
                                    {{ $category->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.restaurants.menu.categories.edit', [$restaurant, $category]) }}"
                               class="inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-orange-600 bg-gradient-to-r from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 dark:from-orange-900/30 dark:to-orange-800/30 dark:text-orange-400 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                რედაქტირება
                            </a>

                            <a href="{{ route('admin.menu.items.create') }}?category_id={{ $category->id }}&restaurant_id={{ $restaurant->id }}"
                               class="inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-emerald-600 bg-gradient-to-r from-emerald-50 to-emerald-100 hover:from-emerald-100 hover:to-emerald-200 dark:from-emerald-900/30 dark:to-emerald-800/30 dark:text-emerald-400 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Item დამატება
                            </a>
                            
                            <form action="{{ route('admin.restaurants.menu.categories.destroy', [$restaurant, $category]) }}" 
                                  method="POST" 
                                  class="col-span-2"
                                  onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ კატეგორიის წაშლა?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-red-600 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 dark:from-red-900/30 dark:to-red-800/30 dark:text-red-400 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="col-span-full flex flex-col items-center justify-center py-20 px-4 text-center">
                <div class="backdrop-blur-lg bg-white/20 dark:bg-gray-800/20 border border-white/30 dark:border-gray-700/30 rounded-3xl p-12 max-w-md mx-auto shadow-2xl">
                    <div class="w-24 h-24 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-700 to-gray-900 dark:from-gray-300 dark:to-gray-100 bg-clip-text text-transparent mb-4">
                        ქვეკატეგორია არ მოიძებნა
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 text-lg leading-relaxed">
                        @if(isset($parentCategory))
                            "{{ $parentCategory->name }}" კატეგორიისთვის ჯერ არ შექმნილა ქვეკატეგორია.
                        @else
                            ამ რესტორნისთვის ჯერ არ შექმნილა ქვეკატეგორია.
                        @endif
                        დაამატეთ პირველი ქვეკატეგორია დასაწყებად.
                    </p>
                    <a href="{{ route('admin.restaurants.menu.categories.create', $restaurant) }}{{ isset($parentCategory) ? '?parent_id=' . $parentCategory->id : '' }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        ქვეკატეგორიის დამატება
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
