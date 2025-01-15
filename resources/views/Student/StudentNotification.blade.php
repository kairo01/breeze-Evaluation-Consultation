<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <style>
    .notification-table {
        width: 80%; 
        max-width: 900px;
        border-collapse: collapse;
        border: 1px solid #e5e7eb;
        font-size: 0.875rem;
    }

    .notification-table th,
    .notification-table td {
        border: 1px solid #d1d5db;
        padding: 0.5rem 1rem;
        text-align: left;
    }

    .notification-table thead tr {
        background-color: #f3f4f6;
        font-weight: 600;
    }

    .notification-table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    .notification-table tbody tr:nth-child(even) {
        background-color: #f9fafb; /* Tailwind gray-50 */
    }

    .notification-table {
        margin-top: 1rem; /* Tailwind mt-4 */
        margin-left: auto;
        margin-right: auto;
    }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Evaluation Notification</h3>
                    <table class="notification-table mx-auto mt-4">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->notifications as $notification)
                                <tr>
                                    <td>{{ $notification->data['title'] ?? 'No title' }}</td>
                                    <td>{{ $notification->data['description'] ?? 'No description' }}</td>
                                    <td>{{ isset($notification->data['start_date']) ? \Carbon\Carbon::parse($notification->data['start_date'])->format('F j, Y, g:i A') : 'No start date' }}</td>
                                    <td>
                                        @if(isset($notification->data['end']))
                                            {{ \Carbon\Carbon::parse($notification->data['end'])->format('F j, Y, g:i A') }}
                                        @elseif(isset($notification->data['end_date']))
                                            {{ \Carbon\Carbon::parse($notification->data['end_date'])->format('F j, Y, g:i A') }}
                                        @else
                                            No end time provided
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Consultation Notifications</h3>
                    @forelse(auth()->user()->notifications->whereIn('type', ['App\Notifications\AppointmentStatusNotification', 'App\Notifications\AppointmentReminder']) as $notification)
                        <div class="mb-4 p-4 bg-gray-100 rounded">
                            @if(isset($notification->data['message']))
                                <p class="font-semibold">{{ $notification->data['message'] }}</p>
                            @endif
                            @if(isset($notification->data['start_time']))
                                <p class="text-sm text-gray-600">Appointment Time: {{ \Carbon\Carbon::parse($notification->data['start_time'])->format('F j, Y, g:i A') }}</p>
                            @endif
                            @if(isset($notification->data['with']))
                                <p class="text-sm text-gray-600">With: {{ $notification->data['with'] }}</p>
                            @endif
                            @if(isset($notification->data['purpose']))
                                <p class="text-sm text-gray-600">Purpose: {{ $notification->data['purpose'] }}</p>
                            @endif
                            @if(isset($notification->data['meeting_mode']))
                                <p class="text-sm text-gray-600">Meeting Mode: {{ $notification->data['meeting_mode'] }}</p>
                            @endif
                            @if(isset($notification->data['meeting_preference']))
                                <p class="text-sm text-gray-600">Meeting Preference: {{ $notification->data['meeting_preference'] }}</p>
                            @endif
                            <p class="text-sm text-gray-600 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p>No consultation notifications found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@section('title')
   Student Notifications
@endsection

</x-app-layout>

