<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department Head Calendar') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="calendar-container flex space-x-4 mt-4 px-4">
        <!-- Mini Calendar & Side Form -->
        <div id="miniCalendarContainer" class="w-1/4">
            <button class="mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="showBusySlotModal()">
                Add Busy Slot
            </button>
            <button class="back-button mb-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="goBack()">
                Back
            </button>

            <!-- Mini Calendar -->
            <div id="miniCalendar"></div>
        </div>

        <!-- Main Calendar -->
        <div id="calendar" class="w-3/4"></div>
    </div>

    <!-- Modal for Adding Busy Slot -->
    <div id="busySlotModal" class="fixed inset-0 z-50 hidden flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-lg font-semibold text-gray-800">Add Busy Slot</h5>
                <button onclick="closeBusySlotModal()" class="text-gray-500 hover:text-gray-700 text-lg font-bold">&times;</button>
            </div>
            <form action="{{ route('DepartmentHead.store.busy.slot') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium">Title</label>
                    <input type="text" id="title" name="title" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Description</label>
                    <textarea id="description" name="description" class="w-full p-2 border rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 font-medium">Date</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="busyAllDay" name="busyAllDay" class="mr-2" onclick="toggleTimeInputs()">
                        <label for="busyAllDay" class="text-gray-700 font-medium">Busy All Day</label>
                    </div>
                </div>
                <div id="timeInputs" class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="from" class="block text-gray-700 font-medium">From</label>
                        <input type="time" id="from" name="from" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label for="to" class="block text-gray-700 font-medium">To</label>
                        <input type="time" id="to" name="to" class="w-full p-2 border rounded">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeBusySlotModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Viewing Event Details -->
    <div id="eventModal" class="fixed inset-0 z-50 hidden flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h5 id="modalTitle" class="text-lg font-semibold text-gray-800"></h5>
                <button onclick="closeEventModal()" class="text-gray-500 hover:text-gray-700 text-lg font-bold">&times;</button>
            </div>
            <div class="text-gray-700">
                <div class="mb-4">
                    <p class="font-semibold text-sm">Title:</p>
                    <p id="modalTitleLabel" class="text-sm mb-2"></p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-sm">Description:</p>
                    <p id="modalDescriptionLabel" class="text-sm mb-2"></p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-sm">Date:</p>
                    <p id="modalDateLabel" class="text-sm mb-2"></p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-sm">Time:</p>
                    <p id="modalTimeLabel" class="text-sm mb-2"></p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold text-sm">Status:</p>
                    <p id="modalStatusLabel" class="text-sm mb-2"></p>
                </div>
                <button id="deleteBusySlotBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded hidden">
                    Delete Busy Slot
                </button>
            </div>
        </div>
    </div>

    <!-- Include FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var miniCalendarEl = document.getElementById('miniCalendar');

        // Main Calendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                ...@json($appointments),
                ...@json($busySlots),
            ],
            eventClick: function (info) {
                const event = info.event;

                if (event.extendedProps.type === 'appointment') {
                    document.getElementById('modalTitle').innerText = 'Approved Appointment';
                    document.getElementById('modalTitleLabel').innerText = `Appointment with: ${event.title}`;
                    document.getElementById('modalDescriptionLabel').innerText = event.extendedProps.description;
                    document.getElementById('modalStatusLabel').innerText = event.extendedProps.status;
                    document.getElementById('deleteBusySlotBtn').classList.add('hidden');
                } else if (event.extendedProps.type === 'busy_slot') {
                    document.getElementById('modalTitle').innerText = 'Busy Slot';
                    document.getElementById('modalTitleLabel').innerText = event.title;
                    document.getElementById('modalDescriptionLabel').innerText = event.extendedProps.description;
                    document.getElementById('modalStatusLabel').innerText = 'N/A';
                    document.getElementById('deleteBusySlotBtn').classList.remove('hidden');
                    document.getElementById('deleteBusySlotBtn').onclick = function() {
                        if (confirm('Are you sure you want to delete this busy slot?')) {
                            fetch(`/department-head/busy-slot/${event.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('Server responded with status ' + response.status);
                                }
                                return response.json();
                            }).then(data => {
                                if (data.success) {
                                    calendar.getEventById(event.id).remove();
                                    closeEventModal();
                                } else {
                                    throw new Error(data.error || 'Unknown error occurred');
                                }
                            }).catch(error => {
                                console.error('Error:', error);
                                alert('Failed to delete busy slot: ' + error.message);
                            });
                        }
                    };
                }

                document.getElementById('modalDateLabel').innerText = event.start.toLocaleDateString();
                document.getElementById('modalTimeLabel').innerText = event.allDay
                    ? 'All Day'
                    : `${event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

                document.getElementById('eventModal').classList.remove('hidden');
            },
            eventDidMount: function(info) {
                if (info.event.extendedProps.type === 'appointment') {
                    updateAppointmentStatus(info.event);
                }
            }
        });

        calendar.render();

        function updateAppointmentStatus(event) {
            const now = new Date();
            const end = event.end;

            if (now > end && event.backgroundColor !== '#4CAF50') {
                event.setProp('backgroundColor', '#4CAF50');
                event.setExtendedProp('status', 'Done');
            } else if (now <= end && event.backgroundColor !== '#1E90FF') {
                event.setProp('backgroundColor', '#1E90FF');
                event.setExtendedProp('status', 'Ongoing');
            }
        }

        // Update appointment statuses every minute
        setInterval(function() {
            calendar.getEvents().forEach(function(event) {
                if (event.extendedProps.type === 'appointment') {
                    updateAppointmentStatus(event);
                }
            });
        }, 60000);


        // Mini Calendar
        var miniCalendar = new FullCalendar.Calendar(miniCalendarEl, {
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

        window.showBusySlotModal = function () {
            document.getElementById('busySlotModal').classList.remove('hidden');
        };

        window.closeBusySlotModal = function () {
            document.getElementById('busySlotModal').classList.add('hidden');
        };

        window.closeEventModal = function () {
            document.getElementById('eventModal').classList.add('hidden');
        };

        window.toggleTimeInputs = function () {
            const isChecked = document.getElementById('busyAllDay').checked;
            document.getElementById('from').disabled = isChecked;
            document.getElementById('to').disabled = isChecked;

            if (isChecked) {
                document.getElementById('from').value = '';
                document.getElementById('to').value = '';
            }
        };

        window.goBack = function () {
            window.history.back();
        };
    });
    </script>

@section('title')
     Department Head Calendar
  @endsection
</x-app-layout>

