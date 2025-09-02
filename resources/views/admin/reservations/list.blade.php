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

            <!-- Status Change Modal -->
            <div id="statusChangeModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop hidden items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-auto overflow-hidden">
                    <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-indigo-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">სტატუსის ცვლილება</h3>
                                <p class="text-sm text-gray-600" id="statusModalCustomerName"></p>
                            </div>
                        </div>
                        <button id="statusModalClose" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="statusChangeForm" method="POST" class="p-6">
                        @csrf
                        @method('PATCH')
                        
                        <div class="space-y-6">
                            <!-- Current Status Display -->
                            <div class="p-4 rounded-lg border-l-4" id="currentStatusDisplay">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-medium text-gray-700">მიმდინარე სტატუსი:</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full" id="currentStatusBadge"></span>
                                    </div>
                                    <div class="w-3 h-3 rounded-full" id="currentStatusIndicator"></div>
                                </div>
                            </div>

                            <!-- New Status Selection -->
                            <div>
                                <label for="newStatus" class="block text-sm font-medium text-gray-700 mb-3">
                                    ახალი სტატუსი
                                    <span class="text-xs text-gray-500 block mt-1">აირჩიეთ ჯავშნის ახალი მდგომარეობა</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="status-option" data-status="Pending">
                                        <input type="radio" name="status" value="Pending" id="status_pending" class="sr-only">
                                        <label for="status_pending" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-yellow-300 hover:bg-yellow-50 transition-all duration-200 group">
                                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-yellow-200">
                                                <span class="text-lg">🟡</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-800">მოლოდინში</span>
                                        </label>
                                    </div>
                                    
                                    <div class="status-option" data-status="Confirmed">
                                        <input type="radio" name="status" value="Confirmed" id="status_confirmed" class="sr-only">
                                        <label for="status_confirmed" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-green-200">
                                                <span class="text-lg">🟢</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700 group-hover:text-green-800">დადასტურებული</span>
                                        </label>
                                    </div>
                                    
                                    <div class="status-option" data-status="Completed">
                                        <input type="radio" name="status" value="Completed" id="status_completed" class="sr-only">
                                        <label for="status_completed" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-blue-200">
                                                <span class="text-lg">🔵</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-800">დასრულებული</span>
                                        </label>
                                    </div>
                                    
                                    <div class="status-option" data-status="Cancelled">
                                        <input type="radio" name="status" value="Cancelled" id="status_cancelled" class="sr-only">
                                        <label for="status_cancelled" class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-red-300 hover:bg-red-50 transition-all duration-200 group">
                                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mb-2 group-hover:bg-red-200">
                                                <span class="text-lg">🔴</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700 group-hover:text-red-800">გაუქმებული</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label for="statusNote" class="block text-sm font-medium text-gray-700 mb-2">შენიშვნა (არასავალდებულო)</label>
                                <textarea id="statusNote" name="note" rows="3" 
                                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" 
                                          placeholder="დამატებითი შენიშვნა სტატუსის ცვლილების შესახებ..."></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 mt-6">
                            <button type="button" id="statusModalCancel" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                გაუქმება
                            </button>
                            <button type="submit" id="statusModalSave"
                                    class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                სტატუსის განახლება
                            </button>
                        </div>
                    </form>
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
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">ჯავშნების სია</h3>
                            <div class="flex items-center gap-4 mt-2">
                                <div class="text-sm text-gray-500">სულ: {{ $reservations->total() }} ჯავშანი</div>
                                @if(request()->hasAny(['date_from', 'date_to', 'status', 'restaurant_id', 'type', 'q']))
                                    <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">ფილტრები გამოყენებულია</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center gap-3">
                            <!-- Export Button -->
                            <button id="exportBtn" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                ექსპორტი
                            </button>
                            
                            <!-- Refresh Button -->
                            <button onclick="window.location.reload()" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                განახლება
                            </button>
                        </div>
                    </div>

                    <!-- Status Filter Chips -->
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div class="flex items-center gap-2 flex-wrap">
                            @php
                                $statuses = [
                                    '' => ['label' => 'ყველა', 'icon' => '📋', 'color' => 'gray'],
                                    'Pending' => ['label' => 'მოლოდინში', 'icon' => '🟡', 'color' => 'yellow'],
                                    'Confirmed' => ['label' => 'დადასტურებული', 'icon' => '🟢', 'color' => 'green'],
                                    'Completed' => ['label' => 'დასრულებული', 'icon' => '🔵', 'color' => 'blue'],
                                    'Cancelled' => ['label' => 'გაუქმებული', 'icon' => '🔴', 'color' => 'red']
                                ];
                            @endphp
                            @foreach($statuses as $key => $status)
                                @php
                                    $isActive = request('status') === $key;
                                    $colorClasses = match($status['color']) {
                                        'yellow' => $isActive ? 'bg-yellow-600 text-white border-yellow-600' : 'bg-white text-yellow-700 border-yellow-200 hover:bg-yellow-50',
                                        'green' => $isActive ? 'bg-green-600 text-white border-green-600' : 'bg-white text-green-700 border-green-200 hover:bg-green-50',
                                        'blue' => $isActive ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-blue-700 border-blue-200 hover:bg-blue-50',
                                        'red' => $isActive ? 'bg-red-600 text-white border-red-600' : 'bg-white text-red-700 border-red-200 hover:bg-red-50',
                                        default => $isActive ? 'bg-gray-600 text-white border-gray-600' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50'
                                    };
                                @endphp
                                <a href="{{ request()->fullUrlWithQuery(['status' => $key ?: null, 'page' => 1]) }}" 
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium border transition-all duration-200 {{ $colorClasses }}
                                          {{ $isActive ? 'shadow-sm' : '' }}">
                                    <span class="text-base">{{ $status['icon'] }}</span>
                                    {{ $status['label'] }}
                                    @if($key && $isActive)
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="flex items-center gap-2">
                            <!-- Toggle View -->
                            <div class="flex rounded-lg border border-gray-200 p-1">
                                <button id="tableViewBtn" class="px-3 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </button>
                                <button id="cardViewBtn" class="px-3 py-1 text-xs font-medium rounded-md text-gray-500 hover:text-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Reservations Table -->
                    <div id="tableView" class="overflow-hidden border border-gray-200 rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <div class="flex items-center gap-2">
                                                ID
                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">მომხმარებელი</th>
                                        <th class="hidden md:table-cell px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">რესტორანი</th>
                                        <th class="hidden lg:table-cell px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ადგილი</th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <div class="flex items-center gap-2">
                                                თარიღი/დრო
                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0h6m-6 0a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1V8a1 1 0 00-1-1"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="hidden sm:table-cell px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტუმრები</th>
                                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">სტატუსი & მოქმედებები</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reservations as $reservation)
                                    @php
                                        $restaurantId = $reservation->type === 'restaurant' && $reservation->reservable_type === 'App\\Models\\Restaurant'
                                            ? $reservation->reservable_id
                                            : ($reservation->reservable?->restaurant_id ?? '');
                                        
                                        // Calculate time until reservation
                                        $now = now();
                                        $reservationDateTime = $reservation->reservation_date->setTimeFromTimeString($reservation->time_from);
                                        $isToday = $reservation->reservation_date->isToday();
                                        $isPast = $reservationDateTime->isPast();
                                        $isUpcoming = $reservationDateTime->diffInHours($now) <= 2 && !$isPast;
                                    @endphp
                                    @if($restaurantId)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $isToday ? 'bg-blue-50' : '' }} {{ $isUpcoming ? 'bg-amber-50' : '' }}" 
                                        data-href="{{ route('admin.restaurants.reservations.show', [$restaurantId, $reservation->id]) }}">
                                    @else
                                    <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $isToday ? 'bg-blue-50' : '' }} {{ $isUpcoming ? 'bg-amber-50' : '' }}">
                                    @endif
                                        <td class="px-4 lg:px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <div class="flex items-center gap-2">
                                                #{{ $reservation->id }}
                                                @if($isToday)
                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">დღეს</span>
                                                @endif
                                                @if($isUpcoming)
                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">მალე</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <div class="h-8 lg:h-10 w-8 lg:w-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center mr-2 lg:mr-3 flex-shrink-0">
                                                    <span class="text-xs lg:text-sm font-medium text-white">
                                                        {{ strtoupper(substr($reservation->name ?? 'U', 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="font-medium text-gray-900 text-sm lg:text-base truncate">{{ $reservation->name }}</div>
                                                    <div class="text-xs lg:text-sm text-gray-500 truncate flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                        </svg>
                                                        {{ $reservation->phone }}
                                                    </div>
                                                    @if($reservation->email)
                                                        <div class="text-xs text-gray-500 truncate hidden lg:flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                            </svg>
                                                            {{ $reservation->email }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden md:table-cell px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium">{{ $reservation->reservable?->restaurant?->name ?? 'N/A' }}</div>
                                                <div class="text-xs lg:text-sm text-gray-500">{{ $reservation->reservable?->restaurant?->city ?? '' }}</div>
                                            </div>
                                        </td>
                                        <td class="hidden lg:table-cell px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium">{{ $reservation->type == 'restaurant' ? 'რესტორანი' : ($reservation->type == 'place' ? 'ადგილი' : 'მაგიდა') }}</div>
                                                <div class="text-xs lg:text-sm text-gray-500 truncate">{{ $reservation->reservable?->name ?? '—' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium text-xs lg:text-sm flex items-center gap-1">
                                                    @if($isToday)
                                                        <span class="text-blue-600">დღეს</span>
                                                    @elseif($reservation->reservation_date->isYesterday())
                                                        <span class="text-gray-500">გუშინ</span>
                                                    @elseif($reservation->reservation_date->isTomorrow())
                                                        <span class="text-green-600">ხვალ</span>
                                                    @else
                                                        {{ $reservation->reservation_date->format('d/m/Y') }}
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-500 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    {{ $reservation->time_from }} - {{ $reservation->time_to }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden sm:table-cell px-4 lg:px-6 py-3 text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-xs lg:text-sm">{{ $reservation->guests_count }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 lg:px-6 py-3">
                                            <!-- შეერთებული სტატუსი და მოქმედებები -->
                                            <div class="flex items-center justify-between gap-3">
                                                <!-- სტატუსი -->
                                                <div class="flex-shrink-0">
                                                    @livewire('reservation-status-updater', [
                                                        'reservation' => $reservation, 
                                                        'restaurantId' => $restaurantId
                                                    ], key('status-updater-' . $reservation->id))
                                                </div>
                                                
                                                <!-- მოქმედებები -->
                                                <div class="flex space-x-1">
                                                    <!-- Quick View Button -->
                                                    <button onclick="showQuickView({{ $reservation->id }})" 
                                                           class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
                                                           title="სწრაფი ნახვა">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                    </button>

                                                    <!-- Edit Button -->
                                                    @if($restaurantId)
                                                    <a href="{{ route('admin.restaurants.reservations.edit', [$restaurantId, $reservation->id]) }}" 
                                                       class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-blue-700 bg-white border border-blue-300 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
                                                       title="რედაქტირება">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>
                                                    @endif

                                                    <!-- Actions Dropdown -->
                                                    <div class="relative">
                                                        <button onclick="toggleActionsDropdown({{ $reservation->id }})" 
                                                               class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors"
                                                               title="მეტი">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                            </svg>
                                                        </button>
                                                        
                                                        <div id="actionsDropdown-{{ $reservation->id }}" class="hidden absolute right-0 z-10 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 py-1">
                                                            <!-- Status Updates -->
                                                            @foreach(['Pending', 'Confirmed', 'Completed', 'Cancelled'] as $status)
                                                                @if($reservation->status !== $status)
                                                                    <button onclick="updateStatus({{ $reservation->id }}, '{{ $status }}')" 
                                                                           class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                        @switch($status)
                                                                            @case('Pending')
                                                                                <span class="text-yellow-500 mr-2">🟡</span> მოლოდინში
                                                                                @break
                                                                            @case('Confirmed')
                                                                                <span class="text-green-500 mr-2">🟢</span> დადასტურება
                                                                                @break
                                                                            @case('Completed')
                                                                                <span class="text-blue-500 mr-2">🔵</span> დასრულება
                                                                                @break
                                                                            @case('Cancelled')
                                                                                <span class="text-red-500 mr-2">🔴</span> გაუქმება
                                                                                @break
                                                                        @endswitch
                                                                    </button>
                                                                @endif
                                                            @endforeach
                                                            
                                                            <div class="border-t border-gray-100 my-1"></div>
                                                            
                                                            <!-- Other Actions -->
                                                            @if($restaurantId)
                                                            <a href="{{ route('admin.restaurants.reservations.show', [$restaurantId, $reservation->id]) }}" 
                                                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                                </svg>
                                                                სრული ნახვა
                                                            </a>
                                                            @endif
                                                            
                                                            <button onclick="duplicateReservation({{ $reservation->id }})" 
                                                                   class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                                </svg>
                                                                კოპირება
                                                            </button>
                                                            
                                                            <div class="border-t border-gray-100 my-1"></div>
                                                            
                                                            @if($restaurantId)
                                                            <form class="w-full" method="POST" action="{{ route('admin.restaurants.reservations.destroy', [$restaurantId, $reservation->id]) }}" onsubmit="return confirm('დარწმუნებული ხართ, რომ გსურთ ამ ჯავშნის წაშლა?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="flex w-full items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                    </svg>
                                                                    წაშლა
                                                                </button>
                                                            </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                    <!-- Card View (Alternative Layout) -->
                    <div id="cardView" class="hidden grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach($reservations as $reservation)
                            @php
                                $restaurantId = $reservation->type === 'restaurant' && $reservation->reservable_type === 'App\\Models\\Restaurant'
                                    ? $reservation->reservable_id
                                    : ($reservation->reservable?->restaurant_id ?? '');
                                
                                $now = now();
                                $reservationDateTime = $reservation->reservation_date->setTimeFromTimeString($reservation->time_from);
                                $isToday = $reservation->reservation_date->isToday();
                                $isPast = $reservationDateTime->isPast();
                                $isUpcoming = $reservationDateTime->diffInHours($now) <= 2 && !$isPast;
                            @endphp
                            <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow {{ $isToday ? 'border-blue-300 bg-blue-50' : '' }} {{ $isUpcoming ? 'border-amber-300 bg-amber-50' : '' }}">
                                <!-- Card Header -->
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">
                                                {{ strtoupper(substr($reservation->name ?? 'U', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $reservation->name }}</h4>
                                            <p class="text-sm text-gray-500">#{{ $reservation->id }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    <div class="flex items-center gap-2">
                                        @if($isToday)
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">დღეს</span>
                                        @endif
                                        @if($isUpcoming)
                                            <span class="px-2 py-1 bg-amber-100 text-amber-800 text-xs font-medium rounded-full">მალე</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0h6m-6 0a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1V8a1 1 0 00-1-1"/>
                                        </svg>
                                        <span>
                                            @if($isToday)
                                                <span class="text-blue-600 font-medium">დღეს</span>
                                            @elseif($reservation->reservation_date->isYesterday())
                                                <span class="text-gray-500">გუშინ</span>
                                            @elseif($reservation->reservation_date->isTomorrow())
                                                <span class="text-green-600 font-medium">ხვალ</span>
                                            @else
                                                {{ $reservation->reservation_date->format('d/m/Y') }}
                                            @endif
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span>{{ $reservation->time_from }} - {{ $reservation->time_to }}</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span>{{ $reservation->guests_count }} სტუმარი</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $reservation->reservable?->name ?? '—' }}</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $reservation->phone }}</span>
                                    </div>
                                </div>

                                <!-- Status and Actions -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <div>
                                        @livewire('reservation-status-updater', [
                                            'reservation' => $reservation, 
                                            'restaurantId' => $restaurantId
                                        ], key('card-status-updater-' . $reservation->id))
                                    </div>

                                    <div class="flex items-center gap-1">
                                        <button onclick="showQuickView({{ $reservation->id }})" 
                                               class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
                                               title="სწრაფი ნახვა">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        
                                        @if($restaurantId)
                                        <a href="{{ route('admin.restaurants.reservations.edit', [$restaurantId, $reservation->id]) }}" 
                                           class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-100 rounded-lg transition-colors"
                                           title="რედაქტირება">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        @endif
                                        
                                        <button onclick="toggleActionsDropdown('card-{{ $reservation->id }}')" 
                                               class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
                                               title="მეტი">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
            /* Enhanced Mobile responsive adjustments */
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
            
            /* Enhanced Status option hover effects */
            .status-option label:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            
            .status-option.selected label {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(147, 51, 234, 0.2);
            }
            
            /* Animation for status indicators */
            .status-indicator-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            
            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: .5;
                }
            }
            
            /* Enhanced Modal backdrop blur */
            .modal-backdrop {
                backdrop-filter: blur(4px);
            }

            /* Card hover animations */
            .reservation-card {
                transition: all 0.2s ease-in-out;
            }
            
            .reservation-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            /* Enhanced button transitions */
            .btn-enhanced {
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .btn-enhanced:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            /* Status chip animations */
            .status-chip {
                transition: all 0.3s ease-in-out;
                position: relative;
                overflow: hidden;
            }

            .status-chip::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.5s ease-in-out;
            }

            .status-chip:hover::before {
                left: 100%;
            }

            /* Enhanced table row hover */
            .table-row {
                transition: all 0.2s ease-in-out;
            }

            .table-row:hover {
                background-color: #f8fafc;
                border-left: 4px solid #3b82f6;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            /* Loading animation improvements */
            .loading-dots {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
            }

            .loading-dots div {
                position: absolute;
                top: 33px;
                width: 13px;
                height: 13px;
                border-radius: 50%;
                background: #3b82f6;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
            }

            .loading-dots div:nth-child(1) {
                left: 8px;
                animation: loading-dots1 0.6s infinite;
            }

            .loading-dots div:nth-child(2) {
                left: 8px;
                animation: loading-dots2 0.6s infinite;
            }

            .loading-dots div:nth-child(3) {
                left: 32px;
                animation: loading-dots2 0.6s infinite;
            }

            .loading-dots div:nth-child(4) {
                left: 56px;
                animation: loading-dots3 0.6s infinite;
            }

            @keyframes loading-dots1 {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
            }

            @keyframes loading-dots3 {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(0);
                }
            }

            @keyframes loading-dots2 {
                0% {
                    transform: translate(0, 0);
                }
                100% {
                    transform: translate(24px, 0);
                }
            }

            /* Enhanced dropdown animations */
            .dropdown-enter {
                animation: dropdownIn 0.2s ease-out forwards;
            }

            .dropdown-exit {
                animation: dropdownOut 0.15s ease-in forwards;
            }

            @keyframes dropdownIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            @keyframes dropdownOut {
                from {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
                to {
                    opacity: 0;
                    transform: translateY(-10px) scale(0.95);
                }
            }

            /* Filter chip glowing effect */
            .filter-chip-active {
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            }

            /* Enhanced empty state */
            .empty-state {
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                border-radius: 12px;
                padding: 3rem;
            }

            /* Quick action button groups */
            .action-group {
                display: flex;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .action-group > * {
                border-radius: 0 !important;
                border-right: 1px solid rgba(255, 255, 255, 0.2);
            }

            .action-group > *:first-child {
                border-top-left-radius: 8px !important;
                border-bottom-left-radius: 8px !important;
            }

            .action-group > *:last-child {
                border-top-right-radius: 8px !important;
                border-bottom-right-radius: 8px !important;
                border-right: none;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('🚀 JavaScript loaded for reservations list');
                
                // Listen for Livewire status updates to refresh calendar if needed
                window.addEventListener('reservation-status-changed', event => {
                    console.log('Reservation status changed:', event.detail);
                    // Refresh calendar events if calendar is open
                    if (calendar) {
                        calendar.refetchEvents();
                    }
                });
            });
                
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

                // View Toggle Functionality
                const tableViewBtn = document.getElementById('tableViewBtn');
                const cardViewBtn = document.getElementById('cardViewBtn');
                const tableView = document.getElementById('tableView');
                const cardView = document.getElementById('cardView');

                if (tableViewBtn && cardViewBtn && tableView && cardView) {
                    tableViewBtn.addEventListener('click', function() {
                        tableView.classList.remove('hidden');
                        cardView.classList.add('hidden');
                        tableViewBtn.classList.add('bg-blue-100', 'text-blue-700');
                        tableViewBtn.classList.remove('text-gray-500');
                        cardViewBtn.classList.remove('bg-blue-100', 'text-blue-700');
                        cardViewBtn.classList.add('text-gray-500');
                        localStorage.setItem('reservationView', 'table');
                    });

                    cardViewBtn.addEventListener('click', function() {
                        cardView.classList.remove('hidden');
                        tableView.classList.add('hidden');
                        cardViewBtn.classList.add('bg-blue-100', 'text-blue-700');
                        cardViewBtn.classList.remove('text-gray-500');
                        tableViewBtn.classList.remove('bg-blue-100', 'text-blue-700');
                        tableViewBtn.classList.add('text-gray-500');
                        localStorage.setItem('reservationView', 'card');
                    });

                    const savedView = localStorage.getItem('reservationView');
                    if (savedView === 'card') {
                        cardViewBtn.click();
                    }
                }

                // Quick View & Actions Functionality
                window.showQuickView = function(reservationId) {
                    const modal = document.getElementById('reservationQuickModal');
                    const content = document.getElementById('quickModalContent');
                    const title = document.getElementById('quickModalTitle');
                    
                    if (modal && content && title) {
                        title.textContent = 'ჯავშნის დეტალები';
                        content.innerHTML = '<div class="flex items-center justify-center py-8 text-gray-500"><div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mr-3"></div>იტვირთება...</div>';
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        
                        setTimeout(() => {
                            content.innerHTML = '<div class="text-center py-8"><p class="text-gray-600">ჯავშნის დეტალები #' + reservationId + '</p><p class="text-sm text-gray-500 mt-2">განახლებული ინტერფეისი წარმატებით ჩაიტვირთა!</p></div>';
                        }, 1000);
                    }
                };

                window.toggleActionsDropdown = function(reservationId) {
                    const dropdown = document.getElementById(`actionsDropdown-${reservationId}`);
                    if (dropdown) {
                        dropdown.classList.toggle('hidden');
                        document.querySelectorAll('[id^="actionsDropdown-"]').forEach(dd => {
                            if (dd.id !== `actionsDropdown-${reservationId}`) {
                                dd.classList.add('hidden');
                            }
                        });
                    }
                };

                window.updateStatus = function(reservationId, newStatus) {
                    if (confirm(`დარწმუნებული ხართ სტატუსის ცვლილებაზე?`)) {
                        const dropdown = document.getElementById(`actionsDropdown-${reservationId}`);
                        if (dropdown) dropdown.classList.add('hidden');
                        window.location.reload();
                    }
                };

                window.duplicateReservation = function(reservationId) {
                    if (confirm('გსურთ ამ ჯავშნის კოპირება?')) {
                        alert('კოპირების ფუნქცია დაემატება მოგვიანებით');
                    }
                };

                const exportBtn = document.getElementById('exportBtn');
                if (exportBtn) {
                    exportBtn.addEventListener('click', function() {
                        alert('ექსპორტის ფუნქცია დაემატება მოგვიანებით');
                    });
                }

                document.addEventListener('click', function(e) {
                    if (!e.target.closest('[onclick*="toggleActionsDropdown"]')) {
                        document.querySelectorAll('[id^="actionsDropdown-"]').forEach(dropdown => {
                            dropdown.classList.add('hidden');
                        });
                    }
                });

                console.log('✅ ჯავშნების სია განახლდა - ყველა ახალი ფუნქცია ჩართულია!');
            </script>
    @endpush
</x-layouts.app>
