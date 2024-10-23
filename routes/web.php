<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login/admin', function () {
    return view('auth.login_admin');
});
