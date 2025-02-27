<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Summary') }}
        </h2>
    </x-slot>

    <div class="container mx-auto max-w-5xl">
        <div class="flex justify-end mt-5">
            <button onclick="printTable()" class="bg-green-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-green-600">
                Print
            </button>
        </div>

        <div id="print-section" class="bg-white p-6 rounded-lg shadow-lg mt-5 flex gap-6">
            
            <!-- Skills Evaluation Table -->
            <div class="w-1/2">
                <h2 class="text-xl font-bold text-center">Skills Evaluation</h2>
                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Skill</th>
                            <th class="border border-gray-300 px-4 py-2">5</th>
                            <th class="border border-gray-300 px-4 py-2">4</th>
                            <th class="border border-gray-300 px-4 py-2">3</th>
                            <th class="border border-gray-300 px-4 py-2">2</th>
                            <th class="border border-gray-300 px-4 py-2">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratingCounts as $skill => $ratings)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($skill) }}</td>
                                @foreach ([5, 4, 3, 2, 1] as $rating)
                                    <td class="border border-gray-300 px-4 py-2">{{ $ratings[$rating] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Teacher Details Table -->
            <div class="w-1/2">
                <h2 class="text-xl font-bold text-center">Teacher Details</h2>
                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Teacher</th>
                            <th class="border border-gray-300 px-4 py-2">Subject</th>
                            <th class="border border-gray-300 px-4 py-2">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="border border-gray-300 px-4 py-2">{{ $evaluation->teacher_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $evaluation->subject }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $evaluation->teacher_comment }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
