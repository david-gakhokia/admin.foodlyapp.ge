@props(['city' => null, 'locales' => config('translatable.locales')])

<div class="p-8">
    <!-- Form Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">City Information</h2>
        <p class="text-gray-600">Fill in the details below to
            {{ isset($city) && $city->exists ? 'update the' : 'create a new' }} city.</p>
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
                            <div
                                class="w-5 h-5 rounded-full @if ($loop->first) bg-purple-500 @else bg-gray-400 @endif flex items-center justify-center">
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
            <div class="locale-content space-y-6 @if (!$loop->first) hidden @endif"
                data-locale="{{ $locale }}">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Name ({{ strtoupper($locale) }})
                            @if ($locale === config('app.locale'))
                                <span class="text-red-500">*</span>
                            @else
                                <span class="text-gray-400">(optional)</span>
                            @endif
                        </label>
                        <input type="text" name="{{ $locale }}[name]"
                            value="{{ old($locale . '.name', isset($city) ? $city->translate($locale)?->name : '') }}"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Enter city name in {{ strtoupper($locale) }}">
                        @error($locale . '.name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Description ({{ strtoupper($locale) }})
                        </label>
                        <textarea name="{{ $locale }}[description]" rows="4"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Enter city description in {{ strtoupper($locale) }}">{{ old($locale . '.description', isset($city) ? $city->translate($locale)?->description : '') }}</textarea>
                        @error($locale . '.description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Meta Title ({{ strtoupper($locale) }})
                        </label>
                        <input type="text" name="{{ $locale }}[meta_title]"
                            value="{{ old($locale . '.meta_title', isset($city) ? $city->translate($locale)?->meta_title : '') }}"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Meta title for SEO">
                        @error($locale . '.meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Meta Description ({{ strtoupper($locale) }})
                        </label>
                        <textarea name="{{ $locale }}[meta_description]" rows="2"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Meta description for SEO">{{ old($locale . '.meta_description', isset($city) ? $city->translate($locale)?->meta_description : '') }}</textarea>
                        @error($locale . '.meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Meta Keywords ({{ strtoupper($locale) }})
                        </label>
                        <input type="text" name="{{ $locale }}[meta_keywords]"
                            value="{{ old($locale . '.meta_keywords', isset($city) ? $city->translate($locale)?->meta_keywords : '') }}"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                            placeholder="Comma separated keywords">
                        @error($locale . '.meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- City Settings -->
    <div class="border-t border-gray-200 pt-8 mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Slug
                    <span class="text-gray-400">(optional)</span>
                </label>
                <input type="text" name="slug" value="{{ old('slug', isset($city) ? $city->slug : '') }}"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                    placeholder="e.g., tbilisi, batumi">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Will be auto-generated from name if left empty</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status
                    <span class="text-red-500">*</span>
                </label>
                <select name="status"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3">
                    @foreach (\App\Models\City::getStatuses() as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', isset($city) ? $city->status : 'active') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rank" class="block text-sm font-semibold text-gray-700 mb-2">
                    Display Order (Rank)
                </label>
                <input type="number" name="rank" id="rank"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                    value="{{ old('rank', isset($city) ? $city->rank : '') }}" min="0" step="1"
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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- File Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ isset($city) && !empty($city->image) ? 'Replace Image' : 'Upload Image' }}
                </label>
                <input type="file" name="image_file" accept="image/*"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3">
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
                    value="{{ old('image_link', isset($city) ? $city->image_link : '') }}"
                    class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20 transition-all duration-200 text-sm bg-gray-50 focus:bg-white px-4 py-3"
                    placeholder="https://example.com/image.jpg">
                @error('image_link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Provide an external image URL if you prefer not to upload a file
                </p>
            </div>

            @if (isset($city) && !empty($city->image))
                <div class="mt-4 flex items-center gap-4">
                    <img src="{{ $city->image }}" alt="City Image" class="w-32 h-24 object-cover rounded-xl border">
                    <!-- სურათის წაშლის ფორმა ცალკე -->
                </div>
            @endif
        </div>
    </div>

    <!-- Submit Button -->
    <div class="border-t border-gray-200 pt-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.cities.index') }}"
                class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-purple-600 to-violet-600 hover:from-purple-700 hover:to-violet-700 text-white rounded-xl font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                {{ isset($city) && $city->exists ? 'Update City' : 'Create City' }}
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
                tab.classList.remove('border-purple-500', 'text-purple-600', 'bg-purple-50');
                tab.classList.add('border-transparent', 'text-gray-500');
                tab.querySelector('div > div').classList.remove('bg-purple-500');
                tab.querySelector('div > div').classList.add('bg-gray-400');
            });

            btn.classList.remove('border-transparent', 'text-gray-500');
            btn.classList.add('border-purple-500', 'text-purple-600', 'bg-purple-50');
            btn.querySelector('div > div').classList.remove('bg-gray-400');
            btn.querySelector('div > div').classList.add('bg-purple-500');

            // Update content visibility
            document.querySelectorAll('.locale-content').forEach(content => {
                content.classList.add('hidden');
                if (content.getAttribute('data-locale') === locale) {
                    content.classList.remove('hidden');
                }
            });
        });
    });
</script>
