<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'portfolio')->name('portfolio');
Route::redirect('/index.html', '/', 301);
