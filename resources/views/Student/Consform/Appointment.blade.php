<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Appointment Form
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($pendingAppointment)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    You already have a pending appointment. Please wait for it to be approved before making a new one.
                </div>
            @endif

            <div id="busyDayMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                This day is busy. Please pick another date and time.
            </div>

            <form action="{{ route('Student.Consform.Appointment.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @if($pendingAppointment) onsubmit="return false;" @endif>
                @csrf

                <!-- Name (Display only) -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name:
                    </label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" disabled class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Course -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="course">
                        Course:
                    </label>
                    <select name="course" id="course" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Course</option>
                        @if(auth()->user()->student_type === 'College')
                            <option value="BSIT/1ST YEAR/101">BSIT/1ST YEAR/101 - BSIT</option>
                            <option value="BSIT/2ND YEAR/202">BSIT/2ND YEAR/202 - BSIT</option>
                            <option value="BSIT/3RD YEAR/301">BSIT/3RD YEAR/301 - BSIT</option>
                            <option value="BSIT/4TH YEAR/401">BSIT/4TH YEAR/401 - BSIT</option>
                        @else
                            @for($grade = 7; $grade <= 12; $grade++)
                                <option value="Grade {{ $grade }}/Section 1">Grade {{ $grade }}/Section 1</option>
                            @endfor
                        @endif
                    </select>
                    @error('course')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Consultant (excluding "HumanResources") -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="consultant_role">
                        Select Consultant:
                    </label>
                    <select name="consultant_role" id="consultant_role" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Consultant</option>
                        @foreach($users as $user)
                            @if((auth()->user()->student_type === 'HighSchool' && $user->role === 'HighSchoolDepartment') || 
                                (auth()->user()->student_type === 'College' && in_array($user->role, ['HmDepartment', 'EngineeringDeparment', 'TesdaDepartment', 'ComputerDepartment', 'Guidance'])))
                                <option value="{{ $user->id }}" data-role="{{ $user->role }}">{{ $user->role }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Purpose -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="purpose">
                        Purpose:
                    </label>
                    <select name="purpose" id="purpose" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Purpose</option>
                        <option value="Transfer Interview">Transfer Interview</option>
                        <option value="Return to Class Interview">Return to Class Interview</option>
                        <option value="Academic Problem">Academic Problem</option>
                        <option value="Graduating Interview and Exit Interview">Graduating Interview and Exit Interview</option>
                        <option value="Counseling">Counseling</option>
                    </select>
                    @error('purpose')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meeting Mode -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="meeting_mode">
                        Meeting Mode:
                    </label>
                    <select name="meeting_mode" id="meeting_mode" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Meeting Mode</option>
                        <option value="Face to Face">Face to Face</option>
                        <option value="Online">Online</option>
                    </select>
                    @error('meeting_mode')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meeting Preference (Conditional) -->
                <div class="mb-4" id="meeting_preference_container" style="display: none;">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="meeting_preference">
                        Meeting Preference:
                    </label>
                    <select name="meeting_preference" id="meeting_preference" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Preference</option>
                        <option value="Zoom">Zoom</option>
                        <option value="Whatsapp">Whatsapp</option>
                    </select>
                    @error('meeting_preference')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date and Time -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                        Date:
                    </label>
                    <input type="date" name="date" id="date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="{{ date('Y-m-d') }}">
                    @error('date')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="time_slot">
                        Time Slot:
                    </label>
                    <select name="time_slot" id="time_slot" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select a time slot</option>
                    </select>
                    <div id="time_slot_loading" class="text-gray-500 text-sm mt-2" style="display: none;">Loading time slots...</div>
                    <div id="time_slot_error" class="text-red-500 text-sm mt-2" style="display: none;"></div>
                    @error('time_slot')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Appoint
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const consultantRoleSelect = document.getElementById('consultant_role');
    const purposeSelect = document.getElementById('purpose');
    const meetingModeSelect = document.getElementById('meeting_mode');
    const meetingPreferenceContainer = document.getElementById('meeting_preference_container');
    const dateInput = document.getElementById('date');
    const timeSlotSelect = document.getElementById('time_slot');
    const timeSlotLoading = document.getElementById('time_slot_loading');
    const timeSlotError = document.getElementById('time_slot_error');

    consultantRoleSelect.addEventListener('change', function() {
        const selectedConsultant = this.selectedOptions[0].dataset.role;

        if (['HmDepartment', 'HighSchoolDepartment', 'EngineeringDeparment', 'TesdaDepartment', 'ComputerDepartment'].includes(selectedConsultant)) {
            Array.from(purposeSelect.options).forEach(function(option) {
                if (option.value !== 'Counseling') {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
            purposeSelect.value = 'Counseling';
        } else {
            Array.from(purposeSelect.options).forEach(function(option) {
                option.disabled = false;
            });
        }

        updateMeetingPreferenceVisibility();
        if (dateInput.value) {
            fetchAvailableTimeSlots();
        }
    });

    meetingModeSelect.addEventListener('change', updateMeetingPreferenceVisibility);

    function updateMeetingPreferenceVisibility() {
        if (consultantRoleSelect.value && meetingModeSelect.value === 'Online') {
            meetingPreferenceContainer.style.display = 'block';
        } else {
            meetingPreferenceContainer.style.display = 'none';
        }
    }

    dateInput.addEventListener('change', fetchAvailableTimeSlots);

    function fetchAvailableTimeSlots() {
        const date = dateInput.value;
        const consultantId = consultantRoleSelect.value;

        if (!date || !consultantId) {
            return;
        }

        timeSlotLoading.style.display = 'block';
        timeSlotError.style.display = 'none';
        timeSlotSelect.disabled = true;
        timeSlotSelect.innerHTML = '<option value="">Loading time slots...</option>';

        fetch(`/api/available-time-slots?date=${date}&consultant_id=${consultantId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            timeSlotSelect.innerHTML = '<option value="">Select a time slot</option>';
            if (data.availableSlots && data.availableSlots.length > 0) {
                data.availableSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = `${slot} - ${addHour(slot)}`;
                    timeSlotSelect.appendChild(option);
                });
                document.getElementById('busyDayMessage').classList.add('hidden');
            } else {
                timeSlotSelect.innerHTML = '<option value="">No available time slots</option>';
                document.getElementById('busyDayMessage').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            timeSlotError.textContent = `Error loading time slots: ${error.message}`;
            timeSlotError.style.display = 'block';
            timeSlotSelect.innerHTML = '<option value="">Error loading time slots</option>';
        })
        .finally(() => {
            timeSlotLoading.style.display = 'none';
            timeSlotSelect.disabled = false;
        });
    }

    function addHour(time) {
        const [hours, minutes] = time.split(':');
        const date = new Date(2000, 0, 1, hours, minutes);
        date.setHours(date.getHours() + 1);
        return date.toTimeString().slice(0, 5);
    }
});
    </script>

@section('title')
   Student Appointment Form
@endsection

</x-app-layout>

