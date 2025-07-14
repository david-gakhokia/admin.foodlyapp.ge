<div>
    @php
        // Define standard input classes for reuse
        $inputClasses =
            'block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500';
        $labelClasses = 'block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2';
        $cardClasses =
            'bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden';
    @endphp

    <div class="max-w-6xl mx-auto space-y-8">
        <form wire:submit="save" class="space-y-8">
            {{-- Header Card --}}
            <div class="{{ $cardClasses }}">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        {{ $isEdit ? 'Edit Menu Category' : 'Create New Category' }}
                    </h2>
                    <p class="text-blue-100 mt-2">
                        {{ $isEdit ? 'Update category information and settings' : 'Add a new category to organize your menu items' }}
                    </p>
                </div>
            </div>



            {{-- Restaurant Select --}}
            <div class="{{ $cardClasses }}">
                <div class="p-8">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Restaurant & Category Configuration
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Select restaurant and parent category</p>
                    </div>

                    <div class="grid grid-cols-1 {{ $restaurant ? 'lg:grid-cols-1' : 'lg:grid-cols-2' }} gap-8">
                        {{-- Restaurant Info or Select --}}
                        @if($restaurant)
                            {{-- Fixed Restaurant Context --}}
                            <div>
                                <label class="{{ $labelClasses }}">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Restaurant
                                </label>
                                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                                    <p class="text-blue-700 dark:text-blue-300 font-semibold">
                                        {{ $restaurant->name }}
                                    </p>
                                    <p class="text-blue-600 dark:text-blue-400 text-sm mt-1">
                                        This category will be created for this restaurant
                                    </p>
                                </div>
                                <input type="hidden" wire:model="restaurant_id" value="{{ $restaurant->id }}">
                            </div>
                        @else
                            {{-- Restaurant Select for General Admin --}}
                            <div>
                                <label for="restaurant_id" class="{{ $labelClasses }}">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Restaurant *
                                </label>
                                <select wire:model.live="restaurant_id" id="restaurant_id"
                                    class="{{ $inputClasses }} @error('restaurant_id') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                    <option value="">🏪 Select Restaurant</option>
                                    @foreach ($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                    @endforeach
                                </select>
                                @error('restaurant_id')
                                    <div class="mt-2 p-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                        <p class="text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>
                        @endif

                        {{-- Parent Category Select --}}
                        <div>
                            <label for="parent_id" class="{{ $labelClasses }}">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                Parent Category
                            </label>
                            <select wire:model="parent_id" id="parent_id"
                                class="{{ $inputClasses }} @error('parent_id') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                {{ empty($restaurant_id) ? 'disabled' : '' }}>
                                @if (empty($restaurant_id))
                                    <option value="">🏪 First select a restaurant</option>
                                @else
                                    <option value="">📁 Main Category</option>
                                    @foreach ($parentCategories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}">
                                            📂 {{ $parentCategory->name ?? 'Category #' . $parentCategory->id }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('parent_id')
                                <div
                                    class="mt-2 p-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                    <p class="text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                            </path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                </div>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Leave empty to create a main category
                            </p>
                            @if (!empty($restaurant_id) && $parentCategories->count() > 0)
                                <div
                                    class="mt-2 p-2 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                    <p class="text-sm text-green-600 dark:text-green-400 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $parentCategories->count() }} categories available
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Additional Settings --}}
            <div class="{{ $cardClasses }}">
                <div class="p-8">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Additional Settings
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Configure advanced options</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Status --}}
                        <div>
                            <label for="status" class="{{ $labelClasses }}">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status
                            </label>
                            <select wire:model="status" id="status" class="{{ $inputClasses }}">
                                <option value="active">✅ Active</option>
                                <option value="inactive">🚫 Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Rank --}}
                        <div>
                            <label for="rank" class="{{ $labelClasses }}">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                Display Order
                            </label>
                            <input type="number" wire:model="rank" id="rank" class="{{ $inputClasses }}"
                                placeholder="0" min="0">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lower numbers appear first</p>
                            @error('rank')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div>
                            <label for="slug" class="{{ $labelClasses }}">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                    </path>
                                </svg>
                                URL Slug
                            </label>
                            <input type="text" wire:model="slug" id="slug" class="{{ $inputClasses }}"
                                placeholder="auto-generated">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Auto-generated if left blank</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Upload --}}
            <div class="{{ $cardClasses }}">
                <div class="p-8">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Category Image
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Upload an image for your category</p>
                    </div>

                    <div class="max-w-md">
                        @if ($isEdit && $imageUrl && !$image)
                            <div class="mb-4 relative group">
                                <img src="{{ $imageUrl }}" alt="Current Image"
                                    class="w-full h-48 rounded-xl object-cover border-2 border-gray-200 dark:border-gray-600 shadow-lg">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-xl transition-all duration-300 flex items-center justify-center">
                                    <span class="text-white opacity-0 group-hover:opacity-100 font-medium">Current
                                        Image</span>
                                </div>
                            </div>
                        @endif

                        @if ($image)
                            <div class="mb-4 relative group">
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                    class="w-full h-48 rounded-xl object-cover border-2 border-blue-200 dark:border-blue-600 shadow-lg">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end">
                                    <p class="text-white text-sm font-medium p-4">New Image Preview</p>
                                </div>
                            </div>
                        @endif

                        <div class="relative">
                            <input type="file" wire:model="image" id="image" class="hidden"
                                accept="image/*">
                            <label for="image" class="block w-full cursor-pointer">
                                <div
                                    class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-blue-400 dark:hover:border-blue-500 transition-colors duration-200 bg-gray-50 dark:bg-gray-700/50">
                                    <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Click to upload
                                        image</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG, GIF up to 2MB
                                    </p>
                                </div>
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Multi-language Content --}}
            <div class="{{ $cardClasses }}">
                <div class="p-8">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                </path>
                            </svg>
                            Multi-language Content
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Add translations for different languages</p>
                    </div>

                    <div class="space-y-6">
                        @foreach (config('translatable.locales') as $locale)
                            <div
                                class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">{{ strtoupper($locale) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-gray-100">
                                            {{ $locale === 'en' ? '🇬🇧 English' : ($locale === 'ka' ? '🇬🇪 ქართული' : strtoupper($locale)) }}
                                        </h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Enter content in
                                            {{ $locale === 'en' ? 'English' : ($locale === 'ka' ? 'Georgian' : strtoupper($locale)) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="{{ $locale }}_name" class="{{ $labelClasses }}">
                                            Category Name *
                                        </label>
                                        <input type="text" wire:model="translations.{{ $locale }}.name"
                                            id="{{ $locale }}_name" class="{{ $inputClasses }}"
                                            placeholder="Enter category name...">
                                        @error("translations.{$locale}.name")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="{{ $locale }}_description" class="{{ $labelClasses }}">
                                            Description
                                        </label>
                                        <textarea wire:model="translations.{{ $locale }}.description" id="{{ $locale }}_description"
                                            rows="3" class="{{ $inputClasses }} resize-none" placeholder="Enter description..."></textarea>
                                        @error("translations.{$locale}.description")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            {{-- Submit Button --}}
            <div class="flex justify-end">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <button type="submit" wire:loading.attr="disabled"
                        class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 hover:from-blue-700 hover:via-purple-700 hover:to-blue-900 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition-all duration-300 disabled:opacity-75 disabled:cursor-not-allowed">
                        <svg wire:loading wire:target="save" class="animate-spin h-6 w-6 mr-3" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <svg wire:loading.remove wire:target="save"
                            class="h-6 w-6 mr-3 group-hover:scale-110 transition-transform duration-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="save"
                            class="group-hover:tracking-wide transition-all duration-200">{{ $isEdit ? 'Save Changes' : 'Create Category' }}</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Loading indicator for restaurant change --}}
    <div wire:loading wire:target="restaurant_id"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-xl">
            <div class="flex items-center space-x-3">
                <svg class="animate-spin h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Loading categories...</span>
            </div>
        </div>
    </div>
</div>
