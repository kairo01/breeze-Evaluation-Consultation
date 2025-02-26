<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Summary') }}
        </h2>
    </x-slot>

    <!-- Centered Container -->
    <div class="container mx-auto max-w-5xl"> <!-- Tailwind: Centers & Limits Width -->
    <!-- <div class="container" style="margin: 0 auto; max-width: 900px;"> --> <!-- Alternative: Inline CSS -->
    
        <!-- Print Button -->
        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
            <button onclick="printTable()" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
                Print
            </button>
        </div>

        <!-- Print Section -->
        <div id="print-section" style="background-color: #ffffff; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-top: 20px;">
            <h2 style="font-size: 1.5rem; font-weight: bold; text-align: center;">Evaluation Summary</h2>

            <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                <thead>
                    <tr style="background-color: #f3f4f6;">
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Teacher</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Skill</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">5</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">4</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">3</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">2</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">1</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Subject</th>
                        <th style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totals = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                        $totalRatings = 0;
                    @endphp

                    @foreach ($ratingCounts as $skill => $ratings)
                        @php
                            $evaluation = $evaluations->shift();
                        @endphp
                        <tr style="{{ $loop->even ? 'background-color: #f9fafb;' : '' }}">
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ $evaluation->teacher_name ?? '' }}</td>
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ ucfirst($skill) }}</td>
                            @foreach ([5, 4, 3, 2, 1] as $rating)
                                <td style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">
                                    {{ $ratings[$rating] }}
                                </td>
                                @php
                                    $totals[$rating] += $ratings[$rating];
                                    $totalRatings += $ratings[$rating] * $rating;
                                @endphp
                            @endforeach
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ $evaluation->subject ?? '' }}</td>
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px;">{{ $evaluation->teacher_comment ?? '' }}</td>
                        </tr>
                    @endforeach

                    <!-- Total Row -->
                    <tr style="background-color: #f3f4f6; font-weight: bold;">
                        <td colspan="2" style="border: 1px solid #e5e7eb; padding: 12px 15px;">Total Skills</td>
                        @foreach ([5, 4, 3, 2, 1] as $rating)
                            <td style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left;">
                                {{ $totals[$rating] }}
                            </td>
                        @endforeach
                        <td colspan="2"></td>
                    </tr>

                    <!-- Total Percentage Breakdown -->
                    @php
                        $totalPossibleScore = 5 * array_sum($totals);
                        $totalPercentage = $totalPossibleScore > 0 ? ($totalRatings / $totalPossibleScore) * 100 : 0;

                        $ratingLabel = $totalPercentage >= 90 ? 'Excellent (5)' :
                                       ($totalPercentage >= 75 ? 'Very Good (4)' :
                                       ($totalPercentage >= 50 ? 'Good (3)' :
                                       ($totalPercentage >= 25 ? 'Fair (2)' : 'Poor (1)')));
                    @endphp
                    <tr style="background-color: #e0f2fe; font-weight: bold;">
                        <td colspan="2" style="border: 1px solid #e5e7eb; padding: 12px 15px;">Total Percentage</td>
                        <td colspan="5" style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: center;">
                            {{ round($totalPercentage, 2) }}%
                        </td>
                        <td colspan="2" style="border: 1px solid #e5e7eb; padding: 12px 15px; text-align: center;">
                            Overall Rating: <strong>{{ $ratingLabel }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function printTable() {
            var printContent = document.getElementById("print-section").innerHTML;
            var newWindow = window.open("", "_blank");
            newWindow.document.write(`
                <html>
                <head>
                    <title>Print Evaluation</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
                        th, td { border: 1px solid #e5e7eb; padding: 12px 15px; text-align: left; }
                        th { background-color: #f3f4f6; }
                        tr:nth-child(even) { background-color: #f9fafb; }
                        .highlight { background-color: #e0f2fe; font-weight: bold; }
                    </style>
                </head>
                <body>
                    ${printContent}
                </body>
                </html>
            `);
            newWindow.document.close();
            newWindow.print();
        }
    </script>
</x-app-layout>
