<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notification') }}
        </h2>
    </x-slot>

    <div class="bg-white shadow-md rounded-lg p-6">
          
            <div class="border p-4 mb-4">
                <ul>
        @foreach (auth()->user()->notifications as $notification)
            <li>
                <strong>{{ $notification->data['title'] }}</strong> - 
                {{ $notification->data['description'] ?? 'No description' }}
                <br>
                <small>Opens on: {{ \Carbon\Carbon::parse($notification->data['start'])->format('F j, Y, g:i A') }}</small>
            </li>
        @endforeach
    </ul>
    
</x-app-layout>
