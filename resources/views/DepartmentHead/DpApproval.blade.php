<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department Head Appointment Approval') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Appointments Pending Approval</h3>

                    <!-- Appointment List -->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4">Name</th>
                                <th class="py-2 px-4">Course</th>
                                <th class="py-2 px-4">Purpose</th>
                                <th class="py-2 px-4">Meeting Mode</th>
                                <th class="py-2 px-4">Meeting Preference</th>
                                <th class="py-2 px-4">Date/Time</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td class="py-2 px-4">{{ $appointment->user->name }}</td>
                                    <td class="py-2 px-4">{{ $appointment->course }}</td>
                                    <td class="py-2 px-4">{{ $appointment->purpose }}</td>
                                    <td class="py-2 px-4">{{ $appointment->meeting_mode }}</td>
                                    <td class="py-2 px-4">{{ $appointment->meeting_preference }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('m/d/Y h:i A') }}</td>
                                    <td class="py-2 px-4">
                                        <form action="{{ route('DepartmentHead.DpApproval.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $appointment->id }}">

                                            <!-- Approve Button -->
                                            <button type="submit" name="status" value="Accepted" class="px-4 py-2 bg-green-500 text-white rounded">Accept</button>

                                            <!-- Decline Button -->
                                            <button type="submit" name="status" value="Declined" class="px-4 py-2 bg-red-500 text-white rounded" data-toggle="modal" data-target="#declineModal{{ $appointment->id }}">Decline</button>
                                        </form>

                                        <!-- Decline Reason Modal -->
                                        <div id="declineModal{{ $appointment->id }}" class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Decline Reason</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea name="reason" class="form-control" placeholder="Enter reason for decline..."></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="status" value="Declined" class="btn btn-danger">Decline</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
