<x-layouts.app :title="'ჯავშნების კალენდარი'">
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Header with Navigation Back -->
            <header class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.reservations.list') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            უკან დაბრუნება
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">ჯავშნების კალენდარი</h1>
                            <p class="text-sm text-gray-500 mt-1">ყველა რესტორნისთვის — ვიზუალური კალენდარი</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            კალენდარის ხედი
                        </span>
                    </div>
                </div>
            </header>

            <!-- Filters Section -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 mb-6">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700">სტატუსი:</label>
                        <select id="statusFilter" class="text-sm border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            <option value="">ყველა სტატუსი</option>
                            <option value="Pending">მოლოდინში</option>
                            <option value="Confirmed">დადასტურებული</option>
                            <option value="Cancelled">გაუქმებული</option>
                            <option value="Completed">დასრულებული</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700">რესტორანი:</label>
                        <select id="restaurantFilter" class="text-sm border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            <option value="">ყველა რესტორანი</option>
                            @php
                                $restaurants = \App\Models\Restaurant::with('translations')->get()->sortBy('name');
                            @endphp
                            @foreach($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button id="refreshCalendar" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        განახლება
                    </button>
                </div>
            </div>

            <!-- Enhanced Status Legend -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-100 p-6 mb-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.997 1.997 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    სტატუსების ლეგენდა
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="status-card flex items-center justify-between bg-white rounded-lg p-3 shadow-sm border border-orange-100 hover:border-orange-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-sm"></div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">მოლოდინში</div>
                                <div class="text-xs text-gray-500">დასადასტურებელი</div>
                            </div>
                        </div>
                        <div class="counter-badge bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 text-sm font-bold px-3 py-1 rounded-full min-w-[2rem] text-center">
                            <span id="pending-count">0</span>
                        </div>
                    </div>
                    <div class="status-card flex items-center justify-between bg-white rounded-lg p-3 shadow-sm border border-green-100 hover:border-green-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full bg-gradient-to-r from-emerald-400 to-green-500 shadow-sm"></div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">დადასტურებული</div>
                                <div class="text-xs text-gray-500">აქტიური ჯავშანი</div>
                            </div>
                        </div>
                        <div class="counter-badge bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-sm font-bold px-3 py-1 rounded-full min-w-[2rem] text-center">
                            <span id="confirmed-count">0</span>
                        </div>
                    </div>
                    <div class="status-card flex items-center justify-between bg-white rounded-lg p-3 shadow-sm border border-red-100 hover:border-red-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full bg-gradient-to-r from-red-400 to-red-500 shadow-sm"></div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">გაუქმებული</div>
                                <div class="text-xs text-gray-500">შეუქმებული ჯავშანი</div>
                            </div>
                        </div>
                        <div class="counter-badge bg-gradient-to-r from-red-100 to-red-100 text-red-700 text-sm font-bold px-3 py-1 rounded-full min-w-[2rem] text-center">
                            <span id="cancelled-count">0</span>
                        </div>
                    </div>
                    <div class="status-card flex items-center justify-between bg-white rounded-lg p-3 shadow-sm border border-blue-100 hover:border-blue-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full bg-gradient-to-r from-blue-400 to-blue-500 shadow-sm"></div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">დასრულებული</div>
                                <div class="text-xs text-gray-500">სტუმრები მოსულან</div>
                            </div>
                        </div>
                        <div class="counter-badge bg-gradient-to-r from-blue-100 to-blue-100 text-blue-700 text-sm font-bold px-3 py-1 rounded-full min-w-[2rem] text-center">
                            <span id="completed-count">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Calendar -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div id="calendar" style="min-height: 700px;">
                    <div class="flex items-center justify-center py-20">
                        <div class="flex items-center space-x-3 text-gray-500">
                            <svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span>კალენდარი იტვირთება...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
        <style>
            /* Calendar custom styles */
            .fc .fc-toolbar {
                margin-bottom: 1.5rem;
            }
            
            .fc .fc-toolbar-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: #1f2937;
            }
            
            .fc .fc-button-primary {
                background-color: #3b82f6;
                border-color: #3b82f6;
                color: white;
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
                border-radius: 0.5rem;
            }
            
            .fc .fc-button-primary:hover {
                background-color: #2563eb;
                border-color: #2563eb;
            }
            
            .fc .fc-daygrid-day {
                background-color: white;
            }
            
            /* Modern Calendar Styling */
            #calendar {
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
                border-radius: 16px;
                overflow: hidden;
                border: 1px solid #e5e7eb;
            }

            /* Header with Gradient */
            .fc .fc-toolbar {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 20px !important;
                margin-bottom: 0 !important;
            }

            .fc .fc-toolbar-title {
                color: white !important;
                font-size: 1.75rem !important;
                font-weight: 700 !important;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .fc .fc-button-primary {
                background: rgba(255, 255, 255, 0.2) !important;
                border: 1px solid rgba(255, 255, 255, 0.3) !important;
                color: white !important;
                border-radius: 8px !important;
                padding: 8px 16px !important;
                font-weight: 600 !important;
                transition: all 0.3s ease !important;
            }

            .fc .fc-button-primary:hover {
                background: rgba(255, 255, 255, 0.3) !important;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .fc .fc-button-primary:not(:disabled):active,
            .fc .fc-button-primary:not(:disabled).fc-button-active {
                background: rgba(255, 255, 255, 0.4) !important;
                box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5) !important;
            }

            .fc .fc-daygrid-day:hover {
                background-color: #f8fafc;
            }
            
            .fc .fc-event {
                border-radius: 8px !important;
                border: none !important;
                padding: 4px 8px !important;
                margin: 2px !important;
                font-size: 0.8rem !important;
                font-weight: 600 !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                cursor: pointer !important;
            }
            
            .fc .fc-event:hover {
                transform: translateY(-2px) scale(1.02) !important;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25) !important;
                z-index: 999 !important;
                opacity: 1 !important;
            }
            
            .fc .fc-day-today {
                background: linear-gradient(135deg, #fef7ff 0%, #f3e8ff 100%) !important;
                border: 2px solid #a855f7 !important;
                position: relative;
            }

            .fc .fc-day-today::before {
                content: 'დღეს';
                position: absolute;
                top: 4px;
                right: 4px;
                background: #a855f7;
                color: white;
                font-size: 0.6rem;
                padding: 2px 6px;
                border-radius: 4px;
                font-weight: 600;
                z-index: 1;
            }
            
            .fc .fc-col-header-cell {
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
                color: #475569 !important;
                font-weight: 700 !important;
                padding: 15px 8px !important;
                text-transform: uppercase !important;
                font-size: 0.7rem !important;
                letter-spacing: 1px !important;
                border-bottom: 2px solid #e2e8f0 !important;
            }

            .fc .fc-daygrid-day {
                min-height: 120px;
                border: 1px solid #e5e7eb !important;
            }

            /* Loading state */
            .fc.fc-loading {
                position: relative;
            }

            .fc.fc-loading::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, transparent, #667eea, transparent);
                animation: loading 1.5s infinite;
                z-index: 1000;
            }

            @keyframes loading {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(100%); }
            }

            /* Today button active state */
            .active-today {
                background: linear-gradient(135deg, #7c3aed, #5b21b6) !important;
                box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4) !important;
                transform: scale(1.05) !important;
            }

            /* Statistics counter animations */
            .counter-badge {
                transition: all 0.3s ease;
                animation: countUpdate 0.5s ease-in-out;
            }

            @keyframes countUpdate {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }

            .status-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
        <script>
            // Simple test first
            console.log('🚀 Script loaded successfully!');
            
            let calendar = null;
            let todayFilterActive = false;

            // Today filter toggle function
            function toggleTodayFilter() {
                console.log('🔄 Toggle today filter called, current state:', todayFilterActive);
                
                if (todayFilterActive) {
                    // Deactivate today filter
                    todayFilterActive = false;
                    console.log('📅 Today filter deactivated');
                    
                    // Update button appearance
                    const todayBtn = document.querySelector('.fc-todayFilterBtn-button');
                    console.log('🔍 Found button element:', todayBtn);
                    if (todayBtn) {
                        todayBtn.classList.remove('fc-button-active');
                        console.log('✅ Removed active class');
                    }
                } else {
                    // Activate today filter
                    todayFilterActive = true;
                    console.log('📅 Today filter activated');
                    
                    // Update button appearance
                    const todayBtn = document.querySelector('.fc-todayFilterBtn-button');
                    console.log('🔍 Found button element:', todayBtn);
                    if (todayBtn) {
                        todayBtn.classList.add('fc-button-active');
                        console.log('✅ Added active class');
                    }
                    
                    // Navigate to today's date
                    if (calendar) {
                        calendar.today();
                        console.log('📍 Navigated to today');
                    }
                }
                
                // Refresh calendar with new filter
                if (calendar) {
                    console.log('🔄 Refreshing calendar events...');
                    calendar.refetchEvents();
                }
            }

            // Load and update statistics
            function loadStatistics() {
                console.log('📊 Loading statistics...');
                fetch('/api/reservations/statistics')
                    .then(response => response.json())
                    .then(data => {
                        console.log('📊 Statistics loaded:', data);
                        
                        // Update counters with animation
                        updateCounter('pending-count', data.Pending || 0);
                        updateCounter('confirmed-count', data.Confirmed || 0);
                        updateCounter('cancelled-count', data.Cancelled || 0);
                        updateCounter('completed-count', data.Completed || 0);
                        
                        console.log('✅ Statistics updated successfully');
                    })
                    .catch(error => {
                        console.error('❌ Failed to load statistics:', error);
                        // Set default values on error
                        document.getElementById('pending-count').textContent = '-';
                        document.getElementById('confirmed-count').textContent = '-';
                        document.getElementById('cancelled-count').textContent = '-';
                        document.getElementById('completed-count').textContent = '-';
                    });
            }

            // Update counter with animation
            function updateCounter(elementId, newValue) {
                const element = document.getElementById(elementId);
                if (element) {
                    // Add animation class
                    element.parentElement.classList.add('counter-badge');
                    
                    // Update value
                    element.textContent = newValue;
                    
                    // Trigger animation
                    element.parentElement.style.animation = 'none';
                    element.parentElement.offsetHeight; // Trigger reflow
                    element.parentElement.style.animation = 'countUpdate 0.5s ease-in-out';
                }
            }
            
            document.addEventListener('DOMContentLoaded', function() {
                console.log('� DOM Content Loaded');
                console.log('🔍 Looking for calendar element...');
                
                const calendarEl = document.getElementById('calendar');
                console.log('📅 Calendar element found:', calendarEl ? 'YES' : 'NO');
                
                if (!calendarEl) {
                    console.error('❌ Calendar element not found!');
                    return;
                }
                
                // Check if FullCalendar is loaded
                console.log('🔍 Checking FullCalendar...');
                if (typeof FullCalendar === 'undefined') {
                    console.error('❌ FullCalendar not loaded!');
                    calendarEl.innerHTML = '<div class="p-8 text-center text-red-500">FullCalendar ბიბლიოთეკა ჩატვირთული არ არის</div>';
                    return;
                }
                
                console.log('✅ FullCalendar is available');
                
                // Clear the loading message
                calendarEl.innerHTML = '';
                
                try {
                    console.log('🔧 Creating calendar...');
                    // Initialize calendar
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'ka',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'todayFilterBtn dayGridMonth,timeGridWeek'
                        },
                        customButtons: {
                            todayFilterBtn: {
                                text: 'დღეს',
                                click: function() {
                                    console.log('🎯 Custom დღეს button clicked!');
                                    toggleTodayFilter();
                                }
                            }
                        },
                        buttonText: {
                            today: 'დღეს',
                            month: 'თვე',
                            week: 'კვირა'
                        },
                        // Load events from API
                        events: {
                            url: '/api/reservations/events/all',
                            method: 'GET',
                            extraParams: function() {
                                const params = {
                                    status: document.getElementById('statusFilter')?.value || '',
                                    restaurant_id: document.getElementById('restaurantFilter')?.value || ''
                                };
                                
                                // Add today's date filter if today button is active
                                if (todayFilterActive) {
                                    const today = new Date();
                                    const todayStr = today.toISOString().split('T')[0]; // YYYY-MM-DD format
                                    params.date = todayStr;
                                    console.log('📅 Adding today filter:', todayStr);
                                }
                                
                                console.log('📤 Sending API request with params:', params);
                                return params;
                            },
                            failure: function(error) {
                                console.error('❌ Failed to load events from API:', error);
                                alert('ჯავშნების ჩატვირთვა ვერ მოხერხდა: ' + (error.responseText || error.message));
                            },
                            success: function(data) {
                                console.log('✅ API Response received:', data);
                                console.log('📊 Events count:', data.length);
                                if (data.length === 0) {
                                    console.warn('⚠️ No events returned from API');
                                }
                            }
                        },
                        eventClick: function(info) {
                            showEventDetails(info.event);
                        },
                        eventDidMount: function(info) {
                            // Add tooltip
                            const props = info.event.extendedProps;
                            const tooltip = `${info.event.title} - ${props.customerName || 'უცნობი'}`;
                            info.el.setAttribute('title', tooltip);
                        },
                        loading: function(bool) {
                            if (bool) {
                                console.log('📥 Loading events...');
                            } else {
                                console.log('✅ Events loaded successfully!');
                            }
                        }
                    });
                    
                    console.log('🎨 Rendering calendar...');
                    calendar.render();
                    console.log('✅ Calendar rendered successfully!');
                    
                    // Setup filter listeners
                    setupFilters();
                    
                    // Load statistics
                    loadStatistics();
                    
                } catch (error) {
                    console.error('❌ Calendar error:', error);
                    calendarEl.innerHTML = '<div class="p-8 text-center text-red-500">კალენდარის ხატვა ვერ მოხერხდა: ' + error.message + '</div>';
                }
            });
            
            // Event details function with beautiful modal
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

                // Create modal HTML
                const modalHTML = `
                <div id="eventModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg leading-6 font-semibold text-white flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        ჯავშნის დეტალები
                                    </h3>
                                    <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-white px-6 py-6">
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 rounded-full" style="background-color: ${event.backgroundColor}"></div>
                                        <span class="text-lg font-semibold text-gray-900">${props.customerName || 'უცნობი'}</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusClasses(props.status)}">
                                            ${getStatusText(props.status)}
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="font-medium">დრო</span>
                                            </div>
                                            <p class="text-gray-900 font-semibold">${startTime}${endTime ? ' - ' + endTime : ''}</p>
                                        </div>
                                        
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                <span class="font-medium">სტუმრების რაოდენობა</span>
                                            </div>
                                            <p class="text-gray-900 font-semibold">${props.partySize || 1} კაცი</p>
                                        </div>
                                    </div>
                                    
                                    ${props.customerPhone ? `
                                    <div class="bg-blue-50 rounded-lg p-4">
                                        <div class="flex items-center text-blue-700 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span class="font-medium">ტელეფონი</span>
                                        </div>
                                        <a href="tel:${props.customerPhone}" class="text-blue-900 font-semibold hover:underline">${props.customerPhone}</a>
                                    </div>
                                    ` : ''}
                                    
                                    ${props.customerEmail ? `
                                    <div class="bg-green-50 rounded-lg p-4">
                                        <div class="flex items-center text-green-700 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-medium">ელ. ფოსტა</span>
                                        </div>
                                        <a href="mailto:${props.customerEmail}" class="text-green-900 font-semibold hover:underline">${props.customerEmail}</a>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-3 flex justify-end">
                                <button onclick="closeModal()" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    დახურვა
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                // Remove existing modal if any
                const existingModal = document.getElementById('eventModal');
                if (existingModal) {
                    existingModal.remove();
                }

                // Add modal to body
                document.body.insertAdjacentHTML('beforeend', modalHTML);
                
                // Add animation
                setTimeout(() => {
                    const modal = document.getElementById('eventModal');
                    if (modal) {
                        modal.classList.add('opacity-100');
                    }
                }, 10);
            }

            function closeModal() {
                const modal = document.getElementById('eventModal');
                if (modal) {
                    modal.remove();
                }
            }

            function getStatusClasses(status) {
                switch (status) {
                    case 'Pending': return 'bg-yellow-100 text-yellow-800';
                    case 'Confirmed': return 'bg-green-100 text-green-800';
                    case 'Cancelled': return 'bg-red-100 text-red-800';
                    case 'Completed': return 'bg-blue-100 text-blue-800';
                    default: return 'bg-gray-100 text-gray-800';
                }
            }

            function getStatusText(status) {
                switch (status) {
                    case 'Pending': return 'მოლოდინში ⏳';
                    case 'Confirmed': return 'დადასტურებული ✅';
                    case 'Cancelled': return 'გაუქმებული ❌';
                    case 'Completed': return 'დასრულებული 🎉';
                    default: return status;
                }
            }

            // Setup filters
            function setupFilters() {
                const statusFilter = document.getElementById('statusFilter');
                const restaurantFilter = document.getElementById('restaurantFilter');
                const refreshButton = document.getElementById('refreshCalendar');

                function refreshCalendar() {
                    if (calendar) {
                        console.log('🔄 Refreshing calendar with filters...');
                        calendar.refetchEvents();
                        // Also refresh statistics when filters change
                        loadStatistics();
                    }
                }

                if (statusFilter) {
                    statusFilter.addEventListener('change', function() {
                        console.log('🔍 Status filter changed:', this.value);
                        refreshCalendar();
                    });
                }
                if (restaurantFilter) {
                    restaurantFilter.addEventListener('change', function() {
                        console.log('🏢 Restaurant filter changed:', this.value);
                        refreshCalendar();
                    });
                }
                if (refreshButton) {
                    refreshButton.addEventListener('click', function() {
                        console.log('🔄 Manual refresh clicked');
                        refreshCalendar();
                    });
                }
            }
        </script>
    @endpush
</x-layouts.app>
