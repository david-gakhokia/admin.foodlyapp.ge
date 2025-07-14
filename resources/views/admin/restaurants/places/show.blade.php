<x-layouts.app :title="'ადგილის დეტალები'">
    <!-- Animated Success/Error Messages -->
    @if (session('success'))
        <div class="mb-8 bg-gradient-to-r from-emerald-400 via-emerald-500 to-teal-500 shadow-2xl border border-emerald-300 text-white px-8 py-6 rounded-2xl backdrop-blur-sm relative overflow-hidden animate-pulse"
            role="alert">
            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
            <div class="relative flex items-center">
                <div class="flex-shrink-0">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-lg font-semibold drop-shadow-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-8 bg-gradient-to-r from-red-400 via-red-500 to-rose-500 shadow-2xl border border-red-300 text-white px-8 py-6 rounded-2xl backdrop-blur-sm relative overflow-hidden animate-pulse"
            role="alert">
            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
            <div class="relative flex items-center">
                <div class="flex-shrink-0">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-lg font-semibold drop-shadow-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Elegant Header with Enhanced Breadcrumbs -->
    <div class="mb-10">
        <!-- Enhanced Breadcrumb with Floating Effect -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol
                class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl lg:rounded-2xl px-3 sm:px-6 py-2 sm:py-3 shadow-lg">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.restaurants.places.index', $restaurant) }}"
                        class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200 hover:scale-105">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2.5 text-blue-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span class="hidden sm:inline">ადგილები</span>
                        <span class="sm:hidden">ადგილები</span>
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.show', $place->restaurant) }}"
                            class="ml-1 sm:ml-2 inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200 hover:scale-105">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 text-emerald-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span
                                class="hidden sm:inline">{{ $place->restaurant ? $place->restaurant->translate('ka')->name ?? ($place->restaurant->translate('en')->name ?? 'რესტორანი') : 'რესტორანი' }}</span>
                            <span class="sm:hidden">რესტორანი</span>
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span
                            class="ml-1 sm:ml-2 text-sm font-bold text-indigo-600 bg-indigo-50 px-2 sm:px-3 py-1 rounded-lg lg:rounded-xl truncate max-w-[200px] sm:max-w-none">{{ $place->translate('ka')->name ?? ($place->translate('en')->name ?? 'ადგილის დეტალები') }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Premium Header Section with Glass Effect -->
        <div
            class="bg-gradient-to-br from-white via-gray-50 to-blue-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-2xl lg:rounded-3xl p-4 sm:p-6 lg:p-8 relative overflow-hidden place-header">
            <!-- Decorative Background Elements -->
            <div
                class="absolute top-0 right-0 w-32 h-32 sm:w-48 sm:h-48 lg:w-64 lg:h-64 bg-gradient-to-br from-blue-100/30 to-purple-100/30 rounded-full -translate-y-16 sm:-translate-y-24 lg:-translate-y-32 translate-x-16 sm:translate-x-24 lg:translate-x-32 blur-3xl">
            </div>
            <div
                class="absolute bottom-0 left-0 w-24 h-24 sm:w-36 sm:h-36 lg:w-48 lg:h-48 bg-gradient-to-tr from-emerald-100/30 to-teal-100/30 rounded-full translate-y-12 sm:translate-y-18 lg:translate-y-24 -translate-x-12 sm:-translate-x-18 lg:-translate-x-24 blur-3xl">
            </div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 sm:gap-6 lg:gap-8">
                <!-- Enhanced Title and Info -->
                <div class="flex items-center gap-3 sm:gap-4 lg:gap-6 min-w-0 flex-1">
                    <!-- Premium Place Image or Icon -->
                    <div class="flex-shrink-0 relative">
                        @if ($place->image_link)
                            <div class="relative">
                                <img src="{{ $place->image_link }}"
                                    alt="{{ $place->translate('ka')->name ?? ($place->translate('en')->name ?? 'Place') }}"
                                    class="w-16 h-16 sm:w-18 sm:h-18 lg:w-20 lg:h-20 rounded-2xl lg:rounded-3xl object-cover shadow-2xl border-3 sm:border-4 border-white ring-2 sm:ring-4 ring-blue-100/50 transition-transform duration-300 hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-black/20 rounded-2xl lg:rounded-3xl">
                                </div>
                            </div>
                        @else
                            <div
                                class="w-16 h-16 sm:w-18 sm:h-18 lg:w-20 lg:h-20 bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-700 rounded-2xl lg:rounded-3xl flex items-center justify-center shadow-2xl ring-2 sm:ring-4 ring-blue-100/50 transition-transform duration-300 hover:scale-110 hover:rotate-3">
                                <svg class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 text-white drop-shadow-lg"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Enhanced Title and Meta -->
                    <div class="min-w-0 flex-1">
                        <h1
                            class="responsive-title text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-800 via-gray-900 to-blue-900 mb-2 lg:mb-3 leading-tight truncate">
                            {{ $place->translate('ka')->name ?? ($place->translate('en')->name ?? 'ადგილის დეტალები') }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3 lg:gap-4 text-sm">
                            <span
                                class="flex items-center bg-white/70 backdrop-blur-sm rounded-lg lg:rounded-xl px-2 sm:px-3 lg:px-4 py-1.5 lg:py-2 shadow-md border border-gray-200/50">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5 mr-1.5 sm:mr-2 text-blue-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="font-bold text-blue-700 text-xs sm:text-sm">ID: #{{ $place->id }}</span>
                            </span>
                            @if ($place->status)
                                <span
                                    class="inline-flex items-center px-2 sm:px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg lg:rounded-xl text-xs sm:text-sm font-bold bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-lg border border-emerald-400/50">
                                    <div
                                        class="w-2 h-2 lg:w-2.5 lg:h-2.5 bg-white rounded-full mr-1.5 lg:mr-2 animate-pulse shadow-lg">
                                    </div>
                                    აქტიური
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 sm:px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg lg:rounded-xl text-xs sm:text-sm font-bold bg-gradient-to-r from-red-500 to-rose-600 text-white shadow-lg border border-red-400/50">
                                    <div
                                        class="w-2 h-2 lg:w-2.5 lg:h-2.5 bg-white rounded-full mr-1.5 lg:mr-2 shadow-lg">
                                    </div>
                                    არააქტიური
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Premium Action Buttons -->
                <div class="flex flex-wrap gap-2 sm:gap-3 lg:gap-4">
                    <a href="{{ route('admin.restaurants.places.tables.create', [$restaurant, $place]) }}"
                        class="group inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3.5 bg-gradient-to-r from-emerald-500 via-teal-600 to-cyan-600 hover:from-emerald-600 hover:via-teal-700 hover:to-cyan-700 text-white font-bold text-sm sm:text-base rounded-xl lg:rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 border border-emerald-400/50">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 group-hover:rotate-90 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="hidden sm:inline">ახალი მაგიდა</span>
                        <span class="sm:hidden">მაგიდა</span>
                    </a>
                    <a href="{{ route('admin.restaurants.places.edit', [$restaurant, $place]) }}"
                        class="group inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3.5 bg-gradient-to-r from-amber-500 via-orange-600 to-red-600 hover:from-amber-600 hover:via-orange-700 hover:to-red-700 text-white font-bold text-sm sm:text-base rounded-xl lg:rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 border border-amber-400/50">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 group-hover:rotate-12 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        რედაქტირება
                    </a>
                    <a href="{{ route('admin.restaurants.places.index', $restaurant) }}"
                        class="group inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3.5 bg-white/80 hover:bg-white backdrop-blur-sm text-gray-700 hover:text-gray-900 border-2 border-gray-300/50 hover:border-gray-400 font-bold text-sm sm:text-base rounded-xl lg:rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 group-hover:-translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="hidden sm:inline">დაბრუნება</span>
                        <span class="sm:hidden">უკან</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Elegant Main Content Layout -->
    <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 overflow-hidden main-grid">
        <!-- Premium Tables Section (3/4 width) -->
        <div class="xl:col-span-3 min-w-0">
            <div
                class="bg-gradient-to-br from-white via-gray-50 to-blue-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-2xl lg:rounded-3xl overflow-hidden relative table-section">
                <!-- Decorative Elements -->
                <div
                    class="absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 bg-gradient-to-br from-emerald-100/20 to-teal-100/20 rounded-full -translate-y-16 lg:-translate-y-24 translate-x-16 lg:translate-x-24 blur-3xl">
                </div>

                <!-- Enhanced Header -->
                <div
                    class="relative bg-gradient-to-r from-emerald-400 via-teal-500 to-cyan-600 px-4 sm:px-6 lg:px-8 py-4 lg:py-6 border-b border-emerald-300/30">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-white/20 backdrop-blur-sm rounded-xl lg:rounded-2xl flex items-center justify-center mr-3 lg:mr-5 shadow-xl border border-white/30">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white drop-shadow-lg"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2
                                    class="responsive-subtitle text-lg sm:text-xl lg:text-2xl font-black text-white drop-shadow-md">
                                    <a href="{{ route('admin.restaurants.places.tables.index', [$place->restaurant, $place]) }}"
                                        class="text-lg sm:text-xl lg:text-2xl font-black text-white drop-shadow-md hover:text-emerald-100 transition-colors duration-300">
                                        მაგიდები
                                    </a>
                                </h2>
                                <p class="text-xs sm:text-sm text-emerald-100 font-semibold drop-shadow-sm">სულ
                                    {{ $place->tables->count() }} მაგიდა • ტევადობა:
                                    {{ $place->tables->sum('capacity') ?? 0 }} პერსონა</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 lg:gap-3">
                            @if ($place->tables->where('status', 'active')->count() > 0)
                                <span
                                    class="inline-flex items-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg lg:rounded-xl text-xs font-bold bg-white/20 backdrop-blur-sm text-white border border-white/30 shadow-lg">
                                    <div
                                        class="w-1.5 h-1.5 lg:w-2 lg:h-2 bg-white rounded-full mr-1 lg:mr-1.5 animate-pulse shadow-lg">
                                    </div>
                                    {{ $place->tables->where('status', 'active')->count() }} აქტიური
                                </span>
                            @endif
                            @if ($place->tables->where('status', '!=', 'active')->count() > 0)
                                <span
                                    class="inline-flex items-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg lg:rounded-xl text-xs font-bold bg-red-500/30 backdrop-blur-sm text-white border border-red-300/30 shadow-lg">
                                    <div
                                        class="w-1.5 h-1.5 lg:w-2 lg:h-2 bg-white rounded-full mr-1 lg:mr-1.5 shadow-lg">
                                    </div>
                                    {{ $place->tables->where('status', '!=', 'active')->count() }} არააქტიური
                                </span>
                            @endif

                            <!-- Slots Management Button -->
                            <a href="{{ route('admin.restaurants.places.slots.index', [$place->restaurant, $place]) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg lg:rounded-xl text-xs font-bold bg-indigo-500/80 hover:bg-indigo-600/80 backdrop-blur-sm text-white border border-indigo-300/30 shadow-lg transition-all duration-300 transform hover:scale-105">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Slots Management
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative p-4 sm:p-6 lg:p-8">
                    @if ($place->tables->count() > 0)
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4 sm:gap-6 responsive-grid">
                            @foreach ($place->tables as $table)
                                <div
                                    class="group table-card bg-gradient-to-br from-white via-gray-50 to-blue-50 border-2 border-gray-200/50 rounded-xl lg:rounded-2xl p-3 sm:p-4 lg:p-5 hover:shadow-2xl hover:border-blue-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:rotate-1 relative overflow-hidden flex flex-col min-h-[280px]">
                                    <!-- Card Decorative Elements -->
                                    <div
                                        class="absolute top-0 right-0 w-12 h-12 lg:w-16 lg:h-16 bg-gradient-to-br from-blue-100/30 to-purple-100/30 rounded-full -translate-y-6 lg:-translate-y-8 translate-x-6 lg:translate-x-8 blur-2xl group-hover:scale-150 transition-transform duration-500">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 w-8 h-8 lg:w-12 lg:h-12 bg-gradient-to-tr from-emerald-100/20 to-teal-100/20 rounded-full translate-y-4 lg:translate-y-6 -translate-x-4 lg:-translate-x-6 blur-xl group-hover:scale-125 transition-transform duration-500">
                                    </div>

                                    <!-- Table Header -->
                                    <div class="relative flex items-start justify-between mb-3 lg:mb-4">
                                        <div class="flex items-center flex-1 min-w-0">
                                            @if ($table->image_link)
                                                <div class="relative flex-shrink-0">
                                                    <img src="{{ $table->image_link }}"
                                                        alt="{{ $table->translate('ka')->name ?? ($table->translate('en')->name ?? 'Table') }}"
                                                        class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 object-cover rounded-xl lg:rounded-2xl mr-3 shadow-xl border-3 border-white ring-2 ring-blue-100/50 group-hover:scale-110 transition-transform duration-300">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-br from-transparent to-black/10 rounded-xl lg:rounded-2xl">
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-blue-400 via-indigo-500 to-purple-600 rounded-xl lg:rounded-2xl mr-3 flex items-center justify-center shadow-xl ring-2 ring-blue-100/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white drop-shadow-lg"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="min-w-0 flex-1">
                                                <h3
                                                    class="responsive-card-title font-black text-gray-900 text-sm sm:text-base lg:text-lg leading-tight mb-1.5 truncate">
                                                    {{ $table->translate('ka')->name ?? ($table->translate('en')->name ?? "მაგიდა #{$table->id}") }}
                                                </h3>
                                                <p
                                                    class="text-xs text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded-lg inline-block shadow-sm border border-blue-200/50">
                                                    ID: #{{ $table->id }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="flex items-center justify-between flex-wrap mb-2 lg:mb-2">
                                        <!-- Table Status -->
                                        @if ($table->status === 'active')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-xl text-xs font-bold bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-xl border border-emerald-400/50 flex-shrink-0 ml-2">
                                                <div
                                                    class="w-2 h-2 bg-white rounded-full mr-1.5 animate-pulse shadow-lg">
                                                </div>
                                                აქტიური
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-xl text-xs font-bold bg-gradient-to-r from-red-500 to-rose-600 text-white shadow-xl border border-red-400/50 flex-shrink-0 ml-2">
                                                <div class="w-2 h-2 bg-white rounded-full mr-1.5 shadow-lg"></div>
                                                არააქტიური
                                            </span>
                                        @endif
                                    </div>
                                    @if ($table->capacity || $table->rank || ($table->translate('ka')->description ?? $table->translate('en')->description))
                                        <!-- Enhanced Table Details -->
                                        <div class="space-y-3 mb-4 flex-1">
                                            @if ($table->capacity)
                                                <div
                                                    class="flex items-center bg-gradient-to-r from-white/90 to-blue-50/90 backdrop-blur-sm rounded-xl p-3 border border-gray-200/50 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                                    <div
                                                        class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center mr-3 shadow-lg flex-shrink-0">
                                                        <svg class="w-4 h-4 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5"
                                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-baseline">
                                                            <span
                                                                class="font-black text-blue-700 text-lg">{{ $table->capacity }}</span>
                                                            <span
                                                                class="text-sm font-semibold text-gray-600 ml-1">პერსონა</span>
                                                        </div>
                                                        <p class="text-xs text-gray-500 font-medium">მაქსიმალური
                                                            ტევადობა</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($table->rank)
                                                <div
                                                    class="flex items-center bg-gradient-to-r from-white/90 to-amber-50/90 backdrop-blur-sm rounded-xl p-3 border border-gray-200/50 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                                    <div
                                                        class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center mr-3 shadow-lg flex-shrink-0">
                                                        <svg class="w-4 h-4 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5"
                                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-baseline">
                                                            <span
                                                                class="text-sm font-semibold text-gray-600">რანგი:</span>
                                                            <span
                                                                class="font-black text-amber-700 ml-2 text-lg">{{ $table->rank }}</span>
                                                        </div>
                                                        {{-- <p class="text-xs text-gray-500 font-medium">მაგიდის პრიორიტეტი</p> --}}
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($table->translate('ka')->description ?? $table->translate('en')->description)
                                                <div
                                                    class="bg-gradient-to-r from-white/90 to-purple-50/90 backdrop-blur-sm rounded-xl p-3 border border-gray-200/50 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                                    <div class="flex items-start">
                                                        <div
                                                            class="w-8 h-8 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl flex items-center justify-center mr-3 shadow-lg flex-shrink-0">
                                                            <svg class="w-4 h-4 text-white" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7" />
                                                            </svg>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-xs text-gray-500 font-semibold mb-1">აღწერა:
                                                            </p>
                                                            <p
                                                                class="text-sm text-gray-700 font-medium leading-relaxed line-clamp-2">
                                                                {{ $table->translate('ka')->description ?? $table->translate('en')->description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <!-- Empty state for minimal tables -->
                                        <div class="flex-1 flex items-center justify-center py-8">
                                            <div class="text-center">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl flex items-center justify-center mx-auto mb-3 opacity-60">
                                                    <svg class="w-8 h-8 text-gray-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <p class="text-xs text-gray-500 font-medium">დამატებითი ინფორმაცია არ
                                                    არის</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Premium Action Buttons -->
                                    <div class="relative flex flex-col gap-2 pt-4 border-t border-gray-200/50 mt-auto">
                                        <div class="grid grid-cols-2 gap-2">
                                            <a href="{{ route('admin.restaurants.places.tables.show', [$place->restaurant, $place, $table]) }}"
                                                class="group inline-flex items-center px-3 py-2 text-xs font-bold text-indigo-700 bg-gradient-to-r from-indigo-50 to-blue-100 hover:from-indigo-100 hover:to-blue-200 rounded-xl border border-indigo-200/50 transition-all duration-300 transform hover:scale-105 shadow-lg justify-center">
                                                <svg class="w-3 h-3 mr-1.5 group-hover:scale-110 transition-transform duration-300"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>

                                            </a>
                                            <a href="{{ route('admin.restaurants.places.tables.edit', [$place->restaurant, $place, $table]) }}"
                                                class="group inline-flex items-center px-3 py-2 text-xs font-bold text-amber-700 bg-gradient-to-r from-amber-50 to-orange-100 hover:from-amber-100 hover:to-orange-200 rounded-xl border border-amber-200/50 transition-all duration-300 transform hover:scale-105 shadow-lg justify-center">
                                                <svg class="w-3 h-3 mr-1.5 group-hover:rotate-12 transition-transform duration-300"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>

                                            </a>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2">
                                            @if ($table->qr_code_image)
                                                <a href="{{ $table->qr_code_image }}" target="_blank"
                                                    class="group inline-flex items-center px-3 py-2 text-xs font-bold text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-100 hover:from-emerald-100 hover:to-teal-200 rounded-xl border border-emerald-200/50 transition-all duration-300 transform hover:scale-105 shadow-lg justify-center">
                                                    <svg class="w-3 h-3 mr-1.5 group-hover:rotate-45 transition-transform duration-300"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                    </svg>

                                                </a>
                                            @else
                                                <div class="flex-1"></div>
                                            @endif
                                            <form
                                                action="{{ route('admin.restaurants.places.tables.destroy', [$place->restaurant, $place, $table]) }}"
                                                method="POST"
                                                onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ მაგიდის წაშლა?')"
                                                class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="group w-full inline-flex items-center px-3 py-2 text-xs font-bold text-red-700 bg-gradient-to-r from-red-50 to-rose-100 hover:from-red-100 hover:to-rose-200 rounded-xl border border-red-200/50 transition-all duration-300 transform hover:scale-105 shadow-lg justify-center">
                                                    <svg class="w-3 h-3 mr-1.5 group-hover:scale-110 transition-transform duration-300"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>

                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Luxury Empty State -->
                        <div class="text-center py-20 relative">
                            <!-- Decorative Background -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 via-teal-50/50 to-cyan-50/50 rounded-3xl">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-emerald-100/20 to-teal-100/20 rounded-full blur-3xl">
                            </div>

                            <div class="relative">
                                <div
                                    class="w-28 h-28 bg-gradient-to-br from-emerald-400 via-teal-500 to-cyan-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl border-4 border-white ring-4 ring-emerald-100/50 transform hover:scale-110 hover:rotate-3 transition-all duration-500">
                                    <svg class="w-14 h-14 text-white drop-shadow-lg" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-4">ჯერ არ არის მაგიდები</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto text-lg leading-relaxed">ამ ადგილს ჯერ არ
                                    აქვს დამატებული მაგიდები. დაამატეთ პირველი მაგიდა რომ დაიწყოთ.</p>
                                <a href="{{ route('admin.restaurants.places.tables.create', [$restaurant, $place]) }}"
                                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 via-teal-600 to-cyan-600 hover:from-emerald-600 hover:via-teal-700 hover:to-cyan-700 text-white font-black rounded-3xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 border border-emerald-400/50">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    პირველი მაგიდის დამატება
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Luxury Sidebar - Place Information (1/4 width) -->
        <div class="xl:col-span-1 max-w-full">
            <div
                class="bg-gradient-to-br from-white via-slate-50 to-gray-100 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-2xl lg:rounded-3xl overflow-hidden relative sidebar-sticky w-full sidebar-section">
                <!-- Decorative Elements -->
                <div
                    class="absolute top-0 right-0 w-20 h-20 lg:w-32 lg:h-32 bg-gradient-to-br from-slate-100/30 to-gray-200/30 rounded-full -translate-y-10 lg:-translate-y-16 translate-x-10 lg:translate-x-16 blur-3xl">
                </div>

                <!-- Enhanced Header -->
                <div
                    class="relative bg-gradient-to-r from-slate-600 via-gray-700 to-slate-800 px-4 sm:px-6 py-4 lg:py-5 border-b border-slate-300/30">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
                    <div class="relative flex items-center">
                        <div
                            class="w-10 h-10 lg:w-12 lg:h-12 bg-white/20 backdrop-blur-sm rounded-xl lg:rounded-2xl flex items-center justify-center mr-3 lg:mr-4 shadow-xl border border-white/30">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white drop-shadow-lg" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg lg:text-xl font-black text-white drop-shadow-md">ადგილის ინფორმაცია</h2>
                            <p class="text-slate-200 text-sm font-semibold drop-shadow-sm">მეტა და სტატისტიკა</p>
                        </div>
                    </div>
                </div>

                <div class="relative p-4 sm:p-6 space-y-6 lg:space-y-8">
                    <!-- Premium Info Cards -->
                    <div class="grid grid-cols-1 gap-4">
                        <!-- ID -->
                        <div
                            class="bg-gradient-to-br from-blue-400 via-blue-500 to-indigo-600 rounded-2xl p-4 border-2 border-blue-300/50 shadow-xl transform hover:scale-105 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-black text-white drop-shadow-md">ID</span>
                                </div>
                                <span class="text-sm font-black text-white drop-shadow-md">#{{ $place->id }}</span>
                            </div>
                        </div>

                        <!-- Restaurant -->
                        <div
                            class="bg-gradient-to-br from-emerald-400 via-teal-500 to-cyan-600 rounded-2xl p-4 border-2 border-emerald-300/50 shadow-xl transform hover:scale-105 transition-all duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h1a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-black text-white drop-shadow-md">რესტორანი</span>
                                </div>
                            </div>
                            <p class="text-sm font-black text-white leading-tight drop-shadow-md">
                                {{ $place->restaurant ? $place->restaurant->translate('ka')->name ?? ($place->restaurant->translate('en')->name ?? $place->restaurant->name) : 'N/A' }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div
                            class="bg-gradient-to-br from-purple-400 via-pink-500 to-rose-600 rounded-2xl p-4 border-2 border-purple-300/50 shadow-xl transform hover:scale-105 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-black text-white drop-shadow-md">სტატუსი</span>
                                </div>
                                @if ($place->status)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-2xl text-xs font-bold bg-white/20 backdrop-blur-sm text-white border border-white/30 shadow-lg">
                                        <div class="w-2 h-2 bg-white rounded-full mr-1.5 animate-pulse shadow-lg">
                                        </div>
                                        აქტიური
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-2xl text-xs font-bold bg-red-500/30 backdrop-blur-sm text-white border border-red-300/30 shadow-lg">
                                        <div class="w-2 h-2 bg-white rounded-full mr-1.5 shadow-lg"></div>
                                        არააქტიური
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div
                            class="bg-gradient-to-br from-teal-400 via-cyan-500 to-blue-600 rounded-2xl p-4 border-2 border-teal-300/50 shadow-xl transform hover:scale-105 transition-all duration-300">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black text-white drop-shadow-md">მაგიდები:</span>
                                    <span
                                        class="text-sm font-black text-white drop-shadow-md">{{ $place->tables->count() }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black text-white drop-shadow-md">ტევადობა:</span>
                                    <span
                                        class="text-sm font-black text-white drop-shadow-md">{{ $place->tables->sum('capacity') ?? 0 }}
                                        პერსონა</span>
                                </div>
                                @if ($place->rank)
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white drop-shadow-md">რანგი:</span>
                                        <span
                                            class="text-sm font-black text-white drop-shadow-md">{{ $place->rank }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Premium Action Buttons -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-black text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            მოქმედებები
                        </h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.restaurants.places.edit', [$restaurant, $place]) }}"
                                class="group w-full inline-flex justify-center items-center px-5 py-3 bg-gradient-to-r from-amber-500 via-orange-600 to-red-600 hover:from-amber-600 hover:via-orange-700 hover:to-red-700 text-white text-sm font-black rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-0.5 border border-amber-400/50">
                                <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                რედაქტირება
                            </a>




                            <a href="{{ route('admin.restaurants.places.slots.index', [$place->restaurant, $place]) }}"
                                class="group w-full inline-flex justify-center items-center px-5 py-3 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-600 hover:from-indigo-600 hover:via-purple-700 hover:to-pink-700 text-white text-sm font-black rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-0.5 border border-indigo-400/50">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Slots Management
                            </a>

                            @if ($place->qr_code_link)
                                <a href="{{ $place->qr_code_link }}" target="_blank"
                                    class="group w-full inline-flex justify-center items-center px-5 py-3 bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-700 hover:from-cyan-600 hover:via-blue-700 hover:to-indigo-800 text-white text-sm font-black rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-0.5 border border-cyan-400/50">
                                    <svg class="w-5 h-5 mr-3 group-hover:scale-125 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    QR ლინკზე გადასვლა
                                </a>
                            @endif

                            <form action="{{ route('admin.restaurants.places.destroy', [$restaurant, $place]) }}"
                                method="POST"
                                onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ადგილის წაშლა?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="group w-full inline-flex justify-center items-center px-5 py-3 bg-gradient-to-r from-red-500 via-pink-600 to-rose-600 hover:from-red-600 hover:via-pink-700 hover:to-rose-700 text-white text-sm font-black rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-0.5 border border-red-400/50">
                                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    წაშლა
                                </button>
                            </form>
                            
                        </div>
                    </div>

                    <!-- Luxury Media Section -->
                    @if ($place->image_link || $place->qr_code_image)
                        <div class="space-y-5">
                            <h3 class="text-sm font-black text-gray-700 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                მედია
                            </h3>
                            <div class="space-y-5">
                                @if ($place->image_link)
                                    <div
                                        class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-4 border-2 border-gray-200/50 shadow-lg">
                                        <p class="text-xs font-black text-gray-700 mb-3">ადგილის სურათი:</p>
                                        <div class="relative group">
                                            <img src="{{ $place->image_link }}"
                                                alt="{{ $place->translate('ka')->name ?? ($place->translate('en')->name ?? 'Place Image') }}"
                                                class="w-full h-auto rounded-2xl shadow-xl border-2 border-white ring-2 ring-gray-200/50 group-hover:scale-105 transition-transform duration-300"
                                                style="max-height: 150px; object-fit: cover;">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-black/10 rounded-2xl group-hover:opacity-0 transition-opacity duration-300">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($place->qr_code_image)
                                    <div
                                        class="bg-gradient-to-br from-gray-50 to-emerald-50 rounded-2xl p-4 border-2 border-gray-200/50 shadow-lg">
                                        <p class="text-xs font-black text-gray-700 mb-3">QR კოდი:</p>
                                        <div class="flex items-center justify-center">
                                            <div
                                                class="bg-white border-3 border-gray-300/50 rounded-2xl p-3 shadow-xl transform hover:scale-110 hover:rotate-3 transition-all duration-300">
                                                <img src="{{ $place->qr_code_image }}" alt="QR კოდი"
                                                    class="w-auto h-auto mx-auto"
                                                    style="max-height: 100px; max-width: 100px;">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="{{ $place->qr_code_image }}" target="_blank"
                                                class="w-full inline-flex justify-center items-center px-4 py-3 text-xs font-bold text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-100 hover:from-emerald-100 hover:to-teal-200 rounded-2xl border-2 border-emerald-200/50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                ჩამოტვირთვა
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Enhanced Meta Information -->
                    <div class="space-y-5 pt-5 border-t-2 border-gray-200/50">
                        <h3 class="text-sm font-black text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            სისტემური ინფორმაცია
                        </h3>
                        <div
                            class="bg-gradient-to-br from-gray-50 to-slate-100 rounded-2xl p-4 border-2 border-gray-200/50 shadow-lg">
                            <div class="space-y-3 text-xs text-gray-600">
                                <div class="flex justify-between items-center py-1">
                                    <span class="font-semibold">შექმნის თარიღი:</span>
                                    <span
                                        class="font-black text-gray-800 bg-white px-2 py-1 rounded-lg">{{ $place->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center py-1">
                                    <span class="font-semibold">ბოლო განახლება:</span>
                                    <span
                                        class="font-black text-gray-800 bg-white px-2 py-1 rounded-lg">{{ $place->updated_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center py-1">
                                    <span class="font-semibold">არსებობს:</span>
                                    <span
                                        class="font-black text-blue-700 bg-blue-50 px-2 py-1 rounded-lg">{{ $place->created_at->diffForHumans() }}</span>
                                </div>
                                @if ($place->slug)
                                    <div class="flex justify-between items-center py-1">
                                        <span class="font-semibold">Slug:</span>
                                        <span
                                            class="font-mono text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-lg font-bold">{{ $place->slug }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($place->translate('ka')->description ?? $place->translate('en')->description)
                        <!-- Elegant Description -->
                        <div class="space-y-5 pt-5 border-t-2 border-gray-200/50">
                            <h3 class="text-sm font-black text-gray-700 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                აღწერა
                            </h3>
                            <div
                                class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-100 rounded-2xl p-5 border-2 border-indigo-200/50 shadow-lg">
                                <p class="text-sm text-gray-700 leading-relaxed font-medium">
                                    {{ $place->translate('ka')->description ?? $place->translate('en')->description }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced auto-hide for success/error messages with animation
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                // Add auto-hide functionality
                setTimeout(() => {
                    alert.style.transition = 'all 0.8s ease-out';
                    alert.style.transform = 'translateY(-100px)';
                    alert.style.opacity = '0';
                    alert.style.scale = '0.95';
                    setTimeout(() => {
                        alert.remove();
                    }, 800);
                }, 5000);

                // Add click to dismiss
                alert.addEventListener('click', function() {
                    this.style.transition = 'all 0.5s ease-out';
                    this.style.transform = 'translateX(100%)';
                    this.style.opacity = '0';
                    setTimeout(() => {
                        this.remove();
                    }, 500);
                });
            });

            // Add hover effects for table cards
            const tableCards = document.querySelectorAll('.group');
            tableCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    this.style.transform = 'translateY(-8px) rotate(1deg) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    this.style.transform = 'translateY(0) rotate(0deg) scale(1)';
                });
            });

            // Add floating animation to decorative elements
            const decorativeElements = document.querySelectorAll('[class*="blur-3xl"]');
            decorativeElements.forEach((element, index) => {
                element.style.animation = `float 6s ease-in-out infinite ${index * 2}s`;
            });

            // Add CSS for animations if not already present
            if (!document.querySelector('#custom-animations')) {
                const style = document.createElement('style');
                style.id = 'custom-animations';
                style.textContent = `
                    @keyframes float {
                        0%, 100% { transform: translateY(0px) rotate(0deg); }
                        50% { transform: translateY(-20px) rotate(5deg); }
                    }
                    
                    @keyframes pulse {
                        0%, 100% { opacity: 1; }
                        50% { opacity: 0.7; }
                    }
                    
                    .animate-pulse {
                        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
                    }

                    /* Responsive table card heights */
                    @media (max-width: 768px) {
                        .table-card {
                            min-height: 280px;
                        }
                        .sidebar-sticky {
                            position: relative !important;
                            top: auto !important;
                        }
                    }
                    
                    @media (min-width: 769px) and (max-width: 1279px) {
                        .table-card {
                            min-height: 300px;
                        }
                    }
                    
                    @media (min-width: 1280px) {
                        .table-card {
                            min-height: 320px;
                        }
                        .sidebar-sticky {
                            position: sticky;
                            top: 1rem;
                        }
                    }

                    /* Enhanced card styling */
                    .table-card:hover {
                        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                        border-color: rgba(59, 130, 246, 0.5);
                    }

                    .table-card::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        border-radius: inherit;
                        padding: 2px;
                        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(168, 85, 247, 0.1), rgba(34, 197, 94, 0.1));
                        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                        mask-composite: exclude;
                        opacity: 0;
                        transition: opacity 0.3s ease;
                    }

                    .table-card:hover::before {
                        opacity: 1;
                    }

                    /* Text truncation utility */
                    .line-clamp-2 {
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }

                    /* Responsive grid improvements */
                    @media (max-width: 640px) {
                        .responsive-grid {
                            grid-template-columns: 1fr;
                            gap: 1rem;
                        }
                    }
                    
                    @media (min-width: 641px) and (max-width: 767px) {
                        .responsive-grid {
                            grid-template-columns: repeat(2, 1fr);
                            gap: 1rem;
                        }
                    }

                    @media (min-width: 768px) and (max-width: 1279px) {
                        .responsive-grid {
                            grid-template-columns: repeat(2, 1fr);
                            gap: 1.5rem;
                        }
                    }
                    
                    @media (min-width: 1280px) and (max-width: 1535px) {
                        .responsive-grid {
                            grid-template-columns: repeat(3, 1fr);
                            gap: 1.5rem;
                        }
                    }
                    
                    @media (min-width: 1536px) {
                        .responsive-grid {
                            grid-template-columns: repeat(4, 1fr);
                            gap: 1.5rem;
                        }
                    }

                    /* Text scaling for mobile */
                    @media (max-width: 640px) {
                        .responsive-title {
                            font-size: 1.5rem !important;
                            line-height: 2rem !important;
                        }
                        .responsive-subtitle {
                            font-size: 0.875rem !important;
                        }
                        .responsive-card-title {
                            font-size: 0.75rem !important;
                        }
                        /* Mobile layout optimizations */
                        .main-grid {
                            gap: 1rem;
                        }
                        .place-header {
                            padding: 1rem;
                            border-radius: 1rem;
                        }
                        .table-section {
                            border-radius: 1rem;
                        }
                        .sidebar-section {
                            border-radius: 1rem;
                        }
                    }
                `;
                document.head.appendChild(style);
            }

            // Add intersection observer for fade-in animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Apply fade-in animation to main content areas
            const animatedElements = document.querySelectorAll('.xl\\:col-span-3, .xl\\:col-span-1');
            animatedElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(30px)';
                element.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(element);
            });
        });
    </script>
</x-layouts.app>
