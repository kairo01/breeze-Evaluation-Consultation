<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New User Account') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/Superadmin/create.css') }}">

    <div class="container mt-8 mx-auto max-w-4xl">
        <div class="bg-white shadow-md rounded-lg p-6">
         
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Starts Here -->
            <form action="{{ route('store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Editable Fields -->
                <div class="space-y-4">
                    <!-- Name -->
                    <div class="flex flex-col pb-3">
                        <label for="name" class="block text-gray-700 font-medium">Name:</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-input w-[80%] rounded-md border-gray-300 shadow-sm"
                            value="{{ old('name') }}" 
                            required
                        >
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col pb-3">
                        <label for="email" class="block text-gray-700 font-medium">Email:</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input w-[80%] rounded-md border-gray-300 shadow-sm"
                            value="{{ old('email') }}" 
                            required
                        >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col pb-3">
                        <label for="password" class="block text-gray-700 font-medium">Password:</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input w-[80%] rounded-md border-gray-300 shadow-sm"
                            required
                        >
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col pb-3">
                        <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password:</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-input w-[80%] rounded-md border-gray-300 shadow-sm"
                            required
                        >
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div class="flex flex-col pb-3">
                        <label for="role" class="block text-gray-700 font-medium">Role:</label>
                        <select class="form-control w-[80%] rounded-md border-gray-300 shadow-sm" id="role" name="role" required>
                            <option value="ComputerDepartment" {{ old('role') == 'ComputerDepartment' ? 'selected' : '' }}>Computer Department</option>
                            <option value="EngineeringDeparment" {{ old('role') == 'EngineeringDeparment' ? 'selected' : '' }}>Engineering Department</option>
                            <option value="HighSchoolDepartment" {{ old('role') == 'HighSchoolDepartment' ? 'selected' : '' }}>High School Department</option>
                            <option value="TesdaDepartment" {{ old('role') == 'TesdaDepartment' ? 'selected' : '' }}>Tesda Department</option>
                            <option value="HmDepartment" {{ old('role') == 'HmDepartment' ? 'selected' : '' }}>HM Department</option>
                            <option value="HumanResources" {{ old('role') == 'HumanResources' ? 'selected' : '' }}>Human Resources</option>
                            <option value="Guidance" {{ old('role') == 'Guidance' ? 'selected' : '' }}>Guidance</option>
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white py-2 px-6 rounded-md shadow hover:bg-blue-700" >
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
