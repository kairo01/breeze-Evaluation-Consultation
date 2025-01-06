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
            <div class="table-container">
                <table class="evaluation-table">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Total Skills</th>
                            <th>Total Facilities</th>
                            <th>Percentage Breakdown</th>
                            <th>Facility Comments</th>
                            <th>Overall Skills</th>
                            <th>Actions</th>
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
                                <td>{{ $skillsTotal }}</td>
                                <td>{{ $facilitiesTotal }}</td>
                                <td>
                                    Skills: <strong>{{ round(($skillsTotal / $maxSkillsScore) * 100, 2) }}%</strong>, 
                                    Facilities: <strong>{{ round(($facilitiesTotal / $maxFacilitiesScore) * 100, 2) }}%</strong>
                                </td>
                                <td>
                                    @foreach ($evaluation->facilities as $facility => $details)
                                        <p><strong>{{ $facility }}:</strong> {{ $details['comment'] }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($overallSkillsTotal as $skill => $total)
                                        <p><strong>{{ $skill }}:</strong> {{ $total }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    <button class="modal-button" onclick="openModal('skills-modal-{{ $loop->index }}')">  
                                        <i class="fas fa-eye"></i> View Skills
                                    </button>
                                    <button class="modal-button" onclick="openModal('facilities-modal-{{ $loop->index }}')">
                                        <i class="fas fa-eye"></i> View Facilities
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Percentage Breakdown and Skills -->
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

                <h4 class="skills-breakdown-title">Overall Skills Breakdown</h4>
                <ul class="skills-list">
                    @foreach ($overallSkillsTotal as $skill => $total)
                        <li><strong>{{ $skill }}:</strong> {{ $total }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Modals for Skills and Facilities -->
            @foreach ($evaluations as $evaluation)
                <!-- Skills Modal -->
                <div class="modal" id="skills-modal-{{ $loop->index }}">
                    <div class="modal-content">
                        <span class="close-button" onclick="closeModal('skills-modal-{{ $loop->index }}')">&times;</span>
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
                    </div>
                </div>

                <!-- Facilities Modal -->
                <div class="modal" id="facilities-modal-{{ $loop->index }}">
                    <div class="modal-content">
                        <span class="close-button" onclick="closeModal('facilities-modal-{{ $loop->index }}')">&times;</span>
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
                    </div>
                </div>
            @endforeach
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
            // Hide the buttons and modals before printing
            document.querySelectorAll('button').forEach(button => button.style.display = 'none');
            document.querySelectorAll('.modal').forEach(modal => modal.style.display = 'none');
            
            const printContent = document.getElementById('print-section').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            
            window.print();
            
            // After printing, reset the page content and display the buttons/modals again
            document.body.innerHTML = originalContent;
            window.location.reload();
        }
    </script>

</x-app-layout>
