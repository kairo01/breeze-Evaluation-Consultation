<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($program . ' Guidance History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-history-controls :route="route('Consultation.CtProgramHistory', $program)" />
                    <h3 class="text-lg font-semibold mb-4">Courses</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($courses as $course)
                            <a href="{{ route('Consultation.CtCourseHistory', ['program' => $program, 'course' => explode('/', $course)[1]]) }}" class="block p-6 bg-gray-100 rounded-lg hover:bg-gray-200">
                                <h4 class="font-semibold text-lg">{{ explode('/', $course)[1] }}</h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

