<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("This is the Appointment page.") }}

                    <!-- Check if the user is a student and if they are college or highschool -->
                    @if(Auth::user()->role == 'Student')
                        @if(in_array(Auth::user()->student_type, ['college', 'highschool']))
                            <h3 class="mt-4">
                                @if(Auth::user()->student_type == 'college')
                                    You are a College Student, ready to book your appointment.
                                @elseif(Auth::user()->student_type == 'highschool')
                                    You are a Highschool Student, ready to book your appointment.
                                @endif
                            </h3>
                        @else
                            <p class="mt-4">You are not a valid student type for appointment scheduling.</p>
                        @endif
                    @else
                        <p class="mt-4">You are not a student. You cannot book an appointment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
