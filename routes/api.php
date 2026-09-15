<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GitHubActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/github-activity', GitHubActivityController::class)->name('github.activity');

Route::middleware('throttle:chat')->group(function () {
    Route::post('/chat', ChatController::class)->name('chat');
    Route::post('/chat.php', ChatController::class);
});
