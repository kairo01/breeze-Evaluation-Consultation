<x-app-layout>
    <x-slot name="header">
       <h2 class="header-title">
            {{ $department['name'] }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/Evaluation/EvaluationHistory.css') }}">

    <div class="content">
        <!-- Department Head Section -->
        <div class="department-head">
            <img src="{{ asset($department['head']['image']) }}" alt="Department Head" class="head-img">
            <h3>Department Head: {{ $department['head']['name'] }}</h3>
            
            <a href="{{ route('Evaluation.History', ['teacher_name' => $department['head']['name']]) }}" class="evaluate-btn">View Evaluation History</a>
        </div>

        <!-- Faculty Members Section -->
        <div class="faculty-members">
            @foreach($department['faculty'] as $faculty)
                <div class="faculty-card">
                    <img src="{{ asset($faculty['image']) }}" alt="Faculty Member" class="faculty-img">
                    <h4>{{ $faculty['name'] }}</h4>
                    <a href="{{ route('Evaluation.History', ['teacher_name' => $faculty['name']]) }}" class="evaluate-btn">View Evaluation History</a>
                </div>
              
            @endforeach
        </div>
    </div>
</x-app-layout>
