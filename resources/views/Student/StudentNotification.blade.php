<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notification') }}
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
                    <td>{{ $notification->data['title'] }}</td>
                    <td>{{ $notification->data['description'] ?? 'No description' }}</td>
                    <td>{{ \Carbon\Carbon::parse($notification->data['start_date'])->format('F j, Y, g:i A') }}</td>
                    <td>
                        @if(isset($notification->data['end']))
                            {{ \Carbon\Carbon::parse($notification->data['end'])->format('F j, Y, g:i A') }}
                        @else
                            No end time provided
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@section('title')
   Student Notification
@endsection

</x-app-layout>
