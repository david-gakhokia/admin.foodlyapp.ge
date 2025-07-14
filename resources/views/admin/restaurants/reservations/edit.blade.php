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
                                <label for="time_from" class="block text-sm font-medium text-gray-700 mb-2">დაწყების დრო *</label>
                                <input type="time" 
                                       id="time_from" 
                                       name="time_from" 
                                       value="{{ old('time_from', $reservation->time_from) }}" 
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('time_from') border-red-300 @enderror" 
                                       required>
                                @error('time_from')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="time_to" class="block text-sm font-medium text-gray-700 mb-2">დასრულების დრო</label>
                                <input type="time" 
                                       id="time_to" 
                                       name="time_to" 
                                       value="{{ old('time_to', $reservation->time_to) }}" 
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('time_to') border-red-300 @enderror">
                                @error('time_to')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">სტატუსი *</label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-300 @enderror" 
                                    required>
                                <option value="Pending" {{ old('status', $reservation->status) == 'Pending' ? 'selected' : '' }}>მოლოდინში</option>
                                <option value="Confirmed" {{ old('status', $reservation->status) == 'Confirmed' ? 'selected' : '' }}>დადასტურებული</option>
                                <option value="Completed" {{ old('status', $reservation->status) == 'Completed' ? 'selected' : '' }}>დასრულებული</option>
                                <option value="Cancelled" {{ old('status', $reservation->status) == 'Cancelled' ? 'selected' : '' }}>გაუქმებული</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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

    <!-- Status Change Confirmation Script -->
    <script>
        document.getElementById('status').addEventListener('change', function() {
            const status = this.value;
            let message = '';
            
            switch(status) {
                case 'confirmed':
                    message = 'დარწმუნებული ხართ, რომ გსურთ ჯავშნის დადასტურება?';
                    break;
                case 'cancelled':
                    message = 'დარწმუნებული ხართ, რომ გსურთ ჯავშნის გაუქმება?';
                    break;
                case 'completed':
                    message = 'დარწმუნებული ხართ, რომ ჯავშანი დასრულებულია?';
                    break;
            }
            
            if (message && !confirm(message)) {
                this.value = '{{ $reservation->status }}';
            }
        });

        // Time validation
        document.getElementById('time_from').addEventListener('change', function() {
            const timeFrom = this.value;
            const timeTo = document.getElementById('time_to').value;
            
            if (timeTo && timeFrom >= timeTo) {
                alert('დაწყების დრო უნდა იყოს ადრე დასრულების დროზე');
                this.value = '';
            }
        });

        document.getElementById('time_to').addEventListener('change', function() {
            const timeTo = this.value;
            const timeFrom = document.getElementById('time_from').value;
            
            if (timeFrom && timeTo <= timeFrom) {
                alert('დასრულების დრო უნდა იყოს გვიან დაწყების დროზე');
                this.value = '';
            }
        });
    </script>
</x-layouts.app>
