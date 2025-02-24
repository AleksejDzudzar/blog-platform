<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');


    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::get('/profile/{user}', [UserController::class, 'show'])->name('profile.show');

    Route::get('/chats', [MessageController::class, 'conversations'])->name('chat.index');
    Route::get('/chat/{user}', [MessageController::class, 'index'])->name('chat.show');
    Route::post('/chat/send', [MessageController::class, 'store'])->name('chat.send');



});

Route::prefix('api')->group(base_path('routes/api.php'));





