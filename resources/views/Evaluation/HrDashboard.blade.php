<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Font and Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrDashboard.css') }}">

    <div class="py-12">
        <!-- Container for Card Layout -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <!-- Title Section -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-2 font-figtree">
                        Evaluation System
                    </h1>
                    <p class="text-lg text-gray-600 mt-2">Academic Year: 2023-2024 1st Semester</p>
                    <p class="text-lg text-gray-600">Evaluation Status: On-going</p>
                </div>
                
                <!-- Card Container -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Total Students Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                        <div class="mb-4 flex items-center justify-center">
                            <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Student Image" class="rounded-full w-16 h-16">
                        </div>
                        <h5 class="text-3xl font-bold text-gray-800">5</h5>
                        <p class="text-lg text-gray-600">Total Faculty</p>
                    </div>

                    <!-- Total Evaluations Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                        <div class="mb-4 flex items-center justify-center">
                            <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Student Image" class="rounded-full w-16 h-16">
                        </div>
                       
                        <h5 class="text-3xl font-bold text-gray-800">0</h5>
                        <p class="text-lg text-gray-600">Total Evaluations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
