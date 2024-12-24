<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login Page</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <!-- Two Logos -->
            <div class="flex items-center space-x-8">
                <!-- College Logo -->
                <a href="/">
                    <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" alt="College Logo" 
                        class="w-32 h-32 mb-4 rounded-full border-2 border-green-600">
                </a>

                <!-- High School Logo -->
                <a href="/">
                    <img src="{{ asset('css/GeneralResources/hslogo.jpg') }}" alt="High School Logo" 
                        class="w-32 h-32 mb-4 rounded-full border-2 border-blue-600">
                </a>
            </div>

            <!-- Login Form -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
