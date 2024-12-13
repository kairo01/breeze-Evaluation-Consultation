<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <!-- Include FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrCalendar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="calendar-container flex space-x-4 mt-4 px-4">
        <!-- Mini Calendar & Side Form -->
        <div id="miniCalendarContainer" class="w-1/4">
            <button class="back-button mb-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="goBack()">
                Back
            </button>

            <!-- Mini Calendar -->
            <div id="miniCalendar"></div>
        </div>

        <!-- Main Calendar -->
        <div id="calendar" class="w-3/4"></div>
    </div>

    <!-- Tailwind Modal for Viewing Event Details -->
    <div id="eventModal" class="fixed inset-0 z-50 hidden flex justify-center items-center bg-black bg-opacity-50">
    <div class="bg-white p-4 rounded-md shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-lg font-semibold text-gray-800" id="modalTitle"></h5>
            <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700 text-lg font-bold">&times;</button>
        </div>
        <div class="text-gray-700">
            <p id="modalDescription" class="text-sm mb-4"></p>
            <p class="font-semibold text-sm">Date and Time:</p>
            <p id="modalDateTime" class="text-sm font-medium"></p>
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
                events: @json($appointments), // Event data passed from the controller
                eventClick: function(info) {
                    // Open modal with event details
                    const event = info.event;
                    document.getElementById('modalTitle').innerText = event.title;
                    document.getElementById('modalDescription').innerText = event.extendedProps.description;

                    // Format the date to a user-friendly format
                    const formattedDate = event.start.toLocaleString();  // Local date string format
                    document.getElementById('modalDateTime').innerText = formattedDate;

                    document.getElementById('eventModal').classList.remove('hidden');
                }
            });
            calendar.render();

            // Mini Calendar
            var miniCalendar = new FullCalendar.Calendar(miniCalendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(info) {
                    calendar.gotoDate(info.dateStr);
                }
            });
            miniCalendar.render();

            // Close modal functionality
            document.getElementById('closeModalBtn').addEventListener('click', function () {
                document.getElementById('eventModal').classList.add('hidden');
            });

            // Close modal if clicked outside
            document.getElementById('eventModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });

            // Go Back Button
            window.goBack = function() {
                window.history.back();
            }
        });
    </script>
</x-app-layout>
