<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('Computer Department') }}
        </h2>
    </x-slot>
         <link rel="stylesheet" href="{{ asset('css/Evaluation/EvaluationHistory.css') }}">
    <div class="content">
        <!-- Department Head Section -->
        <div class="department-head">
            <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="Department Head" class="head-img">
            <h3>Department Head: Jhai De Guzman</h3>
            <button class="evaluate-btn">View Evaluation History</button>
        </div>

        <!-- Faculty Members Section -->
        <div class="faculty-members">
            <!-- Faculty Member 1 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Percian Joseph Borja</h4>
                <button class="evaluate-btn">View Evaluation History</button>
            </div>

            <!-- Faculty Member 2 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Eric Almoguerra</h4>
                <button class="evaluate-btn">View Evaluation History</button>
            </div>

            <!-- Faculty Member 3 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Aries Cayabyab</h4>
                <button class="evaluate-btn">View Evaluation History</button>
            </div>

            <!-- Faculty Member 4 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Nomer Aleviado</h4>
                <button class="evaluate-btn">View Evaluation History</button>
            </div>

            <!-- Faculty Member 5 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Joseph Chua</h4>
                <button class="evaluate-btn">View Evaluation History</button>
            </div>
        </div>
    </div>
</x-app-layout>
