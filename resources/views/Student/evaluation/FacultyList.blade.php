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

            <x-nav-link :href="route('Student.evaluation.evaluationform', ['teacher_name' => $department['head']['name']])" :active="request()->routeIs('Student.evaluation.evaluationform')">
                         <button class="evaluate-btn">Evaluate</button>
                                </x-nav-link>

        </div>

        <!-- Faculty Members Section -->
        <div class="faculty-members">
            @foreach($department['faculty'] as $faculty)
                <div class="faculty-card">
                    <img src="{{ asset($faculty['image']) }}" alt="Faculty Member" class="faculty-img">
                    <h4>{{ $faculty['name'] }}</h4>
                    <button>
                    <x-nav-link :href="route('Student.evaluation.evaluationform', ['teacher_name' => $faculty['name']])" >
                            <button class="evaluate-btn">Evaluate</button>
                                </x-nav-link>
                    </button>
                </div>
        
            @endforeach
        </div>
    </div>
</x-app-layout>
