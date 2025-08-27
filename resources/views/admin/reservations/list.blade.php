<x-layouts.app :title="'რეზერვაციების მართვა'">
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Header -->
            <header class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">რეზერვაციების მართვა</h1>
                        <p class="text-sm text-gray-500 mt-1">მენეჯმენტი — ყველა რესტორნისთვის</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $reservations->total() }} ჯავშანი
                        </span>
                    </div>
                </div>
            </header>

            <!-- Stats Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Reservations -->
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0h6m-6 0a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1V8a1 1 0 00-1-1"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-500">სულ ჯავშნები</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservations->total() ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Today's Reservations -->
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-500">დღევანდელი</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $todayReservations ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Confirmed Today -->
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-500">დადასტურებული</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $confirmedToday ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Calendar Toggle -->
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">
                    <a href="{{ route('admin.reservation.calendar') }}" 
                       class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span>კალენდარი</span>
                    </a>
                </div>
            </div>

            <!-- Quick Reservation Modal -->
            <div id="reservationQuickModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-auto overflow-hidden">
                    <div class="flex items-center justify-between p-5 border-b border-gray-200">
                        <h3 id="quickModalTitle" class="text-lg font-semibold text-gray-900">ჯავშნის დეტალები</h3>
                        <button id="quickModalClose" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    <div id="quickModalContent" class="p-6 max-h-[70vh] overflow-y-auto">
                        <div class="flex items-center justify-center py-8 text-gray-500">
                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mr-3"></div>
                            იტვირთება...
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 p-5 border-t border-gray-200 bg-gray-50">
                        <button id="quickModalEdit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            რედაქტირება
                        </button>
                        <button id="quickModalCloseBottom" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">
                            დახურვა
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Layout Grid: Filters + Full Width Table -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Filters Section (Sidebar) -->
                <aside class="lg:w-80 xl:w-80 flex-shrink-0">
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 sticky top-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">ფილტრები</h3>
                    <form method="GET" action="{{ route('admin.reservations.list') }}" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">დაწყების თარიღი</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">დასრულების თარიღი</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ტიპი</label>
                            <select name="type" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm transition-colors">
                                <option value="">ყველა</option>
                                <option value="restaurant" {{ request('type') == 'restaurant' ? 'selected' : '' }}>რესტორანი</option>
                                <option value="place" {{ request('type') == 'place' ? 'selected' : '' }}>ადგილი</option>
                                <option value="table" {{ request('type') == 'table' ? 'selected' : '' }}>მაგიდა</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">სტატუსი</label>
                            <select name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm transition-colors">
                                <option value="">ყველა</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>მოლოდინში</option>
                                <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>დადასტურებული</option>
                                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>გაუქმებული</option>
                                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>დასრულებული</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">რესტორანი</label>
                            @php
                                // Restaurant names are stored in translations table (Astrotomic Translatable).
                                // Load translations and sort in PHP to avoid ordering by non-existent `name` column on restaurants table.
                                $restaurants = \App\Models\Restaurant::with('translations')->get()->sortBy('name')->pluck('name','id');
                            @endphp
                            <select name="restaurant_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm transition-colors">
                                <option value="">ყველა რესტორანი</option>
                                @foreach($restaurants as $id => $name)
                                    <option value="{{ $id }}" {{ request('restaurant_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ძიება (სახელი/ტელეფონი)</label>
                            <input type="search" name="q" value="{{ request('q') }}" placeholder="სახელი ან ტელეფონი" 
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 text-sm transition-colors">
                        </div>

                        <div class="flex items-center gap-3 pt-4">
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                ფილტრი
                            </button>
                            <a href="{{ route('admin.reservations.list') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium transition-colors">
                                გასუფთავება
                            </a>
                        </div>
                    </form>

                  
                </div>
            </aside>

            <!-- Main Reservations Table (Full Width) -->
            <main class="flex-1 min-w-0">
                <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">ჯავშნების სია</h3>
                        <div class="flex items-center space-x-4">
                            <div class="text-sm text-gray-500">სულ: {{ $reservations->total() }} ჯავშანი</div>
                        </div>
                    </div>

                    <!-- Status Filter Chips -->
                    <div class="flex items-center gap-2 mb-6 flex-wrap">
                        @php
                            $statuses = ['' => 'ყველა', 'Pending' => 'მოლოდინში', 'Confirmed' => 'დადასტურებული', 'Cancelled' => 'გაუქმებული', 'Completed' => 'დასრულებული'];
                        @endphp
                        @foreach($statuses as $key => $label)
                            <a href="{{ request()->fullUrlWithQuery(['status' => $key ?: null, 'page' => 1]) }}" 
                               class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium border transition-colors
                                      {{ request('status') === $key ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Reservations Table -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მომხმარებელი</th>
                                        <th class="hidden md:table-cell px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ადგილი</th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">თარიღი/დრო</th>
                                        <th class="hidden sm:table-cell px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტუმრები</th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტატუსი</th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მოქმედებები</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reservations as $reservation)
                                    @php
                                        $restaurantId = $reservation->type === 'restaurant' && $reservation->reservable_type === 'App\\Models\\Restaurant'
                                            ? $reservation->reservable_id
                                            : ($reservation->reservable?->restaurant_id ?? '');
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition-colors duration-150" data-href="{{ route('admin.restaurants.reservations.show', [$restaurantId, $reservation->id]) }}">
                                        <td class="px-4 lg:px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $reservation->id }}
                                        </td>
                                        <td class="px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <div class="h-8 lg:h-10 w-8 lg:w-10 rounded-full bg-gray-200 flex items-center justify-center mr-2 lg:mr-3 flex-shrink-0">
                                                    <span class="text-xs lg:text-sm font-medium text-gray-600">
                                                        {{ strtoupper(substr($reservation->name ?? 'U', 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="font-medium text-gray-900 text-sm lg:text-base truncate">{{ $reservation->name }}</div>
                                                    <div class="text-xs lg:text-sm text-gray-500 truncate">{{ $reservation->phone }}</div>
                                                    @if($reservation->email)
                                                        <div class="text-xs text-gray-500 truncate hidden lg:block">{{ $reservation->email }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden md:table-cell px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium">{{ $reservation->type == 'restaurant' ? 'რესტორანი' : ($reservation->type == 'place' ? 'ადგილი' : 'მაგიდა') }}</div>
                                                <div class="text-xs lg:text-sm text-gray-500 truncate">{{ $reservation->reservable?->name ?? '—' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium text-xs lg:text-sm">{{ $reservation->reservation_date->format('d/m/Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ $reservation->time_from }} - {{ $reservation->time_to }}</div>
                                            </div>
                                        </td>
                                        <td class="hidden sm:table-cell px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <svg class="w-3 lg:w-4 h-3 lg:h-4 text-gray-400 mr-1 lg:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span class="font-medium text-xs lg:text-sm">{{ $reservation->guests_count }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 lg:px-6 py-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $reservation->status == 'Confirmed' ? 'bg-green-100 text-green-800' : 
                                                   ($reservation->status == 'Pending' ? 'bg-amber-100 text-amber-800' : 
                                                    ($reservation->status == 'Cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                                {{ $reservation->status == 'Confirmed' ? 'დადასტურებული' : 
                                                   ($reservation->status == 'Pending' ? 'მოლოდინში' : 
                                                    ($reservation->status == 'Cancelled' ? 'გაუქმებული' : 'დასრულებული')) }}
                                            </span>
                                        </td>
                                        <td class="px-4 lg:px-6 py-3 text-sm font-medium">
                                            <div class="flex space-x-1 lg:space-x-2">
                                                <a href="{{ route('admin.restaurants.reservations.show', [$restaurantId, $reservation->id]) }}" 
                                                   class="inline-flex items-center gap-1 px-2 lg:px-3 py-1 lg:py-1.5 text-xs lg:text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                    <svg class="w-3 lg:w-4 h-3 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    <span class="hidden lg:inline"></span>
                                                </a>

                                                <a href="{{ route('admin.restaurants.reservations.edit', [$restaurantId, $reservation->id]) }}" 
                                                   class="inline-flex items-center gap-1 px-2 lg:px-3 py-1 lg:py-1.5 text-xs lg:text-sm font-medium text-blue-700 bg-white border border-blue-300 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                    <svg class="w-3 lg:w-4 h-3 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    <span class="hidden lg:inline"></span>
                                                </a>

                                                <form class="inline" method="POST" action="{{ route('admin.restaurants.reservations.destroy', [$restaurantId, $reservation->id]) }}" onsubmit="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ ჯავშნის წაშლა?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-2 lg:px-3 py-1 lg:py-1.5 text-xs lg:text-sm font-medium text-red-700 bg-white border border-red-300 rounded-md hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                        <svg class="w-3 lg:w-4 h-3 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        <span class="hidden lg:inline"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                    <!-- Empty State -->
                    @if($reservations->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0h6m-6 0a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1V8a1 1 0 00-1-1"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">ჯავშნები არ არის</h3>
                            <p class="mt-1 text-sm text-gray-500">ახალი ჯავშნების შექმნა რესტორნის გვერდიდან</p>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($reservations->hasPages())
                        <div class="bg-white px-6 py-4 border-t border-gray-200 rounded-b-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    @if ($reservations->onFirstPage())
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                            წინა
                                        </span>
                                    @else
                                        <a href="{{ $reservations->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                            წინა
                                        </a>
                                    @endif

                                    @if ($reservations->hasMorePages())
                                        <a href="{{ $reservations->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                            შემდეგი
                                        </a>
                                    @else
                                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                            შემდეგი
                                        </span>
                                    @endif
                                </div>

                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            ნაჩვენებია <span class="font-medium">{{ $reservations->firstItem() }}</span> დან <span class="font-medium">{{ $reservations->lastItem() }}</span> მდე
                                            <span class="font-medium">{{ $reservations->total() }}</span> შედეგიდან
                                        </p>
                                    </div>
                                    <div>
                                        {{ $reservations->withQueryString()->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Simple test for navigation -->
    <script>
        console.log('✅ ჯავშნების მართვა გვერდი ჩაიტვირთა');
    </script>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
        <style>
            /* Mobile responsive adjustments */
            @media (max-width: 1023px) {
                .lg\:col-span-3 {
                    grid-column: span 12;
                }
                .lg\:col-span-6 {
                    grid-column: span 12;
                }
                .lg\:hidden {
                    display: block;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('🚀 JavaScript loaded');
                
                // Calendar Modal Functionality
                const toggleCalendarBtn = document.getElementById('toggleCalendarBtn');
                const calendarModal = document.getElementById('calendarModal');
                const calendarModalClose = document.getElementById('calendarModalClose');
                
                console.log('📋 Elements found:', {
                    toggleBtn: !!toggleCalendarBtn,
                    modal: !!calendarModal,
                    close: !!calendarModalClose
                });
                
                let calendar = null;

                if (toggleCalendarBtn && calendarModal) {
                    console.log('✅ Adding click listener to calendar button');
                    toggleCalendarBtn.addEventListener('click', function() {
                        console.log('🖱️ Calendar button clicked!');
                        calendarModal.classList.remove('hidden');
                        calendarModal.classList.add('flex');
                        
                        // Initialize calendar if not already done
                        if (!calendar) {
                            console.log('📅 Initializing FullCalendar...');
                            const calendarEl = document.getElementById('calendar');
                            
                            if (!window.FullCalendar) {
                                console.error('❌ FullCalendar library not loaded!');
                                alert('კალენდარის ბიბლიოთეკა ჩატვირთული არ არის. გთხოვთ განაახლოთ გვერდი.');
                                return;
                            }
                            
                            calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                height: 'auto',
                                locale: 'ka',
                                headerToolbar: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                                },
                                buttonText: {
                                    today: 'დღეს',
                                    month: 'თვე',
                                    week: 'კვირა',
                                    day: 'დღე',
                                    list: 'სია'
                                },
                                // Use AJAX to fetch events
                                events: {
                                    url: '/api/reservations/events/all',
                                    method: 'GET',
                                    extraParams: function() {
                                        // Get current filter values
                                        const urlParams = new URLSearchParams(window.location.search);
                                        return {
                                            status: urlParams.get('status') || '',
                                            restaurant_id: urlParams.get('restaurant_id') || ''
                                        };
                                    },
                                    failure: function() {
                                        console.error('კალენდარის events-ების ჩატვირთვა ვერ მოხერხდა');
                                    }
                                },
                                eventDisplay: 'block',
                                dayMaxEvents: 3,
                                moreLinkClick: 'popover',
                                eventClick: function(info) {
                                    // Show event details in modal instead of navigation
                                    showEventDetails(info.event);
                                    info.jsEvent.preventDefault(); // Don't follow the URL
                                },
                                eventMouseEnter: function(info) {
                                    // Show tooltip on hover
                                    const props = info.event.extendedProps;
                                    const tooltip = `
                                        <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 shadow-lg">
                                            <div><strong>${props.customerName}</strong></div>
                                            <div>📞 ${props.customerPhone}</div>
                                            <div>👥 ${props.partySize} სტუმარი</div>
                                            <div>📍 ${props.reservableName}</div>
                                            <div>📋 ${props.status}</div>
                                        </div>
                                    `;
                                    // Simple tooltip implementation
                                    info.el.title = `${props.customerName} - ${props.partySize} სტუმარი - ${props.status}`;
                                },
                                loading: function(isLoading) {
                                    if (isLoading) {
                                        console.log('კალენდარი იტვირთება...');
                                    }
                                },
                                // Date click to create new reservation
                                dateClick: function(info) {
                                    const selectedDate = info.dateStr;
                                    // TODO: Open create reservation modal with pre-filled date
                                    console.log('ახალი ჯავშნის შექმნა:', selectedDate);
                                }
                            });
                            console.log('🎯 Calendar initialized, rendering...');
                            calendar.render();
                            console.log('✅ Calendar rendered successfully!');
                        } else {
                            console.log('🔄 Refetching calendar events...');
                            // Refetch events if calendar already exists
                            calendar.refetchEvents();
                        }
                    });

                    calendarModalClose.addEventListener('click', function() {
                        console.log('❌ Closing calendar modal');
                        calendarModal.classList.add('hidden');
                        calendarModal.classList.remove('flex');
                    });

                    // Close modal on backdrop click
                    calendarModal.addEventListener('click', function(e) {
                        if (e.target === calendarModal) {
                            calendarModal.classList.add('hidden');
                            calendarModal.classList.remove('flex');
                        }
                    });
                }

                // Event Details Modal Function
                function showEventDetails(event) {
                    const props = event.extendedProps;
                    const startTime = new Date(event.start).toLocaleTimeString('ka-GE', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const endTime = event.end ? new Date(event.end).toLocaleTimeString('ka-GE', {
                        hour: '2-digit',
                        minute: '2-digit'
                    }) : '';

                    const detailsHTML = `
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">სტუმრის სახელი</label>
                                    <p class="text-lg font-semibold">${props.customerName}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">სტატუსი</label>
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full 
                                        ${getStatusClass(props.status)}">
                                        ${getStatusText(props.status)}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">დრო</label>
                                    <p>${startTime}${endTime ? ' - ' + endTime : ''}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">სტუმრების რაოდენობა</label>
                                    <p>${props.partySize} სტუმარი</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500">ლოკაცია</label>
                                <p>${props.reservableName}</p>
                            </div>
                            
                            ${props.customerPhone ? `
                                <div>
                                    <label class="text-sm font-medium text-gray-500">ტელეფონი</label>
                                    <p>${props.customerPhone}</p>
                                </div>
                            ` : ''}
                            
                            ${props.customerEmail ? `
                                <div>
                                    <label class="text-sm font-medium text-gray-500">ელ. ფოსტა</label>
                                    <p>${props.customerEmail}</p>
                                </div>
                            ` : ''}
                        </div>
                    `;

                    // Show in existing quick modal
                    const quickModal = document.getElementById('reservationQuickModal');
                    const quickModalTitle = document.getElementById('quickModalTitle');
                    const quickModalContent = document.getElementById('quickModalContent');
                    
                    if (quickModal && quickModalTitle && quickModalContent) {
                        quickModalTitle.textContent = 'ჯავშნის დეტალები';
                        quickModalContent.innerHTML = detailsHTML;
                        quickModal.classList.remove('hidden');
                        quickModal.classList.add('flex');
                    }
                }

                // Helper functions for status
                function getStatusClass(status) {
                    switch (status) {
                        case 'Pending': return 'bg-amber-100 text-amber-800';
                        case 'Confirmed': return 'bg-green-100 text-green-800';
                        case 'Cancelled': return 'bg-red-100 text-red-800';
                        case 'Completed': return 'bg-blue-100 text-blue-800';
                        default: return 'bg-gray-100 text-gray-800';
                    }
                }

                function getStatusText(status) {
                    switch (status) {
                        case 'Pending': return 'მოლოდინში';
                        case 'Confirmed': return 'დადასტურებული';
                        case 'Cancelled': return 'გაუქმებული';
                        case 'Completed': return 'დასრულებული';
                        default: return status;
                    }
                }

                // Quick Modal Close Functionality
                const quickModal = document.getElementById('reservationQuickModal');
                const quickModalClose = document.getElementById('quickModalClose');
                const quickModalCloseBottom = document.getElementById('quickModalCloseBottom');

                function closeQuickModal() {
                    if (quickModal) {
                        quickModal.classList.add('hidden');
                        quickModal.classList.remove('flex');
                    }
                }

                if (quickModalClose) {
                    quickModalClose.addEventListener('click', closeQuickModal);
                }
                if (quickModalCloseBottom) {
                    quickModalCloseBottom.addEventListener('click', closeQuickModal);
                }
                if (quickModal) {
                    quickModal.addEventListener('click', function(e) {
                        if (e.target === quickModal) {
                            closeQuickModal();
                        }
                    });
                }

                // Calendar Filters Functionality
                const calendarStatusFilter = document.getElementById('calendarStatusFilter');
                const calendarRestaurantFilter = document.getElementById('calendarRestaurantFilter');
                const calendarRefresh = document.getElementById('calendarRefresh');

                function refreshCalendarWithFilters() {
                    if (calendar) {
                        // Update the events source with new filters
                        calendar.removeAllEventSources();
                        calendar.addEventSource({
                            url: '/api/reservations/events/all',
                            method: 'GET',
                            extraParams: {
                                status: calendarStatusFilter?.value || '',
                                restaurant_id: calendarRestaurantFilter?.value || ''
                            },
                            failure: function() {
                                console.error('კალენდარის events-ების ჩატვირთვა ვერ მოხერხდა');
                            }
                        });
                    }
                }

                if (calendarStatusFilter) {
                    calendarStatusFilter.addEventListener('change', refreshCalendarWithFilters);
                }
                if (calendarRestaurantFilter) {
                    calendarRestaurantFilter.addEventListener('change', refreshCalendarWithFilters);
                }
                if (calendarRefresh) {
                    calendarRefresh.addEventListener('click', refreshCalendarWithFilters);
                }

                // Filter functionality
                const filterButtons = document.querySelectorAll('[data-filter]');
                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const filter = this.dataset.filter;
                        
                        // Update active state
                        filterButtons.forEach(btn => btn.classList.remove('bg-blue-600', 'text-white'));
                        filterButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-700'));
                        
                        this.classList.remove('bg-gray-100', 'text-gray-700');
                        this.classList.add('bg-blue-600', 'text-white');
                        
                        // Apply filter to URL
                        const url = new URL(window.location);
                        if (filter === 'all') {
                            url.searchParams.delete('status');
                        } else {
                            url.searchParams.set('status', filter);
                        }
                        window.location.href = url.toString();
                    });
                });

                // Table row click handlers
                const tableRows = document.querySelectorAll('tr[data-href]');
                tableRows.forEach(row => {
                    row.addEventListener('click', function(e) {
                        // Don't navigate if clicking on action buttons
                        if (e.target.closest('button') || e.target.closest('a')) {
                            return;
                        }
                        window.location.href = this.dataset.href;
                    });
                });

                // Modal functionality
                window.viewReservation = function(id) {
                    // Implementation for view modal
                    console.log('View reservation:', id);
                };

                window.editReservation = function(id) {
                    // Implementation for edit modal
                    console.log('Edit reservation:', id);
                };

                window.deleteReservation = function(id) {
                    if (confirm('დარწმუნებული ხართ, რომ გსურთ ამ ჯავშნის წაშლა?')) {
                        // Implementation for delete
                        console.log('Delete reservation:', id);
                    }
                };

                // Search functionality
                const searchInput = document.querySelector('input[type="search"]');
                if (searchInput) {
                    let searchTimeout;
                    searchInput.addEventListener('input', function() {
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(() => {
                            const searchTerm = this.value;
                            const url = new URL(window.location);
                            if (searchTerm) {
                                url.searchParams.set('search', searchTerm);
                            } else {
                                url.searchParams.delete('search');
                            }
                            window.location.href = url.toString();
                        }, 500);
                    });
                }
            });
    @endpush
</x-layouts.app>
