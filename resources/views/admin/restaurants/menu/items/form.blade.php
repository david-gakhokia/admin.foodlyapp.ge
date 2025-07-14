@php
    $locales = config('translatable.locales');
@endphp

<div class="max-w-4xl mx-auto">
    <!-- Language Tabs -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg mb-12">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Locale Tabs">
                @foreach ($locales as $locale)
                    <button type="button"
                        class="locale-tab text-sm font-medium px-4 py-3 border-b-2 transition-all duration-200 @if ($loop->first) border-indigo-500 text-indigo-600 bg-indigo-50 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50 @endif"
                        data-locale="{{ $locale }}">
                        <span class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-current opacity-60"></span>
                            <span>{{ strtoupper($locale) }}</span>
                        </span>
                    </button>
                @endforeach
            </nav>
        </div>

        @foreach ($locales as $locale)
            <div class="locale-content p-8 @if (!$loop->first) hidden @endif" data-locale="{{ $locale }}">
                <div class="space-y-8">
                    <div class="group p-6 bg-gradient-to-r from-gray-50/50 to-blue-50/30 rounded-2xl border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-md">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Name ({{ strtoupper($locale) }})</span>
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                            </span>
                        </label>
                        <input type="text" name="translations[{{ $locale }}][name]"
                            value="{{ old('translations.' . $locale . '.name', isset($menuItem) ? $menuItem->translate($locale)?->name : '') }}"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-gray-200 shadow-sm focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 transition-all duration-300 bg-white hover:border-gray-300 text-base font-medium @error('translations.' . $locale . '.name') border-red-300 bg-red-50 @enderror"
                            placeholder="Enter menu item name..."
                            required>
                        @error('translations.' . $locale . '.name')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div class="group p-6 bg-gradient-to-r from-gray-50/50 to-green-50/30 rounded-2xl border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-md">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Description ({{ strtoupper($locale) }})</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                            </span>
                        </label>
                        <textarea name="translations[{{ $locale }}][description]" rows="5"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-gray-200 shadow-sm focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-white hover:border-gray-300 resize-none text-base @error('translations.' . $locale . '.description') border-red-300 bg-red-50 @enderror"
                            placeholder="Enter detailed description of the menu item...">{{ old('translations.' . $locale . '.description', isset($menuItem) ? $menuItem->translate($locale)?->description : '') }}</textarea>
                        @error('translations.' . $locale . '.description')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div class="group p-6 bg-gradient-to-r from-gray-50/50 to-yellow-50/30 rounded-2xl border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-md">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-lg">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Ingredients ({{ strtoupper($locale) }})</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                            </span>
                        </label>
                        <textarea name="translations[{{ $locale }}][ingredients]" rows="3"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-gray-200 shadow-sm focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 transition-all duration-300 bg-white hover:border-gray-300 resize-none text-base @error('translations.' . $locale . '.ingredients') border-red-300 bg-red-50 @enderror"
                            placeholder="List the ingredients...">{{ old('translations.' . $locale . '.ingredients', isset($menuItem) ? $menuItem->translate($locale)?->ingredients : '') }}</textarea>
                        @error('translations.' . $locale . '.ingredients')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div class="group p-6 bg-gradient-to-r from-gray-50/50 to-red-50/30 rounded-2xl border border-gray-100 hover:border-gray-200 transition-all duration-300 hover:shadow-md">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-red-100 to-pink-100 rounded-lg">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Allergens ({{ strtoupper($locale) }})</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                            </span>
                        </label>
                        <input type="text" name="translations[{{ $locale }}][allergens]"
                            value="{{ old('translations.' . $locale . '.allergens', isset($menuItem) ? $menuItem->translate($locale)?->allergens : '') }}"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-gray-200 shadow-sm focus:border-red-400 focus:ring-4 focus:ring-red-100 transition-all duration-300 bg-white hover:border-gray-300 text-base font-medium @error('translations.' . $locale . '.allergens') border-red-300 bg-red-50 @enderror"
                            placeholder="List any allergens (e.g., nuts, gluten, dairy)...">
                        @error('translations.' . $locale . '.allergens')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Menu Category Selection -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg mb-12">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50/50 to-indigo-50/50">
            <h3 class="text-xl font-bold text-gray-900 flex items-center space-x-3">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span>Restaurant & Category Assignment</span>
            </h3>
            <p class="text-gray-600 mt-2">Choose the restaurant and category for this menu item</p>
        </div>
        <div class="p-8">
            @if(isset($selectedRestaurantId) && $selectedRestaurantId)
                <!-- Show selected restaurant info -->
                <div class="mb-8 p-6 bg-gradient-to-br from-indigo-50/70 to-purple-50/50 rounded-2xl border-2 border-indigo-100">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Selected Restaurant</h4>
                            <p class="text-sm text-gray-600">
                                {{ $restaurants->find($selectedRestaurantId)?->name ?? 'Restaurant #' . $selectedRestaurantId }}
                            </p>
                        </div>
                    </div>
                    <!-- Hidden input for restaurant_id -->
                    <input type="hidden" name="restaurant_id" value="{{ $selectedRestaurantId }}">
                </div>

                @if(isset($selectedCategoryId) && $selectedCategoryId)
                    <!-- Show selected category info -->
                    <div class="p-6 bg-gradient-to-br from-green-50/70 to-emerald-50/50 rounded-2xl border-2 border-green-100">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Selected Category</h4>
                                <p class="text-sm text-gray-600">
                                    {{ $menuCategories->find($selectedCategoryId)?->name ?? 'Category #' . $selectedCategoryId }}
                                </p>
                            </div>
                        </div>
                        <!-- Hidden input for menu_category_id -->
                        <input type="hidden" name="menu_category_id" value="{{ $selectedCategoryId }}">
                    </div>
                @else
                    <!-- Menu Category Selection -->
                    <div class="group p-6 bg-gradient-to-br from-blue-50/70 to-indigo-50/50 rounded-2xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Menu Category</span>
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                            </span>
                        </label>
                        <select name="menu_category_id" id="menu_category_id"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-blue-200 shadow-sm focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white hover:border-blue-300 text-base font-medium @error('menu_category_id') border-red-300 bg-red-50 @enderror"
                            required>
                            <option value="">Select a category...</option>
                            @if(isset($menuCategories) && $menuCategories->count() > 0)
                                @foreach($menuCategories as $category)
                                    <option value="{{ $category->id }}" @selected(old('menu_category_id', $menuItem->menu_category_id ?? '') == $category->id)>
                                        {{ $category->name ?? 'Category #' . $category->id }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">No categories available for this restaurant</option>
                            @endif
                        </select>
                        @error('menu_category_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                @endif
            @else
                <!-- Show restaurant selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Restaurant Selection -->
                    <div class="group p-6 bg-gradient-to-br from-orange-50/70 to-amber-50/50 rounded-2xl border-2 border-orange-100 hover:border-orange-200 transition-all duration-300 hover:shadow-lg">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Restaurant</span>
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                            </span>
                        </label>
                        <select name="restaurant_id" id="restaurant_id"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-orange-200 shadow-sm focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition-all duration-300 bg-white hover:border-orange-300 text-base font-medium @error('restaurant_id') border-red-300 bg-red-50 @enderror"
                            required>
                            <option value="">Select a restaurant...</option>
                            @if(isset($restaurants))
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}" @selected(old('restaurant_id', $menuItem->restaurant_id ?? '') == $restaurant->id)>
                                        {{ $restaurant->name ?? 'Restaurant #' . $restaurant->id }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('restaurant_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Menu Category Selection -->
                    <div class="group p-6 bg-gradient-to-br from-blue-50/70 to-indigo-50/50 rounded-2xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                        <label class="block text-sm font-bold text-gray-800 mb-4">
                            <span class="flex items-center space-x-3">
                                <div class="p-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span class="text-base">Menu Category</span>
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                            </span>
                        </label>
                        <select name="menu_category_id" id="menu_category_id"
                            class="block w-full px-5 py-4 rounded-xl border-2 border-blue-200 shadow-sm focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white hover:border-blue-300 text-base font-medium @error('menu_category_id') border-red-300 bg-red-50 @enderror"
                            required>
                            <option value="">Select a restaurant first</option>
                            @if(isset($menuItem) && $menuItem->menu_category_id && isset($menuCategories))
                                @foreach($menuCategories as $category)
                                    <option value="{{ $category->id }}" @selected(old('menu_category_id', $menuItem->menu_category_id ?? '') == $category->id)>
                                        {{ $category->name ?? 'Category #' . $category->id }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('menu_category_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Menu Item Details -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg mb-10">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-50/50 to-purple-50/50">
            <h3 class="text-xl font-bold text-gray-900 flex items-center space-x-3">
                <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <span>Pricing & Details</span>
            </h3>
            <p class="text-gray-600 mt-2">Configure pricing and quantity information</p>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group p-6 bg-gradient-to-br from-green-50/70 to-emerald-50/50 rounded-2xl border-2 border-green-100 hover:border-green-200 transition-all duration-300 hover:shadow-lg">
                    <label for="price" class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <span class="text-base">Price</span>
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                        </span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-green-600 font-bold text-lg">$</span>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                            class="block w-full pl-10 pr-5 py-4 rounded-xl border-2 border-green-200 shadow-sm focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-white hover:border-green-300 text-lg font-semibold @error('price') border-red-300 bg-red-50 @enderror"
                            value="{{ old('price', $menuItem->price ?? '') }}" placeholder="0.00" required>
                    </div>
                    @error('price')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="group p-6 bg-gradient-to-br from-red-50/70 to-pink-50/50 rounded-2xl border-2 border-red-100 hover:border-red-200 transition-all duration-300 hover:shadow-lg">
                    <label for="discounted_price" class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-red-500 to-pink-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <span class="text-base">Discounted Price</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                        </span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-red-600 font-bold text-lg">$</span>
                        <input type="number" name="discounted_price" id="discounted_price" step="0.01" min="0"
                            class="block w-full pl-10 pr-5 py-4 rounded-xl border-2 border-red-200 shadow-sm focus:border-red-400 focus:ring-4 focus:ring-red-100 transition-all duration-300 bg-white hover:border-red-300 text-lg font-semibold @error('discounted_price') border-red-300 bg-red-50 @enderror"
                            value="{{ old('discounted_price', $menuItem->discounted_price ?? '') }}" placeholder="0.00">
                    </div>
                    @error('discounted_price')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="group p-6 bg-gradient-to-br from-blue-50/70 to-cyan-50/50 rounded-2xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                    <label for="unit" class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-base">Unit</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                        </span>
                    </label>
                    <input type="text" name="unit" id="unit"
                        class="block w-full px-5 py-4 rounded-xl border-2 border-blue-200 shadow-sm focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white hover:border-blue-300 text-base font-medium @error('unit') border-red-300 bg-red-50 @enderror"
                        value="{{ old('unit', $menuItem->unit ?? '') }}" placeholder="e.g. piece, kg, liter, serving">
                    @error('unit')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="group p-6 bg-gradient-to-br from-purple-50/70 to-indigo-50/50 rounded-2xl border-2 border-purple-100 hover:border-purple-200 transition-all duration-300 hover:shadow-lg">
                    <label for="quantity" class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </div>
                            <span class="text-base">Quantity</span>
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                        </span>
                    </label>
                    <input type="number" name="quantity" id="quantity" step="1" min="0"
                        class="block w-full px-5 py-4 rounded-xl border-2 border-purple-200 shadow-sm focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 bg-white hover:border-purple-300 text-lg font-semibold @error('quantity') border-red-300 bg-red-50 @enderror"
                        value="{{ old('quantity', $menuItem->quantity ?? '1') }}" placeholder="1" required>
                    @error('quantity')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Status & Settings -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg mb-10">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-yellow-50/50 to-orange-50/50">
            <h3 class="text-xl font-bold text-gray-900 flex items-center space-x-3">
                <div class="p-3 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                </div>
                <span>Status & Settings</span>
            </h3>
            <p class="text-gray-600 mt-2">Configure item availability and display settings</p>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group p-6 bg-gradient-to-br from-green-50/70 to-emerald-50/50 rounded-2xl border-2 border-green-100 hover:border-green-200 transition-all duration-300 hover:shadow-lg">
                    <label class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-base">Status</span>
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                        </span>
                    </label>
                    <select name="status"
                        class="block w-full px-5 py-4 rounded-xl border-2 border-green-200 shadow-sm focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 bg-white hover:border-green-300 text-base font-medium @error('status') border-red-300 bg-red-50 @enderror"
                        required>
                        <option value="active" @selected(old('status', $menuItem->status ?? 'active') === 'active')>
                            ✅ Active
                        </option>
                        <option value="inactive" @selected(old('status', $menuItem->status ?? '') === 'inactive')>
                            ❌ Inactive
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="group p-6 bg-gradient-to-br from-blue-50/70 to-cyan-50/50 rounded-2xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                    <label class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-base">Available</span>
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Required</span>
                        </span>
                    </label>
                    <select name="available"
                        class="block w-full px-5 py-4 rounded-xl border-2 border-blue-200 shadow-sm focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white hover:border-blue-300 text-base font-medium @error('available') border-red-300 bg-red-50 @enderror"
                        required>
                        <option value="1" @selected(old('available', $menuItem->available ?? '1') == '1')>
                            🟢 Available
                        </option>
                        <option value="0" @selected(old('available', $menuItem->available ?? '') == '0')>
                            🔴 Unavailable
                        </option>
                    </select>
                    @error('available')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="group p-6 bg-gradient-to-br from-yellow-50/70 to-amber-50/50 rounded-2xl border-2 border-yellow-100 hover:border-yellow-200 transition-all duration-300 hover:shadow-lg">
                    <label for="rank" class="block text-sm font-bold text-gray-800 mb-4">
                        <span class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                            <span class="text-base">Display Rank</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                        </span>
                    </label>
                    <input type="number" name="rank" id="rank"
                        class="block w-full px-5 py-4 rounded-xl border-2 border-yellow-200 shadow-sm focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 transition-all duration-300 bg-white hover:border-yellow-300 text-base font-medium @error('rank') border-red-300 bg-red-50 @enderror"
                        value="{{ old('rank', $menuItem->rank ?? '') }}" min="0" step="1" placeholder="Auto-assign">
                    <p class="mt-2 text-xs text-gray-500">Leave empty to auto-assign. Lower numbers appear first in listings.</p>
                    @error('rank')
                        <p class="mt-2 text-sm text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg mb-10">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-purple-50/50 to-pink-50/50">
            <h3 class="text-xl font-bold text-gray-900 flex items-center space-x-3">
                <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span>Menu Item Image</span>
            </h3>
            <p class="text-gray-600 mt-2">Upload an appetizing image of your menu item</p>
        </div>
        <div class="p-8">
            @if (!empty($menuItem->image))
                <div class="mb-6">
                    <div class="relative inline-block">
                        <img src="{{ $menuItem->image }}" alt="Menu Item Image" 
                             class="h-40 w-40 object-cover rounded-2xl shadow-lg border-2 border-gray-200">
                        <div class="absolute -top-2 -right-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 shadow-md">
                                Current
                            </span>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-gray-600 font-medium">Current image will be replaced if you upload a new one</p>
                </div>
            @endif

            <div class="group">
                <label class="block text-sm font-bold text-gray-800 mb-4">
                    <span class="flex items-center space-x-3">
                        <div class="p-2 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <span class="text-base">Upload New Image</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Optional</span>
                    </span>
                </label>
                <div class="mt-2 flex justify-center px-8 pt-8 pb-8 border-3 border-gray-300 border-dashed rounded-2xl hover:border-purple-400 hover:bg-purple-50/30 transition-all duration-300 group-hover:shadow-md">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 group-hover:text-purple-500 transition-colors duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-base text-gray-600 font-medium">
                            <label for="image" class="relative cursor-pointer bg-white rounded-xl font-bold text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-4 focus-within:ring-purple-200 px-3 py-1 transition-all duration-200">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-3 text-sm text-red-600 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
        <!-- Error notification area -->
        <div id="error-notification" class="hidden flex items-center space-x-2 text-sm text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span id="error-message">Something went wrong. Please try again.</span>
        </div>
        
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>* Required fields</span>
        </div>
        
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.menu.items.index') }}" 
               class="group inline-flex items-center px-6 py-3 border-2 border-gray-300 shadow-sm text-sm font-semibold rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="relative">
                    Cancel
                    <span class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-gray-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </span>
            </a>
            
            <button type="submit"
                class="group relative inline-flex items-center px-8 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 focus:outline-none focus:ring-4 focus:ring-purple-300 transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 ease-in-out overflow-hidden"
                id="submit-btn">
                <!-- Animated background -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                
                <!-- Shimmer effect -->
                <div class="absolute inset-0 -skew-x-12 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 group-hover:animate-pulse"></div>
                
                <!-- Loading spinner (hidden by default) -->
                <div id="loading-spinner" class="hidden w-5 h-5 mr-3 animate-spin">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
                
                <svg id="submit-icon" class="w-5 h-5 mr-3 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
                
                <span class="relative font-medium tracking-wide" id="submit-text">
                    {{ isset($menuItem) && $menuItem->exists ? 'Update Menu Item' : 'Create Menu Item' }}
                </span>
                
                <!-- Success pulse animation -->
                <div class="absolute inset-0 rounded-xl bg-green-400 opacity-0 group-active:opacity-30 group-active:animate-ping transition-opacity duration-150"></div>
            </button>
        </div>
    </div>
</div>

<script>
    // Enhanced tabs switching logic with smooth transitions
    document.querySelectorAll('.locale-tab').forEach(btn => {
        btn.addEventListener('click', () => {
            const locale = btn.getAttribute('data-locale');

            // Update tab styling
            document.querySelectorAll('.locale-tab').forEach(tab => {
                tab.classList.remove('border-indigo-500', 'text-indigo-600', 'bg-indigo-50');
                tab.classList.add('border-transparent', 'text-gray-500');
            });
            btn.classList.remove('border-transparent', 'text-gray-500');
            btn.classList.add('border-indigo-500', 'text-indigo-600', 'bg-indigo-50');

            // Switch content with fade effect
            document.querySelectorAll('.locale-content').forEach(content => {
                if (content.getAttribute('data-locale') === locale) {
                    content.classList.remove('hidden');
                    content.style.opacity = '0';
                    setTimeout(() => {
                        content.style.opacity = '1';
                    }, 10);
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Create preview if it doesn't exist
                let preview = document.getElementById('image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'image-preview';
                    preview.className = 'mt-4';
                    e.target.closest('.group').appendChild(preview);
                }
                
                preview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${e.target.result}" alt="Preview" 
                             class="h-32 w-32 object-cover rounded-lg shadow-md border border-gray-200">
                        <div class="absolute -top-2 -right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Preview
                            </span>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">New image preview</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    // Restaurant selection change handler for filtering categories (only when restaurant selection is available)
    const restaurantSelect = document.querySelector('select[name="restaurant_id"]');
    const categorySelect = document.querySelector('select[name="menu_category_id"]');
    
    if (restaurantSelect && categorySelect) {
        restaurantSelect.addEventListener('change', function() {
            const restaurantId = this.value;
            
            // Clear current category options except the default one
            categorySelect.innerHTML = '<option value="">Select a category...</option>';
            
            if (restaurantId) {
                // Show loading state
                categorySelect.disabled = true;
                categorySelect.innerHTML = '<option value="">Loading categories...</option>';
                
                // Make AJAX request to get categories for selected restaurant
                fetch(`/admin/restaurants/${restaurantId}/menu-categories`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    categorySelect.disabled = false;
                    categorySelect.innerHTML = '<option value="">Select a category...</option>';
                    
                    if (data.categories && data.categories.length > 0) {
                        data.categories.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name || `Category #${category.id}`;
                            categorySelect.appendChild(option);
                        });
                    } else {
                        categorySelect.innerHTML = '<option value="">No categories available for this restaurant</option>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    categorySelect.disabled = false;
                    categorySelect.innerHTML = '<option value="">Error loading categories</option>';
                });
            } else {
                categorySelect.disabled = false;
                categorySelect.innerHTML = '<option value="">Select a restaurant first</option>';
            }
        });
    }

    // Form submission handling with error checking
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submit-btn');
    const submitIcon = document.getElementById('submit-icon');
    const submitText = document.getElementById('submit-text');
    const loadingSpinner = document.getElementById('loading-spinner');
    const errorNotification = document.getElementById('error-notification');
    const errorMessage = document.getElementById('error-message');

    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Show loading state
            submitBtn.disabled = true;
            submitIcon.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            submitText.textContent = 'Processing...';
            errorNotification.classList.add('hidden');

            // Check for required fields
            const requiredFields = form.querySelectorAll('[required]');
            let hasErrors = false;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    hasErrors = true;
                    field.classList.add('border-red-300', 'bg-red-50');
                } else {
                    field.classList.remove('border-red-300', 'bg-red-50');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                showError('Please fill in all required fields.');
                return false;
            }

            // Additional validation
            const restaurantId = document.querySelector('input[name="restaurant_id"], select[name="restaurant_id"]')?.value;
            const categoryId = document.querySelector('select[name="menu_category_id"]')?.value;

            if (!restaurantId) {
                e.preventDefault();
                showError('Please select a restaurant.');
                return false;
            }

            if (!categoryId) {
                e.preventDefault();
                showError('Please select a menu category.');
                return false;
            }

            // Log form data for debugging
            const formData = new FormData(form);
            console.log('Form submission data:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ':', value);
            }
        });
    }

    function showError(message) {
        submitBtn.disabled = false;
        submitIcon.classList.remove('hidden');
        loadingSpinner.classList.add('hidden');
        submitText.textContent = '{{ isset($menuItem) && $menuItem->exists ? 'Update Menu Item' : 'Create Menu Item' }}';
        errorMessage.textContent = message;
        errorNotification.classList.remove('hidden');
        
        // Scroll to error
        errorNotification.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Hide error notification when user starts typing
    document.addEventListener('input', function() {
        if (!errorNotification.classList.contains('hidden')) {
            errorNotification.classList.add('hidden');
        }
    });
</script>