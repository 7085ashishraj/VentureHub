<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Make dashboard the networking feed
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    
    // Networking Feed (Posts)
    Route::resource('posts', PostController::class)->except(['index']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    
    // Collaboration Hub
    Route::resource('projects', ProjectController::class);
    
    // Events Module
    Route::resource('events', EventController::class);

    Route::get('/network', [ProfileController::class, 'index'])->name('network.index');
    Route::get('/network/{user}', [ProfileController::class, 'show'])->name('network.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
