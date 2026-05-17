<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return view('welcome');
    }
    return view('welcome-guest');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Make dashboard the networking feed
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    
    // Networking Feed (Posts)
    Route::resource('posts', PostController::class)->except(['index']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    
    // Collaboration Hub
    Route::resource('projects', ProjectController::class)->only(['index', 'store', 'show']);
    Route::post('/projects/{project}/join', [\App\Http\Controllers\ProjectController::class, 'join'])->name('projects.join');
    
    // Events Module
    Route::resource('events', EventController::class)->only(['index', 'store', 'show']);
    Route::post('/events/{event}/ticket', [\App\Http\Controllers\EventController::class, 'ticket'])->name('events.ticket');

    Route::get('/network', [ProfileController::class, 'index'])->name('network.index');
    Route::get('/network/{user}', [ProfileController::class, 'show'])->name('network.show');

    // Venture Rooms Phase 2
    Route::resource('venture-rooms', \App\Http\Controllers\VentureRoomController::class);
    Route::put('/lean-canvases/{lean_canva}', [\App\Http\Controllers\LeanCanvasController::class, 'update'])->name('lean-canvases.update');
    Route::post('/venture-rooms/{venture_room}/milestones', [\App\Http\Controllers\MilestoneController::class, 'store'])->name('milestones.store');
    Route::put('/milestones/{milestone}', [\App\Http\Controllers\MilestoneController::class, 'update'])->name('milestones.update');
    
    Route::get('/templates', [\App\Http\Controllers\DocumentTemplateController::class, 'index'])->name('templates.index');

    // Phase 3: The Trusted Exchange
    Route::resource('pitches', \App\Http\Controllers\PitchController::class)->except(['edit', 'update', 'destroy']);
    
    Route::post('/venture-rooms/{venture_room}/sweat-equity', [\App\Http\Controllers\SweatEquityTaskController::class, 'store'])->name('sweat-equity.store');
    Route::post('/sweat-equity/{task}/claim', [\App\Http\Controllers\SweatEquityTaskController::class, 'claim'])->name('sweat-equity.claim');
    Route::post('/sweat-equity/{task}/complete', [\App\Http\Controllers\SweatEquityTaskController::class, 'complete'])->name('sweat-equity.complete');

    Route::post('/users/{user}/endorse/{skill}', [\App\Http\Controllers\EndorsementController::class, 'store'])->name('endorsements.store');
    
    // Connections Management
    Route::post('/users/{user}/connect', [\App\Http\Controllers\ConnectionController::class, 'store'])->name('connections.store');
    Route::get('/connections', [\App\Http\Controllers\ConnectionController::class, 'index'])->name('connections.index');
    Route::patch('/connections/{connection}', [\App\Http\Controllers\ConnectionController::class, 'update'])->name('connections.update');
    Route::delete('/connections/{connection}', [\App\Http\Controllers\ConnectionController::class, 'destroy'])->name('connections.destroy');

    // Chat / Direct Messaging
    Route::get('/messages/{user?}', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{user}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
