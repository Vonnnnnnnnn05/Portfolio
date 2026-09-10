<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:chat')->group(function () {
    Route::post('/chat', ChatController::class)->name('chat');
    Route::post('/chat.php', ChatController::class);
});
