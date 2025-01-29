<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills Count') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Print Button -->
        <div class="print-button" style="text-align: right; margin-top: 10px;">
            <button onclick="window.print()" style="background-color: #1d4ed8; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Print
            </button>
        </div>

        <!-- Rating Counts for Each Skill Section -->
        <div id="print-section" style="background-color: #ffffff; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-top: 20px;">
            <h3 style="margin-bottom: 1rem;"><strong>Rating Counts for Each Skill (Across All Evaluations):</strong></h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                <thead>
                    <tr style="background-color: #f3f4f6;">
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left; color: #4b5563; font-weight: 600;">Skill</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">5</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">4</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">3</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">2</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">1</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totals = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                    @endphp

                    @foreach ($ratingCounts as $skill => $ratings)
                        <tr style="{{ $loop->even ? 'background-color: #f9fafb;' : '' }}">
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ ucfirst($skill) }}</td>
                            @foreach ([5, 4, 3, 2, 1] as $rating)
                                <td style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">
                                    {{ $ratings[$rating] }}
                                </td>
                                @php
                                    $totals[$rating] += $ratings[$rating];
                                @endphp
                            @endforeach
                        </tr>
                    @endforeach

                    <!-- Total Row -->
                    <tr style="background-color: #f3f4f6; font-weight: bold;">
                        <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">Total</td>
                        @foreach ([5, 4, 3, 2, 1] as $rating)
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">
                                {{ $totals[$rating] }}
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Teacher Comments Section -->
        <div class="teacher-comments" style="margin-top: 30px;">
            <h3>Teacher Comments</h3>
            <table class="comments-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                    <tr style="background-color: #f3f4f6;">
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Teacher</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Subject</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluations as $evaluation)
                        <tr style="{{ $loop->even ? 'background-color: #f9fafb;' : '' }}">
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ $evaluation->teacher_name }}</td>
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ $evaluation->subject }}</td>
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ $evaluation->teacher_comment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Breakdown Section -->
        <div class="breakdown-section" id="print-section" style="margin-top: 30px;">
            <h3 class="breakdown-title">Total Percentage Breakdown</h3>
            @php
                $totalSkills = $evaluations->sum(fn($e) => array_sum($e->teaching_skills));
                $totalFacilities = $evaluations->sum(fn($e) => collect($e->facilities)->pluck('rating')->sum());
                $totalSkillsPercentage = ($totalSkills / (20 * count($evaluations))) * 100;
                $totalFacilitiesPercentage = ($totalFacilities / (25 * count($evaluations))) * 100;
                $overallPercentage = ($totalSkillsPercentage + $totalFacilitiesPercentage) / 2;

                $rating = $overallPercentage >= 90 ? 'Excellent (5)' :
                          ($overallPercentage >= 75 ? 'Very Good (4)' :
                          ($overallPercentage >= 50 ? 'Good (3)' :
                          ($overallPercentage >= 25 ? 'Fair (2)' : 'Poor (1)')));
            @endphp
            <div class="percentage-breakdown">
                <p>Skills: <strong>{{ round($totalSkillsPercentage, 2) }}%</strong></p>
                <p>Facilities: <strong>{{ round($totalFacilitiesPercentage, 2) }}%</strong></p>
                <h4 class="overall-rating">Overall Rating: <strong>{{ $rating }}</strong></h4>
            </div>
        </div>
    </div>
</x-app-layout>
