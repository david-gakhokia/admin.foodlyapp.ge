<x-layouts.app :title="'ჯავშნების კალენდარი - ' . $restaurant->name">
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h6m-6 4h6m-6 4h6m-3-12v12m3-12v12M9 21h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">ჯავშნების კალენდარი</h1>
                            <p class="text-white/80 text-sm">{{ $restaurant->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.restaurants.reservations.index', $restaurant) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            სია
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

        <!-- Legend -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">ლეგენდა</h3>
            <div class="flex flex-wrap items-center gap-6">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-yellow-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">მოლოდინში</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">დადასტურებული</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">გაუქმებული</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-gray-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">დასრულებული</span>
                </div>
            </div>
        </div>

        <!-- Calendar -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div id="calendar" class="p-4"></div>
        </div>
    </div>

    <!-- Reservation Detail Modal -->
    <div id="reservationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">ჯავშნის დეტალები</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="space-y-3">
                    <!-- Content will be populated by JavaScript -->
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        დახურვა
                    </button>
                    <button id="editBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        რედაქტირება
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');
                const events = @json($calendarEvents);
                
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'ka',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: events,
                    eventClick: function(info) {
                        showReservationModal(info.event);
                    },
                    eventDidMount: function(info) {
                        info.el.style.cursor = 'pointer';
                    }
                });
                
                calendar.render();
            });

            function showReservationModal(event) {
                const modal = document.getElementById('reservationModal');
                const modalTitle = document.getElementById('modalTitle');
                const modalContent = document.getElementById('modalContent');
                const editBtn = document.getElementById('editBtn');
                
                modalTitle.textContent = event.title;
                
                const props = event.extendedProps;
                modalContent.innerHTML = `
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">ტიპი:</span>
                            <span class="text-gray-900">${props.type}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">სტატუსი:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                ${props.status === 'Confirmed' ? 'bg-green-100 text-green-800' : 
                                  props.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                  props.status === 'Cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'}">
                                ${props.status === 'Confirmed' ? 'დადასტურებული' : 
                                  props.status === 'Pending' ? 'მოლოდინში' : 
                                  props.status === 'Cancelled' ? 'გაუქმებული' : 'დასრულებული'}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">ტელეფონი:</span>
                            <span class="text-gray-900">${props.phone}</span>
                        </div>
                        ${props.email ? `
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">ელ-ფოსტა:</span>
                            <span class="text-gray-900">${props.email}</span>
                        </div>` : ''}
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">სტუმრების რაოდენობა:</span>
                            <span class="text-gray-900">${props.guests_count}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">ადგილი:</span>
                            <span class="text-gray-900">${props.reservable_name}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">დრო:</span>
                            <span class="text-gray-900">${event.start.toLocaleString()}</span>
                        </div>
                    </div>
                `;
                
                editBtn.onclick = function() {
                    window.location.href = `{{ route('admin.restaurants.reservations.edit', [$restaurant, ':id']) }}`.replace(':id', event.id);
                };
                
                modal.classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('reservationModal').classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('reservationModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        </script>
    @endpush
</x-layouts.app>
