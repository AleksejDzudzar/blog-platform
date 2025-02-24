<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/posts', [PostController::class, 'index'])->name('api.posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('api.posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('api.posts.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');


    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('api.tags.show');

    Route::get('/profile', [UserController::class, 'profile'])->name('api.profile');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('api.profile.update');

});






