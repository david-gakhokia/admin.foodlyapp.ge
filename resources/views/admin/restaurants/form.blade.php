@php
    $isEdit = !is_null($restaurant);
    $submitButtonText = $buttonText ?? ($isEdit ? 'განახლება' : 'რესტორნის შექმნა');
@endphp

<form action="{{ $isEdit ? route('admin.restaurants.update', $restaurant->id) : route('admin.restaurants.store') }}"
    method="POST" enctype="multipart/form-data" id="restaurant-form" class="space-y-8">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif


    <!-- Translations Section -->
    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl p-6 border border-yellow-200 section-animate">
        <div class="flex items-center mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-yellow-600 rounded-lg mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5h12M9 3v2m4 13l4-4M7.5 21L3 16.5M3 16.5L7.5 12M3 16.5h13.5" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">თარგმანები</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-{{ count($locales) }} gap-x-6 gap-y-8">
            @foreach ($locales as $locale)
                <div class="space-y-6 p-4 rounded-lg border border-yellow-200 bg-white bg-opacity-50">
                    <div class="flex items-center">
                        <span class="text-lg font-bold text-yellow-800">{{ strtoupper($locale) }}</span>
                    </div>

                    <div class="space-y-2">
                        <label for="{{ $locale }}_name" class="block text-sm font-medium text-gray-700">
                            დასახელება <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="{{ $locale }}[name]" id="{{ $locale }}_name"
                            value="{{ old($locale . '.name', $isEdit ? $restaurant->translate($locale)?->name : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                    </div>

                    <div class="space-y-2">
                        <label for="{{ $locale }}_description" class="block text-sm font-medium text-gray-700">
                            აღწერა
                        </label>
                        <textarea name="{{ $locale }}[description]" id="{{ $locale }}_description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">{{ old($locale . '.description', $isEdit ? $restaurant->translate($locale)?->description : '') }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="{{ $locale }}_address" class="block text-sm font-medium text-gray-700">
                            მისამართი
                        </label>
                        <input type="text" name="{{ $locale }}[address]" id="{{ $locale }}_address"
                            value="{{ old($locale . '.address', $isEdit ? $restaurant->translate($locale)?->address : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors duration-200">
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Basic Information Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200 section-animate">
        <div class="flex items-center mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-lg mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">ძირითადი ინფორმაცია</h3>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="space-y-2">
                <label for="status" class="block text-sm font-medium text-gray-700">
                    სტატუსი <span class="text-red-500">*</span>
                </label>
                <select name="status" id="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    required>
                    <option value="active"
                        {{ old('status', $restaurant->status ?? 'active') === 'active' ? 'selected' : '' }}>
                        აქტიური
                    </option>
                    <option value="inactive"
                        {{ old('status', $restaurant->status ?? '') === 'inactive' ? 'selected' : '' }}>
                        არააქტიური
                    </option>
                </select>
                <div class="error-message text-red-500 text-xs hidden"></div>
            </div>

            <div class="space-y-2">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-gray-400 text-xs">(auto from English name)</span></label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $restaurant->slug ?? '') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="example-restaurant-slug">
                @error('slug')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="reservation_type" class="block text-sm font-medium text-gray-700">ჯავშნის ტიპი <span class="text-red-500">*</span></label>
                <select name="reservation_type" id="reservation_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" required>
                    @php
                        use App\Helpers\ReservationTypeHelper;
                        $reservationTypes = ReservationTypeHelper::all();
                        $selectedType = old('reservation_type', $restaurant->reservation_type ?? null);
                    @endphp
                    <option value="" disabled {{ !$selectedType ? 'selected' : '' }}>აირჩიეთ ტიპი</option>
                    @foreach($reservationTypes as $type)
                        <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>{{ __($type) }}</option>
                    @endforeach
                </select>
                @error('reservation_type')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="rank" class="block text-sm font-medium text-gray-700">რანგი (სორტირება)</label>
                <input type="number" name="rank" id="rank" value="{{ old('rank', $restaurant->rank ?? 0) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="0" min="0">
                <p class="text-xs text-gray-500">დაბალი რიცხვები ზემოთ გამოჩნდება.</p>
                <div class="error-message text-red-500 text-xs hidden"></div>
            </div>

          
        </div>
    </div>




    <!-- Images Upload Section -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200 section-animate">
        <div class="flex items-center mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-purple-600 rounded-lg mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">სურათები</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Logo card -->
            <div class="relative bg-white rounded-lg border border-gray-200 p-4 flex items-center gap-4">
                <div id="logo-preview-wrapper" class="w-28 h-28 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center border border-gray-200">
                    @if ($isEdit && $restaurant->logo)
                        <img id="logo-preview" src="{{ $restaurant->logo }}" alt="Logo preview" class="w-full h-full object-cover">
                    @else
                        <div id="logo-placeholder" class="text-gray-400 text-xs">ლოგო არ არის</div>
                        <img id="logo-preview" src="" alt="Logo preview" class="w-full h-full object-cover hidden">
                    @endif
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <button type="button" id="logo-change-btn" class="px-3 py-1 bg-purple-600 text-white rounded-md text-sm hover:bg-purple-700">ჩანაცვლება</button>
                        <button type="button" id="logo-remove-btn" class="px-3 py-1 bg-red-50 text-red-600 rounded-md text-sm border border-red-100 hover:bg-red-100">წაშლა</button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, WEBP · მაქს. 0.5MB · რეკომენდირებული: 200×200px</p>
                    <div class="mt-3">
                        <input type="file" name="logo" id="logo" class="hidden" accept="image/*">
                        <input type="hidden" name="remove_logo" id="remove_logo" value="0">
                        <div id="logo-filename" class="text-xs text-gray-600 mt-1">{{ $isEdit && $restaurant->logo ? basename(parse_url($restaurant->logo, PHP_URL_PATH)) : '' }}</div>
                    </div>
                </div>
            </div>

            <!-- Main image card -->
            <div class="relative bg-white rounded-lg border border-gray-200 p-4 flex items-center gap-4">
                <div id="image-preview-wrapper" class="w-40 h-28 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center border border-gray-200">
                    @if ($isEdit && $restaurant->image)
                        <img id="image-preview" src="{{ $restaurant->image }}" alt="Image preview" class="w-full h-full object-cover">
                    @else
                        <div id="image-placeholder" class="text-gray-400 text-xs">ძირითადი სურათი არ არის</div>
                        <img id="image-preview" src="" alt="Image preview" class="w-full h-full object-cover hidden">
                    @endif
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <button type="button" id="image-change-btn" class="px-3 py-1 bg-purple-600 text-white rounded-md text-sm hover:bg-purple-700">ჩანაცვლება</button>
                        <button type="button" id="image-remove-btn" class="px-3 py-1 bg-red-50 text-red-600 rounded-md text-sm border border-red-100 hover:bg-red-100">წაშლა</button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, WEBP · მაქს. 2MB · რეკომენდირებული: 800×600px</p>
                    <div class="mt-3">
                        <input type="file" name="image" id="image" class="hidden" accept="image/*">
                        <input type="hidden" name="remove_image" id="remove_image" value="0">
                        <div id="image-filename" class="text-xs text-gray-600 mt-1">{{ $isEdit && $restaurant->image ? basename(parse_url($restaurant->image, PHP_URL_PATH)) : '' }}</div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            (function(){
                function setupPreview(inputId, previewId, placeholderId, filenameId, removeInputId, changeBtnId, removeBtnId) {
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    const placeholder = document.getElementById(placeholderId);
                    const filenameEl = document.getElementById(filenameId);
                    const removeInput = document.getElementById(removeInputId);
                    const changeBtn = document.getElementById(changeBtnId);
                    const removeBtn = document.getElementById(removeBtnId);

                    if (!input) return;

                    changeBtn && changeBtn.addEventListener('click', function(){ input.click(); });

                    input.addEventListener('change', function(e){
                        const file = input.files && input.files[0];
                        if (!file) return;
                        const reader = new FileReader();
                        reader.onload = function(evt){
                            if (preview) { preview.src = evt.target.result; preview.classList.remove('hidden'); }
                            if (placeholder) { placeholder.style.display = 'none'; }
                            if (filenameEl) filenameEl.textContent = file.name;
                            if (removeInput) removeInput.value = '0';
                        };
                        reader.readAsDataURL(file);
                    });

                    removeBtn && removeBtn.addEventListener('click', function(){
                        if (preview) { preview.src = ''; preview.classList.add('hidden'); }
                        if (placeholder) { placeholder.style.display = ''; }
                        if (input) { input.value = ''; }
                        if (filenameEl) filenameEl.textContent = '';
                        if (removeInput) removeInput.value = '1';
                    });
                }

                document.addEventListener('DOMContentLoaded', function(){
                    setupPreview('logo', 'logo-preview', 'logo-placeholder', 'logo-filename', 'remove_logo', 'logo-change-btn', 'logo-remove-btn');
                    setupPreview('image', 'image-preview', 'image-placeholder', 'image-filename', 'remove_image', 'image-change-btn', 'image-remove-btn');
                });
            })();
        </script>
    </div>

    <!-- Contact Information Section -->
    <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-xl p-6 border border-green-200 section-animate">
        <div class="flex items-center mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-green-600 rounded-lg mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">საკონტაქტო ინფორმაცია</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="space-y-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">ტელეფონი</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </div>
                    <input type="text" name="phone" id="phone"
                        value="{{ old('phone', $restaurant->phone ?? '') }}"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                        placeholder="+995 555 123 456">
                </div>
            </div>

            <div class="space-y-2">
                <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109" />
                        </svg>
                    </div>
                    <input type="text" name="whatsapp" id="whatsapp"
                        value="{{ old('whatsapp', $restaurant->whatsapp ?? '') }}"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                        placeholder="+995 555 123 456">
                </div>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">ელ-ფოსტა</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $restaurant->email ?? '') }}"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                        placeholder="info@restaurant.com">
                </div>
            </div>

            <div class="space-y-2">
                <label for="website" class="block text-sm font-medium text-gray-700">ვებსაიტი</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9m0 18v-9" />
                        </svg>
                    </div>
                    <input type="url" name="website" id="website"
                        value="{{ old('website', $restaurant->website ?? '') }}"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                        placeholder="https://restaurant.com">
                </div>
            </div>
        </div>
    </div>


    <!-- System Parameters Section -->
    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl p-6 border border-cyan-200 section-animate">
        <div class="flex items-center mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-cyan-600 rounded-lg mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">სისტემური პარამეტრები</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">დროის სარტყელი (Timezone) <span class="text-red-500">*</span></label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <select name="timezone" id="timezone" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" required>
                        @foreach(config('timezones.list') as $tzValue => $tzLabel)
                            <option value="{{ $tzValue }}" {{ old('timezone', $restaurant->timezone ?? 'Asia/Tbilisi') == $tzValue ? 'selected' : '' }}>{{ $tzLabel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="working_hours" class="block text-sm font-medium text-gray-700 mb-2">სამუშაო საათები</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <input type="text" name="working_hours" id="working_hours" value="{{ old('working_hours', $restaurant->working_hours ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="10:00-22:00">
                </div>
                <div class="text-red-500 text-xs hidden mt-1" id="error-working_hours"></div>
            </div>

            <div>
                <label for="delivery_time" class="block text-sm font-medium text-gray-700 mb-2">მიტანის დრო (წთ)</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <input type="number" name="delivery_time" id="delivery_time" value="{{ old('delivery_time', $restaurant->delivery_time ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="30" min="0">
                </div>
                <div class="text-red-500 text-xs hidden mt-1" id="error-delivery_time"></div>
            </div>

            <div class="md:col-span-2">
                <label for="map_link" class="block text-sm font-medium text-gray-700 mb-2">Google Maps ბმული</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <input type="text" name="map_link" id="map_link" value="{{ old('map_link', $restaurant->map_link ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="https://maps.google.com/...">
                </div>

            </div>

            <div>
                <label for="price_per_person" class="block text-sm font-medium text-gray-700 mb-2">ფასი ერთ ადამიანზე</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm flex gap-2 items-center">
                    <input type="number" step="0.01" min="0" name="price_per_person" id="price_per_person" value="{{ old('price_per_person', $restaurant->price_per_person ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="50">
                    <select name="price_currency" id="price_currency" class="px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200">
                        <option value="GEL" {{ old('price_currency', $restaurant->price_currency ?? 'GEL') == 'GEL' ? 'selected' : '' }}>GEL - ლარი</option>
                        <option value="USD" {{ old('price_currency', $restaurant->price_currency ?? 'USD') == 'USD' ? 'selected' : '' }}>USD - აშშ დოლარი</option>
                        <option value="EUR" {{ old('price_currency', $restaurant->price_currency ?? 'EUR') == 'EUR' ? 'selected' : '' }}>EUR - ევრო</option>
                        <option value="AED" {{ old('price_currency', $restaurant->price_currency ?? 'AED') == 'AED' ? 'selected' : '' }}>AED - არაბეთის დირჰამი</option>
                        <option value="HUF" {{ old('price_currency', $restaurant->price_currency ?? 'HUF') == 'HUF' ? 'selected' : '' }}>HUF - უნგრული ფორინტი</option>
                        <option value="CZK" {{ old('price_currency', $restaurant->price_currency ?? 'CZK') == 'CZK' ? 'selected' : '' }}>CZK - ჩეხური კრონა</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="discount_rate" class="block text-sm font-medium text-gray-700 mb-2">ფასდაკლების პროცენტი (%)</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm flex items-center gap-4">
                    <input type="number" name="discount_rate" id="discount_rate" value="{{ old('discount_rate', $restaurant->discount_rate ?? 0) }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="0" min="0" max="100">
                    <div class="text-gray-500 text-sm">%</div>
                </div>
                <p class="text-xs text-gray-500 mt-2">ფასდაკლების პროცენტი (0-100).</p>
                <div class="text-red-500 text-xs hidden mt-1" id="error-discount_rate"></div>
            </div>

            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $restaurant->latitude ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="41.7151">
                </div>
            </div>

            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $restaurant->longitude ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="44.8271">
                </div>
            </div>

            <div class="md:col-span-3">
                <label for="map_embed_link" class="block text-sm font-medium text-gray-700 mb-2">Google Maps Embed Link</label>
                <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-sm">
                    <input type="text" name="map_embed_link" id="map_embed_link" value="{{ old('map_embed_link', $restaurant->map_embed_link ?? '') }}" class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition-colors duration-200" placeholder="<iframe ...></iframe>">
                </div>
            </div>
        </div>
    </div>

    <!-- Discount Rate moved into System Parameters -->



    <!-- Submit Button -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
        <div class="flex gap-3 w-full sm:w-auto">
            <a href="{{ route('admin.restaurants.index') }}"
                class="flex-1 sm:flex-initial inline-flex justify-center items-center px-6 py-2.5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg font-medium text-sm transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                გაუქმება
            </a>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <button type="submit" id="submit-btn"
                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-lg shadow-lg transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                <svg class="w-5 h-5 mr-2" id="submit-icon" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span id="submit-text">{{ $submitButtonText }}</span>
                <svg class="w-5 h-5 ml-2 animate-spin hidden" id="loading-spinner" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>
        </div>

</form>
