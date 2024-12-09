<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrDashboard.css') }}">
       <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div style="box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.3); border: 2px solid black;" class="bg-white overflow-hidden sm:rounded-lg">
            <div class="p-6 text-gray-900 text-center">
                <h1 class="text-4xl font-bold">Evaluation System</h1>
                <p class="text-lg mt-2">Academic Year: 2023-2024 1st Semester</p>
                <p class="text-lg">Evaluation Status: On-going</p>
            </div>
        </div>
    </div>
</div>

    <!-- Card Container -->
    <div class="card-container">
        <!-- Total Students -->
        <div class="card">
            <img src="icons/totalstudents.png" alt="Total Students">
            <h5>5</h5>
            <p>Total Students</p>
        </div>

        <!-- Total Evaluations -->
        <div class="card">
            <img src="icons/evals.png" alt="Total Evaluations">
            <h5>0</h5>
            <p>Total Evaluations</p>
        </div>
    
</x-app-layout>
