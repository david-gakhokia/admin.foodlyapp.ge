<x-layouts.app :title="'Place Slots Management - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი')">
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-xl">Slots</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-gradient-to-br from-white via-gray-50 to-blue-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100/30 to-purple-100/30 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-700 rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-indigo-100/50">
                        <svg class="w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <div>
                        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-800 via-gray-900 to-indigo-900 mb-3 leading-tight">
                            {{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }} - Slots
                        </h1>
                        <div class="flex flex-wrap items-center gap-4 text-sm">
                            <span class="flex items-center bg-white/70 backdrop-blur-sm rounded-xl px-4 py-2 shadow-md border border-gray-200/50">
                                <span class="font-bold text-indigo-700">სულ {{ $slots->count() }} Slot</span>
                            </span>
                            <span class="flex items-center bg-white/70 backdrop-blur-sm rounded-xl px-4 py-2 shadow-md border border-gray-200/50">
                                <span class="font-bold text-emerald-700">{{ $slots->where('available', true)->count() }} ხელმისაწვდომი</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('admin.restaurants.places.slots.create', [$restaurant, $place]) }}" 
                       class="group inline-flex items-center px-6 py-3.5 bg-gradient-to-r from-emerald-500 via-teal-600 to-cyan-600 hover:from-emerald-600 hover:via-teal-700 hover:to-cyan-700 text-white font-bold rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        ახალი Slot
                    </a>
                    <a href="{{ route('admin.restaurants.places.show', [$restaurant, $place]) }}" 
                       class="group inline-flex items-center px-6 py-3.5 bg-white/80 hover:bg-white backdrop-blur-sm text-gray-700 hover:text-gray-900 border-2 border-gray-300/50 hover:border-gray-400 font-bold rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        უკან
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slots List -->
    <div class="bg-gradient-to-br from-white via-gray-50 to-blue-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-400 via-purple-500 to-pink-600 px-8 py-6">
            <h2 class="text-2xl font-black text-white drop-shadow-md">Reservation Slots</h2>
        </div>
        
        <div class="p-8">
            @if($slots->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($slots as $slot)
                        <div class="bg-gradient-to-br from-white via-gray-50 to-blue-50 border-2 border-gray-200/50 rounded-2xl p-6 hover:shadow-2xl hover:border-indigo-300/50 transition-all duration-500 transform hover:-translate-y-2">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-black text-gray-900 text-lg">
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
                                </h3>
                                @if($slot->available)
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-500 text-white">
                                        ხელმისაწვდომია
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-red-500 text-white">
                                        არ არის ხელმისაწვდომი
                                    </span>
                                @endif
                            </div>
                            
                            <div class="space-y-3 mb-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-gray-600">დრო:</span>
                                    <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($slot->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->time_to)->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-gray-600">ინტერვალი:</span>
                                    <span class="font-bold text-gray-800">{{ $slot->slot_interval_minutes }} წუთი</span>
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('admin.restaurants.places.slots.edit', [$restaurant, $place, $slot]) }}" 
                                   class="flex-1 inline-flex justify-center items-center px-4 py-2 text-sm font-bold text-amber-700 bg-amber-100 hover:bg-amber-200 rounded-xl transition-all duration-300">
                                    რედაქტირება
                                </a>
                                <form action="{{ route('admin.restaurants.places.slots.destroy', [$restaurant, $place, $slot]) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('ნამდვილად გსურთ ამ slot-ის წაშლა?')"
                                            class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-bold text-red-700 bg-red-100 hover:bg-red-200 rounded-xl transition-all duration-300">
                                        წაშლა
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-28 h-28 bg-gradient-to-br from-indigo-400 via-purple-500 to-pink-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
                        <svg class="w-14 h-14 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-4">ჯერ არ არის Slots</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto text-lg">ამ ადგილს ჯერ არ აქვს დამატებული reservation slots.</p>
                    <a href="{{ route('admin.restaurants.places.slots.create', [$restaurant, $place]) }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 via-teal-600 to-cyan-600 hover:from-emerald-600 hover:via-teal-700 hover:to-cyan-700 text-white font-black rounded-3xl shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        პირველი Slot-ის დამატება
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
