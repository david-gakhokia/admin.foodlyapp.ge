<x-layouts.app :title="'Restaurant Slots - ' . ($restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი #' . $restaurant->id)">
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-bold text-orange-600 bg-orange-50 px-3 py-1 rounded-xl">Restaurant Slots</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-gradient-to-br from-white via-gray-50 to-orange-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-100/30 to-red-100/30 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 via-red-600 to-pink-700 rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-orange-100/50">
                        <svg class="w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <div>
                        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-800 via-gray-900 to-orange-900 mb-3 leading-tight">
                            Restaurant Slots
                        </h1>
                        <p class="text-lg text-gray-600 font-semibold">{{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი #' . $restaurant->id }}</p>
                    </div>
                </div>
                
                <a href="{{ route('admin.restaurants.slots.create', $restaurant) }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 via-red-600 to-pink-600 hover:from-orange-600 hover:via-red-700 hover:to-pink-700 text-white font-bold text-lg rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    ახალი Slot
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-gradient-to-br from-white via-gray-50 to-orange-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl overflow-hidden">
        @if($slots->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-orange-400 via-red-500 to-pink-600">
                            <th class="px-6 py-4 text-left text-sm font-black text-white uppercase tracking-wider">კვირის დღე</th>
                            <th class="px-6 py-4 text-left text-sm font-black text-white uppercase tracking-wider">დროის შუალედი</th>
                            <th class="px-6 py-4 text-left text-sm font-black text-white uppercase tracking-wider">ინტერვალი</th>
                            <th class="px-6 py-4 text-left text-sm font-black text-white uppercase tracking-wider">სტატუსი</th>
                            <th class="px-6 py-4 text-left text-sm font-black text-white uppercase tracking-wider">მოქმედებები</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($slots as $slot)
                            <tr class="hover:bg-orange-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-mono font-bold text-gray-900">
                                        {{ $slot->time_from }} - {{ $slot->time_to }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $slot->slot_interval_minutes }} წუთი
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($slot->available)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            ხელმისაწვდომია
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                            არ არის ხელმისაწვდომი
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.restaurants.slots.show', [$restaurant, $slot]) }}" 
                                           class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            ნახვა
                                        </a>
                                        <a href="{{ route('admin.restaurants.slots.edit', [$restaurant, $slot]) }}" 
                                           class="inline-flex items-center px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            რედაქტირება
                                        </a>
                                        <form action="{{ route('admin.restaurants.slots.destroy', [$restaurant, $slot]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('დარწმუნებული ხართ რომ გსურთ ამ slot-ის წაშლა?')"
                                                    class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                წაშლა
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="p-16 text-center">
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-orange-100 to-red-100 rounded-3xl flex items-center justify-center">
                    <svg class="w-16 h-16 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Slot-ები არ მოიძებნა</h3>
                <p class="text-lg text-gray-600 mb-8">ამ რესტორანისთვის არ არის კონფიგურირებული slot-ები</p>
                <a href="{{ route('admin.restaurants.slots.create', $restaurant) }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 via-red-600 to-pink-600 hover:from-orange-600 hover:via-red-700 hover:to-pink-700 text-white font-bold text-lg rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    პირველი Slot-ის დამატება
                </a>
            </div>
        @endif
    </div>
</x-layouts.app>