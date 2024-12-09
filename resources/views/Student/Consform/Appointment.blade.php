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
                        <option value="Transfer">Transfer</option>
                        <option value="Return to Class">Return to Class</option>
                        <option value="Academic">Academic</option>
                        <option value="Graduating">Graduating</option>
                        <option value="Personal">Personal</option>
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
                        <option value="Gmeet">Gmeet</option>
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
                    <input type="datetime-local" name="date_time" id="date_time" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
        document.getElementById('meeting_mode').addEventListener('change', function() {
            const preferenceContainer = document.getElementById('meeting_preference_container');
            if (this.value === 'Online') {
                preferenceContainer.style.display = 'block';
            } else {
                preferenceContainer.style.display = 'none';
                document.getElementById('meeting_preference').value = '';
            }
        });

        document.getElementById('consultant_role').addEventListener('change', function() {
            const purposeSelect = document.getElementById('purpose');
            const selectedConsultant = this.selectedOptions[0].dataset.role;

            if (selectedConsultant === 'HumanResources' || selectedConsultant === 'ComputerDepartment') {
                // Disable other options and set to "Personal"
                Array.from(purposeSelect.options).forEach(function(option) {
                    if (option.value !== 'Personal') {
                        option.disabled = true;
                    }
                });
                purposeSelect.value = 'Personal';
            } else {
                // Enable all options
                Array.from(purposeSelect.options).forEach(function(option) {
                    option.disabled = false;
                });
            }
        });
    </script>
</x-app-layout>
