<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseAuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('register', [FirebaseAuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [FirebaseAuthController::class, 'register'])->name('register');

Route::get('login', [FirebaseAuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [FirebaseAuthController::class, 'login'])->name('login');

Route::get('home', [FirebaseAuthController::class, 'home'])->name('home');
Route::post('logout', [FirebaseAuthController::class, 'logout'])->name('logout');
