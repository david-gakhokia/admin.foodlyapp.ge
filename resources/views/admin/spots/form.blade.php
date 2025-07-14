@php
    $locales = config('translatable.locales');
@endphp

<div class="p-8">
    <!-- Form Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Spot Information</h2>
        <p class="text-gray-600">Fill in the details below to {{ isset($spot) && $spot->exists ? 'update the' : 'create a new' }} spot.</p>
    </div>

    <!-- Basic Information -->
    <div class="space-y-6 mb-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Basic Information
        </h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status 
                    <span class="text-red-500">*</span>
                </label>
                <select name="status" required
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3">
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status', isset($spot) ? $spot->status : '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', isset($spot) ? $spot->status : '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Display Order (Rank)
                    <span class="text-gray-400">(optional)</span>
                </label>
                <input type="number" name="rank" min="0"
                    value="{{ old('rank', isset($spot) ? $spot->rank : '') }}"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                    placeholder="Leave empty for auto-assign">
                @error('rank')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Language Tabs -->
    <div class="mb-8">
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8" aria-label="Locale Tabs">
                @foreach ($locales as $locale)
                    <button type="button"
                        class="locale-tab whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200 @if ($loop->first) border-purple-500 text-purple-600 bg-purple-50 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50 @endif"
                        data-locale="{{ $locale }}">
                        <div class="flex items-center gap-2">
                            @if($locale === 'en')
                                <div class="w-5 h-5 rounded-full @if ($loop->first) bg-purple-500 @else bg-gray-400 @endif flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">🇺🇸</span>
                                </div>
                                English
                            @elseif($locale === 'ka')
                                <div class="w-5 h-5 rounded-full @if ($loop->first) bg-purple-500 @else bg-gray-400 @endif flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">🇬🇪</span>
                                </div>
                                ქართული
                            @elseif($locale === 'ru')
                                <div class="w-5 h-5 rounded-full @if ($loop->first) bg-purple-500 @else bg-gray-400 @endif flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">🇷🇺</span>
                                </div>
                                Русский
                            @else
                                <div class="w-5 h-5 rounded-full @if ($loop->first) bg-purple-500 @else bg-gray-400 @endif flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">{{ strtoupper($locale)[0] }}</span>
                                </div>
                                {{ strtoupper($locale) }}
                            @endif
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
                            @if($locale === 'en')
                                Name ({{ strtoupper($locale) }})
                            @elseif($locale === 'ka')
                                დასახელება ({{ strtoupper($locale) }})
                            @elseif($locale === 'ru')
                                Название ({{ strtoupper($locale) }})
                            @else
                                Name ({{ strtoupper($locale) }})
                            @endif
                            @if($locale === config('app.locale'))
                                <span class="text-red-500">*</span>
                            @else
                                <span class="text-gray-400">(optional)</span>
                            @endif
                        </label>
                        <input type="text" name="{{ $locale }}[name]"
                            value="{{ old($locale . '.name', isset($spot) ? $spot->translate($locale)?->name : '') }}"
                            @if($locale === config('app.locale')) required @endif
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            @if($locale === 'en')
                                placeholder="e.g., Restaurant, Cafe, Bar"
                            @elseif($locale === 'ka')
                                placeholder="მაგ., რესტორანი, კაფე, ბარი"
                            @elseif($locale === 'ru')
                                placeholder="например, Ресторан, Кафе, Бар"
                            @else
                                placeholder="Enter spot name in {{ strtoupper($locale) }}"
                            @endif>
                        @error($locale . '.name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Media Upload -->
    <div class="border-t border-gray-200 pt-8 mb-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Media (Optional)
        </h3>

        @if(isset($spot) && ($spot->image || $spot->image_link))
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 mb-6">
                <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Current Image:
                </h4>
                <div class="flex items-center gap-4">
                    <img src="{{ $spot->image_link ?: $spot->image }}" 
                         alt="{{ $spot->name }}" 
                         class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 break-all">{{ $spot->image_link ?: $spot->image }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- File Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ isset($spot) && ($spot->image || $spot->image_link) ? 'Replace Image' : 'Upload Image' }}
                </label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-purple-400 transition-colors duration-200">
                    <input type="file" name="image_file" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        onchange="handleFileSelect(this)">
                    
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium text-purple-600 hover:text-purple-500">Click to upload</span>
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

            <!-- Image Link -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Or Image Link
                </label>
                <input type="url" name="image_link"
                    value="{{ old('image_link', isset($spot) ? $spot->image_link : '') }}"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                    placeholder="https://example.com/image.jpg">
                @error('image_link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Provide an external image URL if you prefer not to upload a file</p>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="border-t border-gray-200 pt-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.spots.index') }}"
               class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>
            
            <button type="submit"
                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                {{ isset($spot) && $spot->exists ? 'Update Spot' : 'Create Spot' }}
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Locale tab switching
        const tabs = document.querySelectorAll('.locale-tab');
        const contents = document.querySelectorAll('.locale-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const locale = this.dataset.locale;
                
                // Update tabs
                tabs.forEach(t => {
                    t.classList.remove('border-purple-500', 'text-purple-600', 'bg-purple-50');
                    t.classList.add('border-transparent', 'text-gray-500');
                    t.querySelector('.w-5').classList.remove('bg-purple-500');
                    t.querySelector('.w-5').classList.add('bg-gray-400');
                });
                
                this.classList.add('border-purple-500', 'text-purple-600', 'bg-purple-50');
                this.classList.remove('border-transparent', 'text-gray-500');
                this.querySelector('.w-5').classList.add('bg-purple-500');
                this.querySelector('.w-5').classList.remove('bg-gray-400');
                
                // Update content
                contents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                document.querySelector(`[data-locale="${locale}"].locale-content`).classList.remove('hidden');
            });
        });
    });

    function handleFileSelect(input) {
        const fileNameDiv = document.getElementById('file-name');
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            fileNameDiv.textContent = 'Selected: ' + fileName;
            fileNameDiv.classList.remove('hidden');
        } else {
            fileNameDiv.classList.add('hidden');
        }
    }
</script>
