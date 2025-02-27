<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Calendar') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrCalendar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="calendar-container flex space-x-4 mt-4 px-4">
        <!-- Mini Calendar -->
        <div id="miniCalendarContainer" class="w-1/4">
            <div id="miniCalendar"></div>
        </div>

        <!-- Main Calendar -->
        <div id="calendar" class="w-3/4"></div>
    </div>

    <!-- Modal for Viewing Event Details -->
    <div id="eventModal" class="fixed inset-0 z-50 hidden flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-lg font-semibold text-gray-800" id="modalTitle"></h5>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700 text-lg font-bold">&times;</button>
            </div>
            <div class="text-gray-700">
                <p id="modalDescription" class="text-sm mb-4"></p>
                <p class="font-semibold text-sm">Date and Time:</p>
                <p id="modalDateTime" class="text-sm mb-2"></p>
                <p class="font-semibold text-sm">Status:</p>
                <p id="modalStatus" class="text-sm mb-2"></p>
            </div>
        </div>
    </div>

    <!-- Include FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const miniCalendarEl = document.getElementById('miniCalendar');

            // Main Calendar
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    ...@json($appointments),
                    ...@json($busySlots),
                    ...@json($availabilities),
                ],
                eventClick: function (info) {
                    const event = info.event;

                    if (event.extendedProps.type === 'appointment') {
                        document.getElementById('modalTitle').innerText = `Appointment: ${event.title}`;
                        document.getElementById('modalStatus').innerText = event.extendedProps.status;
                    } else if (event.extendedProps.type === 'busy_slot') {
                        document.getElementById('modalTitle').innerText = `Busy Slot: ${event.title}`;
                        document.getElementById('modalStatus').innerText = 'N/A';
                    } else if (event.extendedProps.type === 'availability') {
                        document.getElementById('modalTitle').innerText = `Consultant Available: ${event.title}`;
                        document.getElementById('modalStatus').innerText = 'Available';
                    }

                    let description = event.extendedProps.description || 'No description available';
                    if (event.extendedProps.type === 'busy_slot') {
                        description += `\nConsultant: ${event.extendedProps.consultant_name} (${event.extendedProps.consultant_role})`;
                    }
                    document.getElementById('modalDescription').innerText = description;

                    const startDate = event.start.toLocaleDateString();
                    const startTime = event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    let dateTimeText = `${startDate} - ${startTime}`;
                    
                    if (event.end) {
                        const endTime = event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        dateTimeText += ` to ${endTime}`;
                    }
                    
                    if (event.allDay) {
                        dateTimeText += ' (All Day)';
                    }
                    
                    document.getElementById('modalDateTime').innerText = dateTimeText;

                    document.getElementById('eventModal').classList.remove('hidden');
                },
                eventDidMount: function(info) {
                    if (info.event.extendedProps.type === 'appointment') {
                        setInterval(function() {
                            var now = new Date();
                            var end = info.event.end;
                            if (now > end && info.event.backgroundColor !== '#4CAF50') {
                                info.event.setProp('backgroundColor', '#4CAF50');
                                info.event.setExtendedProp('status', 'Done');
                            }
                        }, 60000); // Check every minute
                    }
                }
            });

            calendar.render();

            // Mini Calendar
            const miniCalendar = new FullCalendar.Calendar(miniCalendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function (info) {
                    calendar.gotoDate(info.dateStr);
                }
            });

            miniCalendar.render();

            // Modal Functions
            document.getElementById('closeModalBtn').addEventListener('click', function () {
                document.getElementById('eventModal').classList.add('hidden');
            });

            document.getElementById('eventModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });
    </script>

@section('title')
  Student Calendar
@endsection

</x-app-layout>

