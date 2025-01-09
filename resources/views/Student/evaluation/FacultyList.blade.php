<x-app-layout>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="header-title">
            {{ $department['name'] }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/Evaluation/EvaluationHistory.css') }}">

    <div class="content">
       
        @if(array_key_exists('head', $department))
            <div class="department-head">
                <img src="{{ asset($department['head']['image']) }}" alt="Department Head" class="head-img">
                <h3>Department Head: {{ $department['head']['name'] }}</h3>

                <a href="{{ route('Student.evaluation.evaluationform', ['teacher_name' => $department['head']['name']]) }}">
                    <button class="evaluate-btn">Evaluate</button>
                </a>
            </div>
        @endif

        <div class="faculty-members">
            @foreach($department['faculty'] as $faculty)
                <div class="faculty-card">
                    <img src="{{ asset($faculty['image']) }}" alt="Faculty Member" class="faculty-img">
                    <h4>{{ $faculty['name'] }}</h4>
                    <a href="{{ route('Student.evaluation.evaluationform', ['teacher_name' => $faculty['name']]) }}">
                        <button class="evaluate-btn">Evaluate</button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @section('title')
        Student Faculty Evaluate
    @endsection
</x-app-layout>
