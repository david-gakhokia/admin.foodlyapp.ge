<x-layouts.app :title="'Place Slots Management - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი')">
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto py-8 px-4">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">დროის ლოტები</h1>
                        <p class="text-gray-600 mt-1">{{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }}</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.restaurants.places.tables.slots.create', [$restaurant, $place, $table]) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white border border-transparent rounded-xl font-semibold text-sm transition-all duration-200 transform hover:scale-105 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        ახალი ლოტი
                    </a>
                    <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        დაბრუნება
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">სულ ლოტები</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $table->reservationSlots->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">ხელმისაწვდომი</p>
                        <p class="text-2xl font-bold text-green-600">{{ $table->reservationSlots->where('available', true)->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">არაა ხელმისაწვდომი</p>
                        <p class="text-2xl font-bold text-red-600">{{ $table->reservationSlots->where('available', false)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

    <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
        <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">მაგიდის დროის ლოტები</h3>
                <p class="text-sm text-gray-600 mt-1">მართეთ თქვენი რესტორნის დროის ლოტები</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>დღე</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>დრო</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <span>ინტერვალი</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>სტატუსი</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">მოქმედებები</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($table->reservationSlots as $slot)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-lg flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">
                                                    @switch($slot->day_of_week)
                                                        @case('Monday') ორ @break
                                                        @case('Tuesday') სამ @break
                                                        @case('Wednesday') ოთხ @break
                                                        @case('Thursday') ხუთ @break
                                                        @case('Friday') პარ @break
                                                        @case('Saturday') შაბ @break
                                                        @case('Sunday') კვი @break
                                                        @default {{ substr($slot->day_of_week, 0, 3) }}
                                                    @endswitch
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                @switch($slot->day_of_week)
                                                    @case('Monday') ორშაბათი @break
                                                    @case('Tuesday') სამშაბათი @break
                                                    @case('Wednesday') ოთხშაბათი @break
                                                    @case('Thursday') ხუთშაბათი @break
                                                    @case('Friday') პარასკევი @break
                                                    @case('Saturday') შაბათი @break
                                                    @case('Sunday') კვირა @break
                                                    @default {{ $slot->day_of_week }}
                                                @endswitch
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($slot->time_from)->format('H:i') }}
                                        </div>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                        <div class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($slot->time_to)->format('H:i') }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $slot->slot_interval_minutes }} წუთი
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($slot->available)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            ხელმისაწვდომია
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            არ არის ხელმისაწვდომი
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.restaurants.places.tables.slots.edit', [$restaurant, $place, $table, $slot]) }}" class="inline-flex items-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            რედ.
                                        </a>
                                        <form action="{{ route('admin.restaurants.places.tables.slots.destroy', [$restaurant, $place, $table, $slot]) }}" method="POST" class="inline-block" onsubmit="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ ლოტის წაშლა?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                წაშლა
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">ლოტები არ არის დამატებული</h3>
                                        <p class="text-gray-500 mb-4">დაიწყეთ პირველი დროის ლოტის დამატებით</p>
                                        <button class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200" onclick="window.location.href='{{ route('admin.restaurants.places.tables.slots.create', [$restaurant, $place, $table]) }}'">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            ლოტის დამატება
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>