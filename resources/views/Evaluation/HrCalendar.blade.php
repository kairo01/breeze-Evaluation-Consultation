<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrCalendar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="calendar-container">
        <div id="miniCalendarContainer">
            <button id="createEventButton" onclick="showSideForm()">Set Evaluation</button>
            <button class="back-button" onclick="goBack()">Back</button>
            <div id="createEventForm">
                <h3>Set Evaluation</h3>
                <input type="text" id="sideEventTitle" placeholder="Evaluation Title">
                <textarea id="sideEventDescription" placeholder="Description"></textarea>
                <input type="datetime-local" id="sideEventStart">
                <div class="button-container">
                    <button onclick="createEvent('side')" class="event-button">Create</button>
                    <button onclick="hideSideForm()" class="cancel-button">Cancel</button>
                </div>
            </div>
            <div id="miniCalendar"></div>
        </div>
        <div id='calendar'></div>
    </div>
    <div id="blueLabel" class="blue-label">Label</div>
    <div id="overlay" class="overlay" onclick="hideCenteredForm()"></div>
    <div id="centeredForm" class="centered-form">
        <h3>Set Evaluation</h3>
        <input type="text" id="centeredEventTitle" placeholder="Evaluation Title">
        <textarea id="centeredEventDescription" placeholder="Description"></textarea>
        <input type="datetime-local" id="centeredEventStart">
        <div class="button-container">   class="event-button">Create</button>
            <button onclick="hideCenteredForm()" class="cancel-button">Cancel</button>
        </div>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var miniCalendarEl = document.getElementById('miniCalendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(info) {
                    showCenteredForm(info.dateStr);
                }
            });
            calendar.render();

            var miniCalendar = new FullCalendar.Calendar(miniCalendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '',
                    center: '',
                    right: ''
                },
                dateClick: function(info) {
                    calendar.gotoDate(info.dateStr);
                }
            });
            miniCalendar.render();

            window.showSideForm = function() {
                var form = document.getElementById('createEventForm');
                form.style.display = 'block';
            }

            window.hideSideForm = function() {
                var form = document.getElementById('createEventForm');
                form.style.display = 'none';
            }

            window.showCenteredForm = function(date) {
                var form = document.getElementById('centeredForm');
                var overlay = document.getElementById('overlay');
                form.style.display = 'block';
                overlay.style.display = 'block';
                if (date) {
                    form.querySelector('#centeredEventStart').value = date;
                }
            }

            window.hideCenteredForm = function() {
                var form = document.getElementById('centeredForm');
                var overlay = document.getElementById('overlay');
                form.style.display = 'none';
                overlay.style.display = 'none';
            }

            window.createEvent = function(type) {
                var title, description, start, form;

                if (type === 'centered') {
                    form = document.getElementById('centeredForm');
                    title = document.getElementById('centeredEventTitle').value;
                    description = document.getElementById('centeredEventDescription').value;
                    start = document.getElementById('centeredEventStart').value;
                } else {
                    form = document.getElementById('createEventForm');
                    title = document.getElementById('sideEventTitle').value;
                    description = document.getElementById('sideEventDescription').value;
                    start = document.getElementById('sideEventStart').value;
                }

                $.ajax({
                    url: '/events',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: title,
                        description: description,
                        start: start
                    },
                    success: function(response) {
                        if (response.success) {
                            calendar.addEvent({
                                title: response.event.title,
                                description: response.event.description,
                                start: response.event.start,
                                end: response.event.end,
                                allDay: false
                            });
                            form.querySelector('input[type="text"]').value = '';
                            form.querySelector('textarea').value = '';
                            form.querySelector('input[type="datetime-local"]').value = '';
                            if (type === 'centered') {
                                hideCenteredForm(); 
                            } else {
                                hideSideForm();
                            }
                        }
                    }
                });
            }

            window.goBack = function() {
                window.history.back();
            }
        });
    </script>
   
</x-app-layout>
