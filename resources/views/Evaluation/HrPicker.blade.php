<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Department') }}
        </h2>
    </x-slot>

      <link rel="stylesheet" href="{{ asset('css/Evaluation/HrFaculty.css') }}">

    <div class="container">
        <div class="department-grid">
            <!-- Computer Department -->
            <a href="{{ route('evaluation.history', ['department' => 'computer']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/CS.jfif') }}" alt="Computer Department Logo" class="department-logo">
                    <h3>Computer Department</h3>
            </a>

            <!-- HM Department -->
            <a href="{{ route('evaluation.history', ['department' => 'hm']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/Hm.jfif') }}" alt="HM Department Logo" class="department-logo">
                    <h3>HM Department</h3>
            </a>

            <!-- Tesda Department -->
            <a href="{{ route('evaluation.history', ['department' => 'tesda']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/Tesda.png') }}" alt="Tesda Department Logo" class="department-logo">
                    <h3>Tesda Department</h3>
            </a>

            <!-- Engineering Department -->
            <a href="{{ route('evaluation.history', ['department' => 'engineering']) }}" class="department-card">
                <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="Engineering Department Logo" class="department-logo">
                   <h3>Engineering Department</h3>
            </a>

            <a href="{{ route('evaluation.history', ['department' => 'highschool']) }}" class="department-card">
               <img src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="Computer Department Logo" class="department-logo">
                  <h3>HighSchool Department</h3>
            </a>

            <a href="{{ route('evaluation.history', ['department' => 'gened']) }}" class="department-card">
                  <img src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="Gen Ed Faculty Logo" class="department-logo">
                       <h3>Gen Ed Faculty</h3>
            </a>
        </div>
    </div>

@section('title')
  Select Department
@endsection
</x-app-layout>
