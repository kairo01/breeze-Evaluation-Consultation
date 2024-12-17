    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Department') }}
        </h2>
    </x-slot>

      <link rel="stylesheet" href="{{ asset('css/Evaluation/HrFaculty.css') }}">

    <div class="container">
        <div class="department-grid">
            <!-- Computer Department -->
            <a href="{{ route('evaluation.history', ['department' => 'highschool']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/CS.jfif') }}" alt="Computer Department Logo" class="department-logo">
                <h3>HighSchool Department</h3>
            </a>
       </div>  
    </div>


</x-app-layout>
