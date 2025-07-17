<x-layouts.app :title="'Slot-ის რედაქტირება - ' . ($place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი')">
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto py-8 px-4">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 bg-white/90 backdrop-blur-sm border border-gray-200/50 rounded-xl px-6 py-3 shadow-lg">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.restaurants.places.index', $restaurant) }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                        ადგილები
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.places.tables.index', [$restaurant, $place]) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            მაგიდები
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('admin.restaurants.places.tables.slots.index', [$restaurant, $place, $table]) }}" class="ml-2 text-sm font-semibold text-gray-600 hover:text-blue-600 transition-all duration-200">
                            დროის ლოტები
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-sm font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-xl">რედაქტირება</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 mb-8">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">დროის ლოტის რედაქტირება</h1>
                    <p class="text-gray-600 mt-1">{{ $place->translations->where('locale', 'ka')->first()?->name ?? $place->translations->where('locale', 'en')->first()?->name ?? 'უცნობი ადგილი' }} - {{ $table->name ?? 'მაგიდა' }}</p>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">შეცდომები:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">ლოტის ინფორმაცია</h3>
                <p class="text-sm text-gray-600 mt-1">შეცვალეთ დროის ლოტის დეტალები</p>
            </div>
            
            <form action="{{ route('admin.restaurants.places.tables.slots.update', [$restaurant, $place, $table, $slot]) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Day of Week -->
                <div class="space-y-2">
                    <label for="day_of_week" class="block text-sm font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>კვირის დღე *</span>
                        </div>
                    </label>
                    <select id="day_of_week" name="day_of_week" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">აირჩიეთ დღე</option>
                        <option value="Monday" {{ old('day_of_week', $slot->day_of_week) == 'Monday' ? 'selected' : '' }}>ორშაბათი</option>
                        <option value="Tuesday" {{ old('day_of_week', $slot->day_of_week) == 'Tuesday' ? 'selected' : '' }}>სამშაბათი</option>
                        <option value="Wednesday" {{ old('day_of_week', $slot->day_of_week) == 'Wednesday' ? 'selected' : '' }}>ოთხშაბათი</option>
                        <option value="Thursday" {{ old('day_of_week', $slot->day_of_week) == 'Thursday' ? 'selected' : '' }}>ხუთშაბათი</option>
                        <option value="Friday" {{ old('day_of_week', $slot->day_of_week) == 'Friday' ? 'selected' : '' }}>პარასკევი</option>
                        <option value="Saturday" {{ old('day_of_week', $slot->day_of_week) == 'Saturday' ? 'selected' : '' }}>შაბათი</option>
                        <option value="Sunday" {{ old('day_of_week', $slot->day_of_week) == 'Sunday' ? 'selected' : '' }}>კვირა</option>
                    </select>
                </div>

                <!-- Time Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Time -->
                    <div class="space-y-2">
                        <label for="time_from" class="block text-sm font-bold text-gray-700 mb-3">
                            დაწყების დრო <span class="text-red-500">*</span>
                            <span class="text-xs text-orange-600 font-medium block mt-1">24-საათიანი ფორმატი (მაგ: 09:00)</span>
                        </label>
                        <div class="relative">
                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="time_from" id="time_from_hidden" value="{{ old('time_from', $slot->time_from ? \Carbon\Carbon::parse($slot->time_from)->format('H:i') : '') }}">
                            
                            <!-- Custom time input -->
                            <div class="flex items-center gap-2 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus-within:border-green-500 focus-within:ring-4 focus-within:ring-green-100 transition-all duration-300 bg-white shadow-md @error('time_from') border-red-500 @enderror">
                                <select id="time_from_hours" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                    @for($i = 0; $i < 24; $i++)
                                        @php
                                            $currentValue = old('time_from', $slot->time_from ? \Carbon\Carbon::parse($slot->time_from)->format('H:i') : '');
                                            $selectedHour = $currentValue ? substr($currentValue, 0, 2) : '';
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
                                            $currentValue = old('time_from', $slot->time_from ? \Carbon\Carbon::parse($slot->time_from)->format('H:i') : '');
                                            $selectedMinute = $currentValue ? substr($currentValue, 3, 2) : '';
                                        @endphp
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $selectedMinute == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="text-xs text-green-500 font-mono bg-green-50 px-2 py-1 rounded ml-2">
                                    24h
                                </div>
                            </div>
                        </div>
                        @error('time_from')
                            <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="space-y-2">
                        <label for="time_to" class="block text-sm font-bold text-gray-700 mb-3">
                            დასრულების დრო <span class="text-red-500">*</span>
                            <span class="text-xs text-orange-600 font-medium block mt-1">24-საათიანი ფორმატი (მაგ: 18:00)</span>
                        </label>
                        <div class="relative">
                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="time_to" id="time_to_hidden" value="{{ old('time_to', $slot->time_to ? \Carbon\Carbon::parse($slot->time_to)->format('H:i') : '') }}">
                            
                            <!-- Custom time input -->
                            <div class="flex items-center gap-2 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus-within:border-red-500 focus-within:ring-4 focus-within:ring-red-100 transition-all duration-300 bg-white shadow-md @error('time_to') border-red-500 @enderror">
                                <select id="time_to_hours" class="flex-1 bg-transparent border-none focus:outline-none text-lg font-mono font-bold text-gray-800">
                                    @for($i = 0; $i < 24; $i++)
                                        @php
                                            $currentValue = old('time_to', $slot->time_to ? \Carbon\Carbon::parse($slot->time_to)->format('H:i') : '');
                                            $selectedHour = $currentValue ? substr($currentValue, 0, 2) : '';
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
                                            $currentValue = old('time_to', $slot->time_to ? \Carbon\Carbon::parse($slot->time_to)->format('H:i') : '');
                                            $selectedMinute = $currentValue ? substr($currentValue, 3, 2) : '';
                                        @endphp
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $selectedMinute == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="text-xs text-red-500 font-mono bg-red-50 px-2 py-1 rounded ml-2">
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
                <div class="space-y-2">
                    <label for="slot_interval_minutes" class="block text-sm font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>ინტერვალი (წუთებში) *</span>
                        </div>
                    </label>
                    <select id="slot_interval_minutes" name="slot_interval_minutes" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                        <option value="">აირჩიეთ ინტერვალი</option>
                        <option value="15" {{ old('slot_interval_minutes', $slot->slot_interval_minutes) == '15' ? 'selected' : '' }}>15 წუთი</option>
                        <option value="30" {{ old('slot_interval_minutes', $slot->slot_interval_minutes) == '30' ? 'selected' : '' }}>30 წუთი</option>
                        <option value="45" {{ old('slot_interval_minutes', $slot->slot_interval_minutes) == '45' ? 'selected' : '' }}>45 წუთი</option>
                        <option value="60" {{ old('slot_interval_minutes', $slot->slot_interval_minutes) == '60' ? 'selected' : '' }}>1 საათი</option>
                        <option value="90" {{ old('slot_interval_minutes', $slot->slot_interval_minutes) == '90' ? 'selected' : '' }}>1.5 საათი</option>
                        <option value="120" {{ old('slot_interval_minutes', $slot->slot_interval_minutes) == '120' ? 'selected' : '' }}>2 საათი</option>
                    </select>
                </div>

                <!-- Availability -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>სტატუსი</span>
                        </div>
                    </label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="available" value="1" 
                                   {{ old('available', $slot->available) == '1' ? 'checked' : '' }}
                                   class="w-4 h-4 text-green-600 focus:ring-green-500 border-gray-300">
                            <span class="ml-2 text-sm font-medium text-gray-700">ხელმისაწვდომია</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="available" value="0" 
                                   {{ old('available', $slot->available) == '0' ? 'checked' : '' }}
                                   class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300">
                            <span class="ml-2 text-sm font-medium text-gray-700">არ არის ხელმისაწვდომი</span>
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white border border-transparent rounded-xl font-semibold text-sm transition-all duration-200 transform hover:scale-105 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        ცვლილებების შენახვა
                    </button>
                    
                    <a href="{{ route('admin.restaurants.places.tables.slots.index', [$restaurant, $place, $table]) }}" 
                       class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        გაუქმება
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for form validation and custom time inputs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Time input handlers
    function updateHiddenTimeInput(prefix) {
        const hours = document.getElementById(prefix + '_hours').value;
        const minutes = document.getElementById(prefix + '_minutes').value;
        const hiddenInput = document.getElementById(prefix + '_hidden');
        hiddenInput.value = hours + ':' + minutes;
        
        // Update the form field name to match what Laravel expects
        hiddenInput.name = prefix.replace('_hidden', '');
    }

    // Initialize time inputs
    const timeFromHours = document.getElementById('time_from_hours');
    const timeFromMinutes = document.getElementById('time_from_minutes');
    const timeToHours = document.getElementById('time_to_hours');
    const timeToMinutes = document.getElementById('time_to_minutes');

    // Add event listeners
    if (timeFromHours && timeFromMinutes) {
        timeFromHours.addEventListener('change', () => updateHiddenTimeInput('time_from'));
        timeFromMinutes.addEventListener('change', () => updateHiddenTimeInput('time_from'));
        // Initialize on load
        updateHiddenTimeInput('time_from');
    }

    if (timeToHours && timeToMinutes) {
        timeToHours.addEventListener('change', () => updateHiddenTimeInput('time_to'));
        timeToMinutes.addEventListener('change', () => updateHiddenTimeInput('time_to'));
        // Initialize on load
        updateHiddenTimeInput('time_to');
    }
    
    // Time validation
    function validateTimeRange() {
        const timeFromHidden = document.getElementById('time_from_hidden');
        const timeToHidden = document.getElementById('time_to_hidden');
        
        if (timeFromHidden.value && timeToHidden.value) {
            const timeFrom = new Date('1970-01-01T' + timeFromHidden.value);
            const timeTo = new Date('1970-01-01T' + timeToHidden.value);
            
            if (timeTo <= timeFrom) {
                // Show custom validation message
                const timeToContainer = timeToHours.closest('.space-y-2');
                let errorElement = timeToContainer.querySelector('.time-validation-error');
                
                if (!errorElement) {
                    errorElement = document.createElement('p');
                    errorElement.className = 'text-red-500 text-sm mt-2 font-semibold time-validation-error';
                    timeToContainer.appendChild(errorElement);
                }
                errorElement.textContent = 'დასრულების დრო უნდა იყოს დაწყების დროზე გვიან';
                return false;
            } else {
                // Remove validation error if exists
                const timeToContainer = timeToHours.closest('.space-y-2');
                const errorElement = timeToContainer.querySelector('.time-validation-error');
                if (errorElement) {
                    errorElement.remove();
                }
                return true;
            }
        }
        return true;
    }
    
    // Add validation on time change
    if (timeFromHours && timeFromMinutes && timeToHours && timeToMinutes) {
        [timeFromHours, timeFromMinutes, timeToHours, timeToMinutes].forEach(element => {
            element.addEventListener('change', validateTimeRange);
        });
    }

    // Form submission validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateTimeRange()) {
                e.preventDefault();
                return false;
            }
        });
    }
});
</script>
</x-layouts.app>
