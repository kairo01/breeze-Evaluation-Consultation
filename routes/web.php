<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminEvaluation\HrCalendarController;

use App\Http\Controllers\ConsultationController\ConsultationDbController;
use App\Http\Controllers\ConsultationController\ConsultationApprovalController;
use App\Http\Controllers\ConsultationController\ConsultationHistoryController;
use App\Http\Controllers\ConsultationController\ConsultationCalendarController;
use App\Http\Controllers\ConsultationController\ConsultationMessagesController;
use App\Http\Controllers\ConsultationController\ConsultationNotificationController;
use App\Http\Controllers\ConsultationController\ConsultationOverallHistoryController;


use App\Http\Controllers\Student\StudentHistoryController;
use App\Http\Controllers\Student\StudentCalendarController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\EvaluationFormController;
use App\Http\Controllers\Student\StudentAppointmentController;
use App\Http\Controllers\AdminEvaluation\HrCollege;
use App\Http\Controllers\NotifyController;

use App\Http\Controllers\AdminEvaluation\HrCollegeController;
use App\Http\Controllers\AdminEvaluation\AdminEvaluationController;
use App\Http\Controllers\AdminEvaluation\HrFacultylistController;
use App\Http\Controllers\AdminEvaluation\HrHighschoolController;
use App\Http\Controllers\AdminEvaluation\HrPickerController;
use App\Http\Controllers\AdminEvaluation\EvaluationHistoryController;

use App\Http\Controllers\DepartmentHeadController\DpController;
use App\Http\Controllers\DepartmentHeadController\DpApprovalController;
use App\Http\Controllers\DepartmentHeadController\DpHistoryController;
use App\Http\Controllers\DepartmentHeadController\DpCalendarController;
use App\Http\Controllers\DepartmentHeadController\DpNotificationController;
use App\Http\Controllers\DepartmentHeadController\DpOverallHistoryController;



use App\Http\Controllers\AdminEvaluation\EvaluationController;
use App\Http\Controllers\AdminEvaluation\FacilitiesHistoryController;
use App\Http\Controllers\Student\CollegeController;
use App\Http\Controllers\Student\CollegePickerController;
use App\Http\Controllers\Student\HighSchoolController;
use App\Http\Controllers\Student\HighSchoolPickerController;
use App\Http\Controllers\Student\StudentPickerController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\StudentCtNotificationController;
use App\Http\Controllers\Superadmin\SuperAdminController;



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


    Route::get('EvaluationHistory', [EvaluationHistoryController::class, 'index'])
        ->name('EvaluationHistory');

        Route::get('/evaluation/history/', [EvaluationHistoryController::class, 'index'])->name('Evaluation.History');

        Route::get('/evaluation/history/{department}', [EvaluationHistoryController::class, 'show'])->name('evaluation.history');

          // Student Evaluation Form
    Route::get('/student/evaluation', [EvaluationFormController::class, 'index'])
    ->name('Student.evaluation.evaluationform');

    Route::get('/fetch-events', [HrCalendarController::class, 'fetchEvents'])->name('calendar.fetch');
    Route::post('/create-event', [HrCalendarController::class, 'createEvent']);


    // // Route to Facilities Blade
    // Route::get('/facilities/{evaluation}', [FacilitiesHistoryController::class, 'show'])->name('facilities.show');
    
    Route::get('Evaluation.FacilitiesHistory', [FacilitiesHistoryController::class, 'index'])->name('Evaluation.FacilitiesHistory');
    

});

// GUIDANCE == CONSULTATION
Route::middleware(['auth', 'role:Guidance'])->group(function () {
    Route::get('/Consultation/CtDashboard', [ConsultationDbController::class, 'index'])
        ->name('Consultation.CtDashboard');

    Route::get('/Consultation/CtCalendar', [ConsultationCalendarController::class, 'index'])
        ->name('Consultation.CtCalendar');  

    Route::get('/Consultation/CtMessages', [ConsultationMessagesController::class, 'index'])
        ->name('Consultation.CtMessages');


    Route::get('/overall-history', [ConsultationOverallHistoryController::class, 'index'])->name('Consultation.CtOverallHistory');
    Route::get('/program-history/{program}', [ConsultationOverallHistoryController::class, 'showProgramHistory'])->name('Consultation.CtProgramHistory');
    Route::get('/course-history/{program}/{course}', [ConsultationOverallHistoryController::class, 'showCourseHistory'])->name('Consultation.CtCourseHistory');
    Route::post('/consultation/update-completion/{appointment}', [ConsultationHistoryController::class, 'updateCompletion'])->name('consultation.update-completion');
    Route::get('/consultation/notifications', [ConsultationNotificationController::class, 'index'])->name('Consultation.CtNotification');
    Route::post('/consultation/notifications/{id}/mark-as-read', [ConsultationNotificationController::class, 'markAsRead'])->name('Consultation.markNotificationAsRead');
    Route::post('/consultation/notifications/mark-all-as-read', [ConsultationNotificationController::class, 'markAllAsRead'])->name('Consultation.markAllNotificationsAsRead');

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

        Route::get('/evaluation/prepare/{teacher_name}', [EvaluationFormController::class, 'prepare'])->name('evaluation.prepare');

/*/
        Route::get('evaluation-form', [EvaluationController::class, 'showForm']);
        Route::post('evaluation-submit', [EvaluationController::class, 'submit']); // <-- Fixed here
    /*/

    Route::get('/Student.evaluation.StudentPicker', [StudentPickerController::class, 'index'])
    ->name('Student.evaluation.StudentPicker');

    // Student Calendar
    Route::get('/student/StudentCalendar', [StudentCalendarController::class, 'index'])
        ->name('Student.StudentCalendar');

        Route::get('/student/StudentNotification', [NotificationController::class, 'index'])
        ->name('Student.StudentNotification');
       
            Route::get('/create', [EvaluationFormController::class, 'create'])->name('evaluation.create');
            Route::post('/store', [EvaluationFormController::class, 'store'])->name('evaluation.store');



            
Route::get('/evaluation/history/{department}', [EvaluationHistoryController::class, 'show'])->name('evaluation.history');

Route::get('Evaluation.HrHistory', [EvaluationFormController::class, 'index'])->name('Evaluation.HrHistory');

});

Route::prefix('student')->name('Student.')->group(function () {
    Route::get('/appointment', [StudentAppointmentController::class, 'index'])->name('Consform.Appointment');
    Route::post('/appointment', [StudentAppointmentController::class, 'store'])->name('Consform.Appointment.store');
    Route::get('/history', [StudentHistoryController::class, 'index'])->name('StudentHistory');

    Route::get('/consultation-notifications', [StudentCtNotificationController::class, 'index'])->name('consultation-notifications');
    Route::get('/notifications', [StudentCtNotificationController::class, 'index'])->name('StudentNotification');
    Route::post('/notifications/{id}/mark-as-read', [StudentCtNotificationController::class, 'markAsRead'])->name('markNotificationAsRead');
    Route::post('/notifications/mark-all-as-read', [StudentCtNotificationController::class, 'markAllAsRead'])->name('markAllNotificationsAsRead');

    // Add other student routes here
});

// Routes for Consultation
Route::prefix('consultation')->name('Consultation.')->middleware('role:Guidance')->group(function () {
    Route::get('/CtDashboard', [ConsultationDbController::class, 'index'])->name('CtDashboard');
    Route::get('/approval', [ConsultationApprovalController::class, 'index'])->name('CtApproval');
    Route::post('/approval/approve', [ConsultationApprovalController::class, 'approve'])->name('CtApproval.approve');
    Route::post('/approval/decline', [ConsultationApprovalController::class, 'decline'])->name('CtApproval.decline');
    Route::get('/history', [ConsultationHistoryController::class, 'index'])->name('CtHistory');
    Route::post('/busy-slot', [ConsultationCalendarController::class, 'storeBusySlot'])->name('store.busy.slot');

    Route::get('/CtNotification', [ConsultationNotificationController::class, 'index'])->name('CtNotification');
    Route::get('/overall-history', [ConsultationOverallHistoryController::class, 'index'])->name('Consultation.CtOverallHistory');
    Route::get('/program-history/{program}', [ConsultationOverallHistoryController::class, 'showProgramHistory'])->name('Consultation.CtProgramHistory');
    Route::get('/course-history/{program}/{course}', [ConsultationOverallHistoryController::class, 'showCourseHistory'])->name('Consultation.CtCourseHistory');
    Route::delete('/busy-slot/{id}', [ConsultationCalendarController::class, 'deleteBusySlot'])->name('consultation.delete.busy.slot');
    Route::post('/update-completion/{appointment}', [ConsultationHistoryController::class, 'updateCompletion'])->name('consultation.update-completion');

});

Route::middleware(['auth', 'checkDepartmentType'])->prefix('department-head')->group(function () {
    Route::get('/DpDashboard', [DpController::class, 'index'])->name('DepartmentHead.DpDashboard');
    Route::get('/DpCalendar', [DpCalendarController::class, 'index'])->name('DepartmentHead.DpCalendar');
    Route::get('/approval', [DpApprovalController::class, 'index'])->name('DepartmentHead.DpApproval');
    Route::post('/approval/approve', [DpApprovalController::class, 'approve'])->name('DepartmentHead.DpApproval.approve');
    Route::post('/approval/decline', [DpApprovalController::class, 'decline'])->name('DepartmentHead.DpApproval.decline');
    Route::get('/history', [DpHistoryController::class, 'index'])->name('DepartmentHead.DpHistory');
    Route::post('/busy-slot', [DpCalendarController::class, 'storeBusySlot'])->name('DepartmentHead.store.busy.slot');
    Route::delete('/busy-slot/{id}', [DpCalendarController::class, 'deleteBusySlot'])->name('DepartmentHead.delete.busy.slot');
    Route::get('/DpNotification', [DpNotificationController::class, 'index'])->name('DepartmentHead.DpNotification');
    Route::get('/overall-history', [DpOverallHistoryController::class, 'index'])->name('DepartmentHead.DpOverallHistory');
    Route::get('/program-history/{program}', [DpOverallHistoryController::class, 'showProgramHistory'])->name('DepartmentHead.DpProgramHistory');
    Route::get('/course-history/{program}/{course}', [DpOverallHistoryController::class, 'showCourseHistory'])->name('DepartmentHead.DpCourseHistory');
    Route::post('/update-completion/{appointment}', [DpHistoryController::class, 'updateCompletion'])->name('department-head.update-completion');
    Route::get('/notifications', [DpNotificationController::class, 'index'])->name('DepartmentHead.DpNotification');
    Route::post('/notifications/{id}/mark-as-read', [DpNotificationController::class, 'markAsRead'])->name('DepartmentHead.markNotificationAsRead');
    Route::post('/notifications/mark-all-as-read', [DpNotificationController::class, 'markAllAsRead'])->name('DepartmentHead.markAllNotificationsAsRead');

    Route::post('/busy-slot', [ConsultationCalendarController::class, 'storeBusySlot'])->name('DepartmentHead.store.busy.slot');

});

Route::get('/api/available-time-slots', [StudentAppointmentController::class, 'getAvailableTimeSlots'])->name('api.available-time-slots');

// Notification routes
Route::get('/notifications', [NotifyController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{notify}/mark-as-read', [NotifyController::class, 'markAsRead'])->name('notifications.mark-as-read');

Route::get('/superadmindashboard', [SuperAdminController::class, 'index'])->name('Superadmin.SuperAdminDashboard');


Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::get('/superadmin/manage', [SuperAdminController::class, 'manageAccounts'])->name('Superadmin.manage');
    Route::get('edit/{role}', [SuperAdminController::class, 'editAccount'])->name('Superadmin.edit');
    Route::put('update/{role}', [SuperAdminController::class, 'updateAccount'])->name('update');
   Route::delete('/superadmin/delete/{role}', [SuperAdminController::class, 'deleteAccount'])->name('Superadmin.delete-account');
});

Route::put('/edit/{role}', [SuperadminController::class, 'update'])->name('Superadmin.edit');

Route::get('/create', [SuperAdminController::class, 'createAccount'])->name('create'); // Route for showing the create form
Route::post('/create', [SuperAdminController::class, 'storeAccount'])->name('store'); // Route for storing the account