<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('Computer Department') }}
        </h2>
    </x-slot>

    <div class="content">
        <!-- Department Head Section -->
        <div class="department-head">
            <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="Department Head" class="head-img">
            <h3>Department Head: Jhai De Guzman</h3>
            <button class="evaluate-btn">Evaluate</button>
        </div>

        <!-- Faculty Members Section -->
        <div class="faculty-members">
            <!-- Faculty Member 1 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Percian Joseph Borja</h4>
                <button class="evaluate-btn">Evaluate</button>
            </div>

            <!-- Faculty Member 2 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Eric Almoguerra</h4>
                <button class="evaluate-btn">Evaluate</button>
            </div>

            <!-- Faculty Member 3 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Aries Cayabyab</h4>
                <button class="evaluate-btn">Evaluate</button>
            </div>

            <!-- Faculty Member 4 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Nomer Aleviado</h4>
                <button class="evaluate-btn">Evaluate</button>
            </div>

            <!-- Faculty Member 5 -->
            <div class="faculty-card">
                <img src="{{ asset('css/GeneralResources/icon.jpg') }}" alt="Faculty Member" class="faculty-img">
                <h4>Joseph Chua</h4>
                <button class="evaluate-btn">Evaluate</button>
            </div>
        </div>
    </div>

    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .header-title {
        font-weight: bold;
        font-size: 24px;
        color: #333;
    }

    .content {
        padding: 30px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .department-head {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 30px;
    }

    .head-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    .evaluate-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .evaluate-btn:hover {
        background-color: #0056b3;
    }

  
    .faculty-members {
        display: grid;
        grid-template-columns: repeat(3, 200px); /* Exactly 3 items, each 200px */
        justify-content: center;
        gap: 60px; /* Small gap between items */
    }

    .faculty-card {
        background-color: #f9f9f9;
        width: 200px;
        height: 200px;
        padding: 15px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
        margin: 0 auto;
    }

    .faculty-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .faculty-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .faculty-card h4 {
        font-weight: bold;
        margin-top: 5px;
    }
</style>




</x-app-layout>
