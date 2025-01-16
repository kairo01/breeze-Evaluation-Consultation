<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Account') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/Superadmin/edit.css') }}">

    <div class="container mt-8 mx-auto max-w-4xl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="font-bold text-lg mb-4 text-gray-800">{{ $account->role }}</h1>

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
            <form action="{{ route('Superadmin.edit', $account->role) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Editable Fields -->
                <div class="space-y-4">
                    <!-- Name -->
                    <div class="flex flex-col pb-3">
                        <label for="name" class="block text-gray-700 font-medium">Name:</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-input w-4/5 rounded-md border-gray-300 shadow-sm"
                            value="{{ old('name', $account->name) }}" 
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col pb-3">
                        <label for="email" class="block text-gray-700 font-medium">Email:</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input w-4/5 rounded-md border-gray-300 shadow-sm"
                            value="{{ old('email', $account->email) }}" 
                            required
                        >
                    </div>

                    <!-- Current Password -->
                    <div class="flex flex-col pb-3">
                        <label for="current_password" class="block text-gray-700 font-medium">Current Password:</label>
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password" 
                            class="form-input w-4/5 rounded-md border-gray-300 shadow-sm"
                            required
                        >
                    </div>

                    <!-- New Password -->
                    <div class="flex flex-col pb-3">
                        <label for="password" class="block text-gray-700 font-medium">New Password:</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input w-4/5 rounded-md border-gray-300 shadow-sm"
                            placeholder="Input New Password"
                        >
                    </div>

                    <!-- Confirm New Password -->
                    <div class="flex flex-col pb-3">
                        <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm New Password:</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-input w-4/5 rounded-md border-gray-300 shadow-sm"
                            placeholder="Confirm New Password"
                        >
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white py-2 px-6 rounded-md shadow hover:bg-blue-700"
                    >
                        Update Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
