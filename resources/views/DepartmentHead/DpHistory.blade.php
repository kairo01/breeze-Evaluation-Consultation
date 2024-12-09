<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department Head History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Consultation History</h3>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Course</th>
                                <th class="px-4 py-2">Purpose</th>
                                <th class="px-4 py-2">Meeting Mode</th>
                                <th class="px-4 py-2">Date & Time</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td class="px-4 py-2">{{ $appointment->user->name }}</td>
                                    <td class="px-4 py-2">{{ $appointment->course }}</td>
                                    <td class="px-4 py-2">{{ $appointment->purpose }}</td>
                                    <td class="px-4 py-2">{{ $appointment->meeting_mode }}</td>
                                    <td class="px-4 py-2">{{ $appointment->appointment_date_time }}</td>
                                    <td class="px-4 py-2">{{ $appointment->status }}</td>
                                    <td class="px-4 py-2">
                                        @if($appointment->status == 'Pending')
                                            <a href="{{ route('DepartmentHead.DpApproval', $appointment->id) }}" class="text-blue-500">Approve</a>
                                        @else
                                            <a href="{{ route('DepartmentHead.DpHistory', $appointment->id) }}" class="text-blue-500">View Details</a>
                                        @endif
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
