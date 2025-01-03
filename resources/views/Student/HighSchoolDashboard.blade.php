<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('High School Student Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10">
        <!-- Welcome Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold" style="font-family: 'Bunny', sans-serif;">Welcome !!</h1>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;">{{ Auth::user()->name }}</p>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;">{{ Auth::user()->student_id }}</p>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;"> Section: {{ Auth::user()->section }}</p>
            </div>
            <div>
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Student Image" class="rounded-full w-20 h-20">
            </div>
        </div>

   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Appointment Statistics</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $totalAppointments }}</p>
                            <p class="text-sm">Total Appointments</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $approvedAppointments }}</p>
                            <p class="text-sm">Approved Appointments</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $pendingAppointments }}</p>
                            <p class="text-sm">Pending Appointments</p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $declinedAppointments }}</p>
                            <p class="text-sm">Declined Appointments</p>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@section('title')
   Student Dashboard
@endsection
</x-app-layout>

