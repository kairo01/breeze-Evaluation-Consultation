<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css">
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrCalendar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
</head>
<body>
<div class="container">
    <div id="calendar"></div>

    <!-- Success Toast -->
    <div id="successToast" class="toast">Evaluation successfully created!</div>

    <!-- Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h5>Create Event</h5>
                <button type="button" id="closeModal" class="btn-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="createEventForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="student_type" class="form-label">Student Type</label>
                        <select id="student_type" name="student_type" class="form-select" required>
                            <option value="highschool">High School</option>
                            <option value="college">College</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" id="closeModalFooter" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const successToast = $('#successToast');
        const eventModal = $('#eventModal');

        // Initialize FullCalendar
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/fetch-events',
            dateClick: function (info) {
                const now = new Date().toISOString().slice(0, 10);
                if (info.dateStr < now) {
                    alert('Cannot create events in the past!');
                    return;
                }
                $('#start_date').val(info.dateStr + 'T00:00');
                eventModal.fadeIn(); // Show modal
            }
        });

        calendar.render();

        // Form Submission
        $('#createEventForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/create-event',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        successToast.fadeIn().delay(2000).fadeOut();
                        eventModal.fadeOut();
                        calendar.refetchEvents();
                    } else {
                        alert(response.message || 'An error occurred.');
                    }
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        });

        // Close Modal Events
        $('#closeModal, #closeModalFooter').on('click', function () {
            eventModal.fadeOut();
        });
    });
</script>
</body>
</html>

@section('title')
    HumanResources Calendar
@endsection
</x-app-layout>
