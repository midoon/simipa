<?php

use App\Http\Controllers\AdminActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGradeController;
use App\Http\Controllers\AdminGroupController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\AuthTeacherController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view(welcome);
// });

Route::get('/', fn () => redirect('/teacher/login'));


// auth admin
Route::get('/admin/login', [LoginAdminController::class, 'index']);
Route::post('/admin/login', [LoginAdminController::class, 'auth']);
Route::post('/admin/logout', [LoginAdminController::class, 'logout']);

Route::middleware([AdminMiddleware::class])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index']);

    //admin teacher
    Route::get('/admin/teacher', [AdminTeacherController::class, 'index']);
    Route::post('/admin/teacher', [AdminTeacherController::class, 'store']);
    Route::put('/admin/teacher/{teacherId}', [AdminTeacherController::class, 'update']);
    Route::delete('/admin/teacher/{teacherId}', [AdminTeacherController::class, 'destroy']);

    //admin grade
    Route::get('/admin/grade',[AdminGradeController::class, 'index']);
    Route::post('/admin/grade', [AdminGradeController::class, 'store']);
    Route::delete('/admin/grade/{kelasId}', [AdminGradeController::class, 'destroy']);
    Route::put('/admin/grade/{kelasId}', [AdminGradeController::class, 'update']);

    // admin group
    Route::post('/admin/group',[AdminGroupController::class, 'store']);
    Route::put('/admin/group/{groupId}', [AdminGroupController::class, 'update']);
    Route::delete('/admin/group/{groupId}',[AdminGroupController::class, 'destroy']);

    // admin student
    Route::get('/admin/student', [AdminStudentController::class, 'index']);
    Route::post('/admin/student', [AdminStudentController::class, 'store']);
    Route::delete('/admin/student/{studentId}', [AdminStudentController::class, 'destroy']);
    Route::put('/admin/student/{studentId}', [AdminStudentController::class, 'update']);


    //admin subject
    Route::get('/admin/subject', [AdminSubjectController::class, 'index']);
    Route::post('/admin/subject', [AdminSubjectController::class, 'store']);
    Route::delete('/admin/subject/{subjectId}', [AdminSubjectController::class, 'destroy']);
    Route::put('/admin/subject/{subjectId}', [AdminSubjectController::class, 'update']);

    // admin schedule
    Route::get('/admin/schedule', [AdminScheduleController::class, 'index']);
    Route::post('/admin/schedule', [AdminScheduleController::class, 'store']);
    Route::delete('/admin/schedule/{scheduleId}', [AdminScheduleController::class, 'destroy']);
    Route::put('/admin/schedule/{scheduleId}', [AdminScheduleController::class, 'update']);

    // admin activity
    Route::get('/admin/activity', [AdminActivityController::class, 'index']);
    Route::post('/admin/activity', [AdminActivityController::class, 'store']);
    Route::put('/admin/activity/{activityId}', [AdminActivityController::class, 'update']);
    Route::delete('/admin/activity/{activityId}', [AdminActivityController::class, 'destroy']);

    // admin payment
    Route::get('/admin/payment', [AdminPaymentController::class, 'index']);
    Route::post('/admin/payment', [AdminPaymentController::class, 'store']);
});
// admin


//  teacher auth
Route::get('/teacher/register', [AuthTeacherController::class, 'showRegister']);
Route::post('/teacher/register', [AuthTeacherController::class, 'register']);
Route::get('/teacher/login', [AuthTeacherController::class, 'showLogin']);
Route::post('/teacher/login', [AuthTeacherController::class, 'login']);

// Route
Route::get('/teacher/dashboard', [TeacherController::class, 'index']);
Route::get('/teacher/schedule', [TeacherController::class, 'showSchedule']);
Route::get('/teacher/attendance', [TeacherController::class, 'showAttendance']);
Route::get('/teacher/payment', [TeacherController::class, 'showPayment']);

Route::post('/teacher/attendance/create', [TeacherAttendanceController::class, 'index']);
Route::post('/teacher/attendance/store', [TeacherAttendanceController::class, 'store']);
Route::post('/teacher/attendance/read', [TeacherAttendanceController::class, 'showList']);
