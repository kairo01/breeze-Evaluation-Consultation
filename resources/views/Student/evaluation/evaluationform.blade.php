<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <!-- Check if the user is a student and if they are college or highschool -->
                    @if(Auth::user()->role == 'Student')
                        @if(in_array(Auth::user()->student_type, ['college', 'highschool']))
                            <h1>
                                @if(Auth::user()->student_type == 'college')
                                    Welcome, College Student!
                                @elseif(Auth::user()->student_type == 'highschool')
                                    Welcome, Highschool Student!
                                @endif
                            </h1>
                        @else
                            <h1>You are not a student of the expected types.</h1>
                        @endif
                    @else
                        <h1>You are not a student.</h1>
                    @endif

                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Averia+Serif+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=DM+Serif+Text:ital@0;1&family=Diplomata+SC&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Serif Text', serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }


        .container {
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .header h1 {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .h2 {
            font-size: 1.5rem;
            margin-top: 20px;
        }

        .back-btn, .submit-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .back-btn {
            background-color: #6c757d;
            border-radius: 5px;
        }

        .submit-btn {
            background-color: #007bff;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .custom-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="evaluation-content">
            <div class="select-year-container">
                <h2 class="h2">Select School Year:</h2>
                <select class="form-select" id="school_year" name="school_year">
                    <option value="2023-2024">2023-2024</option>
                    <option value="2024-2025" selected>2024-2025</option>
                    <option value="2025-2026">2025-2026</option>
                </select>
            </div>
            <form>
                <div class="evaluation-form">
                    <div class="evaluation-section">
                        <h2 class="h2">PART 1</h2>
                        <h2 class="h2">Directions:</h2>
                        <p>Kindly evaluate your teacher/s per subject according to their teaching performance.</p>
                        <div class="form-group">
                            <h2 class="h2">Name of Teacher:</h2>
                            <input type="text" class="form-control" id="teacher_name" name="teacher_name" required>
                        </div>
                        <div class="form-group">
                            <h2 class="h2">Subject:</h2>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <h2 class="h2">Teaching Performance:</h2>
                            <textarea class="form-control" id="teaching_performance" name="teaching_performance" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="evaluation-section">
                        <h2 class="h2">PART 2</h2>
                        <h2 class="h2">Directions:</h2>
                        <p>Kindly evaluate the following in terms of facilities and services.</p>
                        <div class="form-group">
                            <h2 class="h2">Library:</h2>
                            <textarea class="form-control" id="library" name="library" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <h2 class="h2">Laboratory:</h2>
                            <textarea class="form-control" id="laboratory" name="laboratory" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <h2 class="h2">Comfort Room:</h2>
                            <textarea class="form-control" id="comfort_room" name="comfort_room" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <h2 class="h2">Canteen:</h2>
                            <textarea class="form-control" id="canteen" name="canteen" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">

                    <button type="button" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="custom-popup" style="display: none;">
        Form submitted successfully!
    </div>
    <script>
        document.querySelector('.submit-btn').addEventListener('click', function () {
            const popup = document.querySelector('.custom-popup');
            popup.style.display = 'block';
            setTimeout(() => popup.style.display = 'none', 3000);
        });
    </script>
</body>
</html>
               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
