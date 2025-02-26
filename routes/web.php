<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::resource('posts', PostController::class)->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::get('/home/comments/{postId}', [CommentController::class, 'index'])->name('comments.index');
Route::post('/home/comments/{postId}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
