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
                        // Initialize accumulators for total percentages
                        $totalSkills = 0;
                        $totalFacilities = 0;
                        $overallTotalRating = 0;

                        // Define maximum possible scores
                        $maxSkillsScore = 20;
                        $maxFacilitiesScore = 25;
                    @endphp

                    @foreach ($evaluations as $evaluation)
                        @php
                            // Calculate teaching skills total
                            $skillsTotal = array_sum($evaluation->teaching_skills);

                            // Calculate facilities total
                            $facilitiesTotal = collect($evaluation->facilities)
                                ->pluck('rating')
                                ->sum();

                            // Overall total
                            $totalRating = $skillsTotal + $facilitiesTotal;

                            // Update accumulators
                            $totalSkills += $skillsTotal;
                            $totalFacilities += $facilitiesTotal;
                            $overallTotalRating += $totalRating;

                            // Calculate percentages based on respective criteria totals
                            $skillsPercentage = $maxSkillsScore > 0 ? round(($skillsTotal / $maxSkillsScore) * 100, 2) : 0;
                            $facilitiesPercentage = $maxFacilitiesScore > 0 ? round(($facilitiesTotal / $maxFacilitiesScore) * 100, 2) : 0;
                        @endphp

                        <!-- Main Row -->
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
                            <td>{{ $skillsTotal }} ({{ $skillsPercentage }}%)</td>
                            <td>{{ $facilitiesTotal }} ({{ $facilitiesPercentage }}%)</td>
                            <!-- Total Rating -->
                            <td><strong>{{ $totalRating }}</strong></td>
                            <td>
                                Skills: <strong>{{ $skillsPercentage }}%</strong>, 
                                Facilities: <strong>{{ $facilitiesPercentage }}%</strong>
                            </td>
                        </tr>
                    @endforeach

                    @php
                        // Calculate overall percentages
                        $overallSkillsPercentage = $totalSkills > 0 ? round(($totalSkills / ($maxSkillsScore * count($evaluations))) * 100, 2) : 0;
                        $overallFacilitiesPercentage = $totalFacilities > 0 ? round(($totalFacilities / ($maxFacilitiesScore * count($evaluations))) * 100, 2) : 0;
                    @endphp
                </tbody>
            </table>
        </div>

        <!-- Total Percentage Breakdown -->
        <div class="table-container" style="margin-top: 2rem; padding: 1rem;" id="print-section">
            <h3>Total Percentage Breakdown:</h3>
            <p>Skills: <strong>{{ $overallSkillsPercentage }}%</strong></p>
            <p>Facilities: <strong>{{ $overallFacilitiesPercentage }}%</strong></p>
            <button onclick="printBreakdown()" style="margin-top: 1rem; padding: 0.5rem 1rem; background-color: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Breakdown</button>
        </div>

        <!-- Facilities Tables -->
        @foreach ($evaluations as $evaluation)
            <div class="table-container" style="margin-top: 2rem;">
                <h4 style="color: #2563eb; margin-bottom: 0.5rem;">
                    Facilities for {{ $evaluation->teacher_name }} ({{ $evaluation->subject }})
                </h4>
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
            window.location.reload(); // Reload the page to restore its state
        }
    </script>

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
            border: 1px solid #e5e7eb;
            margin-bottom: 2rem;
        }
        /* Table styling */
        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 20px;
            color: rgb(10, 10, 10);
        }
        .evaluation-table th, .evaluation-table td {
            border: 1px solid black;
            padding: 0.625rem 1rem;
            text-align: left;
        }
        .evaluation-table th {
            background: linear-gradient(to right, #2563eb, #4f46e5);
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .evaluation-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .evaluation-table tr:hover {
            background-color: #f3f4f6;
            transition: background-color 0.2s;
        }
        .skill {
            font-size: 0.875rem;
            color: #4b5563;
        }
        h4 {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
</x-app-layout>
