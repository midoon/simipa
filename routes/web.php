<?php

use App\Http\Controllers\AdminActivityController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFeeController;
use App\Http\Controllers\AdminGradeController;
use App\Http\Controllers\AdminGroupController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminPaymentTypeController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\AuthTeacherController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherFeeController;
use App\Http\Controllers\TeacherPaymentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view(welcome);
// });

Route::get('/', fn () => redirect('/teacher/login'));


// auth admin
Route::get('/admin/login', [AdminAuthController::class, 'index']);
Route::post('/admin/login', [AdminAuthController::class, 'auth']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

Route::middleware([AdminMiddleware::class])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index']);

    //admin teacher
    Route::get('/admin/teacher', [AdminTeacherController::class, 'index']);
    Route::post('/admin/teacher', [AdminTeacherController::class, 'store']);
    Route::put('/admin/teacher/{teacherId}', [AdminTeacherController::class, 'update']);
    Route::delete('/admin/teacher/{teacherId}', [AdminTeacherController::class, 'destroy']);
    Route::get('/admin/teacher/template/donwload', [AdminTeacherController::class, 'downloadTemplate']);
    Route::post('/admin/teacher/upload', [AdminTeacherController::class, 'upload']);


    //admin grade
    Route::get('/admin/grade',[AdminGradeController::class, 'index']);
    Route::post('/admin/grade', [AdminGradeController::class, 'store']);
    Route::delete('/admin/grade/{kelasId}', [AdminGradeController::class, 'destroy']);
    Route::put('/admin/grade/{kelasId}', [AdminGradeController::class, 'update']);
    Route::get('/admin/grade/template/donwload', [AdminGradeController::class, 'downloadTemplate']);
    Route::post('/admin/grade/upload', [AdminGradeController::class, 'upload']);

    // admin group
    Route::post('/admin/group',[AdminGroupController::class, 'store']);
    Route::put('/admin/group/{groupId}', [AdminGroupController::class, 'update']);
    Route::delete('/admin/group/{groupId}',[AdminGroupController::class, 'destroy']);
    Route::get('/admin/group/template/donwload', [AdminGroupController::class, 'downloadTemplate']);
    Route::post('/admin/group/upload', [AdminGroupController::class, 'upload']);

    // admin student
    Route::get('/admin/student', [AdminStudentController::class, 'index']);
    Route::post('/admin/student', [AdminStudentController::class, 'store']);
    Route::delete('/admin/student/{studentId}', [AdminStudentController::class, 'destroy']);
    Route::put('/admin/student/{studentId}', [AdminStudentController::class, 'update']);
    Route::get('/admin/student/template/donwload', [AdminStudentController::class, 'downloadTemplate']);
    Route::post('/admin/student/upload', [AdminStudentController::class, 'upload']);


    //admin subject
    Route::get('/admin/subject', [AdminSubjectController::class, 'index']);
    Route::post('/admin/subject', [AdminSubjectController::class, 'store']);
    Route::delete('/admin/subject/{subjectId}', [AdminSubjectController::class, 'destroy']);
    Route::put('/admin/subject/{subjectId}', [AdminSubjectController::class, 'update']);
    Route::get('/admin/subject/template/donwload', [AdminSubjectController::class, 'downloadTemplate']);
    Route::post('/admin/subject/upload', [AdminSubjectController::class, 'upload']);

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
    Route::get('/admin/payment/type', [AdminPaymentTypeController::class, 'index']);
    Route::post('/admin/payment/type', [AdminPaymentTypeController::class, 'store']);
    Route::put('/admin/payment/type/{paymentTypeId}', [AdminPaymentTypeController::class, 'update']);
    Route::delete('/admin/payment/type/{paymentTypeId}', [AdminPaymentTypeController::class, 'destroy']);

    // Fee
    Route::post('/admin/payment/fee', [AdminFeeController::class, 'store']);
    Route::delete('/admin/payment/fee/{gradeFeeId}', [AdminFeeController::class, 'destroy']);
    Route::put('/admin/payment/fee/{gradeFeeId}', [AdminFeeController::class, 'update']);
});
// admin


//  teacher auth
Route::get('/teacher/register', [TeacherAuthController::class, 'showRegister']);
Route::post('/teacher/register', [TeacherAuthController::class, 'register']);
Route::get('/teacher/login', [TeacherAuthController::class, 'showLogin']);
Route::post('/teacher/login', [TeacherAuthController::class, 'login']);

Route::middleware([TeacherMiddleware::class])->group(function(){
    Route::delete('/teacher/logout', [TeacherAuthController::class, 'logout']);

    // Route
    Route::get('/teacher/dashboard', [TeacherController::class, 'index']);
    Route::get('/teacher/schedule', [TeacherController::class, 'showSchedule']);


    //Presensi
    Route::get('/teacher/attendance/read/filter', [TeacherAttendanceController::class, 'filterRead']);
    Route::get('/teacher/attendance/read', [TeacherAttendanceController::class, 'showRead']);
    Route::get('/teacher/attendance/create/filter', [TeacherAttendanceController::class, 'filterCreate']);
    Route::get('/teacher/attendance/create', [TeacherAttendanceController::class, 'showCreate']);
    Route::post('/teacher/attendance/store', [TeacherAttendanceController::class, 'store']);
    Route::put('/teacher/attendance/update', [TeacherAttendanceController::class, 'update']);
    Route::post('/teacher/attendance/delete', [TeacherAttendanceController::class, 'destroy']);
    Route::get('/teacher/attendance/report/filter', [TeacherAttendanceController::class, 'filterReport']);
    Route::get('/teacher/attendance/report/generate', [TeacherAttendanceController::class, 'report']);

    // Payment
    Route::get('/teacher/payment/create/filter', [TeacherPaymentController::class, 'filterCreate']);
    Route::get('/teacher/payment/create', [TeacherPaymentController::class, 'showCreate']);
    Route::post('/teacher/payment/create', [TeacherPaymentController::class, 'store']);

    Route::get('/teacher/payment/read/filter', [TeacherPaymentController::class, 'filterRead']);
    Route::get('/teacher/payment/read', [TeacherPaymentController::class, 'showRead']);
    Route::get('/teacher/payment/read/detail', [TeacherPaymentController::class, 'showDetail']);
    Route::delete('/teacher/payment/delete', [TeacherPaymentController::class, 'destroy']);
    Route::put('/teacher/payment/update/{paymentId}', [TeacherPaymentController::class, 'update']);

    Route::get('/teacher/payment/report/filter', [TeacherPaymentController::class, 'filterReport']);
    Route::get('/teacher/payment/report/generate', [TeacherPaymentController::class, 'report']);

    Route::get('/teacher/payment/fee/filter', [TeacherFeeController::class, 'filterRead']);
    Route::get('/teacher/payment/fee', [TeacherFeeController::class, 'showRead']);

});




// Route::post('/teacher/attendance/Edit', [TeacherAttendanceController::class, 'edit']);
