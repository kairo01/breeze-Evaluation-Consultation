<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web-Based Evaluation and Consultation System</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts - Bunny Font Link -->
    <link href="https://fonts.googleapis.com/css2?family=Bunny:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Bunny', sans-serif; /* Apply the Bunny font */
            font-weight: 100; /* Apply bold weight */
        }
        .wave {
            position: relative;
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 antialiased">

    <!-- Green Header Wave -->
    <header class="relative">
        <div class="wave -mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#16a34a" fill-opacity="1" d="M0,96L48,101.3C96,107,192,117,288,128C384,139,480,149,576,154.7C672,160,768,160,864,149.3C960,139,1056,117,1152,122.7C1248,128,1344,160,1392,176L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>
      
        <div class="absolute inset-x-0 top-0 flex justify-center pt-8">
            <h1 class="text-3xl sm:text-2xl font-extrabold mb-8 text-black-700 text-center">
                WEB-BASED: STUDENT EVALUATION AND CONSULTATION MANAGEMENT SYSTEM
            </h1>
        </div>

        <!-- Login Button -->
        <a href="{{ route('login') }}" class="absolute top-4 right-6 text-sm bg-white text-green-600 font-semibold px-4 py-2 rounded-full hover:bg-gray-100 transition">
            Log in
        </a>
    </header>

    <!-- Main Content -->
    <!-- Title -->
    <h1 class="text-xl sm:text-xl font-extrabold text-black text-center px-4 -mt-32">
        EASTWOOD PROFESSIONAL COLLEGE OF SCIENCE AND TECHNOLOGY
    </h1>
    
    <!-- Cards Section -->
    <div class="flex flex-wrap justify-center gap-8 mt-10">
        <!-- High School Card -->
        <div class="bg-white shadow-md hover:shadow-lg rounded-lg w-64 h-64 flex flex-col items-center justify-center transition-transform transform hover:scale-105">
            <img src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="High School Logo" class="w-32 h-32 mb-4 rounded-full border-2 border-blue-600">
            <span class="text-lg font-bold">High School</span>
        </div>

        <!-- College Card -->
        <div class="bg-white shadow-md hover:shadow-lg rounded-lg w-64 h-64 flex flex-col items-center justify-center transition-transform transform hover:scale-105">
            <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="College Logo" class="w-32 h-32 mb-4 rounded-full border-2 border-green-600">
            <span class="text-lg font-bold">College</span>
        </div>
    </div>

    <!-- Blue Footer Wave -->
    <footer class="relative">
        <div class="wave -mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#2563eb" fill-opacity="1" d="M0,128L48,138.7C96,149,192,171,288,170.7C384,171,480,149,576,149.3C672,149,768,171,864,165.3C960,160,1056,128,1152,122.7C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
        <div class="absolute bottom-4 w-full text-center">
            <p class="text-sm text-white">© 2024 Eastwood Professional College. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
