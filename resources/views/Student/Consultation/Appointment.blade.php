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
                 
                            </h3>
                            <!-- Appointment Form -->
                            <form action="{{ route('Student.Consultation.Appointment') }}" method="POST">
    @csrf

    <div class="mt-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full" readonly autocomplete="name">
    </div>

    <div class="mt-4">
        <label for="course" class="block text-sm font-medium text-gray-700">Course</label>
        <select name="course" id="course" class="mt-1 block w-full" autocomplete="off">
            <option value="BSIT/1ST YEAR">BSIT/1ST YEAR</option>
            <option value="BSIT/2ND YEAR">BSIT/2ND YEAR</option>
            <option value="BSIT/3RD YEAR">BSIT/3RD YEAR</option>
            <option value="BSIT/4TH YEAR">BSIT/4TH YEAR</option>
        </select>
    </div>

    <div class="mt-4">
        <label for="consultant" class="block text-sm font-medium text-gray-700">Select Consultant</label>
        <select name="consultant" id="consultant" class="mt-1 block w-full" autocomplete="off">
            <option value="AdminConsultant">Admin Consultant</option>
            <option value="ComputerDepartmentConsultant">Computer Department Head</option>
        </select>
    </div>

    <div class="mt-4">
        <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
        <select name="purpose" id="purpose" class="mt-1 block w-full" autocomplete="off">
            <option value="Transfer">Transfer</option>
            <option value="Return to Class">Return to Class</option>
            <option value="Academic">Academic</option>
            <option value="Graduating">Graduating</option>
            <option value="Personal">Personal</option>
        </select>
    </div>

    <div class="mt-4">
        <label for="meeting_mode" class="block text-sm font-medium text-gray-700">Meeting Mode</label>
        <select name="meeting_mode" id="meeting_mode" class="mt-1 block w-full" autocomplete="off">
            <option value="Face to Face">Face to Face</option>
            <option value="Online">Online</option>
        </select>
    </div>

    <div class="mt-4" id="meeting_preference" style="display: none;">
        <label for="meeting_preference" class="block text-sm font-medium text-gray-700">Meeting Preference</label>
        <select name="meeting_preference" id="meeting_preference" class="mt-1 block w-full" autocomplete="off">
            <option value="Zoom">Zoom</option>
            <option value="Gmeet">Google Meet</option>
        </select>
    </div>

    <div class="mt-4">
        <label for="appointment_date_time" class="block text-sm font-medium text-gray-700">Date and Time</label>
        <input type="datetime-local" name="appointment_date_time" id="appointment_date_time" class="mt-1 block w-full" required autocomplete="off">
    </div>

    <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Book Appointment</button>
</form>


                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
            <h3 class="text-xl font-semibold text-green-600">Success!</h3>
            <p class="mt-2 text-gray-600">Your appointment has been successfully booked.</p>
            <button onclick="closeModal()" class="mt-4 bg-green-500 text-white py-2 px-4 rounded">Close</button>
        </div>
    </div>

    <script>
        // Function to show the modal
        function showModal() {
            document.getElementById('successModal').classList.remove('hidden');
        }

        // Function to hide the modal
        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
        }

      
       
    </script>
</x-app-layout>
