<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Department') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrFaculty.css') }}">

    <div class="container">
        <div class="department-grid">
            <!-- Existing department links -->
            <a href="{{ route('evaluation.history', ['department' => 'computer']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/CS.jfif') }}" alt="Computer Department Logo" class="department-logo">
                <h3>Computer Department</h3>
            </a>
            <a href="{{ route('evaluation.history', ['department' => 'hm']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/HM.jfif') }}" alt="HM Department Logo" class="department-logo">
                <h3>HM Department</h3>
            </a>
            <a href="{{ route('evaluation.history', ['department' => 'tesda']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/Tesda.png') }}" alt="Tesda Department Logo" class="department-logo">
                <h3>Tesda Department</h3>
            </a>
            <a href="{{ route('evaluation.history', ['department' => 'engineering']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="Engineering Department Logo" class="department-logo">
                <h3>Engineering Department</h3>
            </a>
        </div>

        <!-- Display HR data if available -->
        @if(isset($hrData) && count($hrData) > 0)
            <div class="hr-data">
                <h3>HR Data</h3>
                <ul>
                    @foreach($hrData as $hrItem)
                        <li>{{ $hrItem['name'] }} - {{ $hrItem['position'] }}</li> <!-- Adjust according to your data structure -->
                    @endforeach
                </ul>
            </div>
        @else
            <p>No HR data available.</p>
        @endif
    </div>
</x-app-layout>
