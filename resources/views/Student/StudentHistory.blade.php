<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Appointment History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 print-content">
                    <x-history-controls :route="route('Student.StudentHistory')" />
                    <div id="appointment-table">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Consultant
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Course
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Purpose
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Meeting Mode
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Meeting Preference
                                   </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Date / Time
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Reason (if Declined)
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Approval Reason / Meeting Details
                                   </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr data-appointment-id="{{ $appointment->id }}" data-is-rescheduled="{{ $appointment->is_rescheduled ? 'true' : 'false' }}" data-not-completed="{{ $appointment->not_completed ? 'true' : 'false' }}">
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $appointment->consultant->name }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $appointment->course }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $appointment->purpose }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->meeting_mode }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->meeting_preference ?? 'N/A' }}
                                       </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $appointment->formatted_date_time }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->decline_reason ?? 'N/A' }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->approval_reason ?? 'N/A' }}
                                       </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center status-cell">
                                            @if($appointment->is_completed == 1)
                                                <span class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">
                                                    Completed
                                                </span>
                                            @elseif($appointment->not_completed == 1 && $appointment->is_rescheduled)
                                                <span class="inline-block px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                                    Rescheduled
                                                </span>
                                            @elseif($appointment->not_completed == 1)
                                                <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">
                                                    Not Completed
                                                </span>
                                            @else
                                                <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                    {{ $appointment->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center action-cell">
                                            @if($appointment->status === 'Approved' && $appointment->is_completed == 0 && $appointment->not_completed == 0)
                                                <button onclick="openCompletedModal({{ $appointment->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                                                    Completed
                                                </button>
                                                <button onclick="openNotCompletedModal({{ $appointment->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Not Completed
                                                </button>
                                            @else
                                                <button onclick="viewDetails({{ $appointment->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    View Details
                                                </button>
                                            @endif
                                            @if($appointment->not_completed == 1 && !$appointment->is_rescheduled)
                                                <a href="{{ route('Student.reschedule', $appointment->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                                                    Reschedule
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Pagination -->
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                {{ $appointments->firstItem() }} - {{ $appointments->lastItem() }} of {{ $appointments->total() }}
                            </div>
                            <div class="flex">
                                @if ($appointments->onFirstPage())
                                    <span class="px-2 py-1 bg-gray-200 text-gray-600 rounded-l">Previous</span>
                                @else
                                    <a href="{{ $appointments->previousPageUrl() }}" class="px-2 py-1 bg-blue-500 text-white rounded-l hover:bg-blue-600">Previous</a>
                                @endif

                                <span class="px-2 py-1 bg-gray-100">
                                    Page {{ $appointments->currentPage() }} of {{ $appointments->lastPage() }}
                                </span>

                                @if ($appointments->hasMorePages())
                                    <a href="{{ $appointments->nextPageUrl() }}" class="px-2 py-1 bg-blue-500 text-white rounded-r hover:bg-blue-600">Next</a>
                                @else
                                    <span class="px-2 py-1 bg-gray-200 text-gray-600 rounded-r">Next</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Modal -->
    <div id="completedModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Rate Your Appointment
                    </h3>
                    <div class="mt-2">
                        <form id="completedForm">
                            <input type="hidden" id="appointmentId" name="appointmentId">
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                <div class="flex items-center">
                                    <input type="radio" id="star5" name="rating" value="5" class="hidden"/>
                                    <label for="star5" class="star">★</label>
                                    <input type="radio" id="star4" name="rating" value="4" class="hidden"/>
                                    <label for="star4" class="star">★</label>
                                    <input type="radio" id="star3" name="rating" value="3" class="hidden"/>
                                    <label for="star3" class="star">★</label>
                                    <input type="radio" id="star2" name="rating" value="2" class="hidden"/>
                                    <label for="star2" class="star">★</label>
                                    <input type="radio" id="star1" name="rating" value="1" class="hidden"/>
                                    <label for="star1" class="star">★</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                                <textarea id="comment" name="comment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="submitCompleted()">
                        Submit
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeCompletedModal()">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Not Completed Modal -->
    <div id="notCompletedModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Appointment Not Completed
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Do you want to mark this appointment as not completed or reschedule it?
                        </p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="rescheduleAppointment()">
                        Reschedule
                    </button>
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="markNotCompleted()">
                        Mark as Not Completed
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeNotCompletedModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="viewDetailsModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Appointment Details
                    </h3>
                    <div class="mt-2">
                        <div class="mb-3">
                            <p class="font-semibold">Status:</p>
                            <p id="appointmentStatus" class="ml-2"></p>
                        </div>
                        <div class="mb-3">
                            <p class="font-semibold">Rating:</p>
                            <p id="appointmentRating" class="ml-2"></p>
                        </div>
                        <div class="mb-3">
                            <p class="font-semibold">Comment:</p>
                            <p id="appointmentComment" class="ml-2"></p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeViewDetailsModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCompletedModal(appointmentId) {
            document.getElementById('appointmentId').value = appointmentId;
            document.getElementById('completedModal').classList.remove('hidden');
        }

        function closeCompletedModal() {
            document.getElementById('completedModal').classList.add('hidden');
        }

        function submitCompleted() {
            const appointmentId = document.getElementById('appointmentId').value;
            const rating = document.querySelector('input[name="rating"]:checked')?.value;
            const comment = document.getElementById('comment').value;

            if (!rating) {
                alert('Please select a rating');
                return;
            }

            if (!comment) {
                alert('Please provide a comment');
                return;
            }

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/student/mark-completed/${appointmentId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ rating, comment })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Error marking appointment as completed');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update the status cell
                    const statusCell = document.querySelector(`[data-appointment-id="${appointmentId}"] .status-cell`);
                    statusCell.innerHTML = `
                <span class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">
                    Completed
                </span>
            `;
            
                    // Update the action cell
                    const actionCell = document.querySelector(`[data-appointment-id="${appointmentId}"] .action-cell`);
                    actionCell.innerHTML = `<button onclick="viewDetails(${appointmentId})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>`;
            
                    // Update the data attribute
                    const row = document.querySelector(`[data-appointment-id="${appointmentId}"]`);
                    row.setAttribute('data-not-completed', 'false');
                    
                    closeCompletedModal();
                } else {
                    alert('Error marking appointment as completed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Error marking appointment as completed');
            });
        }

        function openNotCompletedModal(appointmentId) {
            document.getElementById('appointmentId').value = appointmentId;
            document.getElementById('notCompletedModal').classList.remove('hidden');
        }

        function rescheduleAppointment() {
            const appointmentId = document.getElementById('appointmentId').value;
            window.location.href = `/student/reschedule/${appointmentId}`;
        }

        function markNotCompleted() {
            const appointmentId = document.getElementById('appointmentId').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/student/mark-not-completed/${appointmentId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Error marking appointment as not completed');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update the status cell
                    const statusCell = document.querySelector(`[data-appointment-id="${appointmentId}"] .status-cell`);
                    statusCell.innerHTML = `
                <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">
                    Not Completed
                </span>
            `;
            
                    // Update the action cell
                    const actionCell = document.querySelector(`[data-appointment-id="${appointmentId}"] .action-cell`);
                    actionCell.innerHTML = `
                <button onclick="viewDetails(${appointmentId})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">View Details</button>
                <a href="/student/reschedule/${appointmentId}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Reschedule</a>
            `;
            
                    // Update the data attributes
                    const row = document.querySelector(`[data-appointment-id="${appointmentId}"]`);
                    row.setAttribute('data-not-completed', 'true');
                    row.setAttribute('data-is-rescheduled', 'false');
                    
                    closeNotCompletedModal();
                } else {
                    alert('Error marking appointment as not completed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Error marking appointment as not completed');
            });
        }

        function closeNotCompletedModal() {
            document.getElementById('notCompletedModal').classList.add('hidden');
        }

        function viewDetails(appointmentId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Get the row data attributes directly
            const row = document.querySelector(`[data-appointment-id="${appointmentId}"]`);
            const isNotCompleted = row.getAttribute('data-not-completed') === 'true';
            const isRescheduled = row.getAttribute('data-is-rescheduled') === 'true';
            
            fetch(`/student/appointment-details/${appointmentId}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                // Set the status based on the data attributes, not the API response
                if (isRescheduled) {
                    document.getElementById('appointmentStatus').textContent = 'Rescheduled';
                } else if (isNotCompleted) {
                    document.getElementById('appointmentStatus').textContent = 'Not Completed';
                } else if (data.status === 'Completed' || data.is_completed) {
                    document.getElementById('appointmentStatus').textContent = 'Completed';
                } else {
                    document.getElementById('appointmentStatus').textContent = data.status || 'N/A';
                }
                
                document.getElementById('appointmentRating').textContent = data.rating ? data.rating : 'N/A';
                document.getElementById('appointmentComment').textContent = data.comment ? data.comment : 'N/A';
                document.getElementById('viewDetailsModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching appointment details:', error);
                alert('Error loading appointment details. Please try again.');
            });
        }

        function closeViewDetailsModal() {
            document.getElementById('viewDetailsModal').classList.add('hidden');
        }
    </script>

    <style>
        .star {
            color: #ddd;
            font-size: 30px;
            cursor: pointer;
        }
        .star:hover,
        .star:hover ~ .star,
        input:checked ~ .star {
            color: #ffc107;
        }
    </style>

@section('title')
    Student Appointment History
@endsection

</x-app-layout>

