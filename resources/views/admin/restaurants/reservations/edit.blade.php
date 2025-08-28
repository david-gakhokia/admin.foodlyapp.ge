<x-layouts.app :title="'ჯავშნის რედაქტირება #' . $reservation->id">
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">ჯავშნის რედაქტირება #{{ $reservation->id }}</h1>
                            <p class="text-white/80 text-sm">{{ $restaurant->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.restaurants.reservations.show', [$restaurant, $reservation]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            ნახვა
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

        <!-- Edit Form -->
        <form method="POST" action="{{ route('admin.restaurants.reservations.update', [$restaurant, $reservation]) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">სახელი *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $reservation->name) }}" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-300 @enderror" 
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">ტელეფონი *</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $reservation->phone) }}" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-300 @enderror" 
                                   required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">ელ-ფოსტა</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $reservation->email) }}" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-300 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="guests_count" class="block text-sm font-medium text-gray-700 mb-2">სტუმრების რაოდენობა *</label>
                            <input type="number" 
                                   id="guests_count" 
                                   name="guests_count" 
                                   value="{{ old('guests_count', $reservation->guests_count) }}" 
                                   min="1" 
                                   max="50" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('guests_count') border-red-300 @enderror" 
                                   required>
                            @error('guests_count')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700 mb-2">თარიღი *</label>
                            <input type="date" 
                                   id="reservation_date" 
                                   name="reservation_date" 
                                   value="{{ old('reservation_date', $reservation->reservation_date->format('Y-m-d')) }}" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('reservation_date') border-red-300 @enderror" 
                                   required>
                            @error('reservation_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="time_from" class="block text-sm font-medium text-gray-700 mb-2">
                                    დაწყების დრო *
                                    <span class="text-xs text-blue-600 font-medium block mt-1">24-საათიანი ფორმატი (მაგ: 14:30)</span>
                                </label>
                                <div class="relative">
                                    <!-- Hidden input for form submission -->
                                    <input type="hidden" name="time_from" id="time_from_hidden" value="{{ old('time_from', $reservation->time_from) }}">
                                    
                                    <!-- Custom time input -->
                                    <div class="flex items-center gap-2 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-100 transition-all duration-300 bg-white shadow-md @error('time_from') border-red-500 @enderror">
                                        <select id="time_from_hours" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                            @for($i = 0; $i < 24; $i++)
                                                @php 
                                                    $oldValue = old('time_from', $reservation->time_from);
                                                    $currentHour = $oldValue ? substr($oldValue, 0, 2) : '';
                                                @endphp
                                                <option value="{{ sprintf('%02d', $i) }}" {{ $currentHour == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text-lg font-bold text-gray-600">:</span>
                                        <select id="time_from_minutes" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                            @for($i = 0; $i < 60; $i += 15)
                                                @php 
                                                    $oldValue = old('time_from', $reservation->time_from);
                                                    $currentMinute = $oldValue ? substr($oldValue, 3, 2) : '';
                                                @endphp
                                                <option value="{{ sprintf('%02d', $i) }}" {{ $currentMinute == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                        <div class="text-xs text-blue-500 font-mono bg-blue-50 px-2 py-1 rounded ml-2">
                                            24h
                                        </div>
                                    </div>
                                </div>
                                @error('time_from')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="time_to" class="block text-sm font-medium text-gray-700 mb-2">
                                    დასრულების დრო
                                    <span class="text-xs text-blue-600 font-medium block mt-1">24-საათიანი ფორმატი (მაგ: 18:00)</span>
                                </label>
                                <div class="relative">
                                    <!-- Hidden input for form submission -->
                                    <input type="hidden" name="time_to" id="time_to_hidden" value="{{ old('time_to', $reservation->time_to) }}">
                                    
                                    <!-- Custom time input -->
                                    <div class="flex items-center gap-2 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-100 transition-all duration-300 bg-white shadow-md @error('time_to') border-red-500 @enderror">
                                        <select id="time_to_hours" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                            @for($i = 0; $i < 24; $i++)
                                                @php 
                                                    $oldValue = old('time_to', $reservation->time_to);
                                                    $currentHour = $oldValue ? substr($oldValue, 0, 2) : '';
                                                @endphp
                                                <option value="{{ sprintf('%02d', $i) }}" {{ $currentHour == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text-lg font-bold text-gray-600">:</span>
                                        <select id="time_to_minutes" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                            @for($i = 0; $i < 60; $i += 15)
                                                @php 
                                                    $oldValue = old('time_to', $reservation->time_to);
                                                    $currentMinute = $oldValue ? substr($oldValue, 3, 2) : '';
                                                @endphp
                                                <option value="{{ sprintf('%02d', $i) }}" {{ $currentMinute == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                        <div class="text-xs text-blue-500 font-mono bg-blue-50 px-2 py-1 rounded ml-2">
                                            24h
                                        </div>
                                    </div>
                                </div>
                                @error('time_to')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-3">
                                სტატუსი *
                                <span class="text-xs text-gray-500 block mt-1">აირჩიეთ ჯავშნის მდგომარეობა</span>
                            </label>
                            <div class="relative">
                                <select id="status" 
                                        name="status" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white shadow-md text-sm font-medium @error('status') border-red-500 @enderror" 
                                        required>
                                    <option value="Pending" {{ old('status', $reservation->status) == 'Pending' ? 'selected' : '' }} class="text-yellow-700">
                                        🟡 მოლოდინში
                                    </option>
                                    <option value="Confirmed" {{ old('status', $reservation->status) == 'Confirmed' ? 'selected' : '' }} class="text-green-700">
                                        🟢 დადასტურებული
                                    </option>
                                    <option value="Completed" {{ old('status', $reservation->status) == 'Completed' ? 'selected' : '' }} class="text-blue-700">
                                        🔵 დასრულებული
                                    </option>
                                    <option value="Cancelled" {{ old('status', $reservation->status) == 'Cancelled' ? 'selected' : '' }} class="text-red-700">
                                        🔴 გაუქმებული
                                    </option>
                                </select>
                                <!-- Status indicator icon -->
                                <div class="absolute inset-y-0 right-12 flex items-center pointer-events-none">
                                    <div id="status-indicator" class="w-3 h-3 rounded-full transition-all duration-300"></div>
                                </div>
                                <!-- Dropdown arrow -->
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            
                            <!-- Current status display -->
                            <div class="mt-3 p-3 rounded-lg border-l-4 bg-gray-50" id="current-status-info">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-700">მიმდინარე სტატუსი:</span>
                                        <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full" id="current-status-badge">
                                            {{ $reservation->status == 'Confirmed' ? '🟢 დადასტურებული' : 
                                               ($reservation->status == 'Pending' ? '🟡 მოლოდინში' : 
                                                ($reservation->status == 'Cancelled' ? '🔴 გაუქმებული' : 
                                                 ($reservation->status == 'Completed' ? '🔵 დასრულებული' : $reservation->status))) }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        ბოლო განახლება: {{ $reservation->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="promo_code" class="block text-sm font-medium text-gray-700 mb-2">პრომო კოდი</label>
                            <input type="text" 
                                   id="promo_code" 
                                   name="promo_code" 
                                   value="{{ old('promo_code', $reservation->promo_code) }}" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('promo_code') border-red-300 @enderror">
                            @error('promo_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="occasion" class="block text-sm font-medium text-gray-700 mb-2">მიზეზი/ღონისძიება</label>
                            <input type="text" 
                                   id="occasion" 
                                   name="occasion" 
                                   value="{{ old('occasion', $reservation->occasion) }}" 
                                   placeholder="მაგ. დაბადების დღე, იუბილე, ბიზნეს შეხვედრა..."
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('occasion') border-red-300 @enderror">
                            @error('occasion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m0 0V6a2 2 0 012-2h10a2 2 0 012 2v2" />
                        </svg>
                        შენიშვნები
                    </h3>
                </div>
                <div class="p-6">
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">დამატებითი შენიშვნები</label>
                        <textarea id="notes" 
                                  name="notes" 
                                  rows="4" 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('notes') border-red-300 @enderror" 
                                  placeholder="შეიყვანეთ დამატებითი შენიშვნები...">{{ old('notes', $reservation->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Reservation Information Summary -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        ჯავშნის ინფორმაცია
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $reservation->id }}</div>
                                <div class="text-sm text-blue-800">ჯავშნის ID</div>
                            </div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $reservation->guests_count }}</div>
                                <div class="text-sm text-green-800">სტუმარი</div>
                            </div>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <div class="text-center">
                                <div class="text-lg font-bold text-purple-600">
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
                                <div class="text-sm text-purple-800">ხანგრძლივობა</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                            <div>
                                <span class="text-gray-600">შექმნის თარიღი:</span>
                                <span class="font-medium text-gray-900">{{ $reservation->created_at->format('d/m/Y H:i') }}</span>
                                <span class="text-gray-500">({{ $reservation->created_at->diffForHumans() }})</span>
                            </div>
                            <div>
                                <span class="text-gray-600">ბოლო განახლება:</span>
                                <span class="font-medium text-gray-900">{{ $reservation->updated_at->format('d/m/Y H:i') }}</span>
                                <span class="text-gray-500">({{ $reservation->updated_at->diffForHumans() }})</span>
                            </div>
                            <div>
                                <span class="text-gray-600">ჯავშნის ტიპი:</span>
                                <span class="font-medium text-gray-900">
                                    {{ $reservation->type == 'restaurant' ? 'რესტორანი' : 
                                       ($reservation->type == 'place' ? 'ადგილი' : 'მაგიდა') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-600">ჯავშნის ობიექტი:</span>
                                <span class="font-medium text-gray-900">{{ $reservation->reservable?->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                <a href="{{ route('admin.restaurants.reservations.show', [$restaurant, $reservation]) }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    გაუქმება
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    შენახვა
                </button>
            </div>
        </form>
    </div>

    <style>
        /* Custom time picker styles */
        .custom-time-input select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: transparent;
            border: none;
            outline: none;
            font-family: 'SF Mono', 'Monaco', 'Cascadia Code', 'Roboto Mono', monospace;
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            cursor: pointer;
        }
        
        .custom-time-input select:focus {
            outline: none;
            background-color: rgba(59, 130, 246, 0.05);
            border-radius: 6px;
        }
        
        .custom-time-input select option {
            padding: 8px 12px;
            font-size: 16px;
            font-weight: 600;
        }
        
        /* Focus styles for the container */
        .custom-time-input:focus-within {
            border-color: #3b82f6 !important;
            ring: 4px;
            ring-color: rgba(59, 130, 246, 0.1);
        }
    </style>

    <!-- Status Change Confirmation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Custom time picker functionality
            function updateTimeInput(type) {
                const hoursSelect = document.getElementById(`${type}_hours`);
                const minutesSelect = document.getElementById(`${type}_minutes`);
                const hiddenInput = document.getElementById(`${type}_hidden`);
                
                function updateHiddenInput() {
                    const hours = hoursSelect.value;
                    const minutes = minutesSelect.value;
                    const timeValue = `${hours}:${minutes}`;
                    hiddenInput.value = timeValue;
                }
                
                hoursSelect.addEventListener('change', updateHiddenInput);
                minutesSelect.addEventListener('change', updateHiddenInput);
                
                // Initialize with current values
                updateHiddenInput();
            }
            
            // Initialize both time inputs
            updateTimeInput('time_from');
            updateTimeInput('time_to');
            
            // Status indicator functionality
            function updateStatusIndicator() {
                const statusSelect = document.getElementById('status');
                const indicator = document.getElementById('status-indicator');
                const currentInfo = document.getElementById('current-status-info');
                const currentBadge = document.getElementById('current-status-badge');
                
                const status = statusSelect.value;
                
                // Update indicator color
                switch(status) {
                    case 'Confirmed':
                        indicator.className = 'w-3 h-3 rounded-full bg-green-500 transition-all duration-300 animate-pulse';
                        currentInfo.className = 'mt-3 p-3 rounded-lg border-l-4 border-green-400 bg-green-50';
                        currentBadge.textContent = '🟢 დადასტურებული';
                        currentBadge.className = 'ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                        break;
                    case 'Pending':
                        indicator.className = 'w-3 h-3 rounded-full bg-yellow-500 transition-all duration-300 animate-pulse';
                        currentInfo.className = 'mt-3 p-3 rounded-lg border-l-4 border-yellow-400 bg-yellow-50';
                        currentBadge.textContent = '🟡 მოლოდინში';
                        currentBadge.className = 'ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800';
                        break;
                    case 'Cancelled':
                        indicator.className = 'w-3 h-3 rounded-full bg-red-500 transition-all duration-300';
                        currentInfo.className = 'mt-3 p-3 rounded-lg border-l-4 border-red-400 bg-red-50';
                        currentBadge.textContent = '🔴 გაუქმებული';
                        currentBadge.className = 'ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800';
                        break;
                    case 'Completed':
                        indicator.className = 'w-3 h-3 rounded-full bg-blue-500 transition-all duration-300';
                        currentInfo.className = 'mt-3 p-3 rounded-lg border-l-4 border-blue-400 bg-blue-50';
                        currentBadge.textContent = '🔵 დასრულებული';
                        currentBadge.className = 'ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800';
                        break;
                    default:
                        indicator.className = 'w-3 h-3 rounded-full bg-gray-500 transition-all duration-300';
                        currentInfo.className = 'mt-3 p-3 rounded-lg border-l-4 border-gray-400 bg-gray-50';
                }
            }
            
            // Initialize status indicator
            updateStatusIndicator();
            
            // Update indicator when status changes
            document.getElementById('status').addEventListener('change', updateStatusIndicator);
        });

        document.getElementById('status').addEventListener('change', function() {
            const status = this.value;
            let message = '';
            
            switch(status) {
                case 'Confirmed':
                    message = 'დარწმუნებული ხართ, რომ გსურთ ჯავშნის დადასტურება?';
                    break;
                case 'Cancelled':
                    message = 'დარწმუნებული ხართ, რომ გსურთ ჯავშნის გაუქმება?';
                    break;
                case 'Completed':
                    message = 'დარწმუნებული ხართ, რომ ჯავშანი დასრულებულია?';
                    break;
            }
            
            if (message && !confirm(message)) {
                this.value = '{{ $reservation->status }}';
            }
        });

        // Time validation with custom inputs
        function validateTimeInputs() {
            const timeFromHidden = document.getElementById('time_from_hidden').value;
            const timeToHidden = document.getElementById('time_to_hidden').value;
            
            if (timeFromHidden && timeToHidden && timeFromHidden >= timeToHidden) {
                alert('დაწყების დრო უნდა იყოს ადრე დასრულების დროზე');
                return false;
            }
            return true;
        }

        // Add validation on change
        document.getElementById('time_from_hours').addEventListener('change', validateTimeInputs);
        document.getElementById('time_from_minutes').addEventListener('change', validateTimeInputs);
        document.getElementById('time_to_hours').addEventListener('change', validateTimeInputs);
        document.getElementById('time_to_minutes').addEventListener('change', validateTimeInputs);
    </script>
</x-layouts.app>
