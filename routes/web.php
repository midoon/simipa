<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGradeController;
use App\Http\Controllers\AdminGroupController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\LoginAdminController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view(welcome);
// });

Route::get('/', fn () => redirect('/login/teacher'));

Route::get('/register', fn () => view('auth.register'));

Route::get('/login/admin', [LoginAdminController::class, 'index']);
Route::post('/login/admin', [LoginAdminController::class, 'auth']);

Route::get('/login/teacher', fn () => view('auth.login_teacher'));

// admin
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

Route::get('/admin/schedule', [AdminScheduleController::class, 'index']);
Route::post('/admin/schedule', [AdminScheduleController::class, 'store']);
