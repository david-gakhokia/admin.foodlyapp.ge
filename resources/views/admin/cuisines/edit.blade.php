<x-layouts.app :title="'Edit Cuisine'">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Edit Cuisine</h1>
                       
                    </div>
                    <a href="{{ route('admin.cuisines.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <form action="{{ route('admin.cuisines.update', $cuisine->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Form Header -->
                    <div class="px-8 py-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                        <div class="flex items-center">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold">Update Cuisine Information</h2>
                                <p class="text-blue-100">Modify the details for this cuisine</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="px-8 py-8">
                        
                        <!-- Basic Information Section -->
                        <div class="mb-10">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Basic Information
                            </h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                
                                <!-- Slug Field -->
                                <div class="form-group">
                                    <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                            </svg>
                                            Slug
                                        </span>
                                    </label>
                                    <input type="text" 
                                           name="slug" 
                                           id="slug" 
                                           value="{{ old('slug', $cuisine->slug) }}"
                                           placeholder="e.g., italian-cuisine"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('slug') border-red-300 @enderror" 
                                           required>
                                    @error('slug') 
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p> 
                                    @enderror
                                </div>

                                <!-- Rank -->
                                <div class="form-group">
                                    <label for="rank" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-6 5 6M7 21l5-6 5 6"></path>
                                            </svg>
                                            Display Order
                                        </span>
                                    </label>
                                    <input type="number" 
                                           name="rank" 
                                           id="rank" 
                                           value="{{ old('rank', $cuisine->rank) }}"
                                           min="0"
                                           placeholder="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('rank') border-red-300 @enderror">
                                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                                    @error('rank') 
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p> 
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Status
                                        </span>
                                    </label>
                                    <select name="status" 
                                            id="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('status') border-red-300 @enderror">
                                        <option value="active" {{ old('status', $cuisine->status) == 'active' ? 'selected' : '' }}>
                                            🟢 Active
                                        </option>
                                        <option value="inactive" {{ old('status', $cuisine->status) == 'inactive' ? 'selected' : '' }}>
                                            🔴 Inactive
                                        </option>
                                    </select>
                                    @error('status') 
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p> 
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Cuisine Image
                                        </span>
                                    </label>
                                    
                                    @if($cuisine->image)
                                        <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                            <img src="{{ $cuisine->image }}" alt="{{ $cuisine->name }}" class="h-20 w-20 object-cover rounded-lg shadow-sm">
                                        </div>
                                    @endif
                                    
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload a new file</span>
                                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                    @error('image') 
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Multilingual Content Section -->
                        <div class="border-t border-gray-200 pt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                                Multilingual Content
                            </h3>
                            
                            <div class="space-y-8">
                                @foreach ($locales as $locale)
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <h4 class="text-md font-semibold text-gray-700 mb-4 flex items-center">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full mr-3">
                                                {{ $locale === 'en' ? 'English' : ($locale === 'ka' ? 'ქართული' : strtoupper($locale)) }}
                                            </span>
                                            Content for {{ strtoupper($locale) }}
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Name -->
                                            <div class="form-group">
                                                <label for="name_{{ $locale }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Name ({{ strtoupper($locale) }})
                                                </label>
                                                <input type="text" 
                                                       name="name[{{ $locale }}]" 
                                                       id="name_{{ $locale }}"
                                                       value="{{ old('name.' . $locale, $translationData[$locale]['name'] ?? '') }}"
                                                       placeholder="{{ $locale === 'en' ? 'Enter English name' : ($locale === 'ka' ? 'შეიყვანეთ ქართული სახელი' : 'Enter name') }}"
                                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error("name.$locale") border-red-300 @enderror" 
                                                       required>
                                                @error("name.$locale") 
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $message }}
                                                    </p> 
                                                @enderror
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group">
                                                <label for="description_{{ $locale }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Description ({{ strtoupper($locale) }})
                                                </label>
                                                <textarea name="description[{{ $locale }}]" 
                                                          id="description_{{ $locale }}"
                                                          rows="3"
                                                          placeholder="{{ $locale === 'en' ? 'Enter description' : ($locale === 'ka' ? 'შეიყვანეთ აღწერა' : 'Enter description') }}"
                                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error("description.$locale") border-red-300 @enderror">{{ old('description.' . $locale, $translationData[$locale]['description'] ?? '') }}</textarea>
                                                @error("description.$locale") 
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $message }}
                                                    </p> 
                                                @enderror
                                            </div>

                                            <!-- Meta Title -->
                                            <div class="form-group">
                                                <label for="meta_title_{{ $locale }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Meta Title ({{ strtoupper($locale) }})
                                                </label>
                                                <input type="text" 
                                                       name="meta_title[{{ $locale }}]" 
                                                       id="meta_title_{{ $locale }}"
                                                       value="{{ old('meta_title.' . $locale, $translationData[$locale]['meta_title'] ?? '') }}"
                                                       placeholder="SEO Meta Title"
                                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error("meta_title.$locale") border-red-300 @enderror">
                                                @error("meta_title.$locale") 
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $message }}
                                                    </p> 
                                                @enderror
                                            </div>

                                            <!-- Meta Description -->
                                            <div class="form-group">
                                                <label for="meta_desc_{{ $locale }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Meta Description ({{ strtoupper($locale) }})
                                                </label>
                                                <textarea name="meta_desc[{{ $locale }}]" 
                                                          id="meta_desc_{{ $locale }}"
                                                          rows="3"
                                                          placeholder="SEO Meta Description"
                                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error("meta_desc.$locale") border-red-300 @enderror">{{ old('meta_desc.' . $locale, $translationData[$locale]['meta_desc'] ?? '') }}</textarea>
                                                @error("meta_desc.$locale") 
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $message }}
                                                    </p> 
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Form Footer -->
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Last updated: {{ $cuisine->updated_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.cuisines.index') }}" 
                               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Cuisine
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
