<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Evaluation and Consultation</title>

    <!-- Add Google Fonts Link for Bunny -->
    <link href="https://fonts.googleapis.com/css2?family=Bunny&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 relative min-h-screen font-bunny"> <!-- Apply the Bunny font globally -->
    <!-- Full-Screen Curved Background at the Bottom (Blue) -->
    <div class="absolute inset-0 bottom-0 z-0">
        <svg class="w-full h-[35%] absolute bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#3182ce" d="M0,224L60,202.7C120,181,240,139,360,128C480,117,600,139,720,165.3C840,192,960,224,1080,240C1200,256,1320,256,1380,256L1440,256L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>
    </div>

    <!-- Authentication Links -->
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-black-600 hover:text-black dark:text-black-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
            @endauth
        </div>
    @endif

    <!-- Header (Green Background) -->
    <header class="relative text-white py-4 z-10 font-bunny"> <!-- Apply the Bunny font here -->
        <div class="container mx-auto flex flex-col items-center">
            <div class="flex items-center">
                <h1 class="mt-2 text-xl font-semibold text-center">
                    EASTWOOD PROFESSIONAL COLLEGE OF SCIENCE AND TECHNOLOGY
                </h1>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-24 relative z-10"> <!-- Adjusted margin-top to mt-24 -->
        <!-- Centered Title -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800 font-bunny">
                WEB BASED: STUDENT EVALUATION AND CONSULTATION MANAGEMENT SYSTEM
            </h2>
        </div>

        <!-- Adjusted Position for High School and College -->
        <div class="flex justify-center mt-16 space-x-10">
            <!-- High School Section -->
            <div class="bg-white border shadow-lg w-64 h-64 flex flex-col items-center justify-center rounded-md">
                <div class="bg-gray-300 h-32 w-32 rounded-full flex items-center justify-center border-4 border-black shadow-md">
                    <img src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="High School Logo" class="rounded-full h-28 w-28">
                </div>
                <h3 class="mt-4 font-semibold text-xl font-bunny">High School</h3> <!-- Apply the Bunny font here -->
            </div>

            <!-- College Section -->
            <div class="bg-white border shadow-lg w-64 h-64 flex flex-col items-center justify-center rounded-md">
                <div class="bg-gray-300 h-32 w-32 rounded-full flex items-center justify-center border-4 border-black shadow-md">
                    <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="College Logo" class="rounded-full h-28 w-28">
                </div>
                <h3 class="mt-4 font-semibold text-xl font-bunny">College</h3> <!-- Apply the Bunny font here -->
            </div>
        </div>
    </main>

    <!-- Full-Screen Curved Background at the Top (Green) -->
    <div class="absolute inset-0 top-0 z-0">
        <svg class="w-full h-[35%] absolute top-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#38a169" d="M0,96L60,112C120,128,240,160,360,165.3C480,171,600,149,720,133.3C840,117,960,107,1080,122.7C1200,139,1320,181,1380,202.7L1440,224L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
        </svg>
    </div>
</body>
</html>
