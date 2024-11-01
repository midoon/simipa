<?php

use App\Http\Controllers\AdminController;
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
Route::get('/admin/teacher', [AdminTeacherController::class, 'index']);
