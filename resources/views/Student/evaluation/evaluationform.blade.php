<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Check if the user is a student and if they are college or highschool -->
                    @if(Auth::user()->role == 'Student')
                        @if(in_array(Auth::user()->student_type, ['college', 'highschool']))
                            <h1>
                                @if(Auth::user()->student_type == 'college')
                                    Welcome, College Student!
                                @elseif(Auth::user()->student_type == 'highschool')
                                    Welcome, Highschool Student!
                                @endif
                            </h1>
                        @else
                            <h1>You are not a student of the expected types.</h1>
                        @endif
                    @else
                        <h1>You are not a student.</h1>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
