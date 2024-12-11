<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('College Course') }}
        </h2>
    </x-slot>


    <link rel="stylesheet" href="{{ asset('css/Evaluation/Hrcollege.css') }}">
    <div class="course-container">
        <a href="{{ url('EvaluationHistory') }}">
            <div class="course-item" data-title="Bachelor of Science in Technology Information">
            <img class="course-icon" src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="College Department Icon">
                <span class="course-name">Bachelor of Science in Technology Information</span>
            </div>
        </a>
        <a href="{{ url('HrHM') }}">
            <div class="course-item" data-title="Bachelor of Science in Hospitality Management">
                <img src="{{ asset('/CoursePicture/Hm.jfif') }}" alt="HM">
                <span class="course-name">Bachelor of Science in Hospitality Management</span>
            </div>
        </a>
        <a href="{{ url('HrACT') }}">
            <div class="course-item" data-title="Associate in Computer Technology">
                <img src="{{ asset('css/CourseLogo/Tesda.png') }}" alt="ACT">
                <span class="course-name">cssAssociate in Computer Technology</span>
            </div>
        </a>
        <a href="{{ url('HrHRT') }}">
            <div class="course-item" data-title="Hotel and Restaurant Technology">
                <img src="{{ asset('css/CourseLogo/Tesda.png') }}" alt="HRT">
                <span class="course-name">Hotel and Restaurant Technology</span>
            </div>
        </a>
        <a href="{{ url('HrBSCS') }}">
            <div class="course-item" data-title="Bachelor of Science in Computer Science">
                <img src="{{ asset('css/GeneralResources/logoo.jpg') }}" alt="BSCS">
                <span class="course-name">Bachelor of Science in Computer Science</span>
            </div>
        </a>
        <a href="{{ url('HrCET') }}">
            <div class="course-item" data-title="CET">
             <img src="{{ asset('css/CourseLogo/Tesda.png') }}" alt="CET">
                <span class="course-name">Computer Engineering Technology</span>
            </div>
        </a>
        <a href="{{ url('HrHRS') }}">
            <div class="course-item" data-title="Hotel & Restaurant Services">
            <img src="{{ asset('css/CourseLogo/Tesda.png') }}" alt="HRS">
                <span class="course-name">Hotel & Restaurant Services</span>
            </div>
        </a>
        <a href="{{ url('HrTourism') }}">
            <div class="course-item" data-title="Tourism">
            <img src="{{ asset('css/CourseLogo/Tesda.png') }}" alt="Tourism">
                <span class="course-name">Tourism</span>
            </div>
        </a>
    </div>

    <a href="{{ ('Evaluation.HrFacultylist') }}">
        <button class="back-button">Back</button>
    </a>
</x-app-layout>




