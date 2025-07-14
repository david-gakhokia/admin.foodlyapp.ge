<x-layouts.app :title="'Slot-ის დეტალები - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი')">
    <!-- Header -->
    <div class="mb-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl px-6 py-3 shadow-lg">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.restaurants.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        რესტორნები
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            {{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->translations->where('locale', 'en')->first()?->name ?? 'უცნობი რესტორანი' }}
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.places.show', [$restaurant, $place]) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            {{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.places.slots.index', [$restaurant, $place]) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            Slots
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-bold text-green-600 bg-green-50 px-3 py-1 rounded-xl">დეტალები</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-gradient-to-br from-white via-gray-50 to-green-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-green-100/30 to-blue-100/30 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-700 rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-green-100/50">
                        <svg class="w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            Slot-ის დეტალები
                        </h1>
                        <p class="text-lg text-gray-600 font-medium">
                            {{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.restaurants.places.slots.edit', [$restaurant, $place, $slot]) }}" 
                       class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl shadow-lg hover:from-amber-700 hover:to-orange-700 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        რედაქტირება
                    </a>
                    <a href="{{ route('admin.restaurants.places.slots.index', [$restaurant, $place]) }}" 
                       class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-xl shadow-lg hover:from-gray-700 hover:to-gray-800 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        უკან დაბრუნება
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Slot Details Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100/30 to-purple-100/30 rounded-full -translate-y-16 translate-x-16 blur-2xl"></div>
            
            <div class="relative">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2m-2-2v4m0 0v4m0-4h4m-4 0H9m0 0a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Slot-ის მონაცემები</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Day of Week -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">კვირის დღე</label>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-lg font-medium text-gray-900">
                                @php
                                    $days = [
                                        1 => 'ორშაბათი',
                                        2 => 'სამშაბათი',
                                        3 => 'ოთხშაბათი',
                                        4 => 'ხუთშაბათი',
                                        5 => 'პარასკევი',
                                        6 => 'შაბათი',
                                        0 => 'კვირა'
                                    ];
                                @endphp
                                {{ $days[$slot->day_of_week] ?? 'უცნობი' }}
                            </span>
                        </div>
                    </div>

                    <!-- Time From -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">დაწყების დრო</label>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-lg font-medium text-gray-900">{{ $slot->time_from ?? 'უცნობი' }}</span>
                        </div>
                    </div>

                    <!-- Time To -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">დამთავრების დრო</label>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-lg font-medium text-gray-900">{{ $slot->time_to ?? 'უცნობი' }}</span>
                        </div>
                    </div>

                    <!-- Slot Interval -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ინტერვალი (წუთი)</label>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-lg font-medium text-gray-900">{{ $slot->slot_interval_minutes ?? 'უცნობი' }} წუთი</span>
                        </div>
                    </div>

                    <!-- Availability Status -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30 sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ხელმისაწვდომობა</label>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 {{ $slot->available ? 'bg-green-100' : 'bg-red-100' }} rounded-lg flex items-center justify-center">
                                @if($slot->available)
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @endif
                            </div>
                            <span class="text-lg font-medium {{ $slot->available ? 'text-green-700' : 'text-red-700' }}">
                                {{ $slot->available ? 'ხელმისაწვდომი' : 'არ არის ხელმისაწვდომი' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Place Information Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-100/30 to-pink-100/30 rounded-full -translate-y-16 translate-x-16 blur-2xl"></div>
            
            <div class="relative">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-pink-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">ადგილის მონაცემები</h2>
                </div>

                <div class="space-y-4">
                    <!-- Place Name -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ადგილის სახელი</label>
                        <span class="text-lg font-medium text-gray-900">
                            {{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}
                        </span>
                    </div>

                    <!-- Restaurant Name -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">რესტორანი</label>
                        <span class="text-lg font-medium text-gray-900">
                            {{ $restaurant->translations->where('locale', 'ka')->first()?->name ?? $restaurant->translations->where('locale', 'en')->first()?->name ?? 'უცნობი რესტორანი' }}
                        </span>
                    </div>

                    <!-- Place Description -->
                    @if($place->translations->where('locale', 'ka')->first()?->description ?? $place->translations->where('locale', 'en')->first()?->description)
                        <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">აღწერა</label>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $place->translations->where('locale', 'ka')->first()?->description ?? $place->translations->where('locale', 'en')->first()?->description }}
                            </p>
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/30">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">შექმნის თარიღი</label>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600">{{ $slot->created_at ? $slot->created_at->format('Y-m-d H:i') : 'უცნობი თარიღი' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="mt-8 bg-gradient-to-r from-gray-50 to-white rounded-3xl p-8 shadow-xl border border-gray-200/50">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">მოქმედებები</h3>
                <p class="text-gray-600">აირჩიეთ შესაბამისი მოქმედება</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.restaurants.places.slots.edit', [$restaurant, $place, $slot]) }}" 
                   class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    რედაქტირება
                </a>
                <form action="{{ route('admin.restaurants.places.slots.destroy', [$restaurant, $place, $slot]) }}" method="POST" class="inline" onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ Slot-ის წაშლა?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:from-red-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        წაშლა
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
