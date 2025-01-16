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

    <div class="max-w-7xl mx-auto py-10">
        <!-- Welcome Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold" style="font-family: 'Bunny', sans-serif;">Welcome !!</h1>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;">{{ Auth::user()->name }}</p>
                <p class="text-gray-600" style="font-family: 'Bunny', sans-serif;">{{ Auth::user()->role }}</p>
            </div>
            <div>
                <img src="{{ asset('css/GeneralResources/admin2.png') }}" alt="Admin Image" class="rounded-full w-20 h-20">
            </div>
        </div>
  
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Total Students Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                        <div class="mb-4 flex items-center justify-center">
                           <img src="{{ asset('css/GeneralResources/totalinstructor.png') }}" alt="Instructor Image" class="w-20 h-20">
                        </div>
                          <h5 class="text-3xl font-bold text-gray-800" style="font-family: 'Bunny', sans-serif;">{{ $totalAccounts }}</h5>
                          <p class="text-lg text-gray-600" style="font-family: 'Bunny', sans-serif;">Total User</p>
                    </div>
</x-app-layout>
