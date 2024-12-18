<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse ($notifications as $notification)
                        <div class="mb-4 p-4 border rounded {{ $notification->read ? 'bg-gray-100' : 'bg-white' }}">
                            <p class="text-sm text-gray-600">{{ $notification->created_at->diffForHumans() }}</p>
                            <p class="mt-1 {{ $notification->read ? 'text-gray-600' : 'font-semibold' }}">{{ $notification->message }}</p>
                            @if ($notification->link)
                                <a href="{{ $notification->link }}" class="text-blue-500 hover:underline">View details</a>
                            @endif
                            @if (!$notification->read)
                                <form action="{{ route('notifications.mark-as-read', $notification) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:underline ml-4">Mark as read</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p>No notifications found.</p>
                    @endforelse

                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

