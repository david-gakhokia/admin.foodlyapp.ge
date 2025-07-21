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
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5h12M9 3v2m4 13l4-4M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5"></path>
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

            @if ($isEdit && $restaurant->logo)
                <div class="mb-4">
                    <div class="relative inline-block">
                        <img src="{{ $restaurant->logo }}" alt="Current Logo"
                            class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                        <div class="absolute -top-2 -right-2 bg-green-100 text-green-600 rounded-full p-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
                <div class="flex items-center justify-center w-full">
                    <label for="logo"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">ლოგოს ატვირთვა</span>
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP მაქს. 0.5MB</p>
                        </div>
                        <input type="file" name="logo" id="logo" class="hidden" accept="image/*">
                    </label>
                </div>
                <p class="text-xs text-gray-500">რეკომენდირებული: 200x200px.</p>
            </div>

            <div class="space-y-4">
                <label for="image" class="block text-sm font-medium text-gray-700">ძირითადი სურათი</label>
                @if ($isEdit && $restaurant->image)
                    <div class="mb-4">
                        <div class="relative inline-block">
                            <img src="{{ $restaurant->image }}" alt="Current Image"
                                class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                            <div class="absolute -top-2 -right-2 bg-green-100 text-green-600 rounded-full p-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex items-center justify-center w-full">
                    <label for="image"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">სურათის ატვირთვა</span>
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP მაქს. 2MB</p>
                        </div>
                        <input type="file" name="image" id="image" class="hidden" accept="image/*">
                    </label>
                </div>
                <p class="text-xs text-gray-500">რეკომენდირებული: 800x600px.</p>
            </div>
        </div>
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="timezone" class="block text-sm font-medium text-gray-700">დროის სარტყელი (Timezone) <span class="text-red-500">*</span></label>
                <select name="timezone" id="timezone" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" required>
                    @foreach(config('timezones.list') as $tzValue => $tzLabel)
                        <option value="{{ $tzValue }}" {{ old('timezone', $restaurant->timezone ?? 'Asia/Tbilisi') == $tzValue ? 'selected' : '' }}>{{ $tzLabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label for="working_hours" class="block text-sm font-medium text-gray-700">სამუშაო საათები</label>
                <input type="text" name="working_hours" id="working_hours" value="{{ old('working_hours', $restaurant->working_hours ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="10:00-22:00">
            </div>
            <div class="space-y-2">
                <label for="delivery_time" class="block text-sm font-medium text-gray-700">მიტანის დრო (წთ)</label>
                <input type="text" name="delivery_time" id="delivery_time" value="{{ old('delivery_time', $restaurant->delivery_time ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="30">
            </div>
            <div class="space-y-2">
                <!-- დინამიური reservation_type select უკვე ზემოთაა განთავსებული -->
            </div>
            <div class="space-y-2">
                <label for="price_per_person" class="block text-sm font-medium text-gray-700">ფასი ერთ ადამიანზე</label>
                <div class="flex gap-2">
                    <input type="number" step="0.01" min="0" name="price_per_person" id="price_per_person" value="{{ old('price_per_person', $restaurant->price_per_person ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="50">
                    <select name="price_currency" id="price_currency" class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200">
                        <option value="GEL" {{ old('price_currency', $restaurant->price_currency ?? 'GEL') == 'GEL' ? 'selected' : '' }}>GEL - ლარი</option>
                        <option value="USD" {{ old('price_currency', $restaurant->price_currency ?? 'USD') == 'USD' ? 'selected' : '' }}>USD - აშშ დოლარი</option>
                        <option value="EUR" {{ old('price_currency', $restaurant->price_currency ?? 'EUR') == 'EUR' ? 'selected' : '' }}>EUR - ევრო</option>
                        <option value="AED" {{ old('price_currency', $restaurant->price_currency ?? 'AED') == 'AED' ? 'selected' : '' }}>AED - არაბეთის დირჰამი</option>
                        <option value="HUF" {{ old('price_currency', $restaurant->price_currency ?? 'HUF') == 'HUF' ? 'selected' : '' }}>HUF - უნგრული ფორინტი</option>
                        <option value="CZK" {{ old('price_currency', $restaurant->price_currency ?? 'CZK') == 'CZK' ? 'selected' : '' }}>CZK - ჩეხური კრონა</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label for="map_link" class="block text-sm font-medium text-gray-700">Google Maps ბმული</label>
                <input type="text" name="map_link" id="map_link" value="{{ old('map_link', $restaurant->map_link ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="https://maps.google.com/...">
            </div>
            <div class="space-y-2">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $restaurant->latitude ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="41.7151">
            </div>
            <div class="space-y-2">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $restaurant->longitude ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="44.8271">
            </div>
            <div class="space-y-2 md:col-span-2">
                <label for="map_embed_link" class="block text-sm font-medium text-gray-700">Google Maps Embed Link</label>
                <input type="text" name="map_embed_link" id="map_embed_link" value="{{ old('map_embed_link', $restaurant->map_embed_link ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200" placeholder="<iframe ...></iframe>">
            </div>
        </div>
    </div>

    <!-- Discount Rate Section -->
    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-xl p-6 border border-orange-200 section-animate">
        <div class="flex items-center mb-6">
            <div class="flex items-center justify-center w-10 h-10 bg-orange-600 rounded-lg mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">ფასდაკლება</h3>
        </div>

        <div class="space-y-2">
            <label for="discount_rate" class="block text-sm font-medium text-gray-700">ფასდაკლების პროცენტი
                (%)</label>
            <div class="relative">
                <input type="number" name="discount_rate" id="discount_rate"
                    value="{{ old('discount_rate', $restaurant->discount_rate ?? 0) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200"
                    placeholder="0" min="0" max="100">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 text-sm">%</span>
                </div>
            </div>
            <p class="text-xs text-gray-500">ფასდაკლების პროცენტი (0-100).</p>
        </div>
    </div>



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
