<x-layouts.app :title="'ქვეკატეგორიები - ' . $parent->name . ' - ' . $restaurant->name">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50">
        {{-- Header Section with Breadcrumb --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex flex-col gap-6">
                {{-- Breadcrumb --}}
                <nav class="flex items-center space-x-3 text-sm">
                    <a href="{{ route('admin.restaurants.show', $restaurant) }}" 
                       class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors duration-200">
                        {{ $restaurant->name }}
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}" 
                       class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors duration-200">
                        მენიუს კატეგორიები
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-emerald-600 font-medium">{{ $parent->name ?? 'ქვეკატეგორიები' }}</span>
                </nav>

                {{-- Title and Actions --}}
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="text-center sm:text-left">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-2">
                            {{ $parent->name }} - ქვეკატეგორიები
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">{{ $restaurant->name }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 border border-gray-300 rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            მთავარი კატეგორიები
                        </a>
                        <a href="{{ route('admin.restaurants.menu.categories.children.create', [$restaurant, $parent]) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-2xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            ახალი ქვეკატეგორია
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">ძიება და ფილტრაცია</h2>
                    <p class="text-gray-600 dark:text-gray-400">მოძებნეთ ქვეკატეგორია სახელით და გაფილტრეთ სტატუსით</p>
                </div>
            </div>
            
            <form method="GET" action="{{ route('admin.restaurants.menu.categories.children', [$restaurant, $parent]) }}" class="space-y-6">
                {{-- Single Row Layout --}}
                <div class="flex flex-wrap items-end gap-4">
                    {{-- Search Input --}}
                    <div class="flex-1 min-w-80">
                        <label for="search" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">ძიება</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="მოძებნეთ ქვეკატეგორია სახელით..."
                               class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">
                    </div>

                    {{-- Status Filter --}}
                    <div class="w-48">
                        <label for="status" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">სტატუსი</label>
                        <select name="status" 
                                id="status"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm transition-all duration-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-emerald-400 dark:focus:ring-emerald-400/20 sm:text-sm hover:border-gray-300 dark:hover:border-gray-500">
                            <option value="">ყველა სტატუსი</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>აქტიური</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>არააქტიური</option>
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-3">
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-xl font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            ძიება
                        </button>
                        
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.restaurants.menu.categories.children', [$restaurant, $parent]) }}" 
                               class="inline-flex items-center px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold text-sm transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                გასუფთავება
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Active Filters Display --}}
                @if(request()->hasAny(['search', 'status']))
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl p-4 border border-emerald-200 dark:border-emerald-800">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-medium text-emerald-800 dark:text-emerald-200">აქტიური ფილტრები:</span>
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">
                                    ძიება: "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('status'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">
                                    სტატუსი: {{ request('status') === 'active' ? 'აქტიური' : 'არააქტიური' }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </form>
        </div>

        {{-- Sub Categories Grid Container - 4 cards per row with compact size --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($menuCategories as $index => $category)
                <div class="group bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 overflow-hidden hover:shadow-xl transition-all duration-300 hover:scale-102 transform">
                    {{-- Category Image --}}
                    <div class="relative h-48 bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 dark:from-gray-700 dark:to-gray-600 overflow-hidden">
                        @if($category->image)
                            <img src="{{ $category->image }}" 
                                 alt="{{ $category->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-emerald-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif

                        {{-- Status Badge --}}
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full 
                                {{ $category->status === 'active' 
                                    ? 'bg-green-100 text-green-800 border border-green-200' 
                                    : 'bg-red-100 text-red-800 border border-red-200' }}">
                                {{ $category->status === 'active' ? 'აქტიური' : 'არააქტიური' }}
                            </span>
                        </div>

                        {{-- Rank Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-white/90 text-gray-700 shadow-sm backdrop-blur-sm">
                                <span class="text-emerald-600">#</span>{{ $category->rank ?? 0 }}
                            </span>
                        </div>

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    {{-- Card Content --}}
                    <div class="p-5">
                        {{-- Category Name --}}
                        <h3 class="text-lg font-bold mb-3 line-clamp-2">
                            @if($category->children->count() > 0)
                                <a href="{{ route('admin.restaurants.menu.categories.subchildren', [$restaurant, $parent, $category]) }}" 
                                   class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 group-hover:scale-105 transform inline-block">
                                    {{ $category->name ?? 'უსახელო კატეგორია' }}
                                </a>
                            @else
                                <span class="text-gray-900 dark:text-gray-100">
                                    {{ $category->name ?? 'უსახელო კატეგორია' }}
                                </span>
                            @endif
                        </h3>

                        {{-- Statistics --}}
                        <div class="space-y-3 mb-4">
                            {{-- Sub-children Count --}}
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    მესამე დონე:
                                </span>
                                @if($category->children->count() > 0)
                                    <a href="{{ route('admin.restaurants.menu.categories.subchildren', [$restaurant, $parent, $category]) }}" 
                                       class="text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200 hover:underline">
                                        {{ $category->children->count() }}
                                    </a>
                                @else
                                    <span class="font-medium">{{ $category->children->count() }}</span>
                                @endif
                            </div>

                            {{-- Items Count --}}
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    ელემენტები:
                                </span>
                                <span class="font-medium">{{ $category->menuItems->count() ?? 0 }}</span>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2">
                            <a href="{{ route('admin.restaurants.menu.categories.edit', [$restaurant, $category]) }}"
                               class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                რედაქტირება
                            </a>
                            <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}"
                               class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State with Glassmorphism --}}
                <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center">
                    <div class="backdrop-blur-lg bg-white/20 dark:bg-gray-800/20 border border-white/30 dark:border-gray-700/30 rounded-2xl p-8 max-w-sm mx-auto shadow-xl">
                        <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">ქვეკატეგორიები არ მოიძებნა</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $parent->name }}-ს ჯერ არ აქვს ქვეკატეგორიები.</p>
                        <a href="{{ route('admin.restaurants.menu.categories.children.create', [$restaurant, $parent]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            პირველი ქვეკატეგორიის დამატება
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination --}}
        @if($menuCategories instanceof \Illuminate\Pagination\LengthAwarePaginator && $menuCategories->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg border border-white/30 p-4">
                    {{ $menuCategories->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
    
    <script>        
        // Auto-submit on Enter key in search input
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });
    </script>
    
</x-layouts.app>
