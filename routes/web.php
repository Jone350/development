<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

# Middleware group for guest users
Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [UserController::class, 'login'])
        ->name('user.login');

    Route::get('/password/reset', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/password/reset', [UserController::class, 'forgotPassword'])
        ->name('forgot-password');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [UserController::class, 'store'])
        ->name('register.store');
});

# Middleware group for authenticated users
Route::group(['middleware' => 'auth', 'session.timeout'], function () {
    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');

    Route::get('/home', function () {
        return view('users.home');
    })->name('home');
});
