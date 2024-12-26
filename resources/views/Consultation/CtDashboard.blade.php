<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consultation Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Appointment Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $totalAppointments }}</p>
                            <p>Total Appointments</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $pendingAppointments }}</p>
                            <p>Pending Appointments</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $approvedAppointments }}</p>
                            <p>Approved Appointments</p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg">
                            <p class="text-xl font-bold">{{ $declinedAppointments }}</p>
                            <p>Declined Appointments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

