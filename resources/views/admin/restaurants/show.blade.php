<x-layouts.app :title="'რესტორნის დეტალები'">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50">
        <!-- Modern Hero Section -->
        <div
            class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 rounded-3xl mb-8 shadow-2xl border border-white/20">
            <!-- Geometric Background Pattern -->
            <div class="absolute inset-0 overflow-hidden opacity-10">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60"
                    height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none"
                    fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30"
                    cy="30" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            </div>

            <!-- Floating Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-32 -right-32 w-64 h-64 bg-white/5 rounded-full animate-pulse"></div>
                <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-white/5 rounded-full animate-pulse delay-1000">
                </div>
                <div class="absolute top-1/3 right-1/4 w-48 h-48 bg-white/5 rounded-full animate-bounce slow"></div>
            </div>

            <!-- Content -->
            <div class="relative backdrop-blur-sm bg-black/10 px-8 py-12">
                <div class="flex flex-col lg:flex-row items-start justify-between gap-8">
                    <div class="flex items-start gap-6">
                        <!-- Restaurant Logo/Avatar -->
                        <div class="relative group">
                            @if ($restaurant->logo)
                                <img src="{{ $restaurant->logo }}" alt="Logo"
                                    class="w-28 h-28 rounded-3xl shadow-2xl object-cover bg-white/90 border-2 border-white/50 group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="w-28 h-28 rounded-3xl shadow-2xl flex items-center justify-center bg-white/90 border-2 border-white/50 group-hover:scale-105 transition-transform duration-300">
                                    <span
                                        class="text-5xl text-gray-700 font-bold">{{ Str::substr($restaurant->name ?? 'R', 0, 1) }}</span>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute -bottom-2 -right-2">
                                @if ($restaurant->status === 'active')
                                    <div
                                        class="w-8 h-8 bg-green-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                @else
                                    <div
                                        class="w-8 h-8 bg-gray-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Restaurant Info -->
                        <div class="flex-1">
                            <div class="mb-4">
                                <h1 class="text-3xl font-bold text-white mb-2">
                                    {{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? ($restaurant->name ?? 'უცნობი რესტორანი') }}
                                </h1>
                                <p class="text-xl text-white/80 mb-2">
                                    {{ $restaurant->translations->where('locale', 'en')->first()?->name ?? '-' }}
                                </p>
                                <div class="flex flex-wrap gap-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white/90 border border-white/30">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ $restaurant->slug ?? 'slug-არ-არის' }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm text-white/90 border border-white/30">
                                        ID: {{ $restaurant->id }}
                                    </span>
                                    @if ($restaurant->ranking)
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-amber-500/30 backdrop-blur-sm rounded-full text-sm text-white/90 border border-amber-300/50">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            რანკი: {{ $restaurant->ranking }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Meta Information -->
                            <div class="flex flex-wrap gap-4 mb-4">
                                @if ($restaurant->creator)
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-white/15 rounded text-xs text-white/80">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        ავტორი: {{ $restaurant->creator->name }}
                                    </span>
                                @endif
                                <span
                                    class="inline-flex items-center px-2 py-1 bg-white/15 rounded text-xs text-white/80">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    შექმნის დრო:
                                    {{ $restaurant->created_at ? $restaurant->created_at->format('Y-m-d H:i') : '-' }}
                                </span>
                                @if ($restaurant->updated_at && $restaurant->updated_at != $restaurant->created_at)
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-white/15 rounded text-xs text-white/80">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        განახლება: {{ $restaurant->updated_at->format('Y-m-d H:i') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Statistics -->
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                <div
                                    class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">{{ $restaurant->places->count() }}</div>
                                    <div class="text-xs text-white/70">ადგილები</div>
                                </div>
                                <div
                                    class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">
                                        {{ $restaurant->places->sum(fn($place) => $place->tables->count()) }}</div>
                                    <div class="text-xs text-white/70">მაგიდები</div>
                                </div>
                                <div
                                    class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">
                                        {{ $restaurant->menuCategories->count() }}</div>
                                    <div class="text-xs text-white/70">კატეგორიები</div>
                                </div>
                                <div
                                    class="text-center bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                                    <div class="text-2xl font-bold text-white">
                                        {{ $restaurant->reservationSlots->count() }}</div>
                                    <div class="text-xs text-white/70">სლოტები</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3 min-w-max">
                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}"
                            class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            რედაქტირება
                        </a>

                        <a href="{{ route('admin.restaurants.reservations.index', $restaurant) }}"
                            class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            ჯავშნები
                        </a>

                        <a href="{{ route('admin.restaurants.places.index', $restaurant) }}"
                            class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            ადგილები
                        </a>

                        @if ($restaurant->qr_code_link)
                            <a href="{{ $restaurant->qr_code_link }}" target="_blank"
                                class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 border border-white/20">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                QR კოდი
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Left Content - Main Information -->
            <div class="xl:col-span-2 space-y-8">
                <!-- Restaurant Details Card -->
                <div
                    class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="relative bg-gradient-to-r from-slate-600 via-blue-600 to-indigo-600 px-8 py-6">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">ძირითადი ინფორმაცია</h3>
                                    <p class="text-white/80 text-sm">რესტორნის მთავარი მონაცემები</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-white/90 text-sm font-medium">Live</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Georgian Name -->
                            <div class="group/item">
                                <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    ქართული სახელი
                                </label>
                                <div
                                    class="bg-gradient-to-br from-indigo-50 via-blue-50 to-purple-50 rounded-xl p-4 border-l-4 border-indigo-500 group-hover/item:shadow-lg transition-all duration-300">
                                    <p class="text-gray-900 font-medium">
                                        {{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? ($restaurant->name ?? 'მითითებული არ არის') }}
                                    </p>
                                </div>
                            </div>

                            <!-- English Name -->
                            <div class="group/item">
                                <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                    </svg>
                                    ინგლისური სახელი
                                </label>
                                <div
                                    class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-xl p-4 border-l-4 border-blue-500 group-hover/item:shadow-lg transition-all duration-300">
                                    <p class="text-gray-900 font-medium">
                                        {{ $restaurant->translations->where('locale', 'en')->first()?->name ?? ($restaurant->name ?? 'Not specified') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="group/item">
                                <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    URL Slug
                                </label>
                                <div
                                    class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 rounded-xl p-4 border-l-4 border-emerald-500 group-hover/item:shadow-lg transition-all duration-300">
                                    <p class="text-gray-900 font-medium font-mono">
                                        {{ $restaurant->slug ?? 'მითითებული არ არის' }}</p>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="group/item">
                                <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    სტატუსი
                                </label>
                                <div
                                    class="bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 rounded-xl p-4 border-l-4 border-purple-500 group-hover/item:shadow-lg transition-all duration-300">
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-900 font-medium capitalize">
                                            {{ $restaurant->status ?? 'უცნობი' }}</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $restaurant->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $restaurant->status === 'active' ? 'აქტიური' : $restaurant->status ?? 'უცნობი' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if ($restaurant->ranking)
                                <!-- Ranking -->
                                <div class="group/item">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                        <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        რეიტინგი
                                    </label>
                                    <div
                                        class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 rounded-xl p-4 border-l-4 border-amber-500 group-hover/item:shadow-lg transition-all duration-300">
                                        <p class="text-gray-900 font-medium">{{ $restaurant->ranking }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($restaurant->discount)
                                <!-- Discount -->
                                <div class="group/item">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        ფასდაკლება
                                    </label>
                                    <div
                                        class="bg-gradient-to-br from-red-50 via-pink-50 to-rose-50 rounded-xl p-4 border-l-4 border-red-500 group-hover/item:shadow-lg transition-all duration-300">
                                        <p class="text-gray-900 font-medium">{{ $restaurant->discount }}%</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Descriptions -->
                        @php
                            $kaDesc = $restaurant->translations->where('locale', 'ka')->first()?->description;
                            $enDesc = $restaurant->translations->where('locale', 'en')->first()?->description;
                        @endphp
                        @if ($kaDesc || $enDesc)
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    აღწერები
                                </h4>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    @if ($kaDesc)
                                        <div>
                                            <h5 class="text-sm font-semibold text-gray-700 mb-2">ქართულად</h5>
                                            <div class="bg-gray-50 rounded-xl p-4 text-gray-800 leading-relaxed">
                                                {{ $kaDesc }}</div>
                                        </div>
                                    @endif
                                    @if ($enDesc)
                                        <div>
                                            <h5 class="text-sm font-semibold text-gray-700 mb-2">English</h5>
                                            <div class="bg-gray-50 rounded-xl p-4 text-gray-800 leading-relaxed">
                                                {{ $enDesc }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Information -->
                @if ($restaurant->email || $restaurant->phone || $restaurant->whatsapp || $restaurant->address)
                    <div
                        class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                        <div class="relative bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 px-8 py-6">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="relative flex items-center">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">საკონტაქტო ინფორმაცია</h3>
                                    <p class="text-white/80 text-sm">კომუნიკაციის საშუალებები</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if ($restaurant->email)
                                    <div class="group/contact">
                                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            ელფოსტა
                                        </label>
                                        <div
                                            class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 rounded-xl p-4 border-l-4 border-blue-500 group-hover/contact:shadow-lg transition-all duration-300">
                                            <a href="mailto:{{ $restaurant->email }}"
                                                class="text-blue-600 hover:text-blue-800 font-medium">{{ $restaurant->email }}</a>
                                        </div>
                                    </div>
                                @endif

                                @if ($restaurant->phone)
                                    <div class="group/contact">
                                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            ტელეფონი
                                        </label>
                                        <div
                                            class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 rounded-xl p-4 border-l-4 border-green-500 group-hover/contact:shadow-lg transition-all duration-300">
                                            <a href="tel:{{ $restaurant->phone }}"
                                                class="text-green-600 hover:text-green-800 font-medium">{{ $restaurant->phone }}</a>
                                        </div>
                                    </div>
                                @endif

                                @if ($restaurant->whatsapp)
                                    <div class="group/contact">
                                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.097" />
                                            </svg>
                                            WhatsApp
                                        </label>
                                        <div
                                            class="bg-gradient-to-br from-green-50 via-emerald-50 to-green-50 rounded-xl p-4 border-l-4 border-green-500 group-hover/contact:shadow-lg transition-all duration-300">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $restaurant->whatsapp) }}"
                                                target="_blank"
                                                class="text-green-600 hover:text-green-800 font-medium flex items-center">
                                                {{ $restaurant->whatsapp }}
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if ($restaurant->address)
                                    <div class="md:col-span-2 group/contact">
                                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                            <svg class="w-4 h-4 mr-2 text-red-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            მისამართი
                                        </label>
                                        <div
                                            class="bg-gradient-to-br from-red-50 via-pink-50 to-rose-50 rounded-xl p-4 border-l-4 border-red-500 group-hover/contact:shadow-lg transition-all duration-300">
                                            <p class="text-gray-900 font-medium leading-relaxed">
                                                {{ $restaurant->address }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Reservation Slots -->
                @if ($restaurant->reservation_type === 'Restaurant')
                    <div
                        class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                        <div class="relative bg-gradient-to-r from-purple-500 via-purple-600 to-indigo-600 px-8 py-6">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="relative flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-white">დროის ინტერვალები</h3>
                                        <p class="text-white/80 text-sm">ჯავშნის სლოტები</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                        {{ $restaurant->reservationSlots->count() }} სლოტი
                                    </span>
                                    <a href="{{ route('admin.restaurants.slots.create', $restaurant) }}"
                                        class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl font-medium transition-all duration-300 border border-white/30">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        დამატება
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            @if ($restaurant->reservationSlots->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($restaurant->reservationSlots->take(6) as $slot)
                                        <div
                                            class="group/slot bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span
                                                        class="text-lg font-semibold text-gray-900">{{ $slot->time_from }}
                                                        - {{ $slot->time_to }}</span>
                                                </div>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $slot->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $slot->is_active ? 'აქტიური' : 'არააქტიური' }}
                                                </span>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    მაქს. {{ $slot->max_guests }} სტუმარი
                                                </div>
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    ინტერვალი: {{ $slot->slot_interval_minutes }} წუთი
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($restaurant->reservationSlots->count() > 6)
                                    <div class="mt-6 text-center">
                                        <a href="{{ route('admin.restaurants.slots.index', $restaurant) }}"
                                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            ყველას ნახვა ({{ $restaurant->reservationSlots->count() }})
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-12">
                                    <div
                                        class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">დროის ინტერვალები არ არის</h4>
                                    <p class="text-gray-600 mb-4">ჯავშნების მისაღებად დაამატეთ დროის ინტერვალები</p>
                                    <a href="{{ route('admin.restaurants.slots.create', $restaurant) }}"
                                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-semibold transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        პირველი სლოტის დამატება
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Places Section -->
                <div
                    class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="relative bg-gradient-to-r from-blue-500 via-indigo-600 to-blue-600 px-8 py-6">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">
                                        <a href="{{ route('admin.restaurants.places.index', $restaurant) }}"
                                            class="hover:text-blue-100 transition-colors duration-200">
                                            ადგილები
                                        </a>
                                    </h3>
                                    <p class="text-white/80 text-sm">რესტორნის ადგილები და მაგიდები</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                    {{ $restaurant->places->count() }} ადგილი
                                </span>
                                <a href="{{ route('admin.restaurants.places.create', $restaurant) }}"
                                    class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl font-medium transition-all duration-300 border border-white/30">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    დამატება
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        @if ($restaurant->places->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($restaurant->places->take(4) as $place)
                                    <div
                                        class="group/place bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                        <div class="flex gap-4 items-start">
                                            @if ($place->image)
                                                <img src="{{ $place->image }}" alt="სივრცის ფოტო"
                                                    class="w-16 h-16 object-cover rounded-xl border-2 border-white shadow-sm group-hover/place:scale-105 transition-transform duration-300">
                                            @else
                                                <div
                                                    class="w-16 h-16 flex items-center justify-center bg-blue-100 rounded-xl border-2 border-white text-blue-400 shadow-sm group-hover/place:scale-105 transition-transform duration-300">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <div class="flex justify-between items-start mb-3">
                                                    <h4 class="font-semibold text-gray-900 text-lg">
                                                        @php $placeTranslation = $place->translations->where('locale', 'ka')->first(); @endphp
                                                        {{ $placeTranslation?->name ?? ($place->translations->first()?->name ?? 'უსახელო ადგილი') }}
                                                    </h4>
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $place->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                        {{ $place->is_active ? 'აქტიური' : 'არააქტიური' }}
                                                    </span>
                                                </div>
                                                <div class="flex items-center mb-3">
                                                    <svg class="w-4 h-4 text-indigo-500 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                                                    </svg>
                                                    <span class="text-sm text-gray-600">{{ $place->tables->count() }}
                                                        მაგიდა</span>
                                                </div>
                                                <a href="{{ route('admin.restaurants.places.show', [$restaurant, $place]) }}"
                                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    დეტალურად
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($restaurant->places->count() > 4)
                                <div class="mt-6 text-center">
                                    <a href="{{ route('admin.restaurants.places.index', $restaurant) }}"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        ყველას ნახვა ({{ $restaurant->places->count() }})
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">ადგილები არ არის</h4>
                                <p class="text-gray-600 mb-4">რესტორნისთვის ადგილების დასამატებლად დააჭირეთ ღილაკს</p>
                                <a href="{{ route('admin.restaurants.places.create', $restaurant) }}"
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    პირველი ადგილის დამატება
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Menu Categories -->
                <div
                    class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="relative bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-500 px-8 py-6">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">
                                        <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}"
                                            class="hover:text-yellow-100 transition-colors duration-200">
                                            მენიუს კატეგორიები
                                        </a>
                                    </h3>

                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                    {{ $restaurant->menuCategories->whereNull('parent_id')->count() }} მთავარი
                                </span>
                                <a href="{{ route('admin.restaurants.menu.categories.create', $restaurant) }}"
                                    class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl font-medium transition-all duration-300 border border-white/30">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    დამატება
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        @if ($restaurant->menuCategories->whereNull('parent_id')->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($restaurant->menuCategories->whereNull('parent_id')->take(6) as $category)
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 overflow-hidden border border-gray-100 dark:border-gray-700">
                                        {{-- Category Image --}}
                                        <div
                                            class="relative h-32 bg-gradient-to-br from-orange-50 to-amber-100 dark:from-gray-700 dark:to-gray-600 overflow-hidden">
                                            @if ($category->image)
                                                <img src="{{ $category->image }}"
                                                    alt="{{ $category->translate('en')->name ?? 'Category Image' }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-12 w-12 text-orange-400 dark:text-gray-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                            @endif

                                            {{-- Status Badge --}}
                                            <div class="absolute top-2 right-2">
                                                @if ($category->status === 'active')
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 shadow-sm">
                                                        <div class="w-1 h-1 bg-green-500 rounded-full mr-1"></div>
                                                        აქტიური
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm">
                                                        <div class="w-1 h-1 bg-gray-400 rounded-full mr-1"></div>
                                                        არააქტიური
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Rank Badge --}}
                                            <div class="absolute top-2 left-2">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full bg-white/90 text-gray-700 dark:bg-gray-800/90 dark:text-gray-200 shadow-sm backdrop-blur-sm">
                                                    #{{ $category->rank ?? 0 }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Card Content --}}
                                        <div class="p-4">
                                            {{-- Category Name with Link --}}
                                            <h4 class="text-sm font-bold mb-2 line-clamp-2">
                                                @php $categoryTranslation = $category->translations->where('locale', 'ka')->first(); @endphp
                                                @if ($category->children->count() > 0)
                                                    <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}?parent={{ $category->id }}"
                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                                        {{ $categoryTranslation?->name ?? ($category->translations->first()?->name ?? 'უსახელო კატეგორია') }}
                                                    </a>
                                                @else
                                                    <span class="text-gray-900 dark:text-gray-100">
                                                        {{ $categoryTranslation?->name ?? ($category->translations->first()?->name ?? 'უსახელო კატეგორია') }}
                                                    </span>
                                                @endif
                                            </h4>

                                            {{-- Children & Items Count --}}
                                            <div class="flex items-center justify-between mb-3">
                                                <div
                                                    class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    <svg class="w-3 h-3 mr-1 text-orange-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                        </path>
                                                    </svg>
                                                    {{ $category->children->count() }} ქვეკატ.
                                                </div>

                                                <div
                                                    class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    <svg class="w-3 h-3 mr-1 text-amber-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    <a href="{{ route('admin.restaurants.menu.categories.show', [$restaurant, $category]) }}"
                                                        class="hover:text-amber-600 transition-colors duration-200">
                                                        {{ $category->menuItems->count() }} ელემ.
                                                    </a>
                                                </div>
                                            </div>

                                            {{-- Action Buttons --}}
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.restaurants.menu.categories.edit', [$restaurant, $category]) }}"
                                                    class="flex-1 inline-flex items-center justify-center px-2 py-1.5 text-xs font-medium text-orange-600 bg-orange-50 hover:bg-orange-100 dark:bg-orange-900/30 dark:text-orange-400 dark:hover:bg-orange-900/50 rounded-lg transition-colors duration-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    რედაქტირება
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($restaurant->menuCategories->whereNull('parent_id')->count() > 6)
                                <div class="mt-6 text-center">
                                    <a href="{{ route('admin.restaurants.menu.categories.index', $restaurant) }}"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        ყველას ნახვა
                                        ({{ $restaurant->menuCategories->whereNull('parent_id')->count() }})
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">მენიუს კატეგორიები არ არის</h4>
                                <p class="text-gray-600 mb-4">მენიუს შესაქმნელად დაამატეთ კატეგორიები</p>
                                <a href="{{ route('admin.restaurants.menu.categories.create', $restaurant) }}"
                                    class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-xl font-semibold transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    პირველი კატეგორიის დამატება
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-8">
                <!-- QR Code Section -->
                @if ($restaurant->qr_code_image || $restaurant->qr_code_link)
                    <div
                        class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                        <div class="relative bg-gradient-to-r from-violet-500 via-purple-600 to-indigo-600 px-6 py-4">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="relative flex items-center">
                                <div
                                    class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 group-hover:rotate-12 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-white">QR კოდი</h3>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            @if ($restaurant->qr_code_link)
                                <a href="{{ $restaurant->qr_code_link }}" target="_blank"
                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 mb-4 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    {{ Str::limit($restaurant->qr_code_link, 30) }}
                                </a>
                            @endif
                            @if ($restaurant->qr_code_image)
                                <div class="inline-block p-3 bg-white rounded-2xl shadow-lg border border-gray-200">
                                    <img src="{{ $restaurant->qr_code_image }}" alt="QR Code"
                                        class="w-32 h-32 object-contain">
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Reservations Statistics -->
                <div
                    class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="relative bg-gradient-to-r from-emerald-500 via-teal-600 to-cyan-600 px-6 py-4">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative flex items-center">
                            <div
                                class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white">ჯავშნების სტატისტიკა</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Total Reservations -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">ჯამური</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->reservations()->count() }}</span>
                        </div>

                        <!-- Confirmed Reservations -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">დადასტურებული</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->reservations()->where('status', 'Confirmed')->count() }}</span>
                        </div>

                        <!-- Pending Reservations -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border border-yellow-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">მოლოდინში</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->reservations()->where('status', 'Pending')->count() }}</span>
                        </div>

                        <!-- Cancelled Reservations -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl border border-gray-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gray-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">გაუქმებული</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->reservations()->where('status', 'Cancelled')->count() }}</span>
                        </div>

                        <div class="pt-4 text-center">
                            <a href="{{ route('admin.restaurants.reservations.index', $restaurant) }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                ყველა ჯავშნის ნახვა
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Restaurant Statistics -->
                <div
                    class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="relative bg-gradient-to-r from-slate-600 via-gray-700 to-slate-800 px-6 py-4">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative flex items-center">
                            <div
                                class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white">რესტორნის სტატისტიკა</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Places -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl border border-indigo-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">ადგილები</span>
                            </div>
                            <span class="text-xl font-bold text-gray-900">{{ $restaurant->places->count() }}</span>
                        </div>

                        <!-- Tables -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-purple-50 to-violet-50 rounded-xl border border-purple-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">მაგიდები</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->places->sum(fn($place) => $place->tables->count()) }}</span>
                        </div>

                        <!-- Menu Categories -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-orange-50 to-amber-50 rounded-xl border border-orange-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">კატეგორიები</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->menuCategories->count() }}</span>
                        </div>

                        <!-- Slots -->
                        <div
                            class="flex justify-between items-center p-3 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl border border-pink-200 group/stat hover:shadow-md transition-all duration-300">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center mr-3 group-hover/stat:scale-110 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">სლოტები</span>
                            </div>
                            <span
                                class="text-xl font-bold text-gray-900">{{ $restaurant->reservationSlots->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Quick Actions -->
                <div
                    class="group relative bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 opacity-50">
                    </div>
                    <div
                        class="relative px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-amber-500 to-orange-600">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <div
                                class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            სწრაფი მოქმედებები
                        </h3>
                    </div>
                    <div class="relative p-6 space-y-4">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}"
                            class="group/action w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                            <svg class="w-5 h-5 mr-2 group-hover/action:rotate-12 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            რედაქტირება
                        </a>



                        <!-- Delete Button -->
                        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST"
                            class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="group/action w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105"
                                onclick="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ რესტორნის წაშლა? ეს მოქმედება შეუქცევადია.')">
                                <svg class="w-5 h-5 mr-2 group-hover/action:scale-110 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                წაშლა
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Meta Information Card -->
                <div
                    class="group relative bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 overflow-hidden hover:shadow-2xl transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 opacity-50">
                    </div>
                    <div
                        class="relative px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-gray-400 to-blue-600">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <div
                                class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            მეტა ინფორმაცია
                        </h3>
                    </div>
                    <div class="relative p-6 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">ID</span>
                            <span class="text-sm text-gray-900 font-semibold">{{ $restaurant->id }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">ავტორი</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->creator?->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">ვინ განაახლა</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->updater?->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">შექმნის დრო</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->created_at ? $restaurant->created_at->format('Y-m-d H:i') : '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">განახლების დრო</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->updated_at ? $restaurant->updated_at->format('Y-m-d H:i') : '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">სტატუსი</span>
                            <span class="text-sm text-gray-900 font-semibold">{{ $restaurant->status ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">Time Zone</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->time_zone ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">ვალუტა</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->price_currency ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 font-medium">სამუშაო საათები</span>
                            <span
                                class="text-sm text-gray-900 font-semibold">{{ $restaurant->working_hours ?? '-' }}</span>
                        </div>

                        <!-- Add more meta fields as needed -->
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

    </div>

    <!-- Enhanced JavaScript with More Features -->
    <script>
        // Copy to clipboard with enhanced feedback
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Create enhanced toast notification
                const toast = document.createElement('div');
                toast.className =
                    'fixed top-6 right-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 transform transition-all duration-500 translate-x-full';
                toast.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">წარმატებით კოპირებულია!</div>
                            <div class="text-sm opacity-90">${text}</div>
                        </div>
                    </div>
                `;
                document.body.appendChild(toast);

                // Animate in
                setTimeout(() => toast.classList.remove('translate-x-full'), 100);

                // Animate out
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                    setTimeout(() => toast.remove(), 500);
                }, 3000);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
                alert('კოპირება ვერ მოხერხდა');
            });
        }

        // Add scroll animations
        function addScrollAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('[class*="group"]').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
        }

        // Initialize animations when page loads
        document.addEventListener('DOMContentLoaded', addScrollAnimations);

        // Add floating animation to hero stats
        function addFloatingAnimation() {
            const stats = document.querySelectorAll('.animate-bounce');
            stats.forEach((stat, index) => {
                stat.style.animationDelay = `${index * 0.2}s`;
            });
        }

        addFloatingAnimation();
    </script>

    <!-- Custom CSS for additional animations -->
    <style>
        @keyframes tilt {

            0%,
            50%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(1deg);
            }

            75% {
                transform: rotate(-1deg);
            }
        }

        .animate-tilt {
            animation: tilt 10s infinite linear;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom gradient animations */
        @keyframes gradient-x {

            0%,
            100% {
                transform: translateX(-50%);
            }

            50% {
                transform: translateX(50%);
            }
        }

        /* Glassmorphism effect enhancements */
        .backdrop-blur-xl {
            backdrop-filter: blur(20px);
        }

        /* Custom hover effects */
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }

        .group:hover .group-hover\:rotate-12 {
            transform: rotate(12deg);
        }

        /* Loading skeleton animation */
        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }

            100% {
                background-position: 468px 0;
            }
        }
    </style>
</x-layouts.app>
