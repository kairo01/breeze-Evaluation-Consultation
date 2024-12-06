<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminEvaluation\HrCalendarController;

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

Route::middleware(['auth', 'role:ComputerDepartment'])->group(function () {
    Route::get('departmenthead/dpdashboard', [AdminDpController::class, 'index'])
        ->name('departmenthead.dpdashboard');
});

Route::middleware(['auth', 'role:HumanResources'])->group(function () {
    Route::get('Evaluation.HrDashboard', [AdminEvaluationController::class, 'index'])
        ->name('Evaluation.HrDashboard');

        Route::get('Evaluation.HrCalendar', [HrCalendarController::class, 'index'])
        ->name('Evaluation.HrCalendar');
});

Route::middleware(['auth', 'role:Student'])->group(function () {

    // Student Dashboard Route
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('Student.StudentDashboard');

    // Evaluation Route
    Route::get('/student/evaluation', [EvaluationController::class, 'index'])->name('Student.evaluation.evaluationform');

    // Appointment Route
    Route::get('/student/appointment', [AppointmentController::class, 'index'])->name('Student.Consultation.Appointment');

    // Conditional Routes based on Student Type (College or Highschool)
    Route::get('/student/{student_type}/dashboard', [StudentController::class, 'studentDashboardByType'])->name('Student.StudentDashboardByType');
});


