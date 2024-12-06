</x-app-layout>

<body>

    <h1 class="department-title">Select Department</h1>

    <div class="department-container">
        @foreach($departments as $department)
            <div class="department-item">
                <a href="{{ url('/faculty/'.$department) }}" class="department-link">
                <!-- Add your image path dynamically here -->
                <img src="{{ $departmentImages[$department] ?? asset('images/default.jpg') }}" alt="{{ $department }} Image">
                    <a href="{{ url('/faculty/'.$department) }}" class="department-link">
                    {{ $department }}
                </a>
                    </a>
            </div>
        @endforeach
    </div>

</body>
</x-app-layout>