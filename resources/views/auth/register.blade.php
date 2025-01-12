<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role -->
        <div class="mt-4">
            <label for="role">Role</label>
            <select id="role" name="role" class="block mt-1 w-full" onchange="toggleStudentIdField()">
                <option value="admin">Admin</option>
                <option value="student">Student</option>
            </select>
        </div>

        <!-- Student ID (hidden by default) -->
        <div id="student-id-field" class="mt-4" style="display: none;">
            <x-input-label for="student_id" :value="__('Student ID')" />
            <x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id" :value="old('student_id')" />
            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript -->
    <script>
        function toggleStudentIdField() {
            const role = document.getElementById('role').value;
            const studentIdField = document.getElementById('student-id-field');

            if (role === 'student') {
                studentIdField.style.display = 'block';
            } else {
                studentIdField.style.display = 'none';
            }
        }
    </script>
</x-guest-layout>
