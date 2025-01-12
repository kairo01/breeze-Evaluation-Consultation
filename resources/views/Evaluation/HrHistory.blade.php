<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation History') }}
        </h2>
    </x-slot>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Evaluation/HrViewHistory.css') }}">

    <!-- Rating Scale Container -->
    <div class="rating-scale-container">
        <p><strong>Rating Scale: </strong> 
            <i class="fas fa-sad-cry" style="color: #ff4c4c;"></i> 1 - Poor | 
            <i class="fas fa-frown" style="color: #ff914d;"></i> 2 - Fair | 
            <i class="fas fa-meh" style="color: #f0e500;"></i> 3 - Good | 
            <i class="fas fa-smile" style="color: #66bb6a;"></i> 4 - Very Good | 
            <i class="fas fa-laugh-beam" style="color: #2b9f3e;"></i> 5 - Excellent
        </p>

        <button onclick="printBreakdown()" class="print-button">
            <i class="fas fa-print"></i> Print
        </button>
    </div>

    <div class="container">
        @if(count($evaluations) > 0)
            <!-- Main Evaluation Table -->
            <div class="table-container" id="evaluation-table-container">
                <table class="evaluation-table">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Percentage Breakdown</th>
                            <th>Teacher Comment</th> <!-- New Column for Teacher Comment -->
                            <th>View Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $totalSkills = 0;
                            $totalFacilities = 0;
                            $maxSkillsScore = 20;
                            $maxFacilitiesScore = 25;
                            $overallSkillsTotal = [];
                        @endphp

                        @foreach ($evaluations as $evaluation)
                            @php
                                $skillsTotal = array_sum($evaluation->teaching_skills);
                                $facilitiesTotal = collect($evaluation->facilities)->pluck('rating')->sum();

                                foreach ($evaluation->teaching_skills as $skill => $rating) {
                                    if (!isset($overallSkillsTotal[$skill])) {
                                        $overallSkillsTotal[$skill] = 0;
                                    }
                                    $overallSkillsTotal[$skill] += $rating;
                                }

                                $totalSkills += $skillsTotal;
                                $totalFacilities += $facilitiesTotal;
                            @endphp

                            <tr>
                                <td>{{ $evaluation->teacher_name }}</td>
                                <td>{{ $evaluation->subject }}</td>
                                <td>
                                    Skills: <strong>{{ round(($skillsTotal / $maxSkillsScore) * 100, 2) }}%</strong>, 
                                    Facilities: <strong>{{ round(($facilitiesTotal / $maxFacilitiesScore) * 100, 2) }}%</strong>
                                </td>
                                <td>{{ $evaluation->teacher_comment }}</td> <!-- Display Teacher Comment -->
                                <td>
                                    <button class="modal-button" onclick="openModal('skills-modal-{{ $loop->index }}')">  
                                          <i class="fas fa-chalkboard-teacher"></i> View Skills
                                    </button>
                                    <button class="modal-button" onclick="openModal('facilities-modal-{{ $loop->index }}')">
                                        <i class="fas fa-building"></i> View Facilities
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Percentage Breakdown -->
            <div class="breakdown-section" id="print-section">
                <h3 class="breakdown-title">Total Percentage Breakdown</h3>
                @php
                    $totalSkillsPercentage = ($totalSkills / ($maxSkillsScore * count($evaluations))) * 100;
                    $totalFacilitiesPercentage = ($totalFacilities / ($maxFacilitiesScore * count($evaluations))) * 100;

                    // Calculate the overall percentage by averaging skills and facilities percentages
                    $overallPercentage = ($totalSkillsPercentage + $totalFacilitiesPercentage) / 2;

                    // Determine the overall rating based on the overall percentage
                    $rating = '';
                    if ($overallPercentage >= 90) {
                        $rating = 'Excellent (5)';
                    } elseif ($overallPercentage >= 75) {
                        $rating = 'Very Good (4)';
                    } elseif ($overallPercentage >= 50) {
                        $rating = 'Good (3)';
                    } elseif ($overallPercentage >= 25) {
                        $rating = 'Fair (2)';
                    } else {
                        $rating = 'Poor (1)';
                    }
                @endphp
                <div class="percentage-breakdown">
                    <p>Skills: <strong>{{ round($totalSkillsPercentage, 2) }}%</strong></p>
                    <p>Facilities: <strong>{{ round($totalFacilitiesPercentage, 2) }}%</strong></p>
                    <h4 class="overall-rating">Overall Rating: <strong>{{ $rating }}</strong></h4>
                </div>
            </div>

            <!-- Modals for Skills and Facilities (Visible for Interaction and Printing) -->
            <div id="modals-container">
                @foreach ($evaluations as $evaluation)
                    <!-- Skills Modal -->
                    <div class="modal" id="skills-modal-{{ $loop->index }}">
                        <div class="modal-content">
                              <button class="close-button" onclick="closeModal('skills-modal-{{ $loop->index }}')">&times;</button>
                            <h4>Skills for {{ $evaluation->teacher_name }} ({{ $evaluation->subject }})</h4>
                            <table class="modal-table">
                                <thead>
                                    <tr>
                                        <th>Skill</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evaluation->teaching_skills as $skill => $rating)
                                        <tr>
                                            <td>{{ $skill }}</td>
                                            <td>{{ $rating }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4>Total Skills: <strong>{{ $skillsTotal }}</strong></h4> <!-- Total Skills for this evaluation -->
                        </div>
                    </div>

                    <!-- Facilities Modal -->
                    <div class="modal" id="facilities-modal-{{ $loop->index }}">
                        <div class="modal-content">
                                <button class="close-button" onclick="closeModal('facilities-modal-{{ $loop->index }}')">&times;</button>
                            <h4>Facilities for {{ $evaluation->teacher_name }} ({{ $evaluation->subject }})</h4>
                            <table class="modal-table">
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
                                </tbody>
                            </table>
                            <h4>Total Facilities: <strong>{{ $facilitiesTotal }}</strong></h4> <!-- Total Facilities for this evaluation -->
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="no-history-message">
                <h3>No History Available</h3>
            </div>
        @endif
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function printBreakdown() {
            // Temporarily hide buttons for printing, but keep modals visible
            document.querySelectorAll('.modal-button').forEach(button => button.style.display = 'none');

            // Get the evaluation table and modals content for printing
            const evaluationTable = document.getElementById('evaluation-table-container').outerHTML;
            const modalsContent = document.getElementById('modals-container').outerHTML;
            const breakdownSection = document.getElementById('print-section').outerHTML;

            // Create the content for the print preview
            const printContent = `
                <div class="print-header">
                    <h2>Evaluation History</h2>
                    <p>Rating Scale: 1 - Poor, 2 - Fair, 3 - Good, 4 - Very Good, 5 - Excellent</p>
                </div>
                ${evaluationTable}
                ${breakdownSection}
                ${modalsContent}
            `;

            // Set up print styles
            const printStyles = `
                <style>
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                        padding: 5px;
                    }
                    th, td {
                        text-align: left;
                    }
                    .modal {
                        display: block;
                    }
                </style>
            `;

            // Open a new window for printing
            const printWindow = window.open('', '_blank');
            printWindow.document.write(printStyles);
            printWindow.document.write(printContent);
            printWindow.document.close();

            // Trigger the print action
            printWindow.print();

            // Close the print window after printing
            printWindow.close();

            // Restore visibility of buttons and modals after printing
            document.querySelectorAll('.modal-button').forEach(button => button.style.display = 'inline-block');
        }
    </script>
</x-app-layout>
