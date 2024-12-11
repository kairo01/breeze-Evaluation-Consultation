<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form') }}
        </h2>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                   
                        @csrf <!-- CSRF Token for protection -->
                        <h2 class="font-bold text-lg mb-4">Teacher Evaluation</h2>

    </x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Form</title>
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


                        <!-- Teacher Info Section -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Teacher Name:</label>
                            <input type="text" name="teacher_name"
                                class="form-control @error('teacher_name') border-red-500 @enderror"
                                value="{{ old('teacher_name') }}">
                            @error('teacher_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Subject:</label>
                            <input type="text" name="subject"
                                class="form-control @error('subject') border-red-500 @enderror"
                                value="{{ old('subject') }}">
                            @error('subject')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Teaching Skills Section -->
                        <h3 class="font-bold text-md mt-6 mb-4">Teaching Skills</h3>
                        @foreach ([
                            'Subject Knowledge' => 'Mastery of the subject matter.',
                            'Clarity' => 'Ability to explain concepts clearly and concisely.',
                            'Teaching Methods' => 'Use of diverse and engaging teaching techniques.',
                            'Organization' => 'Preparedness and structured lesson plans.',
                            'Pacing' => 'Proper speed of instruction based on student understanding.'
                        ] as $skill => $description)
                            <div class="mb-4">
                                <label class="block text-gray-700">{{ $skill }}</label>
                                <small class="text-gray-600">{{ $description }}</small>
                                <div class="flex space-x-2 mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" 
                                                   name="teaching_skills[{{ strtolower(str_replace(' ', '_', $skill)) }}]" 
                                                   value="{{ $i }}"
                                                   class="form-control"
                                                   {{ old("teaching_skills." . strtolower(str_replace(' ', '_', $skill))) == $i ? 'checked' : '' }}>
                                            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center
                                                    hover:bg-blue-500 {{ old('teaching_skills') == $i ? 'bg-blue-500' : '' }}">
                                                {{ $i }}
                                            </div>
                                        </label>
                                    @endfor
                                </div>
                                @error("teaching_skills." . strtolower(str_replace(' ', '_', $skill)))
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach

                        <!-- Facilities and Equipment Section -->
                        <h2 class="font-bold text-lg mt-6 mb-4">Facilities and Equipment</h2>
                        @foreach ([ 
                            'Classroom Cleanliness' => 'Overall cleanliness and maintenance of classrooms.',
                            'Ventilation' => 'Availability and functionality of air conditioning or fans.',
                            'Lighting' => 'Adequate lighting for effective learning.',
                            'Seating Arrangement' => 'Comfort and arrangement of chairs and desks.',
                            'Technology' => 'Availability and functionality of projectors, computers, or smartboards.'
                        ] as $facility => $description)
                            <div class="mb-4">
                                <label class="block text-gray-700">{{ $facility }}</label>
                                <small class="text-gray-600">{{ $description }}</small>
                                <div class="flex space-x-2 mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" 
                                                   name="facilities[{{ strtolower(str_replace(' ', '_', $facility)) }}]" 
                                                   value="{{ $i }}"
                                                   class="form-control"
                                                   {{ old("facilities." . strtolower(str_replace(' ', '_', $facility))) == $i ? 'checked' : '' }}>
                                            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center
                                                    hover:bg-blue-500 {{ old('facilities') == $i ? 'bg-blue-500' : '' }}">
                                                {{ $i }}
                                            </div>
                                        </label>
                                    @endfor
                                </div>
                                @error("facilities." . strtolower(str_replace(' ', '_', $facility)))
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
