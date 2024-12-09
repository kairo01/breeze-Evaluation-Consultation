<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    @if(Auth::user()->student_type == 'college')
                        <p>Welcome to the College Calendar</p>
                        <!-- Add College-specific content here -->
                    @elseif(Auth::user()->student_type == 'highschool')
                        <p>Welcome to the High School </p>
                        <!-- Add Highschool-specific content here -->
                    @else
                        <p>Your student type is not recognized.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
