<x-layouts.app :title="'ჯავშნის დეტალები #' . $reservation->id">
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">ჯავშნის დეტალები #{{ $reservation->id }}</h1>
                            <p class="text-white/80 text-sm">{{ $restaurant->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.restaurants.reservations.edit', [$restaurant, $reservation]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            რედაქტირება
                        </a>
                        <a href="{{ route('admin.restaurants.reservations.index', $restaurant) }}" 
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Information -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            მომხმარებლის ინფორმაცია
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">სახელი</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-medium">{{ $reservation->name }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ტელეფონი</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-medium">{{ $reservation->phone }}</p>
                                </div>
                            </div>
                            @if($reservation->email)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ელ-ფოსტა</label>
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <p class="text-gray-900 font-medium">{{ $reservation->email }}</p>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">სტუმრების რაოდენობა</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-medium">{{ $reservation->guests_count }} სტუმარი</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Details -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            ჯავშნის დეტალები
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ტიპი</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $reservation->type == 'restaurant' ? 'bg-blue-100 text-blue-800' : 
                                           ($reservation->type == 'place' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ $reservation->type == 'restaurant' ? 'რესტორანი' : 
                                           ($reservation->type == 'place' ? 'ადგილი' : 'მაგიდა') }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $reservation->type == 'restaurant' ? 'რესტორანი' : ($reservation->type == 'place' ? 'ადგილი' : 'მაგიდა') }}</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-medium">{{ $reservation->reservable?->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">თარიღი</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-medium">{{ $reservation->reservation_date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">დრო</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-medium">{{ $reservation->time_from }} - {{ $reservation->time_to }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                @if($reservation->promo_code || $reservation->notes || $reservation->occasion)
                    <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m0 0V6a2 2 0 012-2h10a2 2 0 012 2v2" />
                                </svg>
                                დამატებითი ინფორმაცია
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if($reservation->occasion)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">მიზეზი/ღონისძიება</label>
                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <p class="text-gray-900 font-medium">{{ $reservation->occasion }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($reservation->promo_code)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">პრომო კოდი</label>
                                        <div class="p-3 bg-gray-50 rounded-lg">
                                            <p class="text-gray-900 font-medium">{{ $reservation->promo_code }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($reservation->notes)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">შენიშვნები</label>
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <p class="text-gray-900">{{ $reservation->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Detailed System Information -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            სისტემური ინფორმაცია
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ჯავშნის ID</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 font-mono">#{{ $reservation->id }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ჯავშნის ტიპი</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $reservation->type == 'restaurant' ? 'bg-blue-100 text-blue-800' : 
                                           ($reservation->type == 'place' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ $reservation->type == 'restaurant' ? 'რესტორნის ჯავშანი' : 
                                           ($reservation->type == 'place' ? 'ადგილის ჯავშანი' : 'მაგიდის ჯავშანი') }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ჯავშნის ობიექტი</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <div class="space-y-2">
                                        <p class="text-gray-900 font-medium">{{ $reservation->reservable?->name ?? 'N/A' }}</p>
                                        @if($reservation->type == 'table' && $reservation->reservable)
                                            <div class="text-sm text-gray-600">
                                                <p><span class="font-medium">ადგილი:</span> {{ $reservation->reservable->place?->name ?? 'N/A' }}</p>
                                                <p><span class="font-medium">რესტორანი:</span> {{ $reservation->reservable->restaurant?->name ?? 'N/A' }}</p>
                                            </div>
                                        @elseif($reservation->type == 'place' && $reservation->reservable)
                                            <div class="text-sm text-gray-600">
                                                <p><span class="font-medium">რესტორანი:</span> {{ $reservation->reservable->restaurant?->name ?? 'N/A' }}</p>
                                            </div>
                                        @elseif($reservation->type == 'restaurant' && $reservation->reservable)
                                            <div class="text-sm text-gray-600">
                                                <p><span class="font-medium">რესტორანი:</span> {{ $reservation->reservable->name ?? 'N/A' }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ჯავშნის წყარო</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900 text-sm font-mono">{{ $reservation->reservable_type }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ჯავშნის მდგომარეობა</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $reservation->status == 'Confirmed' ? 'bg-green-100 text-green-800' : 
                                           ($reservation->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                            ($reservation->status == 'Cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ $reservation->status == 'Confirmed' ? 'დადასტურებული' : 
                                           ($reservation->status == 'Pending' ? 'მოლოდინში' : 
                                            ($reservation->status == 'Cancelled' ? 'გაუქმებული' : 'დასრულებული')) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ჯავშნის ზუსტი დრო</label>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <span class="text-sm text-gray-500">თარიღი:</span>
                                            <span class="text-gray-900 font-medium">{{ $reservation->reservation_date->format('l, F j, Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500">დრო:</span>
                                            <span class="text-gray-900 font-medium">{{ $reservation->time_from }} - {{ $reservation->time_to }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500">ხანგრძლივობა:</span>
                                            <span class="text-gray-900 font-medium">
                                                {{ $reservation->getFormattedDuration() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Panel -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">სტატუსი</h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                {{ $reservation->status == 'Confirmed' ? 'bg-green-100 text-green-800' : 
                                   ($reservation->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                    ($reservation->status == 'Cancelled' ? 'bg-red-100 text-red-800' : 
                                     ($reservation->status == 'Completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))) }}">
                                {{ $reservation->status == 'Confirmed' ? 'დადასტურებული' : 
                                   ($reservation->status == 'Pending' ? 'მოლოდინში' : 
                                    ($reservation->status == 'Cancelled' ? 'გაუქმებული' : 
                                     ($reservation->status == 'Completed' ? 'დასრულებული' : $reservation->status))) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Timestamps Card -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">თარიღები</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">შექმნის თარიღი</label>
                                <p class="text-sm text-gray-900">{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                                <p class="text-xs text-gray-500">{{ $reservation->created_at->diffForHumans() }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ბოლო განახლება</label>
                                <p class="text-sm text-gray-900">{{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
                                <p class="text-xs text-gray-500">{{ $reservation->updated_at->diffForHumans() }}</p>
                            </div>
                            @if($reservation->created_at != $reservation->updated_at)
                                <div class="pt-2 border-t border-gray-200">
                                    <p class="text-xs text-gray-500">
                                        ჯავშანი შეიცვალა {{ $reservation->updated_at->diffForHumans($reservation->created_at) }} შექმნის შემდეგ
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reservation Statistics -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-blue-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">სტატისტიკა</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">ჯავშნამდე დარჩენილი დრო:</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $reservation->getReservationDateTime()->diffForHumans() }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">სტუმრების რაოდენობა:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $reservation->guests_count }}</span>
                            </div>
                            @if($reservation->reservable)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">ჯავშნის ობიექტი:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $reservation->reservable->name ?? 'N/A' }}</span>
                                </div>
                            @endif
                            <div class="pt-2 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">ღონისძიების ხანგრძლივობა:</span>
                                    <span class="text-sm font-medium text-gray-900">
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
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">მოქმედებები</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.restaurants.reservations.edit', [$restaurant, $reservation]) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                რედაქტირება
                            </a>
                            <form method="POST" action="{{ route('admin.restaurants.reservations.destroy', [$restaurant, $reservation]) }}" 
                                  onsubmit="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ ჯავშნის წაშლა?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    წაშლა
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
