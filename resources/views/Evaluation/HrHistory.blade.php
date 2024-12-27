<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation History') }}
        </h2>
    </x-slot>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $totalSkills = 0;
                        $totalFacilities = 0;
                        $maxSkillsScore = 20;
                        $maxFacilitiesScore = 25;
                    @endphp

                    @foreach ($evaluations as $evaluation)
                        @php
                            $skillsTotal = array_sum($evaluation->teaching_skills);
                            $facilitiesTotal = collect($evaluation->facilities)->pluck('rating')->sum();

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

        <!-- Total Percentage Breakdown -->
        <div class="breakdown-section" id="print-section">
            <h3>Total Percentage Breakdown</h3>
            <p>Skills: <strong>{{ round(($totalSkills / ($maxSkillsScore * count($evaluations))) * 100, 2) }}%</strong></p>
            <p>Facilities: <strong>{{ round(($totalFacilities / ($maxFacilitiesScore * count($evaluations))) * 100, 2) }}%</strong></p>
        </div>

        <!-- Modals -->
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
        .evaluation-table, .modal-table {
            width: 100%;
            border-collapse: collapse;
        }
        .evaluation-table th, .evaluation-table td,
        .modal-table th, .modal-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .evaluation-table th, .modal-table th {
            background: #f4f4f4;
            color: black;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }
        .close-button:hover {
            color: #000;
        }
        .modal-button {
            background: rgb(0, 103, 247);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal-button:hover {
            background: rgb(15, 3, 189);
        }

        .rating-scale-container {
            position: relative;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 90px;
        }

        .rating-scale-container .print-button {
            position: absolute;
            top: 20px;
            right: 80px;
            background: rgb(0, 103, 247);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .rating-scale-container .print-button:hover {
            background: rgb(15, 3, 189);
        }

        @media print {
            button {
                display: none;
            }
            .modal {
                display: none;
            }
            .container {
                max-width: 100%;
                margin: 0;
                padding: 10px;
            }
        }
    </style>
</x-app-layout>
