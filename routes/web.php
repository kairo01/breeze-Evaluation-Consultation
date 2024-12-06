<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminEvaluation\HrCalendarController;
use App\Http\Controllers\AdminConsultation\AdminConsultationController;
use App\Http\Controllers\AdminDepartment\AdminDpController;
use App\Http\Controllers\AdminEvaluation\AdminEvaluationController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\AdminConsultation\AdminApprovalController;
use App\Http\Controllers\AdminConsultation\AdminHistoryController;
use App\Http\Controllers\AdminConsultation\AdminCalendarController;
use App\Http\Controllers\AdminConsultation\AdminMessagesController;
use App\Http\Controllers\Student\EvaluationFormController;
use App\Http\Controllers\Student\AppointmentController;
use App\Http\Controllers\AdminEvaluation\HrCollege;
use App\Http\Controllers\AdminEvaluation\HrFacultylistController;
use App\Http\Controllers\AdminEvaluation\HrHighschoolController;
use App\Http\Controllers\AdminEvaluation\HrPicker;
use App\Http\Controllers\AdminEvaluation\Evaluation;
use App\Http\Controllers\AdminEvaluation\EvaluationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';

//GUIDANCE == CONSULTATION
Route::middleware(['auth', 'role:Guidance'])->group(function () {
    Route::get('Consultation.CtDashboard', [AdminConsultationController::class, 'index'])
        ->name('Consultation.CtDashboard');

    Route::get('Consultation.CtApproval', [AdminConsultationController::class, 'index'])
        ->name('Consultation.CtApproval');

    Route::get('Consultation.CtHistory', [AdminConsultationController::class, 'index'])
        ->name('Consultation.CtHistory');

    Route::get('Consultation.CtCalendar', [AdminConsultationController::class, 'index'])
        ->name('Consultation.CtCalendar');  

    Route::get('Consultation.CtMessages', [AdminConsultationController::class, 'index'])
        ->name('Consultation.CtMessages');
        
});

//DEPARTMENT HEAD == DP = CS X EVALS
Route::middleware(['auth', 'role:ComputerDepartment'])->group(function () {
    Route::get('departmenthead/dpdashboard', [AdminDpController::class, 'index'])
        ->name('departmenthead.dpdashboard');
});

// HUMAN RESOURCES == EVALUATION
Route::middleware(['auth', 'role:HumanResources'])->group(function () {
    Route::get('HrDashboard', [AdminEvaluationController::class, 'index'])
        ->name('HrDashboard');

        Route::get('Evaluation.HrCalendar', [HrCalendarController::class, 'index'])
        ->name('Evaluation.HrCalendar');

        Route::get('Evaluation.HrFacultylist', [HrFacultylistController::class, 'index'])
        ->name('Evaluation.HrFacultylist');

        Route::get('Evaluation.HrPicker', [HrPicker::class, 'index'])
        ->name('Evaluation.HrPicker');

        Route::get('HrCollege', [HrCollege::class, 'index'])
        ->name('HrCollege');

        Route::get('HrHighschool', [HrHighschoolController::class, 'index'])
        ->name('HrHighschool');

        Route::get('Evaluation', [EvaluationController::class, 'index'])
        ->name('Evaluation');
});

        Route::prefix('student')->middleware(['auth'])->group(function () {
        Route::get('/student-dashboard/{student_type}', [StudentController::class, 'studentDashboardByType'])->name('Student.StudentDashboardByType');
        Route::get('/student/evaluation', [EvaluationFormController::class, 'index'])->name('Student.evaluation.evaluationform');
        Route::get('/student/appointment', [AppointmentController::class, 'index'])->name('Student.Consultation.Appointment');
    
});

