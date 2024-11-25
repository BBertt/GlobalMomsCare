<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
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
    // Delete Article
    Route::delete('/articles/delete/{id}', [ArticleController::class, 'delete'])->name('articles.delete');
    // Pindah Ke Update Article Page
    Route::get('/article/update/{id}', [ArticleController::class, 'updatePage'])->name('articles.update.page');
    // Simpen Article yang udh di Update
    Route::put('/article/update/store/{id}', [ArticleController::class, 'update'])->name('articles.update');

    // Routing Untuk Create Forum
    Route::get('/forums/new/create', [ForumController::class, 'create'])->name('forums.new.create');
    // Simpen Forum yang baru dibuat
    Route::post('/forums/store', [ForumController::class, 'store'])->name('forums.store');
    // Delete Forums
    Route::delete('/forums/delete/{id}', [ForumController::class, 'delete'])->name('forums.delete');
    // Pindah ke Update Forum Page
    Route::get('/forums/update/{id}', [ForumController::class, 'updatePage'])->name('forums.update.page');
    // Simpen Forum yang di Update
    Route::put('/forums/update/store/{id}', [ForumController::class, 'update'])->name('forums.update');

    // Simpen Comment
    Route::post('/comment/store/{id}', [CommentController::class, 'store'])->name('comment.store');
    // Delete Comment [Dari Page Forumnya]
    Route::post('/comment/delete/{id}/{forumid}', [CommentController::class, 'delete'])->name('comment.delete');
    // Delete Comment [Dari Page Profile]
    Route::post('/comment/delete/{id}', [CommentController::class, 'deleteBackProfile'])->name('comment.delete.profile');

    //Open Profile Page
    Route::get('/profile' ,[AccountController::class, 'profile'])->name('profile.show');

    // Get Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    // Send Chat
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});


// CATATAN
// Klo mau pake DELETE method Example: Route::delete
// Di form harus ada "@method('DELETE')
// Note: Klo mau pake post biasa juga ttp jalan

// Klo mau pake PUT (Buat Update) method Example: Route::put
// Di form harus ada "@method('PUT')
// Note: Klo mau pake post biasa juga ttp jalan
