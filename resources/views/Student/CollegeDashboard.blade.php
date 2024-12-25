<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Bunny', sans-serif;">
            {{ __('College Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10">
        <!-- Welcome Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold" style="font-family: 'Bunny', sans-serif;">Welcome !!</h1>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;">{{ Auth::user()->name }}</p>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;">{{ Auth::user()->student_id }}</p>
            </div>
            <div>
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Student Image" class="rounded-full w-20 h-20">
            </div>
        </div>

        <!-- Appointments and Calendar Section -->
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4" style="font-family: 'Bunny', sans-serif;">Appointments</h3>
                <div class="border p-4 mb-4">
                    Records display here
                </div>
                <button class="text-blue-500 hover:underline" style="font-family: 'Bunny', sans-serif;">More...</button>
        </div>

        <!-- History Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4" style="font-family: 'Bunny', sans-serif;">History</h3>
            <div class="border p-4 mb-4">
                history display here
            </div>
            <button class="text-blue-500 hover:underline" style="font-family: 'Bunny', sans-serif;">More...</button>
        </div>
    </div>

@section('title')
    Student College Dashboard
@endsection

</x-app-layout>
