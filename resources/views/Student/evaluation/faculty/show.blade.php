
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Averia+Serif+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=DM+Serif+Text:ital@0;1&family=Diplomata+SC&display=swap" rel="stylesheet">

<div class="faculty-page">

    <div class="header">
        <h2>{{ $department }} Department</h2>
    </div>

    <div class="faculty-head">
        <div class="faculty-picture">
            
            <img src="{{ asset('css/evaluatepicture/img1.jpg') }}" alt="Department Head Picture">
            <img src="{{ $details['head']['image'] }}" alt="{{ $details['head']['name'] }} Picture">
        </div>

        <p>Department Head: {{ $details['head']['name'] }}</p>
        <a href="{{ route('evaluation-form') }}" class="btn-evaluate">Evaluate</a>
    </div>

        @foreach($details['members'] as $member)
            <div class="faculty-member">
                <div class="faculty-picture">
                    
                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }} Picture">
                </div>
                <p>{{ $member['name'] }}</p>
                <a href="{{ route('evaluation-form') }}" class="btn-evaluate">Evaluate</a>
            </div>
        @endforeach
    </div>
</div>


</body>
</html>