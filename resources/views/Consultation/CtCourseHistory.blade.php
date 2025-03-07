<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($program . '/' . $course . ' Guidance History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Appointment History</h3>
                    <div class="p-6 bg-white border-b border-gray-200 print-content">
                    <x-history-controls :route="route('Consultation.CtCourseHistory', ['program' => $program, 'course' => $course])" />
                    @if($appointments->isEmpty())
                        <p>No appointments found for this course.</p>
                    @else
                        <div id="appointment-table">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Student Name
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Course
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Purpose
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Date / Time
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $appointment->student->name }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $appointment->course }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $appointment->purpose }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $appointment->formatted_date_time }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold 
                                                    @if($appointment->status == 'Approved') 
                                                        text-green-900 bg-green-200
                                                    @elseif($appointment->status == 'Pending')
                                                        text-yellow-900 bg-yellow-200
                                                    @else
                                                        text-red-900 bg-red-200
                                                    @endif
                                                ">
                                                    {{ $appointment->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="mt-4 flex justify-between items-center">
                                <div>
                                    {{ $appointments->firstItem() }} - {{ $appointments->lastItem() }} of {{ $appointments->total() }}
                                </div>
                                <div class="flex">
                                    @if ($appointments->onFirstPage())
                                        <span class="px-2 py-1 bg-gray-200 text-gray-600 rounded-l">Previous</span>
                                    @else
                                        <a href="{{ $appointments->previousPageUrl() }}" class="px-2 py-1 bg-blue-500 text-white rounded-l hover:bg-blue-600">Previous</a>
                                    @endif

                                    <span class="px-2 py-1 bg-gray-100">
                                        Page {{ $appointments->currentPage() }} of {{ $appointments->lastPage() }}
                                    </span>

                                    @if ($appointments->hasMorePages())
                                        <a href="{{ $appointments->nextPageUrl() }}" class="px-2 py-1 bg-blue-500 text-white rounded-r hover:bg-blue-600">Next</a>
                                    @else
                                        <span class="px-2 py-1 bg-gray-200 text-gray-600 rounded-r">Next</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

