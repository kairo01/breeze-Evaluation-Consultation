<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Department Head Approval
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
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($appointments->isEmpty())
                        <p>No pending appointments.</p>
                    @else
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
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
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
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
                                            {{ $appointment->date->format('Y-m-d') }}<br>
                                            {{ $appointment->time->format('H:i') }} - {{ $appointment->time->addHour()->format('H:i') }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <button onclick="showApprovalForm({{ $appointment->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                                Accept
                                            </button>

                                            <form id="approvalForm{{ $appointment->id }}" action="{{ route('DepartmentHead.DpApproval.approve') }}" method="POST" class="hidden mt-2">
                                                @csrf
                                                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                                <div class="mb-2">
                                                    <label for="approval_reason" class="block text-sm font-medium text-gray-700">Approval Reason / Meeting Details:</label>
                                                    <textarea name="approval_reason" id="approval_reason" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                                </div>
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                                    Confirm Approval
                                                </button>
                                            </form>

                                            <!-- Decline Form -->
                                            <button onclick="openDeclineModal({{ $appointment->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                Decline
                                            </button>

                                            <!-- Decline Modal -->
                                            <div id="declineModal{{ $appointment->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
                                                <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                                                    <h2 class="text-xl font-bold mb-4">Decline Appointment</h2>
                                                    <form action="{{ route('DepartmentHead.DpApproval.decline') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                                        <div class="mb-4">
                                                            <label for="decline_reason" class="block text-gray-700 text-sm font-bold mb-2">Reason for Decline:</label>
                                                            <textarea name="decline_reason" id="decline_reason" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                                            @error('decline_reason')
                                                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button type="button" onclick="closeDeclineModal({{ $appointment->id }})" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                                Decline
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Decline Modal -->
    <script>
        function openDeclineModal(id) {
            document.getElementById('declineModal' + id).style.display = 'flex';
        }

        function closeDeclineModal(id) {
            document.getElementById('declineModal' + id).style.display = 'none';
        }
        function showApprovalForm(id) {
            document.getElementById('approvalForm' + id).classList.remove('hidden');
        }
    </script>

   @section('title')
      Department Head Approval
   @endsection
</x-app-layout>

