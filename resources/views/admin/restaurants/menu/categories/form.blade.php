@props(['category' => null, 'restaurant' => null, 'restaurants' => [], 'categories' => [], 'buttonText' => null]) 
@php
    $isEdit = !is_null($category);
    // Define default button text if not provided, or use the one from $isEdit logic
    $submitButtonText = $buttonText ?? ($isEdit ? 'Save Changes' : 'Create Category');

    // Define standard input classes for reuse
    $inputClasses =
        'block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500';
    $labelClasses = 'block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2';
    $cardClasses = 'bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden';
@endphp

<div class="max-w-6xl mx-auto space-y-8">
    <form
        action="{{ $isEdit ? route('admin.restaurants.menu.categories.update', [$restaurant, $category]) : route('admin.restaurants.menu.categories.store', $restaurant) }}"
        method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        {{-- Header Card --}}
        <div class="{{ $cardClasses }}">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    {{ $isEdit ? 'Edit Menu Category' : 'Create New Category' }}
                </h2>
                <p class="text-blue-100 mt-2">{{ $isEdit ? 'Update category information and settings' : 'Add a new category to organize your menu items' }}</p>
            </div>
        </div>

        {{-- Image & Settings Section --}}
        <div class="{{ $cardClasses }}">
            <div class="p-8">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Visual & Display Settings
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Configure the visual appearance and display order</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Image Upload --}}
                    <div class="lg:col-span-1">
                        <label for="image" class="{{ $labelClasses }}">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Category Image
                        </label>
                        @if ($isEdit && $category->image)
                            <div class="mb-4 relative group">
                                <img src="{{ $category->image }}" alt="Current Image"
                                    class="w-full h-48 rounded-xl object-cover border-2 border-gray-200 dark:border-gray-600 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-xl transition-all duration-300 flex items-center justify-center">
                                    <span class="text-white opacity-0 group-hover:opacity-100 font-medium">Current Image</span>
                                </div>
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="image" id="image" class="hidden" accept="image/*">
                            <label for="image" class="block w-full cursor-pointer">
                                <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-blue-400 dark:hover:border-blue-500 transition-colors duration-200 bg-gray-50 dark:bg-gray-700/50">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Click to upload image</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Status & Rank --}}
                    <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Status Dropdown --}}
                        <div>
                            <label for="status" class="{{ $labelClasses }}">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status
                            </label>
                            <select name="status" id="status" class="{{ $inputClasses }}">
                                <option value="active"
                                    {{ old('status', $category->status ?? 'active') === 'active' ? 'selected' : '' }}>
                                    ✅ Active
                                </option>
                                <option value="inactive" {{ old('status', $category->status ?? '') === 'inactive' ? 'selected' : '' }}>
                                    🚫 Inactive
                                </option>
                            </select>
                        </div>

                        {{-- Rank Input --}}
                        <div>
                            <label for="rank" class="{{ $labelClasses }}">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                Display Order
                            </label>
                            <input type="number" name="rank" id="rank" value="{{ old('rank', $category->rank ?? 0) }}"
                                class="{{ $inputClasses }}" placeholder="0" min="0">
                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Lower numbers appear first
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Core Details Section --}}
        <div class="{{ $cardClasses }}">
            <div class="p-8">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Category Configuration
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Set up the basic details and relationships</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Slug Input --}}
                    <div>
                        <label for="slug" class="{{ $labelClasses }}">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            URL Slug
                        </label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug ?? '') }}"
                            class="{{ $inputClasses }}" placeholder="auto-generated-slug">
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Auto-generated if left blank
                        </p>
                    </div>

                    {{-- Restaurant Info (Fixed Context) --}}
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
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    </div>

                    {{-- Parent Category Select --}}
                    <div>
                        <label for="parent_id" class="{{ $labelClasses }}">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                            Parent Category
                        </label>
                        <select name="parent_id" id="parent_id" class="{{ $inputClasses }} @error('parent_id') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror" 
                                {{ $categories->isEmpty() && !$isEdit ? 'disabled' : '' }}>
                            @if($categories->isEmpty() && !$isEdit)
                                <option value="">🏪 First select a restaurant</option>
                            @else
                                <option value="">📁 Main Category</option>
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}"
                                        {{ old('parent_id', $category->parent_id ?? '') == $parentCategory->id ? 'selected' : '' }}>
                                        📂 {{ $parentCategory->name ?? 'Category #' . $parentCategory->id }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('parent_id')
                            <div class="mt-2 p-2 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <p class="text-sm text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            </div>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Leave empty to create a main category
                        </p>
                    </div>
                </div>
            </div>
        </div>


        {{-- Translations Section --}}
        <div class="{{ $cardClasses }}">
            <div class="p-8">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        Multi-language Content
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Add translations for different languages</p>
                </div>
                
                <div class="space-y-8">
                    @foreach (config('translatable.locales') as $locale)
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 border-2 border-gray-200 dark:border-gray-600">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-lg">{{ strtoupper($locale) }}</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                        {{ $locale === 'en' ? '🇬🇧 English' : ($locale === 'ka' ? '🇬🇪 ქართული' : strtoupper($locale)) }} Translation
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Enter content in {{ $locale === 'en' ? 'English' : ($locale === 'ka' ? 'Georgian' : strtoupper($locale)) }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label for="{{ $locale }}_name" class="{{ $labelClasses }}">
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        Category Name
                                    </label>
                                    <input type="text" name="{{ $locale }}[name]" id="{{ $locale }}_name"
                                        value="{{ old($locale . '.name', $category?->translate($locale)?->name ?? '') }}"
                                        class="{{ $inputClasses }}" placeholder="Enter category name...">>
                                </div>

                                <div>
                                    <label for="{{ $locale }}_description" class="{{ $labelClasses }}">
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                        </svg>
                                        Description
                                    </label>
                                    <textarea name="{{ $locale }}[description]" id="{{ $locale }}_description" rows="4"
                                        class="{{ $inputClasses }} resize-none" placeholder="Enter detailed description...">{{ old($locale . '.description', $category?->translate($locale)->description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                <button type="submit"
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 hover:from-blue-700 hover:via-purple-700 hover:to-blue-900 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 group-hover:animate-pulse" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" id="loading-spinner" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="save-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span id="button-text" class="group-hover:tracking-wide transition-all duration-200">{{ $submitButtonText }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Enhanced JavaScript for better UX --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced form submission with loading state
            const form = document.querySelector('form');
            const button = form.querySelector('button[type="submit"]');
            const buttonText = button.querySelector('#button-text');
            const spinner = button.querySelector('#loading-spinner');
            const saveIcon = button.querySelector('#save-icon');

            form.addEventListener('submit', function() {
                button.disabled = true;
                button.classList.add('opacity-75', 'cursor-not-allowed');
                
                if (buttonText) {
                    buttonText.textContent = 'Saving...';
                    buttonText.classList.add('animate-pulse');
                }
                if (saveIcon) saveIcon.style.display = 'none';
                if (spinner) spinner.style.display = 'block';
            });

            // Enhanced file upload preview
            const imageInput = document.getElementById('image');
            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Create or update preview
                            let preview = document.querySelector('.image-preview');
                            if (!preview) {
                                preview = document.createElement('div');
                                preview.className = 'image-preview mt-4';
                                imageInput.parentNode.appendChild(preview);
                            }
                            
                            preview.innerHTML = `
                                <div class="relative group">
                                    <img src="${e.target.result}" alt="Preview" 
                                         class="w-full h-48 rounded-xl object-cover border-2 border-blue-200 dark:border-blue-600 shadow-lg">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end">
                                        <p class="text-white text-sm font-medium p-4">New Image Preview</p>
                                    </div>
                                </div>
                            `;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Enhanced AJAX for loading parent categories for current restaurant
            const parentCategorySelect = document.querySelector('select[name="parent_id"]');
            const restaurantId = {{ $restaurant->id }};
            
            if (parentCategorySelect && restaurantId) {
                // Store the current parent_id value for edit forms
                const currentParentId = parentCategorySelect.value;
                const isEditForm = {{ $isEdit ? 'true' : 'false' }};
                
                // Load parent categories for the current restaurant on page load
                loadParentCategories();
                
                function loadParentCategories() {
                    console.log('Loading parent categories for restaurant:', restaurantId);
                    
                    // Clear current parent category options except the default one
                    parentCategorySelect.innerHTML = '<option value="">📁 Main Category</option>';
                    
                    // Show enhanced loading state
                    parentCategorySelect.disabled = true;
                    parentCategorySelect.classList.add('opacity-50', 'cursor-not-allowed');
                    parentCategorySelect.innerHTML = '<option value="">⏳ Loading categories...</option>';
                    
                    // Make AJAX request to get parent categories for current restaurant
                    const url = `/admin/restaurants/${restaurantId}/parent-categories`;
                    const requestParams = new URLSearchParams();
                    
                    // Add current category ID to exclude it from parent options (edit mode only)
                    @if($isEdit && isset($category))
                        requestParams.append('current_category_id', '{{ $category->id }}');
                    @endif
                    
                    const fullUrl = requestParams.toString() ? `${url}?${requestParams.toString()}` : url;
                    console.log('Making request to:', fullUrl);
                    
                    fetch(fullUrl, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Received data:', data);
                        parentCategorySelect.disabled = false;
                        parentCategorySelect.classList.remove('opacity-50', 'cursor-not-allowed');
                        parentCategorySelect.innerHTML = '<option value="">📁 Main Category</option>';
                        
                        if (data.categories && data.categories.length > 0) {
                            data.categories.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.id;
                                option.textContent = `📂 ${category.name || `Category #${category.id}`}`;
                                
                                // If this is the current parent in edit mode, select it
                                if (isEditForm && currentParentId == category.id) {
                                    option.selected = true;
                                }
                                
                                parentCategorySelect.appendChild(option);
                            });
                            console.log(`Added ${data.categories.length} categories to dropdown`);
                            
                            // Show success notification
                            showNotification(`✅ Loaded ${data.categories.length} categories`, 'success');
                        } else {
                            console.log('No categories found for this restaurant');
                            showNotification('ℹ️ No categories found for this restaurant', 'info');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching parent categories:', error);
                        parentCategorySelect.disabled = false;
                        parentCategorySelect.classList.remove('opacity-50', 'cursor-not-allowed');
                        parentCategorySelect.innerHTML = '<option value="">📁 Main Category</option>';
                        
                        // Show user-friendly error
                        const errorOption = document.createElement('option');
                        errorOption.value = '';
                        errorOption.textContent = '❌ Error loading categories';
                        errorOption.disabled = true;
                        parentCategorySelect.appendChild(errorOption);
                        
                        showNotification('❌ Error loading categories', 'error');
                    });
                }
            }

            // Simple notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-xl shadow-lg z-50 transition-all duration-300 transform translate-x-full ${
                    type === 'success' ? 'bg-green-500 text-white' :
                    type === 'error' ? 'bg-red-500 text-white' :
                    type === 'warning' ? 'bg-yellow-500 text-white' :
                    'bg-blue-500 text-white'
                }`;
                notification.textContent = message;
                
                document.body.appendChild(notification);
                
                // Slide in
                setTimeout(() => notification.classList.remove('translate-x-full'), 100);
                
                // Slide out and remove
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        });
    </script>
@endpush
