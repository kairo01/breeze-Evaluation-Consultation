<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form') }}
        </h2>
    </x-slot>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            background-color: #f9f9f9;
            
        }

        .rating-scale {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-style: italic;
        }

        .section-header {
            text-align: left;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            text-align: center;
            margin-top: 10px;
            border-spacing: 0;
        }

        td, th {
            padding: 10px 5px;
        }

        td:first-child {
            text-align: left;
            padding-left: 10px;
        }

        input[type="radio"] {
            margin: 0;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .rating-header {
        display: grid;
        grid-template-columns: 2fr repeat(5, 1fr); /* First column wider, followed by 5 equal columns */
        padding: 5px 0;
        margin-left: 170px;

        }

        .title {
            display: grid;
            grid-template-columns: 2fr repeat(5, 1fr); /* First column wider, followed by 5 equal columns */
            padding: 5px 0;
            margin-left: 10;

        }

        .rating-header span {
            font-weight: bold;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 10px 5px;
            text-align: center;
        }

        td:first-child {
            text-align: left;
            padding-left: 5px;
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
        }

        .teaching-skills .rating-header {
            display: grid;
            grid-template-columns: 2fr repeat(5, 1fr);
            padding: 5px 0;
            margin-left: 0; /* Adjust alignment specifically for Teaching Skills */
        }

        .teaching-skills table {
            width: 100%;
            border-collapse: collapse;
        }

        .teaching-skills td, .teaching-skills th {
            padding: 10px 5px;
            text-align: center;
        }

        .teaching-skills td:first-child {
            text-align: left;
            padding-left: 5px;
        }

        .facilities .rating-header {
            display: grid;
            grid-template-columns: 2fr repeat(5, 1fr);
            padding: 5px 0;
            margin-left: 0; /* Adjust alignment specifically for Facilities */
        }

        .facilities table {
            width: 100%;
            border-collapse: collapse;
        }

        .facilities td, .facilities th {
            padding: 10px 5px;
            text-align: center;
        }

        .facilities td:first-child {
            text-align: left;
            padding-left: 5px;
        }


    </style>


    <form action="{{ route('evaluation.store') }}" method="POST">
        @csrf
      
        
        <input type="hidden" value="{{Auth::user()->id}}" name="student_id" required>
      
      
        <div class="container">
            <label for="teacher_name">Teacher Name:</label>
            <input type="text" id="teacher_name" name="teacher_name" value="{{ $teacher_name }}" readonly required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>

        <div class="rating-scale container">
            Rating Scale: 1 - Poor | 2 - Fair | 3 - Good | 4 - Very Good | 5 - Excellent
        </div>

        <div class="container">
            <div class="rating-header">
                <span>Teaching Skills</span>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
                <span>5</span>
            </div>
            <table>
                <tbody>
                    @foreach (['Clarity', 'Teaching Methods', 'Organization', 'Pacing'] as $skill)
                        <tr>
                            <td>{{ $skill }}</td>
                            @for ($i = 1; $i <= 5; $i++)
                                <td>
                                    <input type="radio" name="teaching_skills[{{ $skill }}]" value="{{ $i }}" required>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="container">
            <label for="teacher_comment">Comment About the Teacher:</label>
            <textarea id="teacher_comment" name="teacher_comment" rows="4" placeholder="Write your feedback about the teacher here..." required></textarea>
        </div>

        <div class="container">
            <div class="rating-header">
                <span>Facilities</span>
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
                <span>5</span>
            </div>
            <table>
                <tbody>
                    @foreach (['Comfort Room', 'Library', 'Cafeteria', 'Student Lounge', 'Parking Area'] as $facility)
                        <tr>
                            <td>{{ $facility }}</td>
                            @for ($i = 1; $i <= 5; $i++)
                                <td>
                                    <input type="radio" name="facilities[{{ $facility }}][rating]" value="{{ $i }}" required>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="container">
            @foreach (['Comfort Room', 'Library', 'Cafeteria', 'Student Lounge', 'Parking Area'] as $facility)
                <div style="margin-bottom: 15px;">
                    <label for="facility_comment_{{ $facility }}">{{ $facility }} - Add Comment:</label>
                    <input type="text" id="facility_comment_{{ $facility }}" name="facilities[{{ $facility }}][comment]" placeholder="Add Comment Here">
                </div>
            @endforeach
        </div>

        <button type="submit">Submit</button>
    </form>
</x-app-layout>
