<x-layouts.app :title="'ჯავშნების კალენდარი'">
    <div class="space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-xl font-semibold">ჯავშნების კალენდარი</h1>
            <p class="text-sm text-gray-500">კალენდარი (საერთო)</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div id="calendar" class="p-4"></div>
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

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: {
                        url: '{{ route('admin.reservations.events.all') }}'
                    },
                    eventClick: function(info) {
                        const rid = info.event.extendedProps.restaurant_id || info.event.extendedProps.reservable_id || '';
                        if (rid) {
                            const url = `/admin/restaurants/${rid}/reservations/${info.event.id}/edit`;
                            window.location.href = url;
                        } else {
                            alert('რესტორნის იდენთიფიკატორი არ არის ხელმისაწვდომი');
                        }
                    }
                });

                calendar.render();
            });
        </script>
    @endpush
</x-layouts.app>
