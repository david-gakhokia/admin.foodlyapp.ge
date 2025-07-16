<x-layouts.app :title="'ქვეკატეგორიის შექმნა - ' . $parent->name . ' - ' . $restaurant->name"> 
    
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
            ქვეკატეგორიის შექმნა - {{ $parent->name }} - {{ $restaurant->name }}
        </h1>
        <a href="{{ route('admin.restaurants.menu.categories.children', [$restaurant, $parent]) }}"
           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 border border-transparent rounded-lg font-semibold text-sm transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            ქვეკატეგორიებზე დაბრუნება
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm dark:bg-red-900 dark:text-red-200 dark:border-red-700" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="h-6 w-6 text-red-500 dark:text-red-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-red-800 dark:text-red-100">There were some problems with your input:</p>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-200">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.restaurants.menu.categories.children.store', [$restaurant, $parent]) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Parent Info Display --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        მშობელი კატეგორია
                    </h2>
                    <p class="text-emerald-100 mt-2">{{ $parent->name }}</p>
                </div>
            </div>

            {{-- Main Form --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        ქვეკატეგორიის ინფორმაცია
                    </h2>
                    <p class="text-blue-100 mt-2">შეავსეთ ქვეკატეგორიის დეტალები</p>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Georgian Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                სახელი (ქართული) *
                            </label>
                            <input type="text" 
                                   name="name_ka" 
                                   value="{{ old('name_ka') }}" 
                                   required
                                   class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">
                            @error('name_ka')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- English Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                სახელი (ინგლისური) *
                            </label>
                            <input type="text" 
                                   name="name_en" 
                                   value="{{ old('name_en') }}" 
                                   required
                                   class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">
                            @error('name_en')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Georgian Description --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                აღწერა (ქართული)
                            </label>
                            <textarea name="description_ka" 
                                      rows="4"
                                      class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">{{ old('description_ka') }}</textarea>
                            @error('description_ka')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- English Description --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                აღწერა (ინგლისური)
                            </label>
                            <textarea name="description_en" 
                                      rows="4"
                                      class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                სტატუსი *
                            </label>
                            <select name="status" 
                                    required
                                    class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>აქტიური</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>არააქტიური</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Image Upload --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                სურათი
                            </label>
                            <input type="file" 
                                   name="image" 
                                   accept="image/*"
                                   class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">
                            @error('image')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <button type="submit"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-xl font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg id="save-icon" class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <svg id="loading-spinner" class="hidden w-6 h-6 mr-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span id="button-text">ქვეკატეგორიის შექმნა</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                const button = form.querySelector('button[type="submit"]');
                const buttonText = button.querySelector('#button-text');
                const spinner = button.querySelector('#loading-spinner');
                const saveIcon = button.querySelector('#save-icon');

                form.addEventListener('submit', function() {
                    button.disabled = true;
                    button.classList.add('opacity-75', 'cursor-not-allowed');
                    
                    if (buttonText) buttonText.textContent = 'იქმნება...';
                    if (saveIcon) saveIcon.style.display = 'none';
                    if (spinner) spinner.style.display = 'block';
                });
            });
        </script>
    @endpush

</x-layouts.app>
