<x-layouts.app :title="'რედაქტირება Restaurant Slot - ' . ($restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი #' . $restaurant->id)">
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
                        <span class="ml-2 text-sm font-bold text-orange-600 bg-orange-50 px-3 py-1 rounded-xl">რედაქტირება</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-gradient-to-br from-white via-gray-50 to-orange-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-100/30 to-red-100/30 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            
            <div class="relative flex items-center gap-6">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-500 via-red-600 to-pink-700 rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-orange-100/50">
                    <svg class="w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-800 via-gray-900 to-orange-900 mb-3 leading-tight">
                        Restaurant Slot-ის რედაქტირება
                    </h1>
                    <p class="text-lg text-gray-600 font-semibold">{{ $restaurant->translate('ka')->name ?? $restaurant->translate('en')->name ?? 'რესტორანი #' . $restaurant->id }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-gradient-to-br from-white via-gray-50 to-orange-50 backdrop-blur-lg shadow-2xl border border-gray-200/50 rounded-3xl overflow-hidden">
        <div class="bg-gradient-to-r from-orange-400 via-red-500 to-pink-600 px-8 py-6">
            <h2 class="text-2xl font-black text-white drop-shadow-md">Restaurant Slot-ის ინფორმაცია</h2>
        </div>
        
        <div class="p-8">
            <form action="{{ route('admin.restaurants.slots.update', [$restaurant, $slot]) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Day of Week -->
                <div>
                    <label for="day_of_week" class="block text-sm font-bold text-gray-700 mb-3">კვირის დღე <span class="text-red-500">*</span></label>
                    <select name="day_of_week" id="day_of_week" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-300 bg-white shadow-md @error('day_of_week') border-red-500 @enderror">
                        <option value="">აირჩიეთ კვირის დღე</option>
                        <option value="Monday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Monday' ? 'selected' : '' }}>ორშაბათი</option>
                        <option value="Tuesday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Tuesday' ? 'selected' : '' }}>სამშაბათი</option>
                        <option value="Wednesday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Wednesday' ? 'selected' : '' }}>ოთხშაბათი</option>
                        <option value="Thursday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Thursday' ? 'selected' : '' }}>ხუთშაბათი</option>
                        <option value="Friday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Friday' ? 'selected' : '' }}>პარასკევი</option>
                        <option value="Saturday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Saturday' ? 'selected' : '' }}>შაბათი</option>
                        <option value="Sunday" {{ (old('day_of_week') ?? $slot->day_of_week) == 'Sunday' ? 'selected' : '' }}>კვირა</option>
                    </select>
                    @error('day_of_week')
                        <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="time_from" class="block text-sm font-bold text-gray-700 mb-3">
                            დაწყების დრო <span class="text-red-500">*</span>
                            <span class="text-xs text-orange-600 font-medium block mt-1">24-საათიანი ფორმატი (მაგ: 14:30)</span>
                        </label>
                        <div class="relative">
                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="time_from" id="time_from_hidden" value="{{ old('time_from') ?? $slot->time_from }}">
                            
                            <!-- Custom time input -->
                            <div class="flex items-center gap-2 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus-within:border-orange-500 focus-within:ring-4 focus-within:ring-orange-100 transition-all duration-300 bg-white shadow-md @error('time_from') border-red-500 @enderror">
                                <select id="time_from_hours" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                    @for($i = 0; $i < 24; $i++)
                                        @php
                                            $currentTime = old('time_from') ?? $slot->time_from;
                                            $selectedHour = $currentTime ? substr($currentTime, 0, 2) : '09';
                                        @endphp
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $selectedHour == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <span class="text-lg font-bold text-gray-600">:</span>
                                <select id="time_from_minutes" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                    @for($i = 0; $i < 60; $i += 15)
                                        @php
                                            $currentTime = old('time_from') ?? $slot->time_from;
                                            $selectedMinute = $currentTime ? substr($currentTime, 3, 2) : '00';
                                        @endphp
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $selectedMinute == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="text-xs text-orange-500 font-mono bg-orange-50 px-2 py-1 rounded ml-2">
                                    24h
                                </div>
                            </div>
                        </div>
                        @error('time_from')
                            <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="time_to" class="block text-sm font-bold text-gray-700 mb-3">
                            დასრულების დრო <span class="text-red-500">*</span>
                            <span class="text-xs text-orange-600 font-medium block mt-1">24-საათიანი ფორმატი (მაგ: 18:00)</span>
                        </label>
                        <div class="relative">
                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="time_to" id="time_to_hidden" value="{{ old('time_to') ?? $slot->time_to }}">
                            
                            <!-- Custom time input -->
                            <div class="flex items-center gap-2 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus-within:border-orange-500 focus-within:ring-4 focus-within:ring-orange-100 transition-all duration-300 bg-white shadow-md @error('time_to') border-red-500 @enderror">
                                <select id="time_to_hours" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                    @for($i = 0; $i < 24; $i++)
                                        @php
                                            $currentTime = old('time_to') ?? $slot->time_to;
                                            $selectedHour = $currentTime ? substr($currentTime, 0, 2) : '22';
                                        @endphp
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $selectedHour == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <span class="text-lg font-bold text-gray-600">:</span>
                                <select id="time_to_minutes" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                    @for($i = 0; $i < 60; $i += 15)
                                        @php
                                            $currentTime = old('time_to') ?? $slot->time_to;
                                            $selectedMinute = $currentTime ? substr($currentTime, 3, 2) : '00';
                                        @endphp
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $selectedMinute == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="text-xs text-orange-500 font-mono bg-orange-50 px-2 py-1 rounded ml-2">
                                    24h
                                </div>
                            </div>
                        </div>
                        @error('time_to')
                            <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Slot Interval -->
                <div>
                    <label for="slot_interval_minutes" class="block text-sm font-bold text-gray-700 mb-3">სლოტის ინტერვალი (წუთებში) <span class="text-red-500">*</span></label>
                    <select name="slot_interval_minutes" id="slot_interval_minutes" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-300 bg-white shadow-md @error('slot_interval_minutes') border-red-500 @enderror">
                        <option value="">აირჩიეთ ინტერვალი</option>
                        <option value="15" {{ (old('slot_interval_minutes') ?? $slot->slot_interval_minutes) == '15' ? 'selected' : '' }}>15 წუთი</option>
                        <option value="30" {{ (old('slot_interval_minutes') ?? $slot->slot_interval_minutes) == '30' ? 'selected' : '' }}>30 წუთი</option>
                        <option value="45" {{ (old('slot_interval_minutes') ?? $slot->slot_interval_minutes) == '45' ? 'selected' : '' }}>45 წუთი</option>
                        <option value="60" {{ (old('slot_interval_minutes') ?? $slot->slot_interval_minutes) == '60' ? 'selected' : '' }}>1 საათი</option>
                        <option value="90" {{ (old('slot_interval_minutes') ?? $slot->slot_interval_minutes) == '90' ? 'selected' : '' }}>1.5 საათი</option>
                        <option value="120" {{ (old('slot_interval_minutes') ?? $slot->slot_interval_minutes) == '120' ? 'selected' : '' }}>2 საათი</option>
                    </select>
                    @error('slot_interval_minutes')
                        <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Available Status -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">ხელმისაწვდომობა <span class="text-red-500">*</span></label>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   name="available" 
                                   value="1" 
                                   {{ (old('available') ?? $slot->available) == '1' ? 'checked' : '' }}
                                   class="w-5 h-5 text-orange-600 border-2 border-gray-300 focus:ring-orange-500 focus:ring-4">
                            <span class="ml-3 text-sm font-semibold text-gray-700">ხელმისაწვდომია</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   name="available" 
                                   value="0" 
                                   {{ (old('available') ?? $slot->available) == '0' ? 'checked' : '' }}
                                   class="w-5 h-5 text-red-600 border-2 border-gray-300 focus:ring-red-500 focus:ring-4">
                            <span class="ml-3 text-sm font-semibold text-gray-700">არ არის ხელმისაწვდომი</span>
                        </label>
                    </div>
                    @error('available')
                        <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 inline-flex justify-center items-center px-6 py-4 bg-gradient-to-r from-orange-500 via-red-600 to-pink-600 hover:from-orange-600 hover:via-red-700 hover:to-pink-700 text-white font-bold text-lg rounded-2xl shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        განახლება
                    </button>
                    <a href="{{ route('admin.restaurants.slots.show', [$restaurant, $slot]) }}" 
                       class="flex-1 inline-flex justify-center items-center px-6 py-4 bg-white hover:bg-gray-50 text-gray-700 hover:text-gray-900 border-2 border-gray-300 hover:border-gray-400 font-bold text-lg rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        გაუქმება
                    </a>
                </div>
            </form>
        </div>
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
            background-color: rgba(251, 146, 60, 0.05);
            border-radius: 6px;
        }
        
        .custom-time-input select option {
            padding: 8px 12px;
            font-size: 16px;
            font-weight: 600;
        }
        
        /* Focus styles for the container */
        .custom-time-input:focus-within {
            border-color: #f97316 !important;
            ring: 4px;
            ring-color: rgba(251, 146, 60, 0.1);
        }
    </style>

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
                    console.log(`${type} updated to:`, timeValue);
                }
                
                hoursSelect.addEventListener('change', updateHiddenInput);
                minutesSelect.addEventListener('change', updateHiddenInput);
                
                // Initialize
                updateHiddenInput();
            }
            
            // Initialize both time inputs
            updateTimeInput('time_from');
            updateTimeInput('time_to');
        });
    </script>
</x-layouts.app>
