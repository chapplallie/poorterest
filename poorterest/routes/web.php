<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\CheckIfUserActive;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/categories',
    [CategoryController::class, 'store']); 

Route::put('/categories/{id}/deactivate',
    [CategoryController::class, 'deactivate']);
Route::get('/profile',
    [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/profile/edit',
    [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile',
    [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile',
    [ProfileController::class, 'deactivate'])->middleware('auth')->name('profile.deactivate');