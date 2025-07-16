<x-layouts.app :title="$item->name . ' - ' . ($category->name ?? 'კატეგორია') . ' - ' . $restaurant->name">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        {{-- Header Section --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col gap-6">
                {{-- Breadcrumb --}}
                <nav class="flex items-center space-x-3 text-sm">
                    <a href="{{ route('admin.restaurants.show', $restaurant) }}" 
                       class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        {{ $restaurant->name }}
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" 
                       class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        მენიუს კატეგორიები
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}" 
                       class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        {{ $category->name ?? 'კატეგორია' }}
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-blue-600 font-medium">{{ $item->name }}</span>
                </nav>

                {{-- Title and Actions --}}
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="text-center sm:text-left">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            {{ $item->name }}
                        </h1>
                        <p class="text-gray-600 text-lg font-medium">{{ $category->name ?? 'კატეგორია' }} - {{ $restaurant->name }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 border border-gray-300 rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            კატეგორიაზე დაბრუნება
                        </a>
                        <a href="{{ route('admin.restaurants.menu.categories.items.edit', [$restaurant, $category, $item]) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            რედაქტირება
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Item Details --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column - Main Info --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Item Image --}}
                @if($item->image)
                    <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-96 object-cover">
                    </div>
                @endif

                {{-- Description --}}
                @if($item->description)
                    <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">აღწერა</h3>
                        <div class="prose prose-lg max-w-none text-gray-700">
                            {!! nl2br(e($item->description)) !!}
                        </div>
                    </div>
                @endif

                {{-- Ingredients & Allergens --}}
                @if($item->ingredients || $item->allergens)
                    <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @if($item->ingredients)
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-3">ინგრედიენტები</h4>
                                    <p class="text-gray-700">{{ $item->ingredients }}</p>
                                </div>
                            @endif
                            @if($item->allergens)
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-3">ალერგენები</h4>
                                    <p class="text-gray-700">{{ $item->allergens }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Column - Details --}}
            <div class="space-y-6">
                {{-- Price & Status --}}
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">ინფორმაცია</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">ფასი:</span>
                            <span class="text-2xl font-bold text-green-600">₾{{ $item->price }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">სტატუსი:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $item->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->status === 'active' ? 'აქტიური' : 'არააქტიური' }}
                            </span>
                        </div>
                        @if($item->preparation_time)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">მომზადების დრო:</span>
                                <span class="font-medium">{{ $item->preparation_time }} წუთი</span>
                            </div>
                        @endif
                        @if($item->calories)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">კალორიები:</span>
                                <span class="font-medium">{{ $item->calories }} kcal</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">რანგი:</span>
                            <span class="font-medium">#{{ $item->rank ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                {{-- Category Info --}}
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">კატეგორია</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">{{ $category->name ?? 'კატეგორია' }}</h4>
                                <p class="text-sm text-gray-600">{{ $restaurant->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">მოქმედებები</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.restaurants.menu.categories.items.edit', [$restaurant, $category, $item]) }}"
                           class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-xl font-semibold transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            რედაქტირება
                        </a>
                        <form action="{{ route('admin.restaurants.menu.categories.items.destroy', [$restaurant, $category, $item]) }}" 
                              method="POST" 
                              onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ ელემენტის წაშლა?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-semibold transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                წაშლა
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
