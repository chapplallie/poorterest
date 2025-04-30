<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\CheckIfUserActive;
use App\Http\Controllers\MediaController;

Route::get('/',
    [MediaController::class, 'index'])->name('welcome');

Auth::routes();

Route::post('/categories',
    [CategoryController::class, 'store']); 

Route::put('/categories/{id}/deactivate',
    [CategoryController::class, 'deactivate']);

Route::get('/profile',
    [ProfileController::class, 'show'])->middleware('auth')->name('profile');

Route::get('/profile/add',
    [MediaController::class, 'createMedia'])->name('createMedia');

Route::get('/profile/edit',
    [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');


Route::get('/profile/medias',
    [MediaController::class, 'getUserMedia'])->name('userMedia');

Route::get('/profile/medias/edit/{media}',
    [MediaController::class, 'editMedia'])->name('editMedia');
    
Route::post('/todo/store',
[MediaController::class, 'uploadMedia'])->name('todo_store');

Route::put('update/{media}',
[MediaController::class, 'uploadMedia'])->name('media.update');

Route::put('/profile',
    [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
    
Route::delete('/profile',
    [ProfileController::class, 'deactivate'])->middleware('auth')->name('profile.deactivate');