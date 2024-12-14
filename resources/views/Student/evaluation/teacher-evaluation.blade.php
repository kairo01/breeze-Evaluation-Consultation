<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teacher Evaluations') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Teacher Name</th>
                    <th class="border px-4 py-2">Subject</th>
                    <th class="border px-4 py-2">Teaching Skills</th>
                    <th class="border px-4 py-2">Facilities</th>
                    <th class="border px-4 py-2">Teacher Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $evaluation)
                    <tr>
                        <td class="border px-4 py-2">{{ $evaluation->teacher_name }}</td>
                        <td class="border px-4 py-2">{{ $evaluation->subject }}</td>
                        <td class="border px-4 py-2">
                            <ul>
                                @foreach ($evaluation->teaching_skills as $skill => $rating)
                                    <li>{{ $skill }}: {{ $rating }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border px-4 py-2">
                            <ul>
                                @foreach ($evaluation->facilities as $facility => $data)
                                    <li>{{ $facility }}: Rating {{ $data['rating'] }} @if($data['comment']) - Comment: {{ $data['comment'] }} @endif</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="border px-4 py-2">{{ $evaluation->teacher_comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
