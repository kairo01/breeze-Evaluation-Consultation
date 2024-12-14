<x-app-layout>
    <div class="container">
        <div class="table-container">
            <table class="evaluation-table">
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Skills</th>
                        <th>Facilities</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->teacher_name }}</td>
                            <td>{{ $evaluation->subject }}</td>
                            <!-- Teaching Skills -->
                            <td>
                                @foreach ($evaluation->teaching_skills as $skill => $rating)
                                    <div class="skill">
                                        <strong>{{ $skill }}:</strong> {{ $rating }}
                                    </div>
                                @endforeach
                            </td>
                            <!-- Facilities -->
                            <td>
                                @foreach ($evaluation->facilities as $facility => $details)
                                    <div class="facility">
                                        <strong>{{ $facility }}:</strong> 
                                        Rating: <span>{{ $details['rating'] }}</span>, 
                                        Comment: {{ $details['comment'] }}
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $evaluation->year }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <style>
        /* Container */
.container {
    margin: 0 auto;
    padding: 2rem 0;
    max-width: 1200px;
}

/* Table container */
.table-container {
    overflow-x: auto;
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    border: 1px solid #e5e7eb; /* Light gray border */
}

/* Table styling */
.evaluation-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 20px; /* Equivalent to Tailwind text-sm */
    color:rgb(10, 10, 10); /* Tailwind gray-700 */
}

/* Table header */
.evaluation-table th, .evaluation-table td {
    border: 1px solid black; /* Solid black border between cells */
    padding: 0.625rem 1rem; /* Equivalent to px-4 py-3 */
    text-align: left;
}

/* Table header */
.evaluation-table th {
    background: linear-gradient(to right, #2563eb, #4f46e5); /* Blue to indigo gradient */
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Zebra striping for even rows */
.evaluation-table tr:nth-child(even) {
    background-color: #f9fafb; /* Equivalent to Tailwind gray-100 */
}

/* Hover effect */
.evaluation-table tr:hover {
    background-color: #f3f4f6; /* Equivalent to Tailwind gray-50 */
    transition: background-color 0.2s;
}

/* Skill and facility details */
.skill, .facility {
    font-size: 0.875rem; /* Equivalent to text-xs */
    color: #4b5563; /* Tailwind gray-600 */
    margin-bottom: 0.5rem; /* Spacing between skills/facilities */
}

.facility {
    margin-bottom: 1rem; /* Additional spacing between facilities */
}

strong {
    font-weight: 600;
}


    </style>
</x-app-layout>
