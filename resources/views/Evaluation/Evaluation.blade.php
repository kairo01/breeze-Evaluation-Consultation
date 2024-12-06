<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Evaluation History') }}
        </h2>
    </x-slot>

    <div class="container text-center mt-5">
        <!-- Department Header Section -->
        <h1 class="mb-4">Computer Department</h1>
        <div class="row justify-content-center align-items-center mb-5">
            <div class="col-md-4 text-center">
                <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="Department Logo" class="department-logo mb-3">
                <h3>Department Head: Jhai De Guzman</h3>
                <button class="btn btn-primary mt-2">Evaluate</button>
            </div>
        </div>

        <!-- Faculty Grid Section -->
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 p-3">
                    <img src="{{ asset('path/to/default-avatar.png') }}" alt="Faculty Avatar" class="faculty-avatar mx-auto mb-2">
                    <h5 class="mb-1 font-weight-bold">Percian Joseph Borja</h5>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 p-3">
                    <img src="{{ asset('path/to/default-avatar.png') }}" alt="Faculty Avatar" class="faculty-avatar mx-auto mb-2">
                    <h5 class="mb-1 font-weight-bold">Eric Almoguerra</h5>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 p-3">
                    <img src="{{ asset('path/to/default-avatar.png') }}" alt="Faculty Avatar" class="faculty-avatar mx-auto mb-2">
                    <h5 class="mb-1 font-weight-bold">Aries Cayabyab</h5>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 p-3">
                    <img src="{{ asset('path/to/default-avatar.png') }}" alt="Faculty Avatar" class="faculty-avatar mx-auto mb-2">
                    <h5 class="mb-1 font-weight-bold">Nomer Aleviado</h5>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm border-0 p-3">
                    <img src="{{ asset('path/to/default-avatar.png') }}" alt="Faculty Avatar" class="faculty-avatar mx-auto mb-2">
                    <h5 class="mb-1 font-weight-bold">Joseph Chua</h5>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        .department-logo {
            width: 120px;
            height: auto;
        }

        .faculty-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 8px 20px;
            font-size: 14px;
        }

        h1, h3 {
            font-family: 'Arial', sans-serif;
        }
    </style>
</x-app-layout>
