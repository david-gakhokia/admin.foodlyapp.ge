<x-layouts.app :title="'ჯავშნები - ' . $restaurant->name">
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">რესტორნის ჯავშნები</h1>
                            <p class="text-white/80 text-sm">{{ $restaurant->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.restaurants.reservations.calendar', $restaurant) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            კალენდარი
                        </a>
                        <a href="{{ route('admin.restaurants.show', $restaurant) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            უკან
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">დაწყების თარიღი</label>
                    <input type="date" name="date_from" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="{{ request('date_from') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">დასრულების თარიღი</label>
                    <input type="date" name="date_to" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="{{ request('date_to') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ტიპი</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">ყველა</option>
                        <option value="restaurant" {{ request('type') == 'restaurant' ? 'selected' : '' }}>რესტორანი</option>
                        <option value="place" {{ request('type') == 'place' ? 'selected' : '' }}>ადგილი</option>
                        <option value="table" {{ request('type') == 'table' ? 'selected' : '' }}>მაგიდა</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">სტატუსი</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">ყველა</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>მოლოდინში</option>
                        <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>დადასტურებული</option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>გაუქმებული</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>დასრულებული</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">მიზეზი</label>
                    <input type="text" name="occasion" placeholder="მაგ. დაბადების დღე..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           value="{{ request('occasion') }}">
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                        ფილტრი
                    </button>
                    <a href="{{ route('admin.restaurants.reservations.index', $restaurant) }}" 
                       class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg transition-colors duration-200">
                        გასუფთავება
                    </a>
                </div>
            </form>
        </div>

        <!-- Quick Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-lg font-semibold text-gray-900">{{ $reservations->total() }}</div>
                        <div class="text-sm text-gray-500">სულ ჯავშნები</div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $reservations->where('status', 'Confirmed')->count() }}
                        </div>
                        <div class="text-sm text-gray-500">დადასტურებული</div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $reservations->where('status', 'Pending')->count() }}
                        </div>
                        <div class="text-sm text-gray-500">მოლოდინში</div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $reservations->sum('guests_count') }}
                        </div>
                        <div class="text-sm text-gray-500">სულ სტუმრები</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations Table -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">ჯავშნების სია</h2>
                <p class="text-sm text-gray-500">სულ {{ $reservations->total() }} ჯავშანი</p>
            </div>

            @if($reservations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მომხმარებელი</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ტიპი/ობიექტი</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">თარიღი/დრო</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტუმრები/ხანგრძლივობა</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტატუსი</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მიზეზი</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მოქმედებები</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $reservation->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $reservation->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->phone }}</div>
                                        @if($reservation->email)
                                            <div class="text-sm text-gray-500">{{ $reservation->email }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $reservation->type == 'restaurant' ? 'bg-blue-100 text-blue-800' : 
                                               ($reservation->type == 'place' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                            {{ $reservation->type == 'restaurant' ? 'რესტორანი' : 
                                               ($reservation->type == 'place' ? 'ადგილი' : 'მაგიდა') }}
                                        </span>
                                        @if($reservation->reservable)
                                            <div class="text-sm text-gray-500 mt-1 max-w-32 truncate" title="{{ $reservation->reservable->name }}">
                                                {{ $reservation->reservable->name }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="font-medium">{{ $reservation->reservation_date->format('d/m/Y') }}</div>
                                        <div class="text-gray-500">{{ $reservation->time_from }} - {{ $reservation->time_to }}</div>
                                        <div class="text-xs text-gray-400">
                                            {{ $reservation->getReservationDateTime()->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="font-medium">{{ $reservation->guests_count }} სტუმარი</div>
                                        <div class="text-xs text-gray-500">
                                            @php
                                                $duration = $reservation->getDurationInMinutes();
                                                if ($duration > 0) {
                                                    $hours = floor($duration / 60);
                                                    $minutes = $duration % 60;
                                                    
                                                    $text = '';
                                                    if ($hours > 0) $text .= $hours . 'ს ';
                                                    $text .= $minutes . 'წთ';
                                                    echo trim($text);
                                                } else {
                                                    echo 'N/A';
                                                }
                                            @endphp
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $reservation->status == 'Confirmed' ? 'bg-green-100 text-green-800' : 
                                               ($reservation->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                ($reservation->status == 'Cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ $reservation->status == 'Confirmed' ? 'დადასტურებული' : 
                                               ($reservation->status == 'Pending' ? 'მოლოდინში' : 
                                                ($reservation->status == 'Cancelled' ? 'გაუქმებული' : 'დასრულებული')) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($reservation->occasion)
                                            <div class="max-w-32 truncate" title="{{ $reservation->occasion }}">
                                                {{ $reservation->occasion }}
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                        @if($reservation->promo_code)
                                            <div class="text-xs text-blue-600 mt-1">
                                                <span class="bg-blue-50 px-1 py-0.5 rounded">{{ $reservation->promo_code }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.restaurants.reservations.show', [$restaurant, $reservation]) }}" 
                                           class="text-blue-600 hover:text-blue-900">ნახვა</a>
                                        <a href="{{ route('admin.restaurants.reservations.edit', [$restaurant, $reservation]) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">რედაქტირება</a>
                                        <form class="inline" method="POST" action="{{ route('admin.restaurants.reservations.destroy', [$restaurant, $reservation]) }}" 
                                              onsubmit="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ ჯავშნის წაშლა?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">წაშლა</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reservations->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">ჯავშნები არ მოიძებნა</h3>
                    <p class="text-gray-500">ამ რესტორანისთვის ჯერ არ არის ჯავშნები.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
