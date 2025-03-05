<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Department Head History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 print-content">
                    <x-history-controls :route="route('DepartmentHead.DpHistory')" />
                    <div id="appointment-table">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Student Name
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
                                        Approval Reason / Meeting Details
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr data-appointment-id="{{ $appointment->id }}">
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $appointment->student->name }}
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
                                            {{ $appointment->approval_reason ?? 'N/A' }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center status-cell">
                                            <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold 
                                                @if($appointment->is_completed == 1) 
                                                    text-green-900 bg-green-200
                                                @elseif($appointment->not_completed == 1)
                                                    text-red-900 bg-red-200
                                                @else
                                                    text-blue-900 bg-blue-200
                                                @endif
                                            ">
                                                {{ $appointment->is_completed == 1 ? 'Completed' : ($appointment->not_completed == 1 ? 'Not Completed' : $appointment->status) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <button onclick="viewDetails({{ $appointment->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                View Details
                                            </button>
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
        function viewDetails(appointmentId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/department-head/appointment-details/${appointmentId}`, {
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
                document.getElementById('appointmentStatus').textContent = data.status || 'N/A';
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

        // Function to update appointment status in real-time when changed by student
        function updateAppointmentStatus() {
            // Set up an interval to check for status changes
            setInterval(() => {
                const appointmentRows = document.querySelectorAll('[data-appointment-id]');
                appointmentRows.forEach(row => {
                    const appointmentId = row.getAttribute('data-appointment-id');
                    
                    fetch(`/department-head/appointment-details/${appointmentId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const statusCell = row.querySelector('.status-cell');
                        let statusHTML = '';
                        
                        if (data.status === 'Completed') {
                            statusHTML = `<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-green-900 bg-green-200">Completed</span>`;
                        } else if (data.status === 'Not Completed') {
                            statusHTML = `<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-red-900 bg-red-200">Not Completed</span>`;
                        } else {
                            statusHTML = `<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-blue-900 bg-blue-200">${data.status}</span>`;
                        }
                        
                        statusCell.innerHTML = statusHTML;
                    })
                    .catch(error => console.error('Error updating status:', error));
                });
            }, 30000); // Check every 30 seconds
        }

        // Initialize status updates
        document.addEventListener('DOMContentLoaded', function() {
            updateAppointmentStatus();
        });
    </script>

@section('title')
    Department Head History
@endsection

</x-app-layout>

