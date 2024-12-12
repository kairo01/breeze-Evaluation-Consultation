<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose Department') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/Evaluation/Hrpick.css') }}">
    <div class="container">
        <div class="courses-container">
            <!-- College Picker -->
            <div class="course-button college">
                <img class="course-icon" src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="College Department Icon">
                <div><a href="Student.evaluation.CollegeStudent">COLLEGE DEPARTMENT</a></div>
            </div>
            
            <!-- High School Picker -->
            <div class="course-button highschool">
                <img class="course-icon" src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="High School Icon">
                <div><a href="Student.evaluation.HigSchoolStudent">HIGH SCHOOL</a></div>
            </div>
        </div>
    </div>
</x-app-layout>
