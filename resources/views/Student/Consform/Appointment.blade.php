<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Appointment Form
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
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

            <form action="{{ route('Student.Consform.Appointment.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
                        <option value="BSIT/1ST YEAR/101">BSIT/1ST YEAR/101 - BSIT</option>
                        <option value="BSIT/2ND YEAR/202">BSIT/2ND YEAR/202 - BSIT</option>
                        <option value="BSIT/3RD YEAR/301">BSIT/3RD YEAR/301 - BSIT</option>
                        <option value="BSIT/4TH YEAR/401">BSIT/4TH YEAR/401 - BSIT</option>
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
                            @if($user->role !== 'HumanResources') <!-- Exclude HumanResources -->
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
    <label class="block text-gray-700 text-sm font-bold mb-2" for="date_time">
        Date and Time:
    </label>
    <input type="datetime-local" name="date_time" id="date_time" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="{{ now()->format('Y-m-d\TH:i') }}" />
    @error('date_time')
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

    <!-- Tailwind JS for Conditional Display -->
    <script>
        document.getElementById('date_time').addEventListener('change', function() {
                        const selectedDateTime = new Date(this.value);
                        const startHour = new Date(selectedDateTime);
                        startHour.setHours(8, 0, 0); // 8 AM
                        const endHour = new Date(selectedDateTime);
                        endHour.setHours(17, 0, 0); // 5 PM

                        if (selectedDateTime < startHour || selectedDateTime > endHour) {
                            alert('Please select a time between 8 AM and 5 PM.');
                            this.value = ''; // Clear the input
                        }
                    });
        document.getElementById('consultant_role').addEventListener('change', function() {
            const purposeSelect = document.getElementById('purpose');
            const selectedConsultant = this.selectedOptions[0].dataset.role;
            const meetingPreferenceContainer = document.getElementById('meeting_preference_container');
            
            // If the consultant is 'ComputerDepartment', show only 'Counseling'
            if (selectedConsultant === 'ComputerDepartment') {
                Array.from(purposeSelect.options).forEach(function(option) {
                    if (option.value !== 'Counseling') {
                        option.disabled = true;  // Disable all except 'Counseling'
                    }
                });
                purposeSelect.value = 'Counseling'; // Set the default to 'Counseling'
            } else {
                // Enable all options for other consultants
                Array.from(purposeSelect.options).forEach(function(option) {
                    option.disabled = false;
                });
            }

            // Show/Hide Meeting Preference based on Meeting Mode
            if (this.value && document.getElementById('meeting_mode').value === 'Online') {
                meetingPreferenceContainer.style.display = 'block';
            } else {
                meetingPreferenceContainer.style.display = 'none';
            }
        });

        // Ensure the meeting preference is hidden initially
        document.getElementById('meeting_mode').addEventListener('change', function() {
            const meetingPreferenceContainer = document.getElementById('meeting_preference_container');
            if (this.value === 'Online') {
                meetingPreferenceContainer.style.display = 'block';
            } else {
                meetingPreferenceContainer.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
