<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminEvaluation\HrCalendarController;
use App\Http\Controllers\AdminConsultation\AdminConsultationController;
use App\Http\Controllers\AdminEvaluation\AdminEvaluationController;
use App\Http\Controllers\AdminConsultation\AdminApprovalController;
use App\Http\Controllers\AdminConsultation\AdminHistoryController;
use App\Http\Controllers\AdminConsultation\AdminCalendarController;
use App\Http\Controllers\AdminConsultation\AdminMessagesController;

use App\Http\Controllers\Student\StudentHistoryController;
use App\Http\Controllers\Student\StudentCalendarController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\EvaluationFormController;
use App\Http\Controllers\Student\StudentAppointmentController;
use App\Http\Controllers\AdminEvaluation\HrCollege;


use App\Http\Controllers\AdminEvaluation\HrCollegeController;

use App\Http\Controllers\AdminEvaluation\HrFacultylistController;
use App\Http\Controllers\AdminEvaluation\HrHighschoolController;
use App\Http\Controllers\AdminEvaluation\HrPickerController;
use App\Http\Controllers\AdminEvaluation\EvaluationHistoryController;
use App\Http\Controllers\AdminDepartmentHead\AdminDpController;
use App\Http\Controllers\AdminDepartmentHead\DpApprovalController;
use App\Http\Controllers\AdminDepartmentHead\DpHistoryController;
use App\Http\Controllers\AdminDepartmentHead\DpCalendarController;
use App\Http\Controllers\AdminEvaluation\EvaluationController;
use App\Http\Controllers\Student\CollegeController;
use App\Http\Controllers\Student\HighSchoolController;

// Other Routes

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');
});

require __DIR__.'/auth.php';

// GUIDANCE == CONSULTATION
Route::middleware(['auth', 'role:Guidance'])->group(function () {
    Route::get('Consultation.CtDashboard', [AdminConsultationController::class, 'index'])
        ->name('Consultation.CtDashboard');

    Route::get('Consultation.CtApproval', [AdminApprovalController::class, 'index'])
        ->name('Consultation.CtApproval');

    Route::get('Consultation.CtHistory', [AdminHistoryController::class, 'index'])
        ->name('Consultation.CtHistory');

    Route::get('Consultation.CtCalendar', [AdminCalendarController::class, 'index'])
        ->name('Consultation.CtCalendar');  

    Route::get('Consultation.CtMessages', [AdminMessagesController::class, 'index'])
        ->name('Consultation.CtMessages');
});

// DEPARTMENT HEAD == DP = CS X EVALS
Route::middleware(['auth', 'role:ComputerDepartment'])->group(function () {
    Route::get('DepartmentHead/DpDashboard', [AdminDpController::class, 'index'])
        ->name('DepartmentHead.DpDashboard');

    Route::get('DepartmentHead/DpApproval', [DpApprovalController::class, 'index'])
        ->name('DepartmentHead.DpApproval');

    Route::post('DepartmentHead/DpApproval', [DpApprovalController::class, 'store'])
        ->name('DepartmentHead.DpApproval.store');

    Route::get('DepartmentHead/DpHistory', [DpHistoryController::class, 'index'])
        ->name('DepartmentHead.DpHistory');

    Route::get('DepartmentHead/DpCalendar', [DpCalendarController::class, 'index'])
        ->name('DepartmentHead.DpCalendar');
});

// HUMAN RESOURCES == EVALUATION
Route::middleware(['auth', 'role:HumanResources'])->group(function () {
    Route::get('HrDashboard', [AdminEvaluationController::class, 'index'])
        ->name('HrDashboard');

    Route::get('Evaluation.HrCalendar', [HrCalendarController::class, 'index'])
        ->name('Evaluation.HrCalendar');

    Route::get('Evaluation.HrFacultylist', [HrFacultylistController::class, 'index'])
        ->name('Evaluation.HrFacultylist');

        Route::get('Evaluation.HrPicker', [HrPickerController::class, 'index'])
        ->name('Evaluation.HrPicker');

        Route::get('HrCollege', [HrCollegeController::class, 'index'])

        ->name('HrCollege');

    Route::get('HrHighschool', [HrHighschoolController::class, 'index'])
        ->name('HrHighschool');


    Route::get('Evaluation', [EvaluationController::class, 'index'])
        ->name('Evaluation');

    

    Route::get('EvaluationHistory', [EvaluationHistoryController::class, 'index'])
        ->name('EvaluationHistory');

});

// Student Routes
Route::prefix('student')->middleware(['auth'])->group(function () {
    // Student Dashboard by type (college/highschool)
    Route::get('/student-dashboard/college', [CollegeController::class, 'index'])->name('Student.CollegeDashboard');

    Route::get('/student-dashboard/highschool', [HighSchoolController::class, 'index'])->name('Student.HighSchoolDashboard');

    // Student Evaluation Form
    Route::get('/student/evaluation', [EvaluationFormController::class, 'index'])
        ->name('Student.evaluation.evaluationform');

        Route::get('evaluation-form', [EvaluationController::class, 'showForm']);
        Route::post('evaluation-submit', [EvaluationController::class, 'submit']); // <-- Fixed here
        
    // Student Appointment Routes
    Route::get('/student/appointment', [StudentAppointmentController::class, 'index'])
        ->name('Student.Consultation.Appointment');

    Route::post('/student/appointment', [StudentAppointmentController::class, 'store'])
        ->name('Student.Consultation.Appointment.store');

    // Student Appointment History
    Route::get('/student/StudentHistory', [StudentHistoryController::class, 'index'])
        ->name('Student.StudentHistory');

    // Student Calendar
    Route::get('/student/StudentCalendar', [StudentCalendarController::class, 'index'])
        ->name('Student.StudentCalendar');
});
