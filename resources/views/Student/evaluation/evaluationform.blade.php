<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Evaluation Form') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success mb-4 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('evaluation.store') }}" method="POST">
                        @csrf

                        <h2 class="font-bold text-lg mb-4 text-center">Teacher Evaluation</h2>

                        <div class="mb-4 text-center">
                            <label class="block text-gray-700">Teacher Name:</label>
                            <input type="text" name="teacher_name" class="form-control mt-2 w-2/3 mx-auto" required>
                        </div>

                        <div class="mb-4 text-center">
                            <label class="block text-gray-700">Subject:</label>
                            <input type="text" name="subject" class="form-control mt-2 w-2/3 mx-auto" required>
                        </div>

                        <h3 class="font-bold text-md mt-6 mb-4 text-center">Teaching Skills</h3>
                        <div class="space-y-4">
                            @foreach (['Subject Knowledge', 'Clarity', 'Teaching Methods', 'Organization', 'Pacing'] as $skill)
                                <div class="flex items-center">
                                    <label class="w-1/3 text-gray-700">{{ $skill }}</label>
                                    <div class="flex space-x-2 w-2/3 justify-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <label>
                                                <input type="radio" name="teaching_skills[{{ $skill }}]" value="{{ $i }}" required>
                                                {{ $i }}
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <h2 class="font-bold text-lg mt-6 mb-4 text-center">Facilities</h2>
                        <div class="space-y-4">
                            @foreach (['Comfort Room', 'Library', 'Cafeteria', 'Playground', 'Parking Area'] as $facility)
                                <div class="flex items-center">
                                    <label class="w-1/3 text-gray-700">{{ $facility }}</label>
                                    <div class="flex space-x-2 w-2/3 justify-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <label>
                                                <input type="radio" name="facilities[{{ $facility }}]" value="{{ $i }}" required>
                                                {{ $i }}
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
