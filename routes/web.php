<?php

use Illuminate\Support\Facades\Route;

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
    return view('content\authentications\auth-login-basic');
});
Route::get('auth/login-basic', function () {
    return view('content\authentications\auth-login-basic');
});
Route::get('auth/register-basic', function () {
    return view('content\authentications\auth-register-basic');
});
Route::get('auth/forgot-password-basic', function () {
    return view('content\authentications\auth-forgot-password-basic');
});
