<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left uppercase tracking-wide">Teacher</th>
                        <th class="px-4 py-2 text-left uppercase tracking-wide">Subject</th>
                        <th class="px-4 py-2 text-left uppercase tracking-wide">Skills</th>
                        <th class="px-4 py-2 text-left uppercase tracking-wide">Facilities</th>
                        <th class="px-4 py-2 text-left uppercase tracking-wide">Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluations as $evaluation)
                        <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                            <td class="px-4 py-3 border-b border-gray-200">{{ $evaluation->teacher_name }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $evaluation->subject }}</td>

                            <!-- Teaching Skills -->
                            <td class="px-4 py-3 border-b border-gray-200">
                                @foreach ($evaluation->teaching_skills as $skill => $rating)
                                    <div class="text-xs text-gray-600 mb-1">
                                        <strong class="font-semibold text-gray-800">{{ $skill }}:</strong> {{ $rating }}
                                    </div>
                                @endforeach
                            </td>

                            <!-- Facilities (Flexbox Row) -->
                            <td class="px-4 py-3 border-b border-gray-200">
                                @foreach ($evaluation->facilities as $facility => $details)
                                    <div class="flex items-center space-x-4 mb-2">
                                        <strong class="font-semibold text-gray-800 w-1/3">{{ $facility }}:</strong>
                                        <div class="text-xs text-gray-600 w-1/3">Rating: <span class="text-blue-600">{{ $details['rating'] }}</span></div>
                                        <div class="text-xs text-gray-600 w-1/3">Comment: {{ $details['comment'] }}</div>
                                    </div>
                                @endforeach
                            </td>

                            <td class="px-4 py-3 border-b border-gray-200">{{ $evaluation->year }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
