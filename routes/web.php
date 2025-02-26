<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::resource('posts', PostController::class)->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
