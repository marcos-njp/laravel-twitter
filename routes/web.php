<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <--- ADD THIS IMPORT

// Redirect root to the tweet feed if logged in, otherwise login page
Route::get('/', function () {
    // Changed auth()->check() to Auth::check()
    return Auth::check() ? redirect()->route('tweets.index') : view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tweets', TweetController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Like System Route
    Route::post('/tweets/{tweet}/like', [LikeController::class, 'store'])->name('tweets.like');
    // Public User Profile (Display stats and tweets)
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

require __DIR__ . '/auth.php';
