<x-app-layout>
    <div class="container">
        <!-- Main Evaluation Table -->
        <div class="table-container">
            <table class="evaluation-table">
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Skills</th>
                        <th>Total Skills</th>
                        <th>Total Facilities</th>
                        <th>Total Rating</th>
                        <th>Percentage Breakdown</th>
                    </tr>
                </thead>
                
                <tbody>
                    @php
                        $totalSkills = 0;
                        $totalFacilities = 0;
                        $overallTotalRating = 0;
                        $maxSkillsScore = 20;
                        $maxFacilitiesScore = 25;
                    @endphp

                    @foreach ($evaluations as $evaluation)
                        @php
                            $skillsTotal = array_sum($evaluation->teaching_skills);
                            $facilitiesTotal = collect($evaluation->facilities)->pluck('rating')->sum();
                            $totalRating = $skillsTotal + $facilitiesTotal;

                            $totalSkills += $skillsTotal;
                            $totalFacilities += $facilitiesTotal;
                            $overallTotalRating += $totalRating;

                            $skillsPercentage = $maxSkillsScore > 0 ? round(($skillsTotal / $maxSkillsScore) * 100, 2) : 0;
                            $facilitiesPercentage = $maxFacilitiesScore > 0 ? round(($facilitiesTotal / $maxFacilitiesScore) * 100, 2) : 0;
                        @endphp

                        <tr>
                            <td>{{ $evaluation->teacher_name }}</td>
                            <td>{{ $evaluation->subject }}</td>
                            <td>
                                @foreach ($evaluation->teaching_skills as $skill => $rating)
                                    <div class="skill"><strong>{{ $skill }}:</strong> {{ $rating }}</div>
                                @endforeach
                            </td>
                            <td>{{ $skillsTotal }} ({{ $skillsPercentage }}%)</td>
                            <td>{{ $facilitiesTotal }} ({{ $facilitiesPercentage }}%)</td>
                            <td><strong>{{ $totalRating }}</strong></td>
                            <td>
                                Skills: <strong>{{ $skillsPercentage }}%</strong>, 
                                Facilities: <strong>{{ $facilitiesPercentage }}%</strong>
                            </td>
                        </tr>
                    @endforeach

                    @php
                        $overallSkillsPercentage = $totalSkills > 0 ? round(($totalSkills / ($maxSkillsScore * count($evaluations))) * 100, 2) : 0;
                        $overallFacilitiesPercentage = $totalFacilities > 0 ? round(($totalFacilities / ($maxFacilitiesScore * count($evaluations))) * 100, 2) : 0;
                    @endphp
                </tbody>
            </table>
        </div>

        <!-- Total Percentage Breakdown -->
        <div class="breakdown-section" id="print-section">
            <h3>Total Percentage Breakdown</h3>
            <p>Skills: <strong>{{ $overallSkillsPercentage }}%</strong></p>
            <p>Facilities: <strong>{{ $overallFacilitiesPercentage }}%</strong></p>
            <button onclick="printBreakdown()">Print Breakdown</button>
        </div>

        <!-- Facilities Tables -->
        @foreach ($evaluations as $evaluation)
            <div class="table-container">
                <h4>Facilities for {{ $evaluation->teacher_name }} ({{ $evaluation->subject }})</h4>
                <table class="evaluation-table">
                    <thead>
                        <tr>
                            <th>Facility</th>
                            <th>Rating</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluation->facilities as $facility => $details)
                            <tr>
                                <td>{{ $facility }}</td>
                                <td>{{ $details['rating'] }}</td>
                                <td>{{ $details['comment'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Total Facilities Rating:</strong></td>
                            <td>{{ collect($evaluation->facilities)->pluck('rating')->sum() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

    <script>
        function printBreakdown() {
            const printContent = document.getElementById('print-section').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload();
        }
    </script>

    <style>
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .table-container {
            background: #ffffff;
            border-radius: 8px;
            overflow-x: auto;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
        }
        .evaluation-table th, .evaluation-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .evaluation-table th {
            background: #4BC0C0;
            color: white;
        }
        .breakdown-section {
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
            text-align: center;
        }
        .breakdown-section h3 {
            margin-bottom: 10px;
        }
        .breakdown-section button {
            background: #4BC0C0;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .breakdown-section button:hover {
            background: #37a09b;
        }
    </style>
</x-app-layout>
