<?php

use App\Http\Controllers\GitHubActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $githubData = (new GitHubActivityController)(request())->getData(true);
    return view('portfolio', compact('githubData'));
})->name('portfolio');

Route::redirect('/index.html', '/', 301);
Route::get('/github-activity', GitHubActivityController::class);
