<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

// =============================
// INI ROUTING UNTUK SEMUA ORANG
// =============================
// Routing Home
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [ArticleController::class, 'getArticles'])->name('home');
// Routing Search Di Home
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Routing Buat Read More [Detail Articles]
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
// Routing Buat Ke Page Forums
Route::get('/forums', [ForumController::class, 'index'])->name('forum.show');

// ==================================
// INI ROUTING GUESS [GA PUNYA AKUN]
// ==================================
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AccountController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AccountController::class, 'register']);
    // Login
    Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AccountController::class, 'login']);
});

// ========================================
// INI ROUTING YG PUNYA ACCOUNT [UDH LOGIN]
// ========================================
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
    // Routing buat create post [Cuma role "professional" yg bisa access udh di check di home.blade.php]
    Route::get('/articles/new/create', [ArticleController::class, 'create'])->name('articles.new.create');
    // Buat Article
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    // Get Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    // Send Chat
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});
