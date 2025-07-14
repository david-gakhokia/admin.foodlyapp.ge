<!-- Error Messages -->
@if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">შეცდომები:</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Restaurant Selection -->
    <div class="md:col-span-2">
        <label for="restaurant_id" class="block text-sm font-medium text-gray-700 mb-2">
            რესტორანი *
        </label>
        <select name="restaurant_id" id="restaurant_id" required
            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">აირჩიეთ რესტორანი</option>
            @foreach ($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" @if (old('restaurant_id', $selectedRestaurant ?? $place?->restaurant_id) == $restaurant->id) selected @endif>
                    {{ $restaurant->translate('ka')->name ?? ($restaurant->translate('en')->name ?? 'Restaurant #' . $restaurant->id) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Name Fields -->
    @foreach (config('translatable.locales') as $locale)
        <div>
            <label for="{{ $locale }}_name" class="block text-sm font-medium text-gray-700 mb-2">
                ადგილის დასახელება ({{ strtoupper($locale) }})
                @if ($locale === config('app.locale')) * @endif
            </label>
            <input type="text" name="{{ $locale }}[name]" id="{{ $locale }}_name"
                value="{{ old($locale . '.name', $place?->translate($locale)?->name) }}"
                @if ($locale === config('app.locale')) required @endif
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter place name in {{ strtoupper($locale) }}">
        </div>
    @endforeach

    <!-- Rank -->
    <div>
        <label for="rank" class="block text-sm font-medium text-gray-700 mb-2">
            რანგი
        </label>
        <input type="number" name="rank" id="rank" min="0" value="{{ old('rank', $place?->rank ?? 0) }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="0">
    </div>

    <!-- Status -->
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
            სტატუსი *
        </label>
        <select name="status" id="status" required
            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="active" @if (old('status', $place?->status ?? 'active') === 'active') selected @endif>აქტიური</option>
            <option value="inactive" @if (old('status', $place?->status ?? 'active') === 'inactive') selected @endif>არააქტიური</option>
        </select>
    </div>

    <!-- Image Upload/Link Section -->
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-3">
            სურათი
        </label>

        <!-- Image Upload Options -->
        <div class="space-y-4">
            <!-- Option Toggle -->
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="image_type" value="upload" id="image_type_upload"
                        class="form-radio text-blue-600" checked>
                    <span class="ml-2 text-sm text-gray-700">ფაილის ატვირთვა</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="image_type" value="link" id="image_type_link"
                        class="form-radio text-blue-600" @if (old('image_link', $place?->image_link)) checked @endif>
                    <span class="ml-2 text-sm text-gray-700">ლინკის მითითება</span>
                </label>
            </div>

            <!-- File Upload Section -->
            <div id="upload_section" class="@if (old('image_link', $place?->image_link)) hidden @endif">
                <div
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image_file"
                                class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>აირჩიეთ ფაილი</span>
                                <input id="image_file" name="image_file" type="file" class="sr-only"
                                    accept="image/*">
                            </label>
                            <p class="pl-1">ან გადმოიტანეთ აქ</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, WEBP მდე 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Link Input Section -->
            <div id="link_section" class="@if (!old('image_link', $place?->image_link)) hidden @endif">
                <input type="url" name="image_link" id="image_link"
                    value="{{ old('image_link', $place?->image_link) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="https://example.com/image.jpg">
            </div>
        </div>
    </div>

    <!-- Description Fields -->
    @foreach (config('translatable.locales') as $locale)
        <div>
            <label for="{{ $locale }}_description" class="block text-sm font-medium text-gray-700 mb-2">
                აღწერა ({{ strtoupper($locale) }})
            </label>
            <textarea name="{{ $locale }}[description]" id="{{ $locale }}_description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter place description in {{ strtoupper($locale) }}...">{{ old($locale . '.description', $place?->translate($locale)?->description) }}</textarea>
        </div>
    @endforeach
</div>

<!-- Image Preview -->
@if ($place?->image_link || old('image_link'))
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">სურათის გადახედვა</label>
        <div class="max-w-xs">
            <div class="relative">
                <img src="{{ old('image_link', $place?->image_link) }}" alt="Place Image"
                    class="w-full h-48 object-cover rounded-lg border border-gray-200">

                {{-- @if ($place?->image_link && !old('image_link'))
                    <form action="{{ route('admin.places.delete-image', $place) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('დარწმუნებული ხართ რომ გსურთ სურათის წაშლა?')"
                                class="bg-red-500 hover:bg-red-600 text-white rounded-full p-2 shadow-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                @endif --}}
            </div>
        </div>
    </div>
@endif

<!-- QR Code Preview (Only for Edit) -->
@if (isset($place) && $place?->qr_code_image)
    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">QR კოდი</label>
        <div class="bg-gray-50 rounded-lg p-4 border-2 border-dashed border-gray-200">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="bg-white border border-gray-200 rounded-lg p-2">
                        <img src="{{ $place->qr_code_image }}" alt="QR კოდი" class="w-20 h-20 object-contain">
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">ავტომატურად გენერირებული QR კოდი</h4>
                    <p class="text-sm text-gray-600 mb-3">ეს QR კოდი ავტომატურად დაგენერირდა ამ ადგილისთვის და მიუთითებს:</p>
                    @if($place->qr_code_link)
                        <p class="text-xs text-gray-500 font-mono bg-white px-2 py-1 rounded border break-all">{{ $place->qr_code_link }}</p>
                    @endif
                    <div class="mt-3 flex space-x-2">
                        <a href="{{ $place->qr_code_image }}" target="_blank" 
                           class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            ჩამოტვირთვა
                        </a>
                        @if($place->qr_code_link)
                            <a href="{{ $place->qr_code_link }}" target="_blank" 
                               class="inline-flex items-center px-3 py-1.5 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                ლინკზე გადასვლა
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-3 bg-blue-50 border border-blue-200 rounded-md p-3">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-2">
                        <p class="text-xs text-blue-800">QR კოდი ავტომატურად განახლდება თუ შეცვლით ადგილის სახელს ან slug-ს.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif (!isset($place))
    <div class="mt-6">
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">QR კოდი ავტომატურად დაგენერირდება</h3>
                    <div class="mt-1 text-sm text-green-700">
                        <p>ადგილის შექმნის შემდეგ ავტომატურად დაგენერირდება QR კოდი, რომელიც მომხმარებლებს საშუალებას მისცემს სწრაფად მოძებნონ ეს ადგილი.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadRadio = document.getElementById('image_type_upload');
        const linkRadio = document.getElementById('image_type_link');
        const uploadSection = document.getElementById('upload_section');
        const linkSection = document.getElementById('link_section');
        const imageFileInput = document.getElementById('image_file');
        const imageLinkInput = document.getElementById('image_link');

        // Form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                let hasErrors = false;
                const errorMessages = [];
                const defaultLocale = '{{ config("app.locale") }}'; // Gets the default locale from config

                // Check if default locale name is filled (required)
                const defaultName = document.getElementById(defaultLocale + '_name');
                if (defaultName && !defaultName.value.trim()) {
                    hasErrors = true;
                    errorMessages.push(`${defaultLocale.toUpperCase()} name is required (default language)`);
                    defaultName.style.borderColor = '#ef4444';
                } else if (defaultName) {
                    defaultName.style.borderColor = '';
                }

                // For other locales, only validate if they have content (not required but if filled, cannot be empty)
                @foreach (config('translatable.locales') as $locale)
                    @if ($locale !== config('app.locale'))
                        const {{ $locale }}Name = document.getElementById('{{ $locale }}_name');
                        if ({{ $locale }}Name && {{ $locale }}Name.value.trim() === '') {
                            // Check if there was an original value or if user started typing
                            const originalValue = '{{ old($locale . ".name", $place?->translate($locale)?->name ?? "") }}';
                            if (originalValue.trim() !== '') {
                                hasErrors = true;
                                errorMessages.push('{{ strtoupper($locale) }} name cannot be empty if it was previously filled');
                                {{ $locale }}Name.style.borderColor = '#ef4444';
                            } else {
                                {{ $locale }}Name.style.borderColor = '';
                            }
                        } else if ({{ $locale }}Name) {
                            {{ $locale }}Name.style.borderColor = '';
                        }
                    @endif
                @endforeach

                if (hasErrors) {
                    e.preventDefault();
                    alert('Please fix the following errors:\n\n' + errorMessages.join('\n'));
                    return false;
                }
            });
        }

        // Toggle between upload and link sections
        function toggleImageSections() {
            if (uploadRadio.checked) {
                uploadSection.classList.remove('hidden');
                linkSection.classList.add('hidden');
                imageLinkInput.value = '';
            } else {
                uploadSection.classList.add('hidden');
                linkSection.classList.remove('hidden');
                imageFileInput.value = '';
            }
            updatePreview();
        }

        uploadRadio.addEventListener('change', toggleImageSections);
        linkRadio.addEventListener('change', toggleImageSections);

        // File upload preview
        imageFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showPreview(e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                hidePreview();
            }
        });

        // URL input preview
        imageLinkInput.addEventListener('input', function(e) {
            const url = e.target.value;
            if (url && url.match(/\.(jpeg|jpg|gif|png|webp)$/i)) {
                showPreview(url);
            } else {
                hidePreview();
            }
        });

        function showPreview(src) {
            let preview = document.getElementById('image-preview-container');

            if (!preview) {
                // Create preview container
                preview = document.createElement('div');
                preview.id = 'image-preview-container';
                preview.className = 'mt-6';
                preview.innerHTML = `
                <label class="block text-sm font-medium text-gray-700 mb-2">სურათის გადახედვა</label>
                <div class="max-w-xs relative">
                    <img id="image-preview" class="w-full h-48 object-cover rounded-lg border border-gray-200 shadow-sm">
                    <button type="button" id="remove-preview" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;

                // Insert before the script tag
                const form = document.querySelector('form');
                const lastChild = form.lastElementChild;
                form.insertBefore(preview, lastChild);

                // Add remove functionality
                document.getElementById('remove-preview').addEventListener('click', function() {
                    imageFileInput.value = '';
                    imageLinkInput.value = '';
                    hidePreview();
                });
            }

            document.getElementById('image-preview').src = src;
        }

        function hidePreview() {
            const preview = document.getElementById('image-preview-container');
            if (preview) {
                preview.remove();
            }
        }

        function updatePreview() {
            if (uploadRadio.checked && imageFileInput.files[0]) {
                const file = imageFileInput.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    showPreview(e.target.result);
                };
                reader.readAsDataURL(file);
            } else if (linkRadio.checked && imageLinkInput.value) {
                showPreview(imageLinkInput.value);
            } else {
                hidePreview();
            }
        }

        // Initialize preview if there's existing data
        updatePreview();
    });
</script>
