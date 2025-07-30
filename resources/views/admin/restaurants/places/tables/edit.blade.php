<x-layouts.app :title="'მაგიდის რედაქტირება - ' . ($table->translations->where('locale', 'ka')->first()?->name ?? 'უცნობი მაგიდა')">
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
            <a href="{{ route('admin.restaurants.places.tables.show', [$restaurant, $place, $table]) }}" class="hover:text-blue-600 transition-colors duration-200">
                {{ $table->translations->where('locale', 'ka')->first()?->name ?? $table->translations->where('locale', 'en')->first()?->name ?? 'უცნობი მაგიდა' }}
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium">რედაქტირება</span>
        </nav>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </div>
            მაგიდის რედაქტირება
        </h1>
        <p class="text-gray-600 mt-2">
            ადგილი: <span class="font-semibold">{{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}</span> | 
            რესტორანი: <span class="font-semibold">{{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->translations->where('locale', 'en')->first()?->name ?? 'უცნობი რესტორანი' }}</span>
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.restaurants.places.tables.update', [$restaurant, $place, $table]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Form Header -->
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    მაგიდის ინფორმაცია
                </h2>
                <p class="text-gray-600 mt-1">განაახლეთ მაგიდის მონაცემები</p>
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
                                   value="{{ old('translations.' . $locale . '.name', $table->translateOrNew($locale)->name) }}"
                                   placeholder="{{ $localePlaceholders[$locale] ?? '' }}"
                                   @if(in_array($locale, ['ka', 'en'])) required @endif
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('translations.' . $locale . '.name') border-red-500 @enderror">
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
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none @error('translations.' . $locale . '.description') border-red-500 @enderror">{{ old('translations.' . $locale . '.description', $table->translateOrNew($locale)->description) }}</textarea>
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
                               value="{{ old('seats', $table->seats) }}"
                               min="1"
                               max="50"
                               placeholder="მაგ: 4"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('seats') border-red-500 @enderror">
                        @error('seats')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            სტატუსი <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('status') border-red-500 @enderror">
                            <option value="true" {{ old('status', $table->status) == true ? 'selected' : '' }}>აქტიური</option>
                            <option value="false" {{ old('status', $table->status) == false ? 'selected' : '' }}>არააქტიური</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Image Display -->
                @if($table->image)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-4">მიმდინარე სურათი</label>
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200">
                            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6">
                                <div class="relative group">
                                    <img src="{{ Storage::url($table->image) }}" 
                                         alt="Table Image" 
                                         class="w-48 h-48 object-cover rounded-xl border-2 border-white shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-xl transition-all duration-300"></div>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-lg font-semibold text-gray-900">არსებული სურათი</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-blue-100">
                                        <p class="text-sm text-gray-600 mb-2">
                                            <span class="font-medium">ფაილის ზომა:</span> 
                                            <span class="text-gray-500">{{ number_format(Storage::size($table->image) / 1024, 2) }} KB</span>
                                        </p>
                                        <p class="text-sm text-gray-600 mb-3">
                                            <span class="font-medium">ატვირთვის თარიღი:</span> 
                                            <span class="text-gray-500">{{ $table->updated_at->format('d/m/Y H:i') }}</span>
                                        </p>
                                        <div class="flex items-center space-x-2 text-sm text-amber-600 bg-amber-50 px-3 py-2 rounded-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                            <span>ახალი სურათის ატვირთვა შეცვლის მიმდინარე სურათს</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">
                        {{ $table->image ? 'ახალი სურათი' : 'მაგიდის სურათი' }}
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200">
                        <input type="file" 
                               name="image" 
                               id="image-upload"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        
                        <div id="upload-area" class="space-y-4">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <button type="button" 
                                        onclick="document.getElementById('image-upload').click()"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-medium transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    {{ $table->image ? 'ახალი სურათის ატვირთვა' : 'სურათის ატვირთვა' }}
                                </button>
                                <p class="text-sm text-gray-500 mt-3">PNG, JPG, GIF ფაილები - მაქს. 10MB</p>
                                @if($table->image)
                                    <p class="text-xs text-blue-600 mt-1 font-medium">ეს შეცვლის მიმდინარე სურათს</p>
                                @endif
                            </div>
                        </div>

                        <div id="preview-area" class="hidden">
                            <div class="relative inline-block">
                                <img id="preview-image" class="max-w-xs max-h-64 mx-auto rounded-xl shadow-lg border-2 border-white">
                                <div class="absolute -top-2 -right-2">
                                    <button type="button" 
                                            onclick="removePreview()"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full text-sm font-medium transition-colors duration-200 shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 bg-green-50 p-3 rounded-lg border border-green-200">
                                <div class="flex items-center justify-center space-x-2 text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium">ახალი სურათი მზადაა ატვირთვისთვის</span>
                                </div>
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
                            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        ცვლილებების შენახვა
                    </button>
                    
                    <a href="{{ route('admin.restaurants.places.tables.show', [$restaurant, $place, $table]) }}" 
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
