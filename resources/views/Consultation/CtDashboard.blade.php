<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ct Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Total Appointments Card -->
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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Total Appointments</h3>
                        <p class="text-2xl font-bold text-blue-500">1</p>
                    </div>
                </div>

                <!-- Approved Appointments Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Approved Appointments</h3>
                        <p class="text-2xl font-bold text-green-500">1</p>
                    </div>
                </div>

                <!-- Declined Appointments Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Declined Appointments</h3>
                        <p class="text-2xl font-bold text-red-500">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
