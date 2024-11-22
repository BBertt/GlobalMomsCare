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
// Routing Search Bar + Kategory Di Home
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Routing Buat Read More [Detail Articles]
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Routing Buat Ke Page ==== FORUMS ====
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
// Routing Search Bar + Kategory Di  ==== FORUM ====
Route::get('/forums/search', [ForumController::class, 'search'])->name('forums.search');
// Routing Buat Read More [Detail ==== FORUM ====]
Route::get('/forums/detail/{id}', [ForumController::class, 'show'])->name('forums.show');

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
    // Routing buat create Article [Cuma role "professional" yg bisa access udh di check di home.blade.php]
    Route::get('/articles/new/create', [ArticleController::class, 'create'])->name('articles.new.create');
    // Simpen Article yang baru dibuat
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    // Routing Untuk Create Forum
    Route::get('/forums/new/create', [ForumController::class, 'create'])->name('forums.new.create');
    // Simpen Forum yang baru dibuat
    Route::post('/forums/store', [ForumController::class, 'store'])->name('forums.store');
    // Get Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    // Send Chat
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});
