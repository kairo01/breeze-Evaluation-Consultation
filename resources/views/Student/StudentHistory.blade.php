<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Your Appointment History</h3>
                    <table class="table-auto w-full mt-4">

                    <!-- Check if the user is a student and if they are college or highschool -->
                            </h3>
                            <!-- Display student appointment history here -->
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Purpose</th>
                                        <th>Meeting Mode</th>
                                        <th>Meeting Preference</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->name }}</td>
                                            <td>{{ $appointment->course }}</td>
                                            <td>{{ $appointment->purpose }}</td>
                                            <td>{{ $appointment->meeting_mode }}</td>
                                            <td>{{ $appointment->meeting_preference ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('M d, Y h:i A') }}</td>
                                            <td>{{ $appointment->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
