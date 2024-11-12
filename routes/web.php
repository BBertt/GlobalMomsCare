<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// Ini functional semua untuk guest[Tanpa akun]
Route::get('/', function () { return view('home'); })->name('home');
// Register
Route::get('/register', [AccountController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AccountController::class, 'register']);
// Login
Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login']);
// Logout
Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
