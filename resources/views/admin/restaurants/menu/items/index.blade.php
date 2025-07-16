<x-layouts.app :title="'Menu Items' . (isset($selectedCategory) ? ' for ' . $selectedCategory->name : '') . (isset($selectedRestaurant) ? ' - ' . $selectedRestaurant->name : '')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        {{-- Header Section with Breadcrumb --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col gap-6">
                {{-- Breadcrumb --}}
                @if(isset($selectedRestaurant))
                    <nav class="flex items-center space-x-3 text-sm">
                        <a href="{{ route('admin.restaurants.show', $selectedRestaurant) }}" 
                           class="text-gray-500 hover:text-blue-600 transition-colors duration-200">
                            {{ $selectedRestaurant->name }}
                        </a>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ route('admin.restaurants.menu.categories.index', $selectedRestaurant) }}" 
                           class="text-gray-500 hover:text-blue-600 transition-colors duration-200">
                            მთავარი კატეგორიები
                        </a>
                        @if(isset($selectedCategory))
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-blue-600 font-medium">{{ $selectedCategory->name ?? 'მენიუს აითემები' }}</span>
                        @else
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-blue-600 font-medium">მენიუს აითემები</span>
                        @endif
                    </nav>
                @endif

                {{-- Title and Actions --}}
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="text-center sm:text-left">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            მენიუს აითემები
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">
                            @if(isset($selectedCategory))
                                {{ $selectedCategory->name }} - {{ isset($selectedRestaurant) ? $selectedRestaurant->name : 'ყველა რესტორანი' }}
                            @elseif(isset($selectedRestaurant))
                                {{ $selectedRestaurant->name }}
                            @else
                                ყველა რესტორანი
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-3">
                        @if(request('category_id') && request('restaurant_id'))
                            <a href="{{ route('admin.restaurants.menu.categories.index', request('restaurant_id')) }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 border border-gray-300 rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                კატეგორიებზე დაბრუნება
                            </a>
                        @endif
                        <a href="{{ route('admin.menu.items.create') }}{{ request('category_id') ? '?category_id=' . request('category_id') . '&restaurant_id=' . request('restaurant_id') : '' }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            ახალი აითემი
                        </a>
                    </div>
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
                    <p class="text-gray-600 dark:text-gray-400">მოძებნეთ აითემი სახელით და გაფილტრეთ სტატუსით</p>
                </div>
            </div>
            
            <form method="GET" action="{{ route('admin.menu.items.index') }}" class="space-y-6">
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                @if(request('restaurant_id'))
                    <input type="hidden" name="restaurant_id" value="{{ request('restaurant_id') }}">
                @endif
                
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
                                   placeholder="მოძებნეთ აითემი სახელით..." 
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
                            <a href="{{ route('admin.menu.items.index') }}{{ request('category_id') ? '?category_id=' . request('category_id') . '&restaurant_id=' . request('restaurant_id') : '' }}" 
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

        {{-- Cards Grid Container - 4 cards per row with compact size --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($menuItems as $item)
                <div class="group bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 overflow-hidden hover:shadow-xl transition-all duration-300 hover:scale-102 transform">
                    {{-- Item Image --}}
                    <div class="relative h-48 bg-gradient-to-br from-blue-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:to-gray-600 overflow-hidden">
                        @if ($item->image)
                            <img src="{{ $item->image }}" 
                                 alt="{{ $item->translate('en')->name ?? 'Menu Item Image' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @elseif ($item->image_link)
                            <img src="{{ $item->image_link }}" 
                                 alt="{{ $item->translate('en')->name ?? 'Menu Item Image' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-200/50 to-purple-200/50"></div>
                                <div class="relative w-14 h-14 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-3 right-3">
                            @if ($item->status === 'active')
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
                                <span class="text-blue-600">#</span>{{ $item->rank ?? 0 }}
                            </span>
                        </div>

                        {{-- Special Badges --}}
                        <div class="absolute bottom-3 left-3 flex gap-1">
                            @if($item->is_vegan)
                                <span class="inline-flex items-center px-1.5 py-0.5 text-xs font-semibold rounded-full bg-green-500 text-white shadow-md">
                                    🌱
                                </span>
                            @endif
                            @if($item->is_gluten_free)
                                <span class="inline-flex items-center px-1.5 py-0.5 text-xs font-semibold rounded-full bg-orange-500 text-white shadow-md">
                                    🌾
                                </span>
                            @endif
                        </div>

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    {{-- Card Content --}}
                    <div class="p-4">
                        {{-- Item Name --}}
                        @php
                            $defaultLocale = app()->getLocale();
                        @endphp
                        <h3 class="text-lg font-semibold mb-2 line-clamp-2 text-gray-900 dark:text-gray-100">
                            {{ $item->translate($defaultLocale)?->name ?? 'უსახელო აითემი' }}
                        </h3>

                        {{-- Description --}}
                        @if($item->translate($defaultLocale)?->description)
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                {{ $item->translate($defaultLocale)->description }}
                            </p>
                        @endif

                        {{-- Price Section --}}
                        <div class="mb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                        ${{ number_format($item->price, 2) }}
                                    </span>
                                    @if($item->unit)
                                        <span class="text-xs text-gray-500 ml-1">/ {{ $item->unit }}</span>
                                    @endif
                                </div>
                                @if($item->discounted_price)
                                    <div class="text-right">
                                        <div class="text-sm line-through text-gray-400">
                                            ${{ number_format($item->price, 2) }}
                                        </div>
                                        <div class="text-lg font-bold text-red-600">
                                            ${{ number_format($item->discounted_price, 2) }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Additional Info - Compact Grid --}}
                        <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
                            @if($item->calories)
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-3 h-3 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                    </svg>
                                    {{ $item->calories }}კალ
                                </div>
                            @endif
                            @if($item->preparation_time)
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-3 h-3 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $item->preparation_time }}წთ
                                </div>
                            @endif
                            @if($item->quantity)
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    რაოდ: {{ $item->quantity }}
                                </div>
                            @endif
                            @if($item->available !== null)
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-3 h-3 mr-1 {{ $item->available ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item->available ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' }}"/>
                                    </svg>
                                    {{ $item->available ? 'ხელმისაწვდომი' : 'არ არის' }}
                                </div>
                            @endif
                        </div>

                        {{-- Slug Info --}}
                        <div class="mb-3 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium truncate">
                                {{ $item->slug }}
                            </div>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('admin.menu.items.edit', $item) }}"
                               class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-orange-600 bg-gradient-to-r from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 dark:from-orange-900/30 dark:to-orange-800/30 dark:text-orange-400 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                რედაქტირება
                            </a>
                            
                            <form action="{{ route('admin.menu.items.destroy', $item) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ აითემის წაშლა?');">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold bg-gradient-to-r from-gray-700 to-gray-900 dark:from-gray-300 dark:to-gray-100 bg-clip-text text-transparent mb-3">
                            @if(request('search'))
                                ძიების შედეგი არ მოიძებნა
                            @else
                                აითემი არ მოიძებნა
                            @endif
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm leading-relaxed">
                            @if(request('search'))
                                ძიების კრიტერიუმის "{{ request('search') }}" შესაბამისი აითემი არ მოიძებნა.
                            @else
                                ჯერ არ შექმნილა მენიუს აითემი. დაამატეთ პირველი აითემი დასაწყებად.
                            @endif
                        </p>
                        <a href="{{ route('admin.menu.items.create') }}{{ request('category_id') ? '?category_id=' . request('category_id') . '&restaurant_id=' . request('restaurant_id') : '' }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            აითემის დამატება
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
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