<x-layouts.app :title="'მენიუს ელემენტები - ' . ($menuCategory->translations->where('locale', 'ka')->first()?->name ?? $menuCategory->name ?? 'კატეგორია')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50">
        <!-- Modern Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-500 rounded-3xl mb-8 shadow-2xl border border-white/20">
            <!-- Geometric Background Pattern -->
            <div class="absolute inset-0 overflow-hidden opacity-10">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            </div>
            
            <!-- Floating Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-32 -right-32 w-64 h-64 bg-white/5 rounded-full animate-pulse"></div>
                <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-white/5 rounded-full animate-pulse delay-1000"></div>
                <div class="absolute top-1/3 right-1/4 w-48 h-48 bg-white/5 rounded-full animate-bounce slow"></div>
            </div>

            <!-- Content -->
            <div class="relative backdrop-blur-sm bg-black/10 px-8 py-12">
                <div class="flex flex-col lg:flex-row items-start justify-between gap-8">
                    <div class="flex items-start gap-6">
                        <!-- Category Image/Avatar -->
                        <div class="relative group">
                            @if ($menuCategory->image)
                                <img src="{{ $menuCategory->image }}" alt="კატეგორიის სურათი"
                                    class="w-28 h-28 rounded-3xl shadow-2xl object-cover bg-white/90 border-2 border-white/50 group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-28 h-28 rounded-3xl shadow-2xl flex items-center justify-center bg-white/90 border-2 border-white/50 group-hover:scale-105 transition-transform duration-300">
                                    <span class="text-5xl text-gray-700 font-bold">{{ Str::substr($menuCategory->translations->where('locale', 'ka')->first()?->name ?? 'K', 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute -bottom-2 -right-2">
                                @if ($menuCategory->status === 'active')
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-gray-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Category Info -->
                        <div class="flex-1">
                            <div class="mb-4">
                                <h1 class="text-3xl font-bold text-white mb-2">
                                    {{ $menuCategory->translations->where('locale', 'ka')->first()?->name ?? ($menuCategory->name ?? 'უცნობი კატეგორია') }}
                                </h1>
                                <p class="text-xl text-white/80 mb-2">
                                    {{ $menuCategory->translations->where('locale', 'en')->first()?->name ?? '-' }}
                                </p>
                                <div class="flex flex-wrap gap-3">
                                    <span class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white/90 border border-white/30">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        ID: {{ $menuCategory->id }}
                                    </span>
                                    @if($menuCategory->rank)
                                        <span class="inline-flex items-center px-3 py-1 bg-amber-500/30 backdrop-blur-sm rounded-full text-sm text-white/90 border border-amber-300/50">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                            რანკი: {{ $menuCategory->rank }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Breadcrumb -->
                            <div class="flex items-center mb-4">
                                <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="text-white/80 hover:text-white transition-colors duration-200">
                                    {{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->name }}
                                </a>
                                <svg class="w-4 h-4 mx-2 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" class="text-white/80 hover:text-white transition-colors duration-200">
                                    მენიუს კატეგორიები
                                </a>
                                <svg class="w-4 h-4 mx-2 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                <span class="text-white">მენიუს ელემენტები</span>
                            </div>

                            <!-- Statistics -->
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">{{ $menuCategory->menuItems->count() }}</div>
                                    <div class="text-xs text-white/70">მენიუს ელემენტები</div>
                                </div>
                                <div class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">{{ $menuCategory->menuItems->where('status', 'active')->count() }}</div>
                                    <div class="text-xs text-white/70">აქტიური</div>
                                </div>
                                <div class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">{{ $menuCategory->children->count() }}</div>
                                    <div class="text-xs text-white/70">ქვეკატეგორიები</div>
                                </div>
                                <div class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">{{ $menuCategory->rank ?? 0 }}</div>
                                    <div class="text-xs text-white/70">რანკი</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3 min-w-max">
                        <a href="{{ route('admin.restaurants.menu.categories.edit', [$restaurant, $menuCategory]) }}"
                            class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            კატეგორიის რედაქტირება
                        </a>

                        <a href="{{ route('admin.restaurants.menu.categories.items.create', [$restaurant, $menuCategory]) }}"
                            class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            ახალი ელემენტი
                        </a>

                        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}"
                            class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                            </svg>
                            უკან დაბრუნება
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subcategories Section -->
        @if ($menuCategory->children->count() > 0)
            <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">ქვეკატეგორიები</h3>
                        <p class="text-gray-600">ამ კატეგორიას აქვს {{ $menuCategory->children->count() }} ქვეკატეგორია</p>
                    </div>
                    <a href="{{ route('admin.restaurants.parent-categories', $restaurant) }}?parent={{ $menuCategory->id }}"
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        ყველას ნახვა
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($menuCategory->children->take(8) as $subcategory)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 p-4 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                            <div class="flex items-center gap-3">
                                @if ($subcategory->image)
                                    <img src="{{ $subcategory->image }}" alt="{{ $subcategory->name }}"
                                         class="w-12 h-12 rounded-xl object-cover shadow-md">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center shadow-md">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 truncate">{{ $subcategory->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $subcategory->menuItems->count() }} კერძი</p>
                                </div>
                                
                                <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $subcategory]) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                            
                            @if ($subcategory->status === 'active')
                                <div class="mt-2 inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    <div class="w-1 h-1 bg-green-500 rounded-full mr-1"></div>
                                    აქტიური
                                </div>
                            @else
                                <div class="mt-2 inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
                                    <div class="w-1 h-1 bg-gray-400 rounded-full mr-1"></div>
                                    არააქტიური
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                @if ($menuCategory->children->count() > 8)
                    <div class="mt-6 text-center">
                        <a href="{{ route('admin.restaurants.parent-categories', $restaurant) }}?parent={{ $menuCategory->id }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            ყველა {{ $menuCategory->children->count() }} ქვეკატეგორიის ნახვა
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <!-- Menu Items Section -->
        <div class="space-y-8">
            @if ($menuCategory->menuItems->count() > 0)
                <!-- Filters and Search -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-6">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">მენიუს ელემენტები</h3>
                            <p class="text-sm text-gray-600">სულ {{ $menuCategory->menuItems->count() }} ელემენტი</p>
                        </div>
                        <div class="flex gap-3">
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">ყველა სტატუსი</option>
                                <option value="active">აქტიური</option>
                                <option value="inactive">არააქტიური</option>
                            </select>
                            <input type="text" placeholder="ძიება..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>
                </div>

                <!-- Menu Items Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
                    @foreach ($menuCategory->menuItems as $item)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 overflow-hidden border border-gray-100">
                            {{-- Item Image --}}
                            <div class="relative h-48 bg-gradient-to-br from-orange-50 to-amber-100 overflow-hidden">
                                @if ($item->image)
                                    <img src="{{ $item->image }}" 
                                         alt="{{ $item->translations->where('locale', 'ka')->first()?->name ?? 'Menu Item' }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Status Badge --}}
                                <div class="absolute top-3 right-3">
                                    @if ($item->status === 'active')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 shadow-sm">
                                            <div class="w-1 h-1 bg-green-500 rounded-full mr-1"></div>
                                            აქტიური
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600 shadow-sm">
                                            <div class="w-1 h-1 bg-gray-400 rounded-full mr-1"></div>
                                            არააქტიური
                                        </span>
                                    @endif
                                </div>

                                {{-- Price Badge --}}
                                @if($item->price)
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full bg-white/90 text-gray-700 shadow-sm backdrop-blur-sm">
                                            {{ number_format($item->price, 2) }} ₾
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Card Content --}}
                            <div class="p-4">
                                {{-- Item Name --}}
                                <h4 class="text-lg font-bold mb-2 line-clamp-2 text-gray-900">
                                    @php $itemTranslation = $item->translations->where('locale', 'ka')->first(); @endphp
                                    {{ $itemTranslation?->name ?? ($item->translations->first()?->name ?? 'უსახელო ელემენტი') }}
                                </h4>

                                {{-- Description --}}
                                @if($itemTranslation?->description)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $itemTranslation->description }}</p>
                                @endif

                                {{-- Meta Information --}}
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-3 h-3 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        ID: {{ $item->id }}
                                    </div>
                                    
                                    @if($item->rank)
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-3 h-3 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                            #{{ $item->rank }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.restaurants.menu.categories.items.edit', [$restaurant, $menuCategory, $item]) }}"
                                       class="flex-1 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-orange-600 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        რედაქტირება
                                    </a>
                                    <a href="{{ route('admin.restaurants.menu.categories.items.show', [$restaurant, $menuCategory, $item]) }}"
                                       class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.restaurants.menu.categories.items.destroy', [$restaurant, $menuCategory, $item]) }}" method="POST" onsubmit="return confirm('ნამდვილად გსურთ წაშლა?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" aria-label="წაშლა" title="წაშლა"
                                                class="relative inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200 group">
                                            <!-- Decorative pulse ring behind the icon -->
                                            <span class="absolute left-3 w-7 h-7 rounded-full flex items-center justify-center pointer-events-none">
                                                <span class="absolute inset-0 rounded-full bg-red-300 opacity-30 animate-ping"></span>
                                                <span class="absolute inset-0 rounded-full bg-red-100/60"></span>
                                            </span>

                                            <!-- Icon -->
                                            <svg class="relative w-4 h-4 text-red-600 transform transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-12 text-center">
                    <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">მენიუს ელემენტები არ არის</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        ამ კატეგორიაში ჯერ არ არის დამატებული მენიუს ელემენტები. დაამატეთ პირველი ელემენტი.
                    </p>
                    <a href="{{ route('admin.restaurants.menu.categories.items.create', [$restaurant, $menuCategory]) }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        პირველი ელემენტის დამატება
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
