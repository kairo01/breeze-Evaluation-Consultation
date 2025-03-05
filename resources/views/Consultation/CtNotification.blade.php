<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guidance Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Your Notifications</h3>
                    @forelse(auth()->user()->notifications as $notification)
                        <div class="mb-4 p-4 bg-gray-100 rounded">
                            <p class="font-semibold">{{ $notification->data['message'] }}</p>
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
                            @if(isset($notification->data['rating']))
                                <p class="text-sm text-gray-600">Rating: {{ $notification->data['rating'] }} / 5</p>
                            @endif
                            @if(isset($notification->data['comment']))
                                <p class="text-sm text-gray-600">Comment: {{ $notification->data['comment'] }}</p>
                            @endif
                            <p class="text-sm text-gray-600 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p>No notifications found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

