<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Evaluation Details') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold text-lg mb-4 text-center">Teacher: {{ $evaluation->teacher_name }}</h2>
                    <p class="text-center">Subject: {{ $evaluation->subject }}</p>

                    <h3 class="font-bold text-md mt-6 mb-4 text-center">Teaching Skills</h3>
                    <ul>
                        @foreach ($evaluation->teaching_skills as $skill => $rating)
                            <li>{{ $skill }}: {{ $rating }}</li>
                        @endforeach
                    </ul>

                    <h3 class="font-bold text-md mt-6 mb-4 text-center">Facilities</h3>
                    <ul>
                        @foreach ($evaluation->facilities as $facility => $rating)
                            <li>{{ $facility }}: {{ $rating }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
