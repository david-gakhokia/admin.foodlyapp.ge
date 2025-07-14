<x-layouts.app :title="'Restaurant Slot Details - ' . ($restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი #' . $restaurant->id)">
    <!-- Header -->
    <div class="mb-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl px-6 py-3 shadow-lg">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.restaurants.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                        რესტორნები
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            {{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი' }}
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.slots.index', $restaurant) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            Restaurant Slots
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-xl">Slot Details</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-gradient-to-br from-white via-gray-50 to-blue-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100/30 to-indigo-100/30 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-700 rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-blue-100/50">
                        <svg class="w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <div>
                        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-800 via-gray-900 to-blue-900 mb-3 leading-tight">
                            Restaurant Slot Details
                        </h1>
                        <p class="text-lg text-gray-600 font-semibold">{{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი #' . $restaurant->id }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.restaurants.slots.edit', [$restaurant, $slot]) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 via-red-600 to-pink-600 hover:from-orange-600 hover:via-red-700 hover:to-pink-700 text-white font-bold text-sm rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        რედაქტირება
                    </a>
                    <a href="{{ route('admin.restaurants.slots.index', $restaurant) }}" 
                       class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 hover:text-gray-900 border-2 border-gray-300 hover:border-gray-400 font-bold text-sm rounded-xl shadow-lg transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        უკან
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-gradient-to-br from-white via-gray-50 to-blue-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600 px-8 py-6">
            <h2 class="text-2xl font-black text-white drop-shadow-md">Slot-ის ინფორმაცია</h2>
        </div>
        
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Day of Week -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/50">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">კვირის დღე</h3>
                            <p class="text-sm text-gray-600">ეს slot მუშაობს შემდეგ დღეს</p>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-blue-600">
                        @switch($slot->day_of_week)
                            @case('Monday')
                                ორშაბათი
                                @break
                            @case('Tuesday')
                                სამშაბათი
                                @break
                            @case('Wednesday')
                                ოთხშაბათი
                                @break
                            @case('Thursday')
                                ხუთშაბათი
                                @break
                            @case('Friday')
                                პარასკევი
                                @break
                            @case('Saturday')
                                შაბათი
                                @break
                            @case('Sunday')
                                კვირა
                                @break
                            @default
                                {{ $slot->day_of_week }}
                        @endswitch
                    </div>
                </div>

                <!-- Time Range -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/50">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">დროის შუალედი</h3>
                            <p class="text-sm text-gray-600">მუშაობის საათები</p>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-green-600 font-mono">
                        {{ $slot->time_from }} - {{ $slot->time_to }}
                    </div>
                </div>

                <!-- Slot Interval -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/50">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">ინტერვალი</h3>
                            <p class="text-sm text-gray-600">slot-ების ხანგრძლივობა</p>
                        </div>
                    </div>
                    <div class="text-2xl font-black text-purple-600">
                        {{ $slot->slot_interval_minutes }} წუთი
                    </div>
                </div>

                <!-- Availability Status -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/50">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-{{ $slot->available ? 'green' : 'red' }}-500 to-{{ $slot->available ? 'emerald' : 'pink' }}-600 rounded-xl flex items-center justify-center">
                            @if($slot->available)
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">ხელმისაწვდომობა</h3>
                            <p class="text-sm text-gray-600">რეზერვაციის სტატუსი</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($slot->available)
                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-lg font-bold bg-green-100 text-green-800">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                ხელმისაწვდომია
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-lg font-bold bg-red-100 text-red-800">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                არ არის ხელმისაწვდომი
                            </span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
