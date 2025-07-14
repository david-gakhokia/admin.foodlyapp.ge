@php
    $locales = config('translatable.locales');
@endphp

<div class="p-8">
    <!-- Form Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Dish Information</h2>
        <p class="text-gray-600">Fill in the details below to {{ isset($dish) && $dish->exists ? 'update the' : 'create a new' }} dish.</p>
    </div>

    <!-- Language Tabs -->
    <div class="mb-8">
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8" aria-label="Locale Tabs">
                @foreach ($locales as $locale)
                    <button type="button"
                        class="locale-tab whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200 @if ($loop->first) border-green-500 text-green-600 bg-green-50 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50 @endif"
                        data-locale="{{ $locale }}">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-full @if ($loop->first) bg-green-500 @else bg-gray-400 @endif flex items-center justify-center">
                                <span class="text-xs font-bold text-white">{{ strtoupper($locale)[0] }}</span>
                            </div>
                            {{ strtoupper($locale) }}
                        </div>
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Language Content -->
        @foreach ($locales as $locale)
            <div class="locale-content space-y-6 @if (!$loop->first) hidden @endif" data-locale="{{ $locale }}">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Name ({{ strtoupper($locale) }}) 
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="{{ $locale }}[name]"
                            value="{{ old($locale . '.name', isset($dish) ? $dish->translate($locale)?->name : '') }}"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Enter dish name in {{ strtoupper($locale) }}">
                        @error($locale . '.name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Description ({{ strtoupper($locale) }})
                        </label>
                        <textarea name="{{ $locale }}[description]" rows="4"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Enter dish description in {{ strtoupper($locale) }}">{{ old($locale . '.description', isset($dish) ? $dish->translate($locale)?->description : '') }}</textarea>
                        @error($locale . '.description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Dish Settings -->
    <div class="border-t border-gray-200 pt-8 mb-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Dish Settings
        </h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status 
                    <span class="text-red-500">*</span>
                </label>
                <select name="status"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3">
                    <option value="active" @selected(old('status', $dish->status ?? '') === 'active')>
                        ✅ Active
                    </option>
                    <option value="inactive" @selected(old('status', $dish->status ?? '') === 'inactive')>
                        ❌ Inactive
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="rank" class="block text-sm font-semibold text-gray-700 mb-2">
                    Display Order (Rank)
                </label>
                <input type="number" name="rank" id="rank" readonly
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                    value="{{ old('rank', $dish->rank ?? '') }}" 
                    min="0" step="1" 
                    placeholder="Enter display order (e.g., 1, 2, 3...)">
                @error('rank')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Lower numbers appear first in the list</p>
            </div>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="border-t border-gray-200 pt-8 mb-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Dish Image
        </h3>
        
        @if (!empty($dish->image) && isset($dish))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-center gap-3 mb-3">
                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-green-800">Current image uploaded</span>
                </div>
                <img src="{{ $dish->image }}" alt="Current Dish Image" 
                     class="h-32 w-32 object-cover rounded-lg shadow-md border border-green-200">
            </div>
        @endif

        <div class="relative">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                {{ isset($dish) && !empty($dish->image) ? 'Replace Image' : 'Upload Image' }}
            </label>
            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-green-400 transition-colors duration-200">
                <input type="file" name="image_file" accept="image/*"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    onchange="handleFileSelect(this)">
                
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium text-green-600 hover:text-green-500">Click to upload</span>
                            or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
            </div>
            
            <div id="file-name" class="mt-2 text-sm text-gray-600 hidden"></div>
            
            @error('image_file')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="border-t border-gray-200 pt-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.dishes.index') }}"
               class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>
            
            <button type="submit"
                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if(isset($dish) && $dish->exists)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    @endif
                </svg>
                {{ isset($dish) && $dish->exists ? 'Update Dish' : 'Create Dish' }}
            </button>
        </div>
    </div>
</div>

<script>
    // Enhanced tabs switching logic
    document.querySelectorAll('.locale-tab').forEach(btn => {
        btn.addEventListener('click', () => {
            const locale = btn.getAttribute('data-locale');

            // Update tab styles
            document.querySelectorAll('.locale-tab').forEach(tab => {
                tab.classList.remove('border-green-500', 'text-green-600', 'bg-green-50');
                tab.classList.add('border-transparent', 'text-gray-500');
                tab.querySelector('div > div').classList.remove('bg-green-500');
                tab.querySelector('div > div').classList.add('bg-gray-400');
            });
            
            btn.classList.remove('border-transparent', 'text-gray-500');
            btn.classList.add('border-green-500', 'text-green-600', 'bg-green-50');
            btn.querySelector('div > div').classList.remove('bg-gray-400');
            btn.querySelector('div > div').classList.add('bg-green-500');

            // Update content visibility
            document.querySelectorAll('.locale-content').forEach(content => {
                content.classList.add('hidden');
                if (content.getAttribute('data-locale') === locale) {
                    content.classList.remove('hidden');
                }
            });
        });
    });

    // File upload handler
    function handleFileSelect(input) {
        const fileNameDiv = document.getElementById('file-name');
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
            fileNameDiv.innerHTML = `
                <div class="flex items-center gap-2 p-2 bg-green-50 border border-green-200 rounded-lg">
                    <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-green-800 font-medium">${fileName}</span>
                    <span class="text-green-600 text-xs">(${fileSize} MB)</span>
                </div>
            `;
            fileNameDiv.classList.remove('hidden');
        } else {
            fileNameDiv.classList.add('hidden');
        }
    }
</script>