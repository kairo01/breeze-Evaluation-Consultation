<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form') }}
        </h2>
    </x-slot>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="max-w-7xl mx-auto py-10">
        <!-- Form Section -->
        <form id="evaluationForm" action="{{ route('evaluation.store') }}" method="POST" 
              class="p-6 rounded-lg shadow-md max-w-4xl mx-auto bg-white">
            @csrf
            <input type="hidden" value="{{ Auth::user()->id }}" name="student_id" required>

            <!-- Teacher Details -->
            <div class="mb-4">
                <label for="teacher_name" class="block font-semibold text-gray-700">Teacher Name:</label>
                <input type="text" id="teacher_name" name="teacher_name" value="{{ $teacher_name }}" 
                       class="w-full max-w-md p-2 border border-gray-300 rounded-lg" readonly required>
            </div>

            <div class="mb-4">
                <label for="subject" class="block font-semibold text-gray-700">Subject:</label>
                <input type="text" id="subject" name="subject" 
                       class="w-full max-w-md p-2 border border-gray-300 rounded-lg" required>
            </div>

            <!-- Rating Scale -->
            <div class="p-4 rounded-lg mb-6 bg-gray-100">
             <p class="font-semibold text-center mb-2">Rating Scale</p>
      
                <i class="fas fa-sad-cry" style="color: #ff4c4c;"></i> 1 - Poor | 
                  <i class="fas fa-frown" style="color: #ff914d;"></i> 2 - Fair | 
                  <i class="fas fa-meh" style="color: #f0e500;"></i> 3 - Good | 
                  <i class="fas fa-smile" style="color: #66bb6a;"></i> 4 - Very Good | 
                  <i class="fas fa-laugh-beam" style="color: #2b9f3e;"></i> 5 - Excellent
        </p>
            </div>

            <!-- Teaching Skills -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Teaching Skills</h3>
                <table class="w-full border-collapse border border-gray-300 text-center">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">Criteria</th>
                            <th class="border border-gray-300 p-2">1</th>
                            <th class="border border-gray-300 p-2">2</th>
                            <th class="border border-gray-300 p-2">3</th>
                            <th class="border border-gray-300 p-2">4</th>
                            <th class="border border-gray-300 p-2">5</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['Clarity', 'Teaching Methods', 'Organization', 'Pacing'] as $skill)
                        <tr>
                            <td class="border border-gray-300 p-2 text-left">{{ $skill }}</td>
                            @for ($i = 1; $i <= 5; $i++)
                            <td class="border border-gray-300">
                                <input type="radio" name="teaching_skills[{{ $skill }}]" value="{{ $i }}" required>
                            </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Facilities -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Facilities</h3>
                <table class="w-full border-collapse border border-gray-300 text-center">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">Facility</th>
                            <th class="border border-gray-300 p-2">1</th>
                            <th class="border border-gray-300 p-2">2</th>
                            <th class="border border-gray-300 p-2">3</th>
                            <th class="border border-gray-300 p-2">4</th>
                            <th class="border border-gray-300 p-2">5</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['Comfort Room', 'Library', 'Cafeteria', 'Student Lounge', 'Parking Area'] as $facility)
                        <tr>
                            <td class="border border-gray-300 p-2 text-left">{{ $facility }}</td>
                            @for ($i = 1; $i <= 5; $i++)
                            <td class="border border-gray-300">
                                <input type="radio" name="facilities[{{ $facility }}][rating]" value="{{ $i }}" required>
                            </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Facilities Comments -->
            <div class="mb-6">
                @foreach (['Comfort Room', 'Library', 'Cafeteria', 'Student Lounge', 'Parking Area'] as $facility)
                <div class="mb-4">
                    <label for="facility_comment_{{ $facility }}" class="block font-semibold text-gray-700">
                        {{ $facility }} - Add Comment:
                    </label>
                    <input type="text" id="facility_comment_{{ $facility }}" 
                           name="facilities[{{ $facility }}][comment]" 
                           placeholder="Add your comment here..." 
                           class="w-full max-w-md p-2 border border-gray-300 rounded-lg">
                </div>
                @endforeach
            </div>

            <!-- Teacher Comment -->
            <div class="mb-4">
                <label for="teacher_comment" class="block font-semibold text-gray-700">Comment About the Teacher:</label>
                <textarea id="teacher_comment" name="teacher_comment" rows="4" 
                          class="w-full max-w-md p-2 border border-gray-300 rounded-lg" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" id="submitBtn" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script>
        // Show success alert on form submission
        document.getElementById('evaluationForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission until confirmation

            alert('Evaluation submitted successfully!');
            this.submit(); // Continue with form submission after alert
        });
    </script>

</x-app-layout>
