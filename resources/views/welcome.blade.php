<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Landing Page</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />  

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            /* Custom styles if necessary */
        </style>
    </head>
    <body class="bg-white text-gray-900 font-sans antialiased">
        
        <div class="relative min-h-screen flex items-center justify-center px-6 sm:px-12">
            <div class="text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight text-gray-900 mb-6 font-figtree">
    EASTWOODS: WEB-BASED EVALUATION AND CONSULTATION MANAGEMENT SYSTEM
            </h1>

                <!-- Container for images side by side -->
                <div class="flex justify-center space-x-10 mb-6">
                    <div class="course-button college">
                        <img class="course-icon w-48 h-48 object-contain" src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="College Department Icon">
                    </div>
                    
                    <div class="course-button highschool">
                        <img class="course-icon w-48 h-48 object-contain" src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="High School Icon">
                    </div>
                </div>

                <!-- Heading and Text -->
                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight text-gray-900 mb-6">
                    
                </h1>

                <!-- Buttons -->
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600 transition duration-300">Log In</a>
                    <!-- <a href="{{ route('register') }}" class="inline-block px-6 py-3 border-2 border-gray-900 text-gray-900 font-semibold rounded-full hover:bg-gray-900 hover:text-white transition duration-300">Sign Up</a> -->
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <footer class="bg-gray-100 text-center py-6 mt-12">
            <p class="text-sm text-gray-500">© 2024 Your Company. All rights reserved.</p>
        </footer>
    </body>
</html>
