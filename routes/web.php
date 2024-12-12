<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminEvaluation\HrCalendarController;
use App\Http\Controllers\ConsultationController\ConsultationDbController;
use App\Http\Controllers\AdminEvaluation\AdminEvaluationController;
use App\Http\Controllers\ConsultationController\ConsultationApprovalController;
use App\Http\Controllers\ConsultationController\ConsultationHistoryController;
use App\Http\Controllers\ConsultationController\ConsultationCalendarController;
use App\Http\Controllers\ConsultationController\ConsultationMessagesController;

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

use App\Http\Controllers\DepartmentHeadController\DpController;
use App\Http\Controllers\DepartmentHeadController\DpApprovalController;
use App\Http\Controllers\DepartmentHeadController\DpHistoryController;
use App\Http\Controllers\DepartmentHeadController\DpCalendarController;



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
    Route::get('Consultation.CtDashboard', [ConsultationDbController::class, 'index'])
        ->name('Consultation.CtDashboard');

    Route::get('Consultation.CtApproval', [ConsultationApprovalController::class, 'index'])
        ->name('Consultation.CtApproval');

    Route::get('Consultation.CtHistory', [ConsultationHistoryController::class, 'index'])
        ->name('Consultation.CtHistory');

    Route::get('Consultation.CtCalendar', [ConsultationCalendarController::class, 'index'])
        ->name('Consultation.CtCalendar');  

    Route::get('Consultation.CtMessages', [ConsultationMessagesController::class, 'index'])
        ->name('Consultation.CtMessages');
});

// DEPARTMENT HEAD 
Route::middleware(['auth', 'role:ComputerDepartment'])->group(function () {
    Route::get('DepartmentHead/DpDashboard', [DpController::class, 'index'])
        ->name('DepartmentHead.DpDashboard');

    Route::get('DepartmentHead/DpApproval', [DpApprovalController::class, 'index'])
        ->name('DepartmentHead.DpApproval');

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

    Route::get('EvaluationHistory', [EvaluationHistoryController::class, 'index'])
        ->name('EvaluationHistory');

        Route::get('/evaluation/history/{department}', [EvaluationHistoryController::class, 'show'])->name('evaluation.history');
});

// Student Routes
Route::prefix('student')->middleware(['auth'])->group(function () {

    Route::get('/student-dashboard/college', [CollegeController::class, 'index'])->name('Student.CollegeDashboard');

    Route::get('/student-dashboard/highschool', [HighSchoolController::class, 'index'])->name('Student.HighSchoolDashboard');

    // Student Evaluation Form
    Route::get('/student/evaluation', [EvaluationFormController::class, 'index'])
        ->name('Student.evaluation.evaluationform');

/*/
        Route::get('evaluation-form', [EvaluationController::class, 'showForm']);
        Route::post('evaluation-submit', [EvaluationController::class, 'submit']); // <-- Fixed here
    /*/


    // Student Appointment Routes
    Route::get('/student/appointment', [StudentAppointmentController::class, 'index'])
        ->name('Student.Consultation.Appointment');

    // Student Appointment History
    Route::get('/student/StudentHistory', [StudentHistoryController::class, 'index'])
        ->name('Student.StudentHistory');

    // Student Calendar
    Route::get('/student/StudentCalendar', [StudentCalendarController::class, 'index'])
        ->name('Student.StudentCalendar');

       
            Route::get('/create', [EvaluationFormController::class, 'create'])->name('evaluation.create');
            Route::post('/store', [EvaluationFormController::class, 'store'])->name('evaluation.store');
            Route::get('/show/{id}', [EvaluationFormController::class, 'show'])->name('evaluation.show');
     
        
});
