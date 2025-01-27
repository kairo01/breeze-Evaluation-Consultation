<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Student Appointment History
       </h2>
   </x-slot>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           @if(session('success'))
               <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                   {{ session('success') }}
               </div>
           @endif

           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                   <x-history-controls :route="route('Student.StudentHistory')" />
                   <div id="appointment-table">
                       <table class="min-w-full leading-normal">
                           <thead>
                               <tr>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Consultant
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Course
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Purpose
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Meeting Mode
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Meeting Preference
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Date / Time
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Status
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Reason (if Declined)
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Approval Reason / Meeting Details
                                   </th>
                                   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                       Completed
                                   </th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($appointments as $appointment)
                                   <tr>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->consultant->name }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->course }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->purpose }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->meeting_mode }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->meeting_preference ?? 'N/A' }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->formatted_date_time }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                           @if($appointment->status === 'Pending')
                                               <span class="inline-block px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                                   Pending
                                               </span>
                                           @elseif($appointment->status === 'Approved')
                                               <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                   Approved
                                               </span>
                                           @elseif($appointment->status === 'Declined')
                                               <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">
                                                   Declined
                                               </span>
                                           @endif
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->decline_reason ?? 'N/A' }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                           {{ $appointment->approval_reason ?? 'N/A' }}
                                       </td>
                                       <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                           <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" 
                                                  {{ $appointment->is_completed ? 'checked' : '' }} 
                                                  {{ $appointment->status !== 'Approved' || !$appointment->is_past_due ? 'disabled' : '' }}
                                                  onchange="updateCompletionStatus({{ $appointment->id }}, this.checked)">
                                       </td>
                                   </tr>
                               @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <script>
   function updateCompletionStatus(appointmentId, isCompleted) {
       fetch(`/student/update-completion/${appointmentId}`, {
           method: 'POST',
           headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
           },
           body: JSON.stringify({ is_completed: isCompleted })
       })
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               console.log('Appointment completion status updated');
           } else {
               console.error('Failed to update appointment completion status');
           }
       });
   }
   </script>

@section('title')
  Student Appointment History
@endsection

</x-app-layout>

