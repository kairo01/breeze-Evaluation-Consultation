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
use App\Http\Controllers\Student\CollegePickerController;
use App\Http\Controllers\Student\HighSchoolController;
use App\Http\Controllers\Student\HighSchoolPickerController;
use App\Http\Controllers\Student\StudentPickerController;
use App\Http\Controllers\Student\NotificationController;


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

        Route::get('/evaluation/history/', [EvaluationHistoryController::class, 'index'])->name('Evaluation.History');

        Route::get('/evaluation/history/{department}', [EvaluationHistoryController::class, 'show'])->name('evaluation.history');

          // Student Evaluation Form
    Route::get('/student/evaluation', [EvaluationFormController::class, 'index'])
    ->name('Student.evaluation.evaluationform');

});

// GUIDANCE == CONSULTATION
Route::middleware(['auth', 'role:Guidance'])->group(function () {
    Route::get('/Consultation/CtDashboard', [ConsultationDbController::class, 'index'])
        ->name('Consultation.CtDashboard');

    Route::get('/Consultation/CtCalendar', [ConsultationCalendarController::class, 'index'])
        ->name('Consultation.CtCalendar');  

    Route::get('/Consultation/CtMessages', [ConsultationMessagesController::class, 'index'])
        ->name('Consultation.CtMessages');
});

// Route::get('/highschool', function () {
//     return 'High School Page';
// })->name('highschool.index');

// Route::get('/college', function () {
//     return 'College Page';
// })->name('college.index');
Route::get('faculty/{department}', [FacultyListController::class, 'show']);

// DEPARTMENT HEAD 



// Student Routes
Route::prefix('student')->middleware(['auth'])->group(function () {

    // Student Dashboard
    Route::get('/student-dashboard/college', [CollegeController::class, 'index'])
        ->middleware('student.type:College')
        ->name('Student.CollegeDashboard');

    Route::get('/student-dashboard/highschool', [HighSchoolController::class, 'index'])
        ->middleware('student.type:HighSchool')
        ->name('Student.HighSchoolDashboard');

    // Student Evaluation Form
    Route::get('/student/evaluation', [EvaluationFormController::class, 'index'])
        ->name('Student.evaluation.evaluationform');


/*/
        Route::get('evaluation-form', [EvaluationController::class, 'showForm']);
        Route::post('evaluation-submit', [EvaluationController::class, 'submit']); // <-- Fixed here
    /*/


    // Student Calendar
    Route::get('/student/StudentCalendar', [StudentCalendarController::class, 'index'])
        ->name('Student.StudentCalendar');

        Route::get('/student/StudentNotification', [NotificationController::class, 'index'])
        ->name('Student.StudentNotification');
       
            Route::get('/create', [EvaluationFormController::class, 'create'])->name('evaluation.create');
            Route::post('/store', [EvaluationFormController::class, 'store'])->name('evaluation.store');

            Route::get('/Student.evaluation.StudentPicker', [StudentPickerController::class, 'index'])
            ->name('Student.evaluation.StudentPicker');

            Route::get('Student.evaluation.CollegeStudent', [CollegePickerController::class, 'index'])
            ->name('Student.evaluation.CollegeStudent');


            Route::get('/Student.evaluation.HigSchoolStudent', [HighSchoolPickerController::class, 'index'])
            ->name('Student.evaluation.HigSchoolStudent');
            
Route::get('/evaluation/history/{department}', [EvaluationHistoryController::class, 'show'])->name('evaluation.history');

Route::get('Evaluation.HrHistory', [EvaluationFormController::class, 'index'])->name('Evaluation.HrHistory');

});

Route::prefix('student')->name('Student.')->group(function () {
    Route::get('/appointment', [StudentAppointmentController::class, 'index'])->name('Consform.Appointment');
    Route::post('/appointment', [StudentAppointmentController::class, 'store'])->name('Consform.Appointment.store');
    Route::get('/history', [StudentHistoryController::class, 'index'])->name('StudentHistory');
    // Add other student routes here
});

// Routes for Consultation
Route::prefix('consultation')->name('Consultation.')->middleware('role:Guidance')->group(function () {
    Route::get('/approval', [ConsultationApprovalController::class, 'index'])->name('CtApproval');
    Route::post('/approval/approve', [ConsultationApprovalController::class, 'approve'])->name('CtApproval.approve');
    Route::post('/approval/decline', [ConsultationApprovalController::class, 'decline'])->name('CtApproval.decline');
    Route::get('/history', [ConsultationHistoryController::class, 'index'])->name('CtHistory');
    Route::post('/busy-slot', [ConsultationCalendarController::class, 'storeBusySlot'])->name('store.busy.slot');
});

Route::middleware(['auth', 'checkDepartmentType'])->prefix('department-head')->group(function () {
    Route::get('/DpDashboard', [DpController::class, 'index'])->name('DepartmentHead.DpDashboard');
    Route::get('/DpCalendar', [DpCalendarController::class, 'index'])->name('DepartmentHead.DpCalendar');
    Route::get('/approval', [DpApprovalController::class, 'index'])->name('DepartmentHead.DpApproval');
    Route::post('/approval/approve', [DpApprovalController::class, 'approve'])->name('DepartmentHead.DpApproval.approve');
    Route::post('/approval/decline', [DpApprovalController::class, 'decline'])->name('DepartmentHead.DpApproval.decline');
    Route::get('/history', [DpHistoryController::class, 'index'])->name('DepartmentHead.DpHistory');
    Route::post('/busy-slot', [ConsultationCalendarController::class, 'storeBusySlot'])->name('DepartmentHead.store.busy.slot');
});

Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth'])->name('notifications');


