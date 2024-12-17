<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hr Calendar') }}
        </h2>
    </x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Calendar</h2>
        <div id="calendar"></div>

        <!-- Success Alert (Toast Notification) -->
        <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1050">
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Evaluation successfully set!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <!-- Modal to Create Event -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="createEventForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventModalLabel">Set Evaluation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Evaluation Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="student_type" class="form-label">Student Type</label>
                                <select class="form-select" id="student_type" name="student_type" required>
                                    <option value="" disabled selected>Select student type</option>
                                    <option value="highschool">High School</option>
                                    <option value="college">College</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Set Evaluation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function (info) {
                    $('#start_date').val(info.dateStr + 'T00:00'); // Autofill start date
                    $('#eventModal').modal('show');
                }
            });

            calendar.render();

            // Handle form submission
            $('#createEventForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/create-event',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            const toast = new bootstrap.Toast(document.getElementById('successToast'));
                            toast.show(); // Show the success alert
                            $('#eventModal').modal('hide'); // Close the modal
                            calendar.refetchEvents(); // Refresh the calendar events
                        }
                    },
                    error: function () {
                        alert('An error occurred while creating the evaluation.');
                    }
                });
            });
        });
    </script>
</body>
</html>

</x-app-layout>