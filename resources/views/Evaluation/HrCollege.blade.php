<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('Select College Department') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1 class="title">Select College Department</h1>
        <div class="department-grid">
            <!-- Computer Department -->
            <a href="{{ route('evaluation.history', ['department' => 'computer']) }}" class="department-card">
                <img src="{{ asset('images/computer_logo.png') }}" alt="Computer Department Logo" class="department-logo">
                <h3>Computer Department</h3>
            </a>

            <!-- HM Department -->
            <a href="{{ route('evaluation.history', ['department' => 'hm']) }}" class="department-card">
                <img src="{{ asset('images/hm_logo.png') }}" alt="HM Department Logo" class="department-logo">
                <h3>HM Department</h3>
            </a>

            <!-- Tesda Department -->
            <a href="{{ route('evaluation.history', ['department' => 'tesda']) }}" class="department-card">
                <img src="{{ asset('images/tesda_logo.png') }}" alt="Tesda Department Logo" class="department-logo">
                <h3>Tesda Department</h3>
            </a>

            <!-- Engineering Department -->
            <a href="{{ route('evaluation.history', ['department' => 'engineering']) }}" class="department-card">
                <img src="{{ asset('images/engineering_logo.png') }}" alt="Engineering Department Logo" class="department-logo">
                <h3>Engineering Department</h3>
            </a>
        </div>
    </div>

    <style>
        .container {
            text-align: center;
            padding: 40px 20px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .department-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .department-card {
            background-color: #28a745;
            color: white;
            width: 200px;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            text-decoration: none;
        }
        .department-card:hover {
            transform: translateY(-5px);
        }
        .department-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
            border-radius: 50%;
        }
        h3 {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</x-app-layout>
