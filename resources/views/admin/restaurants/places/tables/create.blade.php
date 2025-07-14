<x-layouts.app :title="'ახალი მაგიდა - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? 'უცნობი ადგილი')">
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
            <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" class="hover:text-blue-600 transition-colors duration-200">
                მაგიდები
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium">ახალი მაგიდა</span>
        </nav>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            ახალი მაგიდის შექმნა
        </h1>
        <p class="text-gray-600 mt-2">
            ადგილი: <span class="font-semibold">{{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}</span> | 
            რესტორანი: <span class="font-semibold">{{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->translations->where('locale', 'en')->first()?->name ?? 'უცნობი რესტორანი' }}</span>
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.restaurants.places.tables.store', [$restaurant, $place]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Form Header -->
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    მაგიდის ინფორმაცია
                </h2>
                <p class="text-gray-600 mt-1">შეავსეთ მაგიდის მონაცემები</p>
            </div>

            <div class="px-8 pb-8 space-y-8">
                <!-- Basic Information -->
                @php
                    $locales = config('translatable.locales');
                    $localeNames = [
                        'ka' => 'ქართული',
                        'en' => 'ინგლისური', 
                        'ru' => 'რუსული'
                    ];
                    $localePlaceholders = [
                        'ka' => 'მაგ: VIP მაგიდა #1',
                        'en' => 'e.g. VIP Table #1',
                        'ru' => 'напр: VIP Стол #1'
                    ];
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-{{ count($locales) > 2 ? '3' : '2' }} gap-8">
                    @foreach($locales as $locale)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                დასახელება ({{ $localeNames[$locale] ?? $locale }}) 
                                @if(in_array($locale, ['ka', 'en']))
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>
                            <input type="text" 
                                   name="translations[{{ $locale }}][name]" 
                                   value="{{ old('translations.' . $locale . '.name') }}"
                                   placeholder="{{ $localePlaceholders[$locale] ?? '' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('translations.' . $locale . '.name') border-red-500 @enderror">
                            @error('translations.' . $locale . '.name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Descriptions -->
                @php
                    $descriptionPlaceholders = [
                        'ka' => 'მაგიდის დეტალური აღწერა...',
                        'en' => 'Detailed table description...',
                        'ru' => 'Подробное описание стола...'
                    ];
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-{{ count($locales) > 2 ? '3' : '2' }} gap-8">
                    @foreach($locales as $locale)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                აღწერა ({{ $localeNames[$locale] ?? $locale }})
                            </label>
                            <textarea name="translations[{{ $locale }}][description]" 
                                      rows="4"
                                      placeholder="{{ $descriptionPlaceholders[$locale] ?? '' }}"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 resize-none @error('translations.' . $locale . '.description') border-red-500 @enderror">{{ old('translations.' . $locale . '.description') }}</textarea>
                            @error('translations.' . $locale . '.description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Table Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Seats (Main capacity field) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ადგილების რაოდენობა <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="seats" 
                               value="{{ old('seats') }}"
                               min="1"
                               max="50"
                               placeholder="მაგ: 4"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('seats') border-red-500 @enderror">
                        @error('seats')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            სტატუსი <span class="text-red-500">*</span>
                        </label>
                        <select name="status" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>აქტიური</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>არააქტიური</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">მაგიდის სურათი</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-green-400 transition-colors duration-200">
                        <input type="file" 
                               name="image" 
                               id="image-upload"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        
                        <div id="upload-area" class="space-y-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <button type="button" 
                                        onclick="document.getElementById('image-upload').click()"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    სურათის ატვირთვა
                                </button>
                                <p class="text-sm text-gray-500 mt-2">PNG, JPG, GIF ფაილები - მაქს. 10MB</p>
                            </div>
                        </div>

                        <div id="preview-area" class="hidden">
                            <img id="preview-image" class="max-w-xs max-h-64 mx-auto rounded-lg shadow-lg">
                            <div class="mt-4">
                                <button type="button" 
                                        onclick="removePreview()"
                                        class="inline-flex items-center px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-sm font-medium transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    წაშლა
                                </button>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        მაგიდის შექმნა
                    </button>
                    
                    <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" 
                       class="inline-flex items-center justify-center px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        გაუქმება
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('upload-area').classList.add('hidden');
                    document.getElementById('preview-area').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function removePreview() {
            document.getElementById('image-upload').value = '';
            document.getElementById('upload-area').classList.remove('hidden');
            document.getElementById('preview-area').classList.add('hidden');
        }
    </script>
</x-layouts.app>
